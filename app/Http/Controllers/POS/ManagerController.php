<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Category;
use App\Models\Shop;
use App\Models\Product;
use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Notifiable;
use App\Models\PurchaseItem;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class ManagerController extends Controller
{
    public function index()
    {
        if (Auth::user()->role !== 'manager') {
            return redirect()->route('cashier-dashboard')->with('error', 'Unauthorized Access');
        }

        $users = User::where('role', '!=', 'manager')->get(); // Exclude admin users
        return view('manager.dashboard');
    }

    public function notifications()
    {
        $user = Auth::user();  // Get the logged-in admin
        $notifications = $user->notifications()->latest()->get();  // Get all notifications (you can also add filtering here)

        // Return as JSON response or use view if you're displaying them on the page
        return response()->json($notifications);
    }

    /**
     * Show the notifications page for the manager.
     */
    public function getNotifications()
    {
        $user = Auth::user();

        // Fetch unread notifications (or all notifications) for the admin
        $notifications = $user->notifications;

        return view('manager.notification', compact('notifications'));
    }
    

    public function editProfile()
    {
        $admin = Auth::user(); // Get the currently logged-in admin
        return view('manager.profile', compact('admin'));
    }

    public function updateProfile(Request $request)
    {
        $admin = Auth::user(); // Get logged-in admin

        // Validate input
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $admin->id, // Ignore current admin's email
            'password' => 'nullable|min:6|confirmed'
        ]);

        // Update name and email
        $admin->name = $request->name;
        $admin->email = $request->email;

        // If password is provided, update it
        if ($request->password) {
            $admin->password = bcrypt($request->password);
        }

        $admin->save();

        return redirect()->route('manager.profile')->with('success', 'Profile updated successfully.');
    }

    public function showRegisterForm()
    {
        if (Auth::user()->role !== 'manager') {
            return redirect()->route('cashier-dashboard')->with('error', 'Unauthorized Access');
        }

        $shops = Shop::all(); // or filter to specific ones if needed
        return view('manager.register', compact('shops',));
    }

    public function storeStaff(Request $request)
    {
        // Validate the input
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6|confirmed',
            'role' => 'required|in:cashier,manager',
            'shop_id' => 'required_unless:role,admin|exists:shops,id',
        ]);
    
        // Create the new user
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password), // Hash password
            'role' => $request->role,
            'shop_id' => $request->shop_id, // Store id is saved here for cashiers
        ]);
    
        return redirect()->route('manager.register')->with('success', 'Staff registered successfully.');
    }

    public function role()
    {
        if (Auth::user()->role !== 'manager') {
            return abort(403, 'Unauthorized action.');
        }
    
        // ✅ Show only cashiers, not other managers or admins
        $users = User::where('role', 'cashier')->get();
    
        return view('manager.manage-role', compact('users'));
    }
    

    public function updateRole(Request $request, $id)
    {
        if (Auth::user()->role !== 'manager') {
            return abort(403, 'Unauthorized action.');
        }

        $user = User::findOrFail($id);
        $user->role = $request->role;
        $user->save();

        return redirect()->back()->with('success', 'User role updated successfully.');
    }

    public function viewProducts()
    {
        if (Auth::user()->role !== 'manager') {
            abort(403, 'Unauthorized access');
        }
    
        // Fetch categories
        $categories = Category::all();
    
        // Fetch products
        $products = Product::with('category')->paginate(10);
    
        // Fetch shops
        $shops = Shop::all();  // Assuming the manager has access to all shops, adjust if needed
    
        // Return the view with the necessary data
        return view('manager.product', compact('products', 'categories', 'shops'));
    }
    
    
    // public function showProductForm()
    // {
    //     if (Auth::user()->role !== 'manager') {
    //         return redirect()->route('dashboard')->with('error', 'You do not have access.');
    //     }

    //     $categories = Category::all();
    //     return view('manager.product', compact('categories'));
    // }

//     public function store(Request $request)
// {
//     $user = Auth::user();

//     // Authorization logic
//     if ($user->role === 'manager') {
//         $hasPermission = \App\Models\ProductPermission::where('manager_id', $user->id)->exists();

//         if (!$hasPermission) {
//             abort(403, 'You are not allowed to add products.');
//         }
//     } elseif ($user->role !== 'admin') {
//         abort(403, 'Unauthorized action.');
//     }

//     // Validation
//     $request->validate([
//         'category_id' => 'required|exists:categories,id',
//         'name' => 'required|string|max:255',
//         'price' => 'required|numeric|min:0',
//         'cost_price' => 'required|numeric|min:0',
//         'stock_quantity' => 'required|integer|min:0',
//     ]);

//     // Product creation
//     $product = Product::create($request->all());

//     // Check and notify if stock is low
//     $this->checkStockNotification($product);

//     session()->flash('success', 'Product stocked successfully!');
//     return redirect()->route('manager.product');
// }


public function dashboard()
{   
    // Start of the week (Monday)
    $startOfWeek = Carbon::now()->startOfWeek(); // default is Monday
    $endOfWeek = Carbon::now()->endOfWeek();     // Sunday
    $today = Carbon::today();

    // 💸 Total sales today
    $totalSalesThisWeek = PurchaseItem::whereBetween('created_at', [$startOfWeek, $endOfWeek])
    ->sum('total_price');

    // 💰 Revenue today (same for now)
    $totalRevenueToday =  PurchaseItem::whereDate('created_at', $today)
    ->sum('total_price');

    // 📦 Count of products still in stock
    $productsInStock = Product::where('stock_quantity', '>', 0)->count();

    // 🧾 Top selling products *for today only*
    $topSelling = PurchaseItem::whereDate('created_at', $today)
        ->select('product_id', DB::raw('SUM(quantity) as total_sold'))
        ->groupBy('product_id')
        ->orderByDesc('total_sold')
        ->with('product') // eager load product
        ->take(5)
        ->get();

    // 🥧 Pie chart data
    $topSellingProductNames = [];
    $topSellingProductSales = [];

    foreach ($topSelling as $item) {
        $topSellingProductNames[] = $item->product->name ?? 'Unknown';
        $topSellingProductSales[] = $item->total_sold;
    }

    // 📈 Sales trend over the last 7 days
    $salesTrend = PurchaseItem::select(
            DB::raw('DATE(created_at) as date'),
            DB::raw('SUM(total_price) as total')
        )
        ->whereDate('created_at', '>=', now()->subDays(6))
        ->groupBy('date')
        ->orderBy('date')
        ->get();

    $salesTrendLabels = [];
    $salesTrendData = [];

    $dates = collect(range(0, 6))->map(function ($daysAgo) {
        return Carbon::today()->subDays($daysAgo)->format('Y-m-d');
    })->reverse();

    foreach ($dates as $date) {
        $salesTrendLabels[] = Carbon::parse($date)->format('M d');
        $daySale = $salesTrend->firstWhere('date', $date);
        $salesTrendData[] = $daySale ? $daySale->total : 0;
    }

    return view('manager.dashboard', compact(
        'totalSalesThisWeek',
        'totalRevenueToday',
        'productsInStock',
        'topSelling',
        'topSellingProductNames',
        'topSellingProductSales',
        'salesTrendLabels',
        'salesTrendData'
    ));
}
}
