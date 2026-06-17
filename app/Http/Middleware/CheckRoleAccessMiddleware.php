<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Models\Menu;

class CheckRoleAccessMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  Closure(Request): (Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $user = auth()->user();

        if (!$user) {
            abort(403);
        }

        // Get current route path
       $currentRoute = $request->route()->getName();
       
       if (!$currentRoute) {
            abort(403);
        }
        // Find menu by route
        $menu = Menu::where('menu_route', $currentRoute)->first();        
        if (!$menu) {
            abort(403, 'Menu not defined');
        }

        // Get user role IDs
        $roleIds = $user->roles->pluck('id');

        // Check access via role_menu
        $hasAccess = $menu->roles()
            ->whereIn('roles.id', $roleIds)
            ->exists();

        if (!$hasAccess) {
            abort(403, 'Unauthorized');
        }

        return $next($request);
    }
}
