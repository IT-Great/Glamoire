<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Models\Product;
use App\Models\Promo;
use App\Models\PromoProduct;
use App\Models\Cart;
use App\Models\Cart_item;
use App\Models\Wishlist;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class PromoController extends Controller
{
    // USER
    public function index(){

        $promos = Promo::with(['products'])->where('type', '=', 'promo')->get();
        $vouchers = Promo::with(['products'])->where('type', '=', 'voucher')->get();

        return view('user.component.promo', [
            'promos' => $promos,
            'vouchers' => $vouchers,
        ]);
    }

    public function detailPromoUser($name)
    {
        // dd($name);
        $userId = session('id_user');

        if ($userId) { 
            $promo = Promo::where('promo_name', $name)->with(['products.brand'])
            ->get();

            foreach ($promo as $promoItem) {
                // Pastikan products adalah koleksi
                foreach ($promoItem->products as $product) {
                    // Hitung diskon untuk setiap produk
                    $priceDiscount = ($product->regular_price * $promoItem->discount) / 100;
                    $priceAfterDiscount = $product->regular_price - $priceDiscount;
                    
                    // Masukkan hasil diskon ke objek promo
                    // Misalkan kita menyimpan hasil diskon ke dalam array untuk setiap produk
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
        }
        else{

            $promo = Promo::where('promo_name', $name)
            ->with(['products.brand'])
            ->get();

            foreach ($promo as $promoItem) {
                // Pastikan products adalah koleksi 
                foreach ($promoItem->products as $product) {
                    // Hitung diskon untuk setiap produk
                    $priceDiscount = ($product->regular_price * $promoItem->discount) / 100;
                    $priceAfterDiscount = $product->regular_price - $priceDiscount;
                    
                    // Masukkan hasil diskon ke objek promo
                    // Misalkan kita menyimpan hasil diskon ke dalam array untuk setiap produk
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
                'discount' => 'required|numeric|min:0|max:100',
                'product_ids' => 'required|array',
                'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048'
            ]);

            // Simpan single image
            $imagePath = null;
            if ($request->hasFile('image')) {
                $image = $request->file('image');
                $imageName = time() . '_' . $image->getClientOriginalName();
                // Simpan file ke storage/app/public/uploads/promo
                $imagePath = $image->storeAs('uploads/promo', $imageName, 'public');
            }

            // Simpan data promo
            $promo = Promo::create([
                'promo_name' => $request->promo_name,
                'date_range' => $request->date_range, // Tidak perlu explode, mutator akan menangani
                'discount' => $request->discount,
                'image' => $imagePath ?? null,
                'type' => $request->type, // Isi field 'type' dari input tersembunyi
            ]);

            // Simpan produk yang dipilih ke pivot table
            $promo->products()->attach($request->product_ids);

            // Redirect dengan pesan sukses
            return redirect()->route('index-promo')->with('success', 'Promo created successfully!');
        } catch (\Illuminate\Validation\ValidationException $e) {
            return redirect()->back()->withErrors($e->errors())->withInput();
        } catch (\Exception $e) {
            Log::error('Error creating product', ['exception' => $e->getMessage()]);
            return redirect()->back()->withErrors(['error' => 'An error occurred while creating the product: ' . $e->getMessage()])->withInput();
        }
    }





    // PROMO VOUCHER
    public function indexPromoVoucher()
    {
        $promo = Promo::whereIn('type', ['voucher', 'shop voucher', 'product voucher'])->get();
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
                'max_transaction' => 'required',
                'usage_quota' => 'required',
                'max_quantity_buyer' => 'required',
                'promo_code' => 'required',
                'discount' => 'required',
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
                'max_transaction' => $maxTransaction,
                'promo_code' => $promoCode,
                'usage_quota' => $request->usage_quota,
                'max_quantity_buyer' => $request->max_quantity_buyer,
                'discount' => $request->discount,
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





    // PROMO SHOP VOUCHER
    public function createPromoShopVoucher()
    {
        return view('admin.promo.voucher.create-voucher-toko');
    }

    public function storePromoShopVoucher(Request $request)
    {
        try {

            $request->validate([
                'promo_name' => 'required|string|max:255',
                'date_range' => 'required|string|max:255',
                'min_transaction' => 'required',
                'max_transaction' => 'required',
                'usage_quota' => 'required',
                'max_quantity_buyer' => 'required',
                'promo_code' => 'required',
                'discount' => 'required',
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
                'max_transaction' => $maxTransaction,
                'promo_code' => $promoCode,
                'usage_quota' => $request->usage_quota,
                'max_quantity_buyer' => $request->max_quantity_buyer,
                'discount' => $request->discount,
                'image' => $imagePath ?? null,
                'type' => $request->type, // Isi field 'type' dari input tersembunyi
            ]);

            // Redirect dengan pesan sukses
            return redirect()->route('index-promo-voucher')->with('success', 'Promo Shop Voucher created successfully!');
        } catch (\Illuminate\Validation\ValidationException $e) {
            return redirect()->back()->withErrors($e->errors())->withInput();
        } catch (\Exception $e) {
            Log::error('Error creating Voucher', ['exception' => $e->getMessage()]);
            return redirect()->back()->withErrors(['error' => 'An error occurred while creating the Voucher: ' . $e->getMessage()])->withInput();
        }
    }





    // PROMO PRODUCT VOUCHER
    public function createPromoProductVoucher()
    {
        return view('admin.promo.voucher.create-voucher-product');
    }

    public function storePromoProductVoucher(Request $request)
    {
        try {

            $request->validate([
                'promo_name' => 'required|string|max:255',
                'date_range' => 'required|string|max:255',
                'min_transaction' => 'required',
                'max_transaction' => 'required',
                'usage_quota' => 'required',
                'max_quantity_buyer' => 'required',
                'promo_code' => 'required',
                'discount' => 'required',
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
                'max_transaction' => $maxTransaction,
                'promo_code' => $promoCode,
                'usage_quota' => $request->usage_quota,
                'max_quantity_buyer' => $request->max_quantity_buyer,
                'discount' => $request->discount,
                'image' => $imagePath ?? null,
                'type' => $request->type, // Isi field 'type' dari input tersembunyi
            ]);

            // Redirect dengan pesan sukses
            return redirect()->route('index-promo-voucher')->with('success', 'Promo Product Voucher created successfully!');
        } catch (\Illuminate\Validation\ValidationException $e) {
            return redirect()->back()->withErrors($e->errors())->withInput();
        } catch (\Exception $e) {
            Log::error('Error creating Voucher', ['exception' => $e->getMessage()]);
            return redirect()->back()->withErrors(['error' => 'An error occurred while creating the Voucher: ' . $e->getMessage()])->withInput();
        }
    }





    // PROMO ONGKIR
    public function indexPromoOngkir()
    {
        $promo = Promo::all();
        $products = Product::all();
        $brands = Brand::all();
        return view('admin.promo.ongkir.index', [
            'promo' => $promo,
            'products' => $products,
            'brands' => $brands,

        ]);
    }

    public function createPromoOngkir()
    {
        return view('admin.promo.ongkir.create');
    }

    public function storePromoOngkir(Request $request)
    {
        try {

            $request->validate([
                'promo_name' => 'required|string|max:255',
                'start_date' => 'required',
                'end_date' => 'required',
                'min_transaction' => 'required',
                'promo_code' => 'required',
                'description' => 'required',
                'terms_conditions' => 'required',
                'diskon' => 'required',
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
                'start_date' => $request->start_date,
                'end_date' => $request->end_date,
                'min_transaction' => $request->min_transaction,
                'promo_code' => $request->promo_code,
                'description' => $request->description,
                'terms_conditions' => $request->terms_conditions,
                'diskon' => $request->diskon,
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
                'discount' => 'required|numeric|min:0|max:100',
                'product_ids' => 'required|array',
                'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
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
                'discount' => $request->discount,
                'image' => $imagePath ?? null,
                'type' => $request->type, // Isi field 'type' dari input tersembunyi
            ]);

            // Simpan produk yang dipilih ke pivot table
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
