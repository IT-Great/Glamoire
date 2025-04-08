<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use App\Models\CategoryProduct;
use App\Models\Brand;
use Illuminate\Support\Facades\URL;


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
        View::composer('user.layouts.navbar', function ($view) {
            $categories = CategoryProduct::where('parent_id', '=', NULL)->get();
            $subCategories =  CategoryProduct::where('parent_id', '!=', NULL)->get();
            $brands     = Brand::all();

            // dd($subCategories);
            $view->with('categories', $categories)->with('brands', $brands)->with('subCategories', $subCategories);
        });
        View::composer('user.layouts.footer', function ($view) {
            $categories = CategoryProduct::where('parent_id', '=', NULL)->get();
            $subCategories =  CategoryProduct::where('parent_id', '!=', NULL)->get();
            $brands     = Brand::all();

            // dd($subCategories);
            $view->with('categories', $categories)->with('brands', $brands)->with('subCategories', $subCategories);
        });
        if (config('app.env') !== 'http://localhost') {
            URL::forceScheme('http');
        }
    }
}
