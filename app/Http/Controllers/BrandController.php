<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Models\Cart;
use App\Models\Cart_item;
use App\Models\Wishlist;
use App\Models\Promo;
use App\Models\Product;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\ValidationException;

class BrandController extends Controller
{
    // BRAND
    public function indexBrand(Request $request)
    {
        // Mengambil brand beserta jumlah produk yang terkait
        $brands = Brand::withCount('products')
            ->orderBy('created_at', 'desc')
            ->paginate(100);

        return view('admin.brand.index', [
            'brands' => $brands,
        ]);
    }


    public function searchBrands(Request $request)
    {
        $query = $request->get('search');
        $brands = Brand::where('name', 'like', "%{$query}%")->paginate(10);

        return response()->json([
            'brands' => $brands->items(), // Hanya ambil item dari paginasi
            'pagination' => (string) $brands->links()->render()
        ]);
    }

    public function createBrand()
    {
        return view('admin.brand.create');
    }

    public function storeBrand(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'description' => 'required',
            'brand_logo' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        // Generate unique brand code based on the brand name
        $brandCode = $this->generateBrandCode($request->name);

        $imagePath = null;
        if ($request->hasFile('brand_logo')) {
            $image = $request->file('brand_logo');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $imagePath = $image->storeAs('brand_logos', $imageName, 'public');
        }

        $brand = Brand::create([
            'name' => $request->name,
            'description' => $request->description,
            'brand_logo' => $imagePath,
            'brand_code' => $brandCode,
        ]);

        // Check if the request is AJAX
        if ($request->ajax()) {
            return response()->json([
                'success' => true,
                'data' => $brand, // Return brand data including the new ID
                'message' => 'Brand has been added successfully!',
            ]);
        }

        // Fallback for non-AJAX requests (if needed)
        return redirect()->route('index-brand-admin')->with('success', 'Brand created successfully!');
    }

    private function generateBrandCode($brandName)
    {
        // Ambil tiga huruf pertama dari nama merek dan ubah menjadi huruf kapital
        $prefix = strtoupper(substr($brandName, 0, 3));

        // Jika nama brand kurang dari 3 karakter, tambahkan huruf 'X' sebagai pengisi
        $prefix = str_pad($prefix, 3, 'X');

        // Generate tiga digit angka acak
        $randomNumbers = rand(100, 999);

        // Gabungkan tiga huruf dari nama brand dan tiga digit angka acak
        $brandCode = $prefix . $randomNumbers;

        // Pastikan kode tersebut unik dalam database
        while (Brand::where('brand_code', $brandCode)->exists()) {
            $randomNumbers = rand(100, 999);  // Generate ulang angka acak jika kode tidak unik
            $brandCode = $prefix . $randomNumbers;
        }

        return $brandCode;
    }



    public function detailBrand($id)
    {
        $brand = Brand::find($id);

        if (!$brand) {
            return redirect()->route('index-brand-admin')->with('error', 'Brand not found');
        }

        return view('admin.brand.edit', compact('brand'));
    }

    public function updateBrandAdmin(Request $request, $id)
    {
        $brand = Brand::find($id);
        if (!$brand) {
            return redirect()->route('admin.brand.index')->with('error', 'Brand not found');
        }

        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required',
            'brand_logo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $brand->name = $validatedData['name'];
        $brand->description = $validatedData['description'];

        if ($request->hasFile('brand_logo')) {
            // Hapus gambar lama jika ada
            if ($brand->brand_logo && Storage::disk('public')->exists($brand->brand_logo)) {
                Storage::disk('public')->delete($brand->brand_logo);
            }

            // Upload gambar baru ke storage/app/public/brand_logos
            $image = $request->file('brand_logo');
            $imagePath = $image->store('brand_logos', 'public'); // menyimpan ke disk 'public'
            $brand->brand_logo = $imagePath; // simpan path-nya seperti 'brand_logos/nama.jpg'
        }


        $brand->save();

        return redirect()->route('index-brand-admin')->with('success', 'Brand updated successfully');
    }

