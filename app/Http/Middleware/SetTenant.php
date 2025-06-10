<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SetTenant
{
   public function handle(Request $request, Closure $next)
{
    if (Auth::check()) {
        $user = Auth::user();

        if ($user && $user->tenant) {
            app()->instance('tenant_id', $user->tenant->id);
        } else {
            abort(403, 'No tenant information available.');
        }
    }

    return $next($request); // Always allow unauthenticated users to continue
}

}
