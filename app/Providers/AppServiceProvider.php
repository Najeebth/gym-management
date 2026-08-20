<?php

namespace App\Providers;

use App\Services\NavigationService;
use App\Services\WebsiteService;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;
use Livewire\Livewire;
use Livewire\Mechanisms\HandleRequests\EndpointResolver;

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
        // Livewire's update endpoint defaults to the `web` middleware group only.
        // Every component in this app lives behind an authenticated admin page,
        // so require `auth` here too rather than relying on each component to
        // check it individually.
        Livewire::setUpdateRoute(function ($handle) {
            return Route::post(EndpointResolver::updatePath(), $handle)->middleware(['auth']);
        });

        // Livewire only auto-injects its JS/CSS on pages that render a Livewire
        // component. But the shared layout's nav dropdown (Profile/Log Out menu)
        // uses Alpine on every page, and Alpine now only ships bundled inside
        // Livewire's script (app.js no longer loads it separately) — so without
        // this, the dropdown silently has no Alpine on any page but the one
        // that happens to render a <livewire:.../> component.
        Livewire::forceAssetInjection();

        // The public site's nav and footer partials are rendered on every
        // public page, so their data is supplied via a composer here rather
        // than being passed down from each individual controller action.
        View::composer('partials.site-nav', function ($view) {
            $view->with('navItems', app(NavigationService::class)->activeForPublicNav());
        });

        View::composer('partials.site-footer', function ($view) {
            $view->with('footer', app(WebsiteService::class)->getFooter());
            $view->with('navItems', app(NavigationService::class)->activeForPublicNav());
        });
    }
}