    public function showBrand($id)
    {
        $brand = Brand::findOrFail($id);

        // If the brand logo is a path, convert it to a full URL
        if ($brand->brand_logo) {
            // Assuming the logo is stored in the public storage
            $brand->brand_logo = asset('storage/' . $brand->brand_logo);
        }

        return response()->json($brand);
    }


    public function deleteBrand($id)
    {
        $brand = Brand::find($id);

        if (!$brand) {
            return response()->json([
                'success' => false,
                'message' => 'Brand not found.'
            ]);
        }

        // Hapus logo brand dari folder storage
        if (!empty($brand->brand_logo) && Storage::disk('public')->exists($brand->brand_logo)) {
            Storage::disk('public')->delete($brand->brand_logo);
        }

        // Hapus produk dari database
        $brand->delete();

        return response()->json([
            'success' => true,
            'message' => 'Brand deleted successfully.'
        ]);
    }

    // AKSES USER 
    public function brands($name)
    {
        $userId = session('id_user');

        if ($userId) {
            $cartId = Cart::where('user_id', $userId)->value('id');
            $cartItems = Cart_item::where('cart_id', $cartId)->get();
            $wishlists = Wishlist::where('user_id', $userId)->get();

            $brands = Brand::where('name', $name)
                ->with(['products' => function ($query) {
                    // Load promos for products, but allow products without promos to be included
                    $query->with(['promos' => function ($promoQuery) {
                        $promoQuery->select('promos.*', 'promo_products.discounted_price')
                            ->whereRaw("STR_TO_DATE(SUBSTRING_INDEX(date_range, ' - ', 1), '%Y-%m-%d') <= ?", [Carbon::today()])
                            ->whereRaw("STR_TO_DATE(SUBSTRING_INDEX(date_range, ' - ', -1), '%Y-%m-%d') >= ?", [Carbon::today()])
                            ->where('promo_products.discounted_price', '>', 0);
                    }]);
                }])
                ->get();

            $idBrand = Brand::where('name', $name)->value('id');

            $brandVouchers = Promo::where('type', '=', 'brand voucher')
                ->where('brand_id', $idBrand)
                ->whereColumn('total_used', '<', 'usage_quota')
                ->whereRaw("STR_TO_DATE(SUBSTRING_INDEX(date_range, ' - ', 1), '%Y-%m-%d') <= ?", [Carbon::today()])
                ->whereRaw("STR_TO_DATE(SUBSTRING_INDEX(date_range, ' - ', -1), '%Y-%m-%d') >= ?", [Carbon::today()])
                ->get();

            $newestProducts = Product::where('brand_id', $idBrand)
                ->with(['promos' => function ($promoQuery) {
                    $promoQuery->select('promos.*', 'promo_products.discounted_price')
                        ->wherePivot('discounted_price', '>', 0)
                        ->whereRaw("STR_TO_DATE(SUBSTRING_INDEX(date_range, ' - ', 1), '%Y-%m-%d') <= ?", [Carbon::today()])
                        ->whereRaw("STR_TO_DATE(SUBSTRING_INDEX(date_range, ' - ', -1), '%Y-%m-%d') >= ?", [Carbon::today()]);
                }])
                ->orderBy('created_at', 'desc')
                ->get();

            foreach ($newestProducts as $newproduct) {
                $variationPrices = $newproduct->productVariations->pluck('variant_price')->unique()->sort();

                if ($variationPrices->count() > 1) {
                    // Jika ada lebih dari satu harga unik, buat rentang harga
                    $newproduct->priceVariation = 'Rp' . number_format($variationPrices->first(), 0, ',', '.')
                        . ' - Rp' . number_format($variationPrices->last(), 0, ',', '.');
                } elseif ($variationPrices->count() == 0) {
                    $newproduct->priceVariation = null;
                } else {
                    // Jika semua harga variasi sama, cukup tampilkan satu harga
                    $newproduct->priceVariation = 'Rp' . number_format($variationPrices->first(), 0, ',', '.');
                }
            }

            $topProducts = Product::where('brand_id', $idBrand)
                ->with(['promos' => function ($promoQuery) {
                    $promoQuery->select('promos.*', 'promo_products.discounted_price')
                        ->wherePivot('discounted_price', '>', 0)
                        ->whereRaw("STR_TO_DATE(SUBSTRING_INDEX(date_range, ' - ', 1), '%Y-%m-%d') <= ?", [Carbon::today()])
                        ->whereRaw("STR_TO_DATE(SUBSTRING_INDEX(date_range, ' - ', -1), '%Y-%m-%d') >= ?", [Carbon::today()]);
                }])
                ->orderBy('sale', 'desc') // Order products by sale within the products relation
                ->get();

            foreach ($topProducts as $topproduct) {
                $variationPrices = $topproduct->productVariations->pluck('variant_price')->unique()->sort();

                if ($variationPrices->count() > 1) {
                    // Jika ada lebih dari satu harga unik, buat rentang harga
                    $topproduct->priceVariation = 'Rp' . number_format($variationPrices->first(), 0, ',', '.')
                        . ' - Rp' . number_format($variationPrices->last(), 0, ',', '.');
                } elseif ($variationPrices->count() == 0) {
                    $topproduct->priceVariation = null;
                } else {
                    // Jika semua harga variasi sama, cukup tampilkan satu harga
                    $topproduct->priceVariation = 'Rp' . number_format($variationPrices->first(), 0, ',', '.');
                }
            }

            $allbrand = Brand::where('name', $name)
                ->with(['products' => function ($query) {
                    // Load promos for products, but allow products without promos to be included   
                    $query->with(['promos' => function ($promoQuery) {
                        $promoQuery->select('promos.*', 'promo_products.discounted_price')
                            ->wherePivot('discounted_price', '>', 0)
                            ->whereRaw("STR_TO_DATE(SUBSTRING_INDEX(date_range, ' - ', 1), '%Y-%m-%d') <= ?", [Carbon::today()])
                            ->whereRaw("STR_TO_DATE(SUBSTRING_INDEX(date_range, ' - ', -1), '%Y-%m-%d') >= ?", [Carbon::today()]);
                    }]);
                }])
                ->first();

            // dd($brand);
            return view('user.component.brand', [
                'countBrand' => count($allbrand->products),
                'brands'    => $brands,
                'newest'    => $newestProducts,
                'top'       => $topProducts,
                'cartItems' => $cartItems,
                'wishlists' => $wishlists,
                'brandVouchers' => $brandVouchers,
            ]);
        } else {
            $brands = Brand::where('name', $name)
                ->with(['products' => function ($query) {
                    // Load promos for products, but allow products without promos to be included
                    $query->with(['promos' => function ($promoQuery) {
                        $promoQuery->select('promos.*', 'promo_products.discounted_price')
                            ->whereRaw("STR_TO_DATE(SUBSTRING_INDEX(date_range, ' - ', 1), '%Y-%m-%d') <= ?", [Carbon::today()])
                            ->whereRaw("STR_TO_DATE(SUBSTRING_INDEX(date_range, ' - ', -1), '%Y-%m-%d') >= ?", [Carbon::today()])
                            ->where('promo_products.discounted_price', '>', 0);
                    }]);
                }])
                ->get();

            $idBrand = Brand::where('name', $name)->value('id');

            $brandVouchers = Promo::where('type', '=', 'brand voucher')
                ->where('brand_id', $idBrand)
                ->whereColumn('total_used', '<', 'usage_quota')
                ->whereRaw("STR_TO_DATE(SUBSTRING_INDEX(date_range, ' - ', 1), '%Y-%m-%d') <= ?", [Carbon::today()])
                ->whereRaw("STR_TO_DATE(SUBSTRING_INDEX(date_range, ' - ', -1), '%Y-%m-%d') >= ?", [Carbon::today()])
                ->get();

            $newestProducts = Product::where('brand_id', $idBrand)
                ->with(['promos' => function ($promoQuery) {
                    $promoQuery->select('promos.*', 'promo_products.discounted_price')
                        ->wherePivot('discounted_price', '>', 0)
                        ->whereRaw("STR_TO_DATE(SUBSTRING_INDEX(date_range, ' - ', 1), '%Y-%m-%d') <= ?", [Carbon::today()])
                        ->whereRaw("STR_TO_DATE(SUBSTRING_INDEX(date_range, ' - ', -1), '%Y-%m-%d') >= ?", [Carbon::today()]);
                }])
                ->orderBy('created_at', 'desc')
                ->get();

            foreach ($newestProducts as $newproduct) {
                $variationPrices = $newproduct->productVariations->pluck('variant_price')->unique()->sort();

                if ($variationPrices->count() > 1) {
                    // Jika ada lebih dari satu harga unik, buat rentang harga
                    $newproduct->priceVariation = 'Rp' . number_format($variationPrices->first(), 0, ',', '.')
                        . ' - Rp' . number_format($variationPrices->last(), 0, ',', '.');
                } elseif ($variationPrices->count() == 0) {
                    $newproduct->priceVariation = null;
                } else {
                    // Jika semua harga variasi sama, cukup tampilkan satu harga
                    $newproduct->priceVariation = 'Rp' . number_format($variationPrices->first(), 0, ',', '.');
                }
            }

            $topProducts = Product::where('brand_id', $idBrand)
                ->with(['promos' => function ($promoQuery) {
                    $promoQuery->select('promos.*', 'promo_products.discounted_price')
                        ->wherePivot('discounted_price', '>', 0)
                        ->whereRaw("STR_TO_DATE(SUBSTRING_INDEX(date_range, ' - ', 1), '%Y-%m-%d') <= ?", [Carbon::today()])
                        ->whereRaw("STR_TO_DATE(SUBSTRING_INDEX(date_range, ' - ', -1), '%Y-%m-%d') >= ?", [Carbon::today()]);
                }])
                ->orderBy('sale', 'desc') // Order products by sale within the products relation
                ->get();

            foreach ($topProducts as $topproduct) {
                $variationPrices = $topproduct->productVariations->pluck('variant_price')->unique()->sort();

                if ($variationPrices->count() > 1) {
                    // Jika ada lebih dari satu harga unik, buat rentang harga
                    $topproduct->priceVariation = 'Rp' . number_format($variationPrices->first(), 0, ',', '.')
                        . ' - Rp' . number_format($variationPrices->last(), 0, ',', '.');
                } elseif ($variationPrices->count() == 0) {
                    $topproduct->priceVariation = null;
                } else {
                    // Jika semua harga variasi sama, cukup tampilkan satu harga
                    $topproduct->priceVariation = 'Rp' . number_format($variationPrices->first(), 0, ',', '.');
                }
            }

            $allbrand = Brand::where('name', $name)
                ->with(['products' => function ($query) {
                    // Load promos for products, but allow products without promos to be included   
                    $query->with(['promos' => function ($promoQuery) {
                        $promoQuery->select('promos.*', 'promo_products.discounted_price')
                            ->wherePivot('discounted_price', '>', 0)
                            ->whereRaw("STR_TO_DATE(SUBSTRING_INDEX(date_range, ' - ', 1), '%Y-%m-%d') <= ?", [Carbon::today()])
                            ->whereRaw("STR_TO_DATE(SUBSTRING_INDEX(date_range, ' - ', -1), '%Y-%m-%d') >= ?", [Carbon::today()]);
                    }]);
                }])
                ->first();

            $allbrand = Brand::where('name', $name)
                ->with(['products'])
                ->first();

            // dd($brands);
            return view('user.component.brand', [
                'countBrand' => count($allbrand->products),
                'brands' => $brands,
                'newest' => $newestProducts,
                'top'    => $topProducts,
                'brandVouchers' => $brandVouchers,
            ]);
        }
    }
}