<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Models\Product;
use App\Models\Promo;
use App\Models\PromoProduct;
use App\Models\Cart;
use App\Models\Cart_item;
use App\Models\PromoTier;
use App\Models\Wishlist;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class PromoController extends Controller
{
    // USER
    public function index()
    {
        try {
            $date = now()->format('Y-m-d');
            $promos = Promo::where('type', '=', 'promo')
            ->whereRaw("STR_TO_DATE(SUBSTRING_INDEX(date_range, ' - ', 1), '%Y-%m-%d') <= ?", [$date])
            ->whereRaw("STR_TO_DATE(SUBSTRING_INDEX(date_range, ' - ', -1), '%Y-%m-%d') >= ?", [$date])
            ->with(['products'])
            ->get();
            
            $vouchers = Promo::whereIn('type', ['voucher', 'product voucher'])->get();

            return view('user.component.promo', [
                'promos' => $promos,
                'vouchers' => $vouchers,
            ]);
        } catch (Exception $err) {
            dd($err);
        }

    }

    public function detailPromoUser($name)
    {
        // dd($name);
        $userId = session('id_user');

        if ($userId) {
            $promo = Promo::where('promo_name', $name)->with(['products.brand'])
                ->get();

            foreach ($promo as $promoItem) {
                foreach ($promoItem->products as $product) {
                    
                    if ($promoItem->discount > 100) {
                        $priceAfterDiscount = $product->regular_price - $promoItem->discount;
                    }
                    elseif ($promoItem->discount <= 100) {
                        $priceDiscount = ($product->regular_price) * ($promoItem->discount/100);
                        $priceAfterDiscount = $product->regular_price - $priceDiscount;
                    }

                    $product->price_after_discount = $priceAfterDiscount;
                }
            }

            $cartId = Cart::where('user_id', $userId)->value('id');
            $cartItems = Cart_item::where('cart_id', $cartId)->get();
            $wishlists = Wishlist::where('user_id', $userId)->get();

            return view('user.component.detail-promo', [
                'promo' => $promo,
                'cartItems' => $cartItems,
                'wishlists' => $wishlists,
            ]);
        } else {

            $promo = Promo::where('promo_name', $name)
                ->with(['products.brand'])
                ->get();

            foreach ($promo as $promoItem) {
                foreach ($promoItem->products as $product) {
                    if ($promoItem->discount > 100) {
                        $priceAfterDiscount = $product->regular_price - $promoItem->discount;
                    }
                    elseif ($promoItem->discount <= 100) {
                        $priceDiscount = ($product->regular_price) * ($promoItem->discount/100);
                        $priceAfterDiscount = $product->regular_price - $priceDiscount;
                    }

                    $product->price_after_discount = $priceAfterDiscount;
                }
            }

            // dd($promo);
            return view('user.component.detail-promo', [
                'promo' => $promo,
            ]);
        }
    }


    // ADMIN
    public function indexPromo()
    {
        $promo = Promo::where('type', 'promo')->get();
        $products = Product::all();
        $brands = Brand::all();
        return view('admin.promo.index', [
            'promo' => $promo,
            'products' => $products,
            'brands' => $brands,

        ]);
    }

    public function createPromo()
    {
        // Ambil data produk dari database
        $products = Product::all(); // Pastikan kamu menggunakan model Product
        return view('admin.promo.create', compact('products'));
    }

    public function storePromo(Request $request)
    {
        try {
            $request->validate([
                'promo_name' => 'required|string|max:255',
                'date_range' => 'required|string|max:255',
                'min_transaction' => 'required',
                'usage_quota' => 'required',
                'max_quantity_buyer' => 'required',
                'promo_code' => 'required',
                'discount' => 'required',
                'product_ids' => 'required|array',
                'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048'
            ]);

            // Hapus format rupiah dari regular_price
            $minTransaction = str_replace(['Rp. ', '.'], '', $request->min_transaction);

            // Generate kode promo otomatis
            $randomCode = strtoupper(substr(str_shuffle('abcdefghijklmnopqrstuvwxyz123456789'), 0, 5));
            $promoCode = 'Glamo' . $randomCode;


            // Simpan single image
            $imagePath = null;
            if ($request->hasFile('image')) {
                $image = $request->file('image');
                $imageName = time() . '_' . $image->getClientOriginalName();
                // Simpan file ke storage/app/public/uploads/promo
                $imagePath = $image->storeAs('promo', $imageName, 'public');
            }

            // Simpan data promo
            $promo = Promo::create([
                'promo_name' => $request->promo_name,
                'date_range' => $request->date_range, // Tidak perlu explode, mutator akan menangani
                'min_transaction' => $minTransaction,
                'promo_code' => $promoCode,
                'usage_quota' => $request->usage_quota,
                'max_quantity_buyer' => $request->max_quantity_buyer,
                'discount' => $request->discount,
                'image' => $imagePath ?? null,
                'type' => $request->type, // Isi field 'type' dari input tersembunyi
            ]);

            $promo->products()->attach($request->product_ids);

            // Redirect dengan pesan sukses
            return redirect()->route('index-promo')->with('success', 'Promo created successfully!');
        } catch (\Illuminate\Validation\ValidationException $e) {
            return redirect()->back()->withErrors($e->errors())->withInput();
        } catch (\Exception $e) {
            Log::error('Error creating Voucher', ['exception' => $e->getMessage()]);
            return redirect()->back()->withErrors(['error' => 'An error occurred while creating the Promo: ' . $e->getMessage()])->withInput();
        }
    }





    // PROMO VOUCHER
    public function indexPromoVoucher()
    {
        $promo = Promo::whereIn('type', ['voucher', 'brand voucher', 'product voucher'])->get();
        $products = Product::all();
        $brands = Brand::all();
        return view('admin.promo.voucher.index', [
            'promo' => $promo,
            'products' => $products,
            'brands' => $brands,

        ]);
    }

    public function createPromoVoucher()
    {
        return view('admin.promo.voucher.create');
    }

    public function storePromoVoucher(Request $request)
    {
        try {

            $request->validate([
                'promo_name' => 'required|string|max:255',
                'date_range' => 'required|string|max:255',
                'min_transaction' => 'required',
                'usage_quota' => 'required',
                'max_quantity_buyer' => 'required',
                'promo_code' => 'required',
                'discount' => 'required',
                // 'max_discount' => 'required',
                'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048'
            ]);

            // Hapus format rupiah dari regular_price
            $minTransaction = str_replace(['Rp. ', '.'], '', $request->min_transaction);
            $maxTransaction = str_replace(['Rp. ', '.'], '', $request->max_transaction);

            // Generate kode promo otomatis
            $randomCode = strtoupper(substr(str_shuffle('abcdefghijklmnopqrstuvwxyz123456789'), 0, 5));
            $promoCode = 'Glamo' . $randomCode;

            // Simpan single image
            $imagePath = null;
            if ($request->hasFile('image')) {
                $image = $request->file('image');
                $imageName = time() . '_' . $image->getClientOriginalName();
                // Simpan file ke storage/app/public/uploads/promo
                $imagePath = $image->storeAs('promo', $imageName, 'public');
            }

            // Simpan data promo
            Promo::create([
                'promo_name' => $request->promo_name,
                'date_range' => $request->date_range, // Tidak perlu explode, mutator akan menangani
                'min_transaction' => $minTransaction,
                'promo_code' => $promoCode,
                'usage_quota' => $request->usage_quota,
                'max_quantity_buyer' => $request->max_quantity_buyer,
                'discount' => $request->discount,
                'max_discount' => $request->max_discount,
                'image' => $imagePath ?? null,
                'type' => $request->type, // Isi field 'type' dari input tersembunyi
            ]);

            // Redirect dengan pesan sukses
            return redirect()->route('index-promo-voucher')->with('success', 'Promo Voucher created successfully!');
        } catch (\Illuminate\Validation\ValidationException $e) {
            return redirect()->back()->withErrors($e->errors())->withInput();
        } catch (\Exception $e) {
            Log::error('Error creating Voucher', ['exception' => $e->getMessage()]);
            return redirect()->back()->withErrors(['error' => 'An error occurred while creating the Voucher: ' . $e->getMessage()])->withInput();
        }
    }

    // PROMO BRAND VOUCHER
    public function createPromoShopVoucher()
    {
        $brands = Brand::with('products')->get();
        return view('admin.promo.voucher.create-voucher-toko', compact('brands'));
    }

    public function storePromoShopVoucher(Request $request)
    {
        try {
            $request->validate([
                'promo_name' => 'required|string|max:255',
                'date_range' => 'required|string|max:255',
                'min_transaction' => 'required',
                'usage_quota' => 'required',
                'max_quantity_buyer' => 'required',
                'promo_code' => 'required',
                'discount' => 'required|numeric|min:0|max:100',
                'brand_id' => 'required|exists:brands,id',
                'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048'
            ]);

            // Hapus format rupiah dari regular_price
            $minTransaction = str_replace(['Rp. ', '.'], '', $request->min_transaction);

            // Generate kode promo otomatis
            $randomCode = strtoupper(substr(str_shuffle('abcdefghijklmnopqrstuvwxyz123456789'), 0, 5));
            $promoCode = 'Glamo' . $randomCode;

            // Simpan single image
            $imagePath = null;
            if ($request->hasFile('image')) {
                $image = $request->file('image');
                $imageName = time() . '_' . $image->getClientOriginalName();
                // Simpan file ke storage/app/public/uploads/promo
                $imagePath = $image->storeAs('promo', $imageName, 'public');
            }

            $promo = Promo::create([
                'promo_name' => $request->promo_name,
                'date_range' => $request->date_range,
                'min_transaction' => $minTransaction,
                'promo_code' => $promoCode,
                'usage_quota' => $request->usage_quota,
                'max_quantity_buyer' => $request->max_quantity_buyer,
                'discount' => $request->discount,
                'image' => $imagePath ?? null,
                'type' => $request->type,
                'brand_id' => $request->brand_id,
            ]);


            // Proses diskon produk
            foreach ($request->product_ids as $productId) {
                $discountValue = $request->product_discount[$productId] ?? null; // Ambil diskon spesifik produk
                $discountType = $request->discount_type[$productId] ?? 'nominal'; // Ambil tipe diskon

                // Hapus format dari discountValue jika tipe diskon nominal
                if ($discountType === 'nominal') {
                    $discountValue = str_replace(['Rp. ', '.'], '', $discountValue);
                }

                // Attach produk dengan diskon yang sesuai
                $promo->products()->attach($productId, [
                    'discount_product_voucher_item' => $discountValue ?: $promo->discount, // Jika tidak ada diskon produk, gunakan diskon global
                    'discount_type' => $discountType,
                    'created_at' => now(),
                    'updated_at' => now()
                ]);
            }

            // Redirect dengan pesan sukses
            return redirect()->route('index-promo-voucher')->with('success', 'Promo Brand Voucher created successfully!');
        } catch (\Illuminate\Validation\ValidationException $e) {
            return redirect()->back()->withErrors($e->errors())->withInput();
        } catch (\Exception $e) {
            Log::error('Error creating Voucher', ['exception' => $e->getMessage()]);
            return redirect()->back()->withErrors(['error' => 'An error occurred while creating the Voucher: ' . $e->getMessage()])->withInput();
        }
    }


    public function getProductsByBrand($brandId)
    {
        $products = Product::where('brand_id', $brandId)
            ->with('brand')
            ->get()
            ->map(function ($product) {
                return [
                    'id' => $product->id,
                    'product_name' => $product->product_name,
                    'stock_quantity' => $product->stock_quantity,
                    'regular_price' => $product->regular_price,
                    'main_image' => Storage::url($product->main_image), // Convert ke URL lengkap
                    // tambahkan field lain yang diperlukan
                ];
            });

        return response()->json([
            'success' => true,
            'products' => $products
        ]);
    }




    // PROMO PRODUCT VOUCHER
    public function createPromoProductVoucher()
    {
        $products = Product::all(); // Pastikan kamu menggunakan model Product
        return view('admin.promo.voucher.create-voucher-product', compact('products'));
    }

    // public function storePromoProductVoucher(Request $request)
    // {
    //     try {

    //         $request->validate([
    //             'promo_name' => 'required|string|max:255',
    //             'date_range' => 'required|string|max:255',
    //             'min_transaction' => 'required',
    //             'usage_quota' => 'required',
    //             'max_quantity_buyer' => 'required',
    //             'promo_code' => 'required',
    //             'discount' => 'required',
    //             'product_ids' => 'required|array',
    //             'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048'
    //         ]);

    //         // Hapus format rupiah dari regular_price
    //         $minTransaction = str_replace(['Rp. ', '.'], '', $request->min_transaction);

    //         // Generate kode promo otomatis
    //         $randomCode = strtoupper(substr(str_shuffle('abcdefghijklmnopqrstuvwxyz123456789'), 0, 5));
    //         $promoCode = 'Glamo' . $randomCode;


    //         // Simpan single image
    //         $imagePath = null;
    //         if ($request->hasFile('image')) {
    //             $image = $request->file('image');
    //             $imageName = time() . '_' . $image->getClientOriginalName();
    //             // Simpan file ke storage/app/public/uploads/promo
    //             $imagePath = $image->storeAs('promo', $imageName, 'public');
    //         }

    //         // Simpan data promo
    //         $promo = Promo::create([
    //             'promo_name' => $request->promo_name,
    //             'date_range' => $request->date_range, // Tidak perlu explode, mutator akan menangani
    //             'min_transaction' => $minTransaction,
    //             'promo_code' => $promoCode,
    //             'usage_quota' => $request->usage_quota,
    //             'max_quantity_buyer' => $request->max_quantity_buyer,
    //             'discount' => $request->discount,
    //             'image' => $imagePath ?? null,
    //             'type' => $request->type, // Isi field 'type' dari input tersembunyi
    //         ]);

    //         $promo->products()->attach($request->product_ids);

    //         // Redirect dengan pesan sukses
    //         return redirect()->route('index-promo-voucher')->with('success', 'Promo Product Voucher created successfully!');
    //     } catch (\Illuminate\Validation\ValidationException $e) {
    //         return redirect()->back()->withErrors($e->errors())->withInput();
    //     } catch (\Exception $e) {
    //         Log::error('Error creating Voucher', ['exception' => $e->getMessage()]);
    //         return redirect()->back()->withErrors(['error' => 'An error occurred while creating the Voucher: ' . $e->getMessage()])->withInput();
    //     }
    // }

    public function storePromoProductVoucher(Request $request)
    {
        try {
            $request->validate([
                'promo_name' => 'required|string|max:255',
                'date_range' => 'required|string|max:255',
                'min_transaction' => 'required',
                'usage_quota' => 'required',
                'max_quantity_buyer' => 'required',
                'promo_code' => 'required',
                'discount' => 'required',
                'product_ids' => 'required|array',
                'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            ]);

            // Hapus format rupiah dari regular_price
            $minTransaction = str_replace(['Rp. ', '.'], '', $request->min_transaction);

            // Generate kode promo otomatis
            $randomCode = strtoupper(substr(str_shuffle('abcdefghijklmnopqrstuvwxyz123456789'), 0, 5));
            $promoCode = 'Glamo' . $randomCode;

            // Simpan single image
            $imagePath = null;
            if ($request->hasFile('image')) {
                $image = $request->file('image');
                $imageName = time() . '_' . $image->getClientOriginalName();
                $imagePath = $image->storeAs('promo', $imageName, 'public');
            }

            // Simpan data promo
            $promo = Promo::create([
                'promo_name' => $request->promo_name,
                'date_range' => $request->date_range,
                'min_transaction' => $minTransaction,
                'promo_code' => $promoCode,
                'usage_quota' => $request->usage_quota,
                'max_quantity_buyer' => $request->max_quantity_buyer,
                'discount' => $request->discount, // Diskon All
                'image' => $imagePath ?? null,
                'type' => $request->type,
            ]);

            // Loop melalui produk terpilih untuk simpan diskon per produk
            foreach ($request->product_ids as $productId) {
                $discountProduct = $request->product_discount[$productId] ?? null; // Ambil diskon per produk
                $promo->products()->attach($productId, [
                    'discount_product_voucher_item' => $discountProduct ?: $promo->discount, // Gunakan diskon all jika tidak ada input
                ]);
            }

            // Redirect dengan pesan sukses
            return redirect()->route('index-promo-voucher')->with('success', 'Promo Product Voucher created successfully!');
        } catch (\Illuminate\Validation\ValidationException $e) {
            return redirect()->back()->withErrors($e->errors())->withInput();
        } catch (\Exception $e) {
            Log::error('Error creating Voucher', ['exception' => $e->getMessage()]);
            return redirect()->back()->withErrors(['error' => 'An error occurred while creating the Voucher: ' . $e->getMessage()])->withInput();
        }
    }


    // detail promo voucher
    public function detailPromoVoucher($id)
    {
        $promo = promo::find($id);
        $products = Product::all();

        if (!$promo) {
            return redirect()->route('index-promo')->with('error', 'Promo not found');
        }

        return view('admin.promo.voucher.review', [
            'promo' => $promo,
            // 'products' => $products,
        ]);
    }



    public function editPromoVoucher($id)
    {
        $promo = Promo::findOrFail($id);
        $brands = Brand::all();
        $products = Product::all();

        // Parse date range yang tersimpan menjadi format yang sesuai
        $start_date = Carbon::parse($promo->start_date)->format('m/d/Y');
        $end_date = Carbon::parse($promo->end_date)->format('m/d/Y');
        $promo->date_range = $start_date . ' - ' . $end_date;

        switch ($promo->type) {
            case 'brand voucher':
                return view('admin.promo..voucher.edit-voucher-brand', compact('promo', 'brands'));
            case 'product voucher':
                return view('admin.promo.voucher.edit-voucher-product', compact('promo', 'products'));
            case 'voucher':
                return view('admin.promo.voucher.edit-voucher-limited', compact('promo'));
            default:
                return redirect()->back()->with('error', 'Invalid voucher type');
        }
    }

    // Regular Voucher Edit
    public function updatePromoVoucher(Request $request, $id)
    {
        try {
            $request->validate([
                'promo_name' => 'required|string|max:255',
                'date_range' => 'required|string|max:255',
                'min_transaction' => 'required',
                'usage_quota' => 'required',
                'max_quantity_buyer' => 'required',
                'discount' => 'required',
                'max_discount' => 'required',
                'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
            ]);

            $promo = Promo::findOrFail($id);

            // Hapus format rupiah dari min_transaction
            $minTransaction = str_replace(['Rp. ', '.'], '', $request->min_transaction);

            // Handle image update
            $imagePath = $promo->image;
            if ($request->hasFile('image')) {
                // Delete old image if exists
                if ($promo->image && Storage::disk('public')->exists($promo->image)) {
                    Storage::disk('public')->delete($promo->image);
                }

                $image = $request->file('image');
                $imageName = time() . '_' . $image->getClientOriginalName();
                $imagePath = $image->storeAs('promo', $imageName, 'public');
            }

            // Update promo data
            $promo->update([
                'promo_name' => $request->promo_name,
                'date_range' => $request->date_range,
                'min_transaction' => $minTransaction,
                'usage_quota' => $request->usage_quota,
                'max_quantity_buyer' => $request->max_quantity_buyer,
                'discount' => $request->discount,
                'max_discount' => $request->max_discount,
                'image' => $imagePath,
            ]);

            return redirect()->route('index-promo-voucher')->with('success', 'Promo Voucher updated successfully!');
        } catch (\Illuminate\Validation\ValidationException $e) {
            return redirect()->back()->withErrors($e->errors())->withInput();
        } catch (\Exception $e) {
            Log::error('Error updating Voucher', ['exception' => $e->getMessage()]);
            return redirect()->back()->withErrors(['error' => 'An error occurred while updating the Voucher: ' . $e->getMessage()])->withInput();
        }
    }

    // Brand Voucher Edit
    public function updatePromoBrandVoucher(Request $request, $id)
    {
        try {
            $request->validate([
                'promo_name' => 'required|string|max:255',
                'date_range' => 'required|string|max:255',
                'min_transaction' => 'required',
                'usage_quota' => 'required',
                'max_quantity_buyer' => 'required',
                'discount' => 'required|numeric|min:0|max:100',
                'max_discount' => 'required|numeric|min:0',
                'brand_id' => 'required|exists:brands,id',
                'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
            ]);

            $promo = Promo::findOrFail($id);

            // Hapus format rupiah dari min_transaction
            $minTransaction = str_replace(['Rp. ', '.'], '', $request->min_transaction);

            // Handle image update
            $imagePath = $promo->image;
            if ($request->hasFile('image')) {
                // Delete old image if exists
                if ($promo->image && Storage::disk('public')->exists($promo->image)) {
                    Storage::disk('public')->delete($promo->image);
                }

                $image = $request->file('image');
                $imageName = time() . '_' . $image->getClientOriginalName();
                $imagePath = $image->storeAs('promo', $imageName, 'public');
            }

            // Update promo data
            $promo->update([
                'promo_name' => $request->promo_name,
                'date_range' => $request->date_range,
                'min_transaction' => $minTransaction,
                'usage_quota' => $request->usage_quota,
                'max_quantity_buyer' => $request->max_quantity_buyer,
                'discount' => $request->discount,
                'max_discount' => $request->max_discount,
                'image' => $imagePath,
                'brand_id' => $request->brand_id,
            ]);

            // Update discounted prices for brand products
            $brand = Brand::findOrFail($request->brand_id);
            foreach ($brand->products as $product) {
                $discountedPrice = $product->regular_price * (1 - $request->discount / 100);
                $maxDiscountAmount = $product->regular_price * ($request->max_discount / 100);

                if ($product->regular_price - $discountedPrice > $maxDiscountAmount) {
                    $discountedPrice = $product->regular_price - $maxDiscountAmount;
                }

                $product->update(['discounted_price' => $discountedPrice]);
            }

            // Sync products for the brand
            $promo->products()->sync($brand->products->pluck('id'));

            return redirect()->route('index-promo-voucher')->with('success', 'Promo Brand Voucher updated successfully!');
        } catch (\Illuminate\Validation\ValidationException $e) {
            return redirect()->back()->withErrors($e->errors())->withInput();
        } catch (\Exception $e) {
            Log::error('Error updating Voucher', ['exception' => $e->getMessage()]);
            return redirect()->back()->withErrors(['error' => 'An error occurred while updating the Voucher: ' . $e->getMessage()])->withInput();
        }
    }

    // Product Voucher Edit
    public function updatePromoProductVoucher(Request $request, $id)
    {
        try {
            $request->validate([
                'promo_name' => 'required|string|max:255',
                'date_range' => 'required|string|max:255',
                'min_transaction' => 'required',
                'usage_quota' => 'required',
                'max_quantity_buyer' => 'required',
                'discount' => 'required',
                'product_ids' => 'required|array',
                'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
            ]);

            $promo = Promo::findOrFail($id);

            // Hapus format rupiah dari min_transaction
            $minTransaction = str_replace(['Rp. ', '.'], '', $request->min_transaction);

            // Handle image update
            $imagePath = $promo->image;
            if ($request->hasFile('image')) {
                // Delete old image if exists
                if ($promo->image && Storage::disk('public')->exists($promo->image)) {
                    Storage::disk('public')->delete($promo->image);
                }

                $image = $request->file('image');
                $imageName = time() . '_' . $image->getClientOriginalName();
                $imagePath = $image->storeAs('promo', $imageName, 'public');
            }

            // Update promo data
            $promo->update([
                'promo_name' => $request->promo_name,
                'date_range' => $request->date_range,
                'min_transaction' => $minTransaction,
                'usage_quota' => $request->usage_quota,
                'max_quantity_buyer' => $request->max_quantity_buyer,
                'discount' => $request->discount,
                'image' => $imagePath,
            ]);

            // Sync selected products
            $promo->products()->sync($request->product_ids);

            return redirect()->route('index-promo-voucher')->with('success', 'Promo Product Voucher updated successfully!');
        } catch (\Illuminate\Validation\ValidationException $e) {
            return redirect()->back()->withErrors($e->errors())->withInput();
        } catch (\Exception $e) {
            Log::error('Error updating Voucher', ['exception' => $e->getMessage()]);
            return redirect()->back()->withErrors(['error' => 'An error occurred while updating the Voucher: ' . $e->getMessage()])->withInput();
        }
    }








    // PROMO ONGKIR   
    public function createPromoOngkir()
    {
        $products = Product::all(); // Pastikan kamu menggunakan model Product
        return view('admin.promo.voucher.create-voucher-ongkir', compact('products'));
    }

    public function storePromoOngkir(Request $request)
    {
        try {

            $request->validate([
                'promo_name' => 'required|string|max:255',
                'date_range' => 'required|string|max:255',
                'min_transaction' => 'required',
                'promo_code' => 'required',
                // 'description' => 'required',
                // 'terms_conditions' => 'required',
                'discount' => 'required',
                'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048'
            ]);

            // Simpan single image
            $image = null;
            if ($request->hasFile('image')) {
                $image = $request->file('image');
                $imageName = time() . '_' . $image->getClientOriginalName();
                $image->move(public_path('uploads/promo'), $imageName);
                $imagePath = 'uploads/promo/' . $imageName;
            }

            // Simpan data promo
            Promo::create([
                'promo_name' => $request->promo_name,
                'date_range' => $request->date_range,
                'min_transaction' => $request->min_transaction,
                'promo_code' => $request->promo_code,
                // 'description' => $request->description,
                // 'terms_conditions' => $request->terms_conditions,
                'discount' => $request->discount,
                'image' => $imagePath ?? null,
                'type' => $request->type, // Isi field 'type' dari input tersembunyi
            ]);

            // Redirect dengan pesan sukses
            return redirect()->route('index-promo')->with('success', 'Promo Voucher created successfully!');
        } catch (\Exception $e) {
            // Tangani error
            Log::error($e->getMessage()); // Tulis log
            return back()->withErrors(['error' => 'Something went wrong: ' . $e->getMessage()]);
        }
    }

    public function detailPromo($id)
    {
        $promo = promo::find($id);

        if (!$promo) {
            return redirect()->route('index-promo')->with('error', 'Promo not found');
        }

        return view('admin.promo.review', [
            'promo' => $promo,
        ]);
    }


    public function deletePromo($id)
    {
        $promo = Promo::find($id);

        if (!$promo) {
            return response()->json([
                'success' => false,
                'message' => 'Promo not found.'
            ]);
        }

        // Hapus gambar utama dari folder
        if (!empty($promo->image) && file_exists(public_path($promo->image))) {
            unlink(public_path($promo->image));
        }

        // Hapus produk dari database
        $promo->delete();

        return response()->json([
            'success' => true,
            'message' => 'Promo deleted successfully.'
        ]);
    }





    // PROMO DISKON
    public function indexPromoDiskon()
    {
        $promo = Promo::where('type', 'discount')->get();
        $products = Product::all();
        $brands = Brand::all();
        return view('admin.promo.diskon.index', [
            'promo' => $promo,
            'products' => $products,
            'brands' => $brands,

        ]);
    }

    public function createPromoDiskon()
    {
        $products = Product::all(); // Pastikan kamu menggunakan model Product
        return view('admin.promo.diskon.create', compact('products'));
    }


    public function storePromoDiskon(Request $request)
    {
        try {

            $request->validate([
                'promo_name' => 'required|string|max:255',
                'date_range' => 'required|string|max:255',
                'discount_type' => 'required|in:percentage,nominal,package',
                'product_ids' => 'required|array',
                'product_ids.*' => 'exists:products,id',
                // 'discount' => 'required|numeric|min:0|max:100',

            ]);

            // Simpan single image
            $image = null;
            if ($request->hasFile('image')) {
                $image = $request->file('image');
                $imageName = time() . '_' . $image->getClientOriginalName();
                $image->move(public_path('uploads/promo'), $imageName);
                $imagePath = 'uploads/promo/' . $imageName;
            }

            // Simpan data promo
            $promo = Promo::create([
                'promo_name' => $request->promo_name,
                'date_range' => $request->date_range,
                'discount_type' => $request->discount_type,
                'type' => 'discount',
            ]);

            // simpantier diskon
            switch ($request->discount_type) {
                case 'percentage':
                    $this->savePercentageTiers($request, $promo);
                    break;
                case 'nominal':
                    $this->saveNominalTiers($request, $promo);
                    break;
                case 'package':
                    $this->savePackageTiers($request, $promo);
                    break;
            }

            // Attach products
            $promo->products()->attach($request->product_ids);

            // Redirect dengan pesan sukses
            return redirect()->route('index-promo-diskon')->with('success', 'Promo Diskon created successfully!');
        } catch (\Illuminate\Validation\ValidationException $e) {
            return redirect()->back()->withErrors($e->errors())->withInput();
        } catch (\Exception $e) {
            Log::error('Error creating product', ['exception' => $e->getMessage()]);
            return redirect()->back()->withErrors(['error' => 'An error occurred while creating the product: ' . $e->getMessage()])->withInput();
        }
    }


    private function savePercentageTiers($request, $promo)
    {
        $quantities = $request->input('percentage_min_quantity', []);
        $discounts = $request->input('percentage_discount_value', []);

        foreach ($quantities as $index => $quantity) {
            PromoTier::create([
                'promo_id' => $promo->id,
                'tier_level' => $index + 1,
                'min_quantity' => $quantity,
                'discount_value' => $discounts[$index],
                'discount_type' => 'percentage'
            ]);
        }
    }

    private function saveNominalTiers($request, $promo)
    {
        $quantities = $request->input('nominal_min_quantity', []);
        $discounts = $request->input('nominal_discount_value', []);

        foreach ($quantities as $index => $quantity) {
            PromoTier::create([
                'promo_id' => $promo->id,
                'tier_level' => $index + 1,
                'min_quantity' => $quantity,
                'discount_value' => $discounts[$index],
                'discount_type' => 'nominal'
            ]);
        }
    }

    private function savePackageTiers($request, $promo)
    {
        $quantities = $request->input('package_quantity', []);
        $prices = $request->input('package_price', []);

        foreach ($quantities as $index => $quantity) {
            PromoTier::create([
                'promo_id' => $promo->id,
                'tier_level' => $index + 1,
                'min_quantity' => $quantity,
                'package_price' => $prices[$index],
                'discount_type' => 'package'
            ]);
        }
    }





    // PROMO VOUCHER NEW USER
    public function indexPromoNewUser()
    {
        $promo = Promo::where('type', 'new user')->get();
        $products = Product::all();
        $brands = Brand::all();
        return view('admin.promo.newuser.index', [
            'promo' => $promo,
            'products' => $products,
            'brands' => $brands,

        ]);
    }

    public function createPromoNewUser()
    {
        return view('admin.promo.newuser.create');
    }

    public function storePromoNewUser(Request $request)
    {
        try {

            $request->validate([
                'promo_name' => 'required|string|max:255',
                'min_transaction' => 'required',
                'max_discount' => 'required',
                'discount' => 'required',
            ]);

            // Simpan single image
            $imagePath = null;
            if ($request->hasFile('image')) {
                $image = $request->file('image');
                $imageName = time() . '_' . $image->getClientOriginalName();
                // Simpan file ke storage/app/public/uploads/promo
                $imagePath = $image->storeAs('promo', $imageName, 'public');
            }

            // Simpan data promo
            Promo::create([
                'promo_name' => $request->promo_name,
                'min_transaction' => $request->min_transaction,
                'max_discount' => $request->max_discount,
                'discount' => $request->discount,
                'type' => $request->type, // Isi field 'type' dari input tersembunyi
            ]);

            // Redirect dengan pesan sukses
            return redirect()->route('index-promo-new-user')->with('success', 'Promo Voucher New User created successfully!');
        } catch (\Illuminate\Validation\ValidationException $e) {
            return redirect()->back()->withErrors($e->errors())->withInput();
        } catch (\Exception $e) {
            Log::error('Error creating product', ['exception' => $e->getMessage()]);
            return redirect()->back()->withErrors(['error' => 'An error occurred while creating the product: ' . $e->getMessage()])->withInput();
        }
    }
}
