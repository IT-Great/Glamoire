<?php

// namespace App\Providers;

// use Carbon\Carbon;
// use App\Models\Brand;
// use App\Models\CategoryProduct;
// use Illuminate\Support\Facades\URL;
// use Illuminate\Support\Facades\View;
// use Illuminate\Support\ServiceProvider;


// class AppServiceProvider extends ServiceProvider
// {
//     /**
//      * Register any application services.
//      */
//     public function register(): void
//     {
//         //
//     }

//     /**
//      * Bootstrap any application services.
//      */
//     public function boot(): void
//     {
//         Carbon::setLocale('id');
//         // View::composer('user.layouts.navbar', function ($view) {
//         //     $categories = CategoryProduct::where('parent_id', '=', NULL)->get();
//         //     $subCategories =  CategoryProduct::where('parent_id', '!=', NULL)->get();
//         //     $brands     = Brand::all();

//         //     // dd($subCategories);
//         //     $view->with('categories', $categories)->with('brands', $brands)->with('subCategories', $subCategories);
//         // });
//         // View::composer('user.layouts.footer', function ($view) {
//         //     $categories = CategoryProduct::where('parent_id', '=', NULL)->get();
//         //     $subCategories =  CategoryProduct::where('parent_id', '!=', NULL)->get();
//         //     $brands     = Brand::all();

//         //     // dd($subCategories);
//         //     $view->with('categories', $categories)->with('brands', $brands)->with('subCategories', $subCategories);
//         // });

//         View::composer(['user.layouts.navbar', 'user.layouts.footer'], function ($view) {
//             $categories = CategoryProduct::whereNull('parent_id')->get();
//             $subCategories = CategoryProduct::whereNotNull('parent_id')->get();
//             $brands = Brand::all();

//             $view->with(compact('categories', 'subCategories', 'brands'));
//         });

//         // if (config('app.env') !== 'http://localhost') {
//         //     URL::forceScheme('http');
//         // }
//         if (config('app.env') !== 'production') {
//             URL::forceScheme('http');
//         }
//         if (config('app.env') === 'production') {
//             URL::forceScheme('https');
//         }
//     }
// }

namespace App\Providers;

use Carbon\Carbon;
use App\Models\Brand;
use App\Models\Setting;
use App\Models\CategoryProduct;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;

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
        // 1. Pengaturan Bahasa Waktu
        Carbon::setLocale('id');

        // 2. View Composer untuk Navbar dan Footer (Kode lama Anda)
        View::composer(['user.layouts.navbar', 'user.layouts.footer'], function ($view) {
            $categories = CategoryProduct::where('parent_id', '=', NULL)->get();
            $subCategories = CategoryProduct::where('parent_id', '!=', NULL)->get();
            $brands = Brand::all();

            $view->with(compact('categories', 'brands', 'subCategories'));
        });

        // 3. Paksa HTTPS jika di Production (Kode lama Anda)
        if (config('app.env') === 'production') {
            URL::forceScheme('https');
        }

        // =========================================================
        // 4. OVERRIDE PENGATURAN DINAMIS DARI DATABASE
        // =========================================================
        
        // PENTING: Gunakan Schema::hasTable agar saat pertama kali 
        // menjalankan 'php artisan migrate', sistem tidak error mencari tabel
        if (Schema::hasTable('settings')) {
            
            // Ambil semua data pengaturan dari database
            $settings = Setting::pluck('value', 'key')->toArray();

            // --- A. OVERRIDE KONFIGURASI EMAIL (SMTP) ---
            if (isset($settings['mail_host'])) {
                Config::set('mail.mailers.smtp.host', $settings['mail_host']);
            }
            if (isset($settings['mail_port'])) {
                Config::set('mail.mailers.smtp.port', $settings['mail_port']);
            }
            if (isset($settings['mail_username'])) {
                Config::set('mail.mailers.smtp.username', $settings['mail_username']);
            }
            if (isset($settings['mail_password']) && !empty($settings['mail_password'])) {
                Config::set('mail.mailers.smtp.password', $settings['mail_password']);
            }
            if (isset($settings['mail_encryption'])) {
                Config::set('mail.mailers.smtp.encryption', $settings['mail_encryption']);
            }
            if (isset($settings['mail_from_name'])) {
                Config::set('mail.from.name', $settings['mail_from_name']);
            }
            if (isset($settings['contact_email'])) {
                Config::set('mail.from.address', $settings['contact_email']);
            }

            // --- B. OVERRIDE KONFIGURASI PRISMA LINK ---
            if (isset($settings['prismalink_mode'])) {
                Config::set('services.prismalink.mode', $settings['prismalink_mode']);
            }
            if (isset($settings['prismalink_base_url'])) {
                Config::set('services.prismalink.base_url', $settings['prismalink_base_url']);
            }
            if (isset($settings['prismalink_merch_id'])) {
                Config::set('services.prismalink.merch_id', $settings['prismalink_merch_id']);
            }
            if (isset($settings['prismalink_merch_key_id'])) {
                Config::set('services.prismalink.merch_key_id', $settings['prismalink_merch_key_id']);
            }
            if (isset($settings['prismalink_secret_key']) && !empty($settings['prismalink_secret_key'])) {
                Config::set('services.prismalink.secret_key', $settings['prismalink_secret_key']);
            }
            if (isset($settings['prismalink_mac'])) {
                Config::set('services.prismalink.mac', $settings['prismalink_mac']);
            }
            if (isset($settings['prismalink_transaction_api'])) {
                Config::set('services.prismalink.transaction_api', $settings['prismalink_transaction_api']);
            }

            // --- C. OVERRIDE PENGATURAN SISTEM & TIMEZONE ---
            if (isset($settings['timezone'])) {
                Config::set('app.timezone', $settings['timezone']);
                date_default_timezone_set($settings['timezone']); // Set timezone PHP
            }
        }
    }
}