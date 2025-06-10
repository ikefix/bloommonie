<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\ServiceProvider;

use App\Http\Controllers\AdminController;
use App\Http\Controllers\ManagerController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\PurchaseItemController;
use App\Http\Controllers\ShopController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\ProductPermissionController;
use App\Http\Controllers\StockTransferController;
use App\Http\Controllers\CategoryController;



/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// Public routes (no tenant required)
Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

// Home route accessible without tenant context (optional)
Route::get('/home', [PurchaseItemController::class, 'index'])->name('home');


// Routes that require authentication AND tenant context
Route::middleware(['auth', 'setTenant'])->group(function () {

    // Admin routes
    Route::middleware('role:admin')->group(function () {
        Route::get('/admin', [AdminController::class, 'index']);
        Route::get('/admin-dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');

        Route::get('/admin/manage-roles', [RoleController::class, 'index'])->name('admin.manage_roles');
        Route::patch('/admin/update-role/{id}', [RoleController::class, 'updateRole'])->name('admin.updateRole');

        Route::get('/admin/register', [AdminController::class, 'showRegisterForm'])->name('admin.register');
        Route::post('/admin/register', [AdminController::class, 'storeStaff'])->name('admin.storeStaff');

        Route::get('/admin/profile', [AdminController::class, 'editProfile'])->name('admin.profile');
        Route::post('/admin/profile/update', [AdminController::class, 'updateProfile'])->name('admin.profile.update');

        Route::get('/admin/sales', [AdminController::class, 'sales'])->name('admin.sales');
        Route::get('/admin/filter-sales', [AdminController::class, 'filterSales'])->name('admin.sales.filter');
        Route::delete('/admin/users/{id}', [AdminController::class, 'deleteUser'])->name('admin.deleteUser');

        Route::get('/admin/manager-permissions', [ProductPermissionController::class, 'show'])->name('admin.manager-permissions');
        Route::post('/admin/grant-product-access', [ProductPermissionController::class, 'grantAccess'])->name('admin.give-product-access');
        Route::post('/admin/revoke-product-access', [ProductPermissionController::class, 'revokeAccess'])->name('admin.revoke-product-access');
    });

    // Manager routes
    Route::middleware('role:manager')->group(function () {
        Route::get('/manager-dashboard', [ManagerController::class, 'dashboard'])->name('manager.jop');

        Route::get('/manager/sales', [PurchaseItemController::class, 'managersales'])->name('manage.sales');
        Route::get('/manager/profile', [ManagerController::class, 'editProfile'])->name('manager.profile');
        Route::post('/manager/profile/update', [ManagerController::class, 'updateProfile'])->name('manager.profile.update');

        Route::get('/manager/register', [ManagerController::class, 'showRegisterForm'])->name('manager.register');
        Route::post('/manager/register', [ManagerController::class, 'storeStaff'])->name('manager.storeStaff');

        Route::get('/manager/manage-roles', [ManagerController::class, 'role'])->name('manager.manage_role');
        Route::patch('/manager/update-role/{id}', [ManagerController::class, 'updateRole'])->name('manager.updateRole');

        Route::get('/manager/products', [ManagerController::class, 'viewProducts'])->name('manager.product');
    });

    // Product routes
    Route::get('/products/create', [ProductController::class, 'create'])->name('products.create')->middleware('admin');
    Route::post('/products', [ProductController::class, 'store'])->name('products.store');
    Route::put('/products/{id}', [ProductController::class, 'update'])->name('products.update')->middleware('admin');
    Route::delete('/products/{id}', [ProductController::class, 'destroy'])->name('products.destroy');

    Route::get('/products/by-category/{categoryId}', [ProductController::class, 'getByCategory']);
    Route::get('/products/search-suggestions', [ProductController::class, 'searchSuggestions']);
    Route::get('/products/search', [ProductController::class, 'liveSearch'])->name('products.live-search');

    // Category routes
    Route::resource('categories', CategoryController::class);

    // Shop routes
    Route::get('/shops/create', [ShopController::class, 'index'])->name('shops.create');
    Route::post('/shops', [ShopController::class, 'store'])->name('shops.store');
    Route::get('/shops/{id}/edit', [ShopController::class, 'edit'])->name('shops.edit');
    Route::put('/shops/{id}', [ShopController::class, 'update'])->name('shops.update');
    Route::delete('/shops/{id}', [ShopController::class, 'destroy'])->name('shops.destroy');

    // Stock Transfer
    Route::get('/stock-transfers/create', [StockTransferController::class, 'create'])->name('stock-transfers.create');
    Route::post('/stock-transfers', [StockTransferController::class, 'store'])->name('stock-transfers.store');
    Route::get('/products-by-shop/{shopId}', [StockTransferController::class, 'getProductsByShop']);

    // PurchaseItem / Cashier routes
    Route::get('/purchaseitem/products/{categoryId}', [PurchaseItemController::class, 'getProductsByCategory']);
    Route::post('/purchaseitem/store', [PurchaseItemController::class, 'store'])->name('purchaseitem.store');
    Route::get('/purchaseitem/receipt/{id}', [PurchaseItemController::class, 'showReceipt'])->name('purchaseitem.receipt');

    Route::get('/cashiersales', [PurchaseItemController::class, 'cashiersales'])->name('cashiersales');

    // Notifications for admin and manager
    Route::get('/notifications', [NotificationController::class, 'index'])->name('user.notifications');
    Route::get('/notifications/{notification}/mark-read', [NotificationController::class, 'markAsRead'])->name('notifications.markAsRead');
    Route::delete('/notifications/{notification}', [NotificationController::class, 'destroy'])->name('notifications.delete');

    // API route for product stock
    Route::get('/api/product-stock/{id}', function ($id) {
        $product = \App\Models\Product::findOrFail($id);
        return response()->json(['stock' => $product->stock_quantity]);
    });
});
