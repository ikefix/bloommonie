<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Models\Tenant;

class SetTenant
{
    public function handle(Request $request, Closure $next)
    {
        $host = $request->getHost(); // e.g. shop1.bloommonie.com
        $mainDomain = config('app.main_domain', 'bloommonie.com');

        // Extract subdomain
        $subdomain = str_replace('.' . $mainDomain, '', $host);

        // Find tenant by subdomain
        $tenant = Tenant::where('domain', $host)->first();

        if (!$tenant) {
            \Log::info('Tenant not found for domain: ' . $host); 
            abort(403, 'Tenant not found.');
        }

        // Share tenant globally (optional)
        app()->instance('tenant', $tenant);

        // You can also set DB context or use the tenant ID in queries
        // e.g. use global scopes or manually inject $tenant->id

        return $next($request);
    }
}
