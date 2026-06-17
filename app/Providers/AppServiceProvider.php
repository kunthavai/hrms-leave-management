<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use Illuminate\Pagination\Paginator;
use App\Models\Menu;
class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Paginator::useBootstrap();
        View::composer('*', function ($view) {

            if (auth()->check()) {

                $roleIds = auth()->user()
                 ->roles()
                 ->pluck('roles.id');

                $menus = Menu::with([
                    'subMenus' => function ($q) use ($roleIds) {
                        $q->where('show_in_sidebar', 1)
                        ->where('status', 1)
                        ->whereHas('roles', function ($roleQuery) use ($roleIds) {

                            $roleQuery->whereIn(
                                'roles.id',
                                $roleIds
                            );

                        })
                        ->orderBy('menu_order');
                    }
                ])
                ->whereNull('parent_id')
                ->where('show_in_sidebar', 1)
                ->where('status', 1)
                ->whereHas('roles', function ($q) use ($roleIds) {

                    $q->whereIn('roles.id', $roleIds);

                })
                ->orderBy('menu_order')
                ->get();

                $view->with('menus', $menus);
            }
        });
    }
}
