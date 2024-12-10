<?php

namespace App\Http\Controllers;

use App\Models\Shipping_address;
use App\Models\User;
use App\Models\Role;
use App\Models\Subscribe;
use App\Models\Cart;
use App\Models\Cart_item;
use App\Models\Wishlist;
use App\Models\Buynow;
use App\Models\Product;
use App\Models\RatingAndReview;
use App\Models\ProductVariations;

use Exception;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    // Mengambil data User
    public function account($user)
    {
        try {
            // dd(session()->all());
            $id      = session('id_user');
            $profile = User::with([
                'shippingAddress' => function ($query) {
                    $query->orderBy('is_main', 'DESC'); // Mengurutkan shippingAddress berdasarkan is_main
                },
                'wishlist.product', 
                'cart.cartItems',
                'orders.items.product.brand',
                'orders.invoice',
                'orders.items.productVariant',
                'orders.ratingAndReviews'
            ])->where('id', $id)
            ->with(['orders' => function ($query) {
                $query->orderBy('created_at', 'DESC'); // Mengurutkan orders berdasarkan tanggal terbaru
            }])->first();


            $getWishlist = Wishlist::where('user_id', $id)->pluck('product_id');
            $getProductWishlist  = Product::whereIn('id', $getWishlist)
            ->with(['promos'  => function ($query) {
                $query->select('promos.*', 'promo_products.discounted_price')
                ->whereRaw("STR_TO_DATE(SUBSTRING_INDEX(date_range, ' - ', 1), '%Y-%m-%d') <= ?", [Carbon::today()])
                ->whereRaw("STR_TO_DATE(SUBSTRING_INDEX(date_range, ' - ', -1), '%Y-%m-%d') >= ?", [Carbon::today()])
                    ->wherePivot('discounted_price', '>', 0);
                }])
            ->get();

            foreach ($getProductWishlist as $prod) {
                $variationPrices = $prod->productVariations->pluck('variant_price')->unique()->sort();

                if ($variationPrices->count() > 1) {
                    // Jika ada lebih dari satu harga unik, buat rentang harga
                    $prod->priceVariation = 'Rp' . number_format($variationPrices->first(), 0, ',', '.') 
                                            . ' - Rp' . number_format($variationPrices->last(), 0, ',', '.');
                }
                elseif($variationPrices->count() == 0){
                    $prod->priceVariation = null;
                } 
                else {
                    // Jika semua harga variasi sama, cukup tampilkan satu harga
                    $prod->priceVariation = 'Rp' . number_format($variationPrices->first(), 0, ',', '.');
                }
            }
            
            return view('user.component.account', [
                'profile' => $profile,
                'wishlists' => $getProductWishlist,
            ]);
        } catch (Exception $err) {
            dd($err);
        }
    }

    // Action Tambah Shipping Address
    public function actionAddShippingAddress(Request $request)
    {
        try {

            $id = User::where('id', session('id_user'))->value('id');
            $checkMainAddress = Shipping_address::where('user_id', $id)->where('is_main', true)->first();
            $checkUseAddress = Shipping_address::where('user_id', $id)->where('is_use', true)->first();

            Shipping_address::create([
                'label'          => $request->label,
                'recipient_name' => $request->recipient_name,
                'handphone'      => $request->handphone,
                'province'       => $request->province_name,
                'regency'        => $request->regency_name,
                'district'       => $request->district_name,
                'address'        => $request->address,
                'benchmark'      => $request->benchmark,
                'user_id'        => $id,
                'id_province'    => $request->province,
                'id_regency'     => $request->regency,
                'id_district'    => $request->district,
                'is_main'        => $checkMainAddress ? false : true,
                'is_use'         => $checkUseAddress ? false : true,
            ]);

            session()->flash('after_add_address');
            return redirect()->back();
        } catch (Exception $err) {
            dd($err);
        }
    }

    public function addToChart(Request $request)
    {
        try {
            $userId = session('id_user');
            
            if (session('id_user')) {
                $checkCartUser = Cart::where('user_id', session('id_user'))->exists();
                $cartId = Cart::where('user_id', session('id_user'))->value('id');

                // JIKA CART SUDAH ADA MAKA TIDAK PERLU CREATE CART
                if($checkCartUser){
                    $cartId = Cart::where('user_id', session('id_user'))->value('id');
                    $product = Product::with(['promos'  => function ($query) {
                    $query->select('promos.*', 'promo_products.discounted_price')
                        ->whereRaw("STR_TO_DATE(SUBSTRING_INDEX(date_range, ' - ', 1), '%Y-%m-%d') <= ?", [Carbon::today()])
                        ->whereRaw("STR_TO_DATE(SUBSTRING_INDEX(date_range, ' - ', -1), '%Y-%m-%d') >= ?", [Carbon::today()])
                        ->wherePivot('discounted_price', '>', 0);
                    }])
                    ->where('id', $request->product_id)->first();

                    $activePromo = $product->promos->first();
                    $price = $activePromo ? $activePromo->pivot->discounted_price : $product->regular_price;
                    
                    $total = $price;

                    Cart_item::create([
                        'cart_id'    => $cartId,
                        'product_id' => $request->product_id,
                        'quantity'   =>  1,
                        'is_choose'  => TRUE,
                        'price'      => $price,
                        'total'      => $total,
                    ]);

                // JIKA BARU PERTAMA KALI MENAMBAHKAN CART
                } else {
                    $cart = Cart::create([
                        'user_id' => $userId,
                    ]);
                    
                    $cartId = Cart::where('user_id', session('id_user'))->value('id');
                    $product = Product::with(['promos'  => function ($query) {
                    $query->select('promos.*', 'promo_products.discounted_price')
                        ->whereRaw("STR_TO_DATE(SUBSTRING_INDEX(date_range, ' - ', 1), '%Y-%m-%d') <= ?", [Carbon::today()])
                        ->whereRaw("STR_TO_DATE(SUBSTRING_INDEX(date_range, ' - ', -1), '%Y-%m-%d') >= ?", [Carbon::today()])
                        ->wherePivot('discounted_price', '>', 0);
                    }])
                    ->where('id', $request->product_id)->first();

                    $activePromo = $product->promos->first();
                    $price = $activePromo ? $activePromo->pivot->discounted_price : $product->regular_price;
                    
                    $total = $price;

                    Cart_item::create([
                        'cart_id'    => $cart->id,
                        'product_id' => $request->product_id,
                        'quantity'   =>  1,
                        'is_choose'  => TRUE,
                        'price'      => $price,
                        'total'      => $total,
                    ]);
                    
                }
                
                return response()->json(['success' => true, 'message' => 'Berhasil Menambahkan Produk ke Keranjang']);
            }
            return response()->json(['success' => false, 'message' => 'Masuk/Daftar Terlebih Dahulu Yaa']);

        } catch (Exception $err) {
            return response()->json(['success' => false, 'message' => $err]);
        }
    }

    public function addToCartBuyNow(Request $request){
        $cartId = Cart::where('user_id', session('id_user'))->value('id');
        foreach ($request->product_id as $productId) {
            $checkStockProduct = Product::where('id', $productId)->value('stock_quantity');

            if ($checkStockProduct !== 0) {
                $cartItem = Cart_item::where('cart_id', $cartId)
                ->where('product_id', $productId)
                ->exists(); 
    
                if(!$cartItem){
                    $price = Product::where('id', $productId)->value('regular_price');
                    
                    Cart_item::create([
                        'cart_id'    => $cartId,
                        'product_id' => $productId,
                        'quantity'   =>  1,
                        'is_choose'  => TRUE,
                        'price'      => $price,
                        'total'      => $price,
                    ]);
                }
            }
            else{
                
            }
        }
        return response()->json(['success' => true, 'message' => 'Cek Keranjang Belanjamu']);
    }

    public function addToChartWithQuantity(Request $request){
        try {
            $userId = session('id_user');
            
            if (session('id_user')) {
                $checkCartUser = Cart::where('user_id', session('id_user'))->exists();
                $cartId = Cart::where('user_id', session('id_user'))->value('id');

                // JIKA CART SUDAH ADA MAKA TIDAK PERLU CREATE CART
                if($checkCartUser){
                    $checkCartItem = Cart_item::where('cart_id', $cartId)
                    ->where('product_id', $request->product_id)->exists();

                    // JIKA PRODUK SUDAH ADA DI CART USER
                    if ($checkCartItem) {
                        $cartItem  = Cart_item::where('cart_id', $cartId)
                        ->where('product_id', $request->product_id)->first();

                        $itemPrice = $cartItem->price; 
                        $itemQuantity = $cartItem->quantity;

                        // Tingkatkan kuantitas item dengan 1
                        $newQuantity = $itemQuantity + $request->quantity;
    
                        // Hitung total harga baru berdasarkan harga satuan dan kuantitas baru
                        $newPrice = $itemPrice * $newQuantity;

                        // Update kuantitas dan harga di database
                        $cartItem->update([
                            'quantity' => $newQuantity,
                            'total'    => $newPrice, 
                        ]);
                    }
                    // JIKA PRODUK BELUM ADA DI CART USER
                    else{
                        $cartId = Cart::where('user_id', session('id_user'))->value('id');
                        $product = Product::where('id', $request->product_id)->first();
                        $total = $product->regular_price;

                        Cart_item::create([
                            'cart_id'    => $cartId,
                            'product_id' => $request->product_id,
                            'quantity'   => $request->quantity ? $request->quantity : 1,
                            'is_choose'  => TRUE,
                            'price'      => $product->regular_price,
                            'total'      => $total,
                        ]);
                    }

                // JIKA BARU PERTAMA KALI MENAMBAHKAN CART ITEM
                }else{
                    $cart = Cart::create([
                        'user_id' => $userId,
                    ]);

                    $cartId = Cart::where('user_id', session('id_user'))->value('id');
                    $product = Product::where('id', $request->product_id)->first();
                    $total = $product->regular_price;

                    Cart_item::create([
                        'cart_id'    => $cart->id,
                        'product_id' => $request->product_id,
                        'quantity'   => $request->quantity ? $request->quantity : 1,
                        'is_choose'  => TRUE,
                        'price'      => $product->regular_price,
                        'total'      => $total,
                    ]);
                    
                }

                return response()->json(['success' => true, 'message' => 'Berhasil Menambahkan Produk ke Keranjang']);
            }
            return response()->json(['success' => false, 'message' => 'Masuk/Daftar Terlebih Dahulu Yaa']);

        } catch (Exception $err) {
            return response()->json(['success' => false, 'message' => $err]);
        }
    }

    public function addToChartWithQuantityVariant(Request $request){
        try {
            $userId = session('id_user');
            
            if (session('id_user')) {
                $checkCartUser = Cart::where('user_id', session('id_user'))->exists();
                $cartId = Cart::where('user_id', session('id_user'))->value('id');

                // JIKA CART SUDAH ADA MAKA TIDAK PERLU CREATE CART
                if($checkCartUser){
                    $checkCartItem = Cart_item::where('cart_id', $cartId)
                    ->where('product_id', $request->product_id)
                    ->where('product_variant_id', $request->product_variant_id)
                    ->exists();

                    // JIKA PRODUK SUDAH ADA DI CART USER
                    if ($checkCartItem) {
                        $cartItem  = Cart_item::where('cart_id', $cartId)
                        ->where('product_id', $request->product_id)->first();

                        $itemPrice = $cartItem->price; 
                        $itemQuantity = $cartItem->quantity;

                        // Tingkatkan kuantitas item dengan 1
                        $newQuantity = $itemQuantity + $request->quantity;
    
                        // Hitung total harga baru berdasarkan harga satuan dan kuantitas baru
                        $newPrice = $itemPrice * $newQuantity;

                        // Update kuantitas dan harga di database
                        $cartItem->update([
                            'quantity' => $newQuantity,
                            'total'    => $newPrice, 
                        ]);
                    }
                    // JIKA PRODUK BELUM ADA DI CART USER
                    else{
                        $cartId = Cart::where('user_id', session('id_user'))->value('id');
                        $product = ProductVariations::where('id', $request->product_variant_id)
                        ->where('product_id', $request->product_id)
                        ->first();

                        $total = $product->variant_price;

                        Cart_item::create([
                            'cart_id'    => $cartId,
                            'product_id' => $request->product_id,
                            'product_variant_id' => $request->product_variant_id,
                            'quantity'   => $request->quantity ? $request->quantity : 1,
                            'is_choose'  => TRUE,
                            'price'      => $product->variant_price,
                            'total'      => $total,
                        ]);
                    }

                // JIKA BARU PERTAMA KALI MENAMBAHKAN CART ITEM
                }else{
                    $cart = Cart::create([
                        'user_id' => $userId,
                    ]);

                    $cartId = Cart::where('user_id', session('id_user'))->value('id');
                    $product = Product::where('id', $request->product_id)->first();
                    $total = $product->regular_price;

                    Cart_item::create([
                        'cart_id'    => $cart->id,
                        'product_id' => $request->product_id,
                        'quantity'   => $request->quantity ? $request->quantity : 1,
                        'is_choose'  => TRUE,
                        'price'      => $product->regular_price,
                        'total'      => $total,
                    ]);
                    
                }

                return response()->json(['success' => true, 'message' => 'Berhasil Menambahkan Produk ke Keranjang']);
            }
            return response()->json(['success' => false, 'message' => 'Masuk/Daftar Terlebih Dahulu Yaa']);

        } catch (Exception $err) {
            return response()->json(['success' => false, 'message' => $err]);
        }
    }

    public function addToWishlist(Request $request){
        try {

            if (session('id_user')) {
                $userId = session('id_user');
    
                if($request->product_variant_id !== null){
                    Wishlist::create([
                        'user_id'    => $userId,
                        'product_id' => $request->product_id,
                        'product_variant_id' => $request->product_variant_id,
                    ]);
                }
                else{
                    Wishlist::create([
                        'user_id'    => $userId,
                        'product_id' => $request->product_id,
                    ]);
                }
                return response()->json(['success' => true, 'message' => 'Berhasil Menambahkan Produk ke Favoritmu']);
            }
            return response()->json(['success' => false, 'message' => 'Masuk/Daftar Terlebih Dahulu Yaa']);
        } catch (Exception $err) {
            dd($err);
        }
    }

    public function removeFromWishlist(Request $request)
    {
        try {
            if (session('id_user')) {
                $userId = session('id_user');
    
                if($request->product_variant_id){
                    Wishlist::where('product_id', $request->product_id)
                    ->where('product_variant_id', $request->product_variant_id)
                    ->where('user_id', $userId)
                    ->delete();
                } else {
                    Wishlist::where('product_id', $request->product_id)
                    ->where('user_id', $userId)
                    ->delete();
                }
    
                return response()->json(['success' => true, 'message' => 'Berhasil Menghapus Barang Dari Wishlist']);
            }
            return response()->json(['success' => false, 'message' => 'Masuk/Daftar Terlebih Dahulu Yaa']);
        } catch (\Throwable $th) {
            //throw $th;
        }
    }

    public function updateProfile(Request $request)
    {
        try {
            $user = User::find(session('id_user'));
            if (!$user) {
                return response()->json(['success' => false, 'message' => 'User Tidak Ditemukan']);
            } else {
                $user->update($request->all());
                session()->put([
                    'username' => $request->fullname,
                ]);
            }

            session()->flash('after_update_profile');
            return redirect()->back();
        } catch (Exception $err) {
            dd($err);
        }
    }

    public function updateShippingAddress(Request $request)
    {
        $address = Shipping_address::find($request->input('address-id'));

        if (!$address) {
            return response()->json(['success' => false, 'message' => 'Address not found.']);
        } else {
            $address->update($request->all());
        }

        session()->flash('after_update_address');

        return redirect()->back();
    }

    public function deleteShippingAddress(Request $request)
    {
        try {
            $address = Shipping_address::where('id', $request->input('address_id'))->delete();
            // session()->flash('after_delete_address');
            return response()->json(['success' => true, 'message' => 'Berhasil Menghapus Alamat Pengiriman']);
        } catch (Exception $err) {
            dd($err);
        }
    }

    public function setMainAddress(Request $request)
    {
        try {
            DB::beginTransaction();

            // Ambil alamat utama saat ini (jika ada)
            $currentMainAddress = Shipping_address::where('user_id', session('id_user'))
                ->where('is_main', true)
                ->first();

            // Jika ada alamat utama saat ini, set is_main menjadi FALSE
            if ($currentMainAddress) {
                $currentMainAddress->update([
                    'is_main'    => false,
                    'updated_at' => now(),
                ]);
            }

            // Set alamat baru sebagai alamat utama
            $newMainAddress = Shipping_address::where('id', $request->address_id)
                ->where('user_id', session('id_user'))  // Pastikan alamat ini milik user yang sedang login
                ->firstOrFail();

            $newMainAddress->update([
                'is_main'    => true,
                'updated_at' => now(),
            ]);

            $checkIsUser = Shipping_address::where('user_id', session('id_user'))
            ->get();

            // Ambil semua alamat pengguna berdasarkan user_id dari session
            $checkIsUser = Shipping_address::where('user_id', session('id_user'))->get();

            // Cek apakah ada alamat dengan is_use == TRUE
            $hasIsUseTrue = $checkIsUser->contains('is_use', true);

            if (!$hasIsUseTrue) {
                // Jika tidak ada alamat dengan is_use == TRUE, cari yang is_main == TRUE
                $mainAddress = Shipping_address::where('user_id', session('id_user'))
                    ->where('is_main', true)
                    ->first();

                if ($mainAddress) {
                    // Set alamat utama sebagai alamat yang digunakan (is_use == TRUE)
                    $mainAddress->update(['is_use' => true]);
                }
            }



            // Commit transaction jika semua update berhasil
            DB::commit();

            return response()->json(['success' => true, 'message' => 'Berhasil Mengubah Alamat Pengiriman']);
        } catch (Exception $err) {
            dd($err);
        }
    }

    public function useAddress(Request $request)
    {
        try {
            // Ambil alamat utama saat ini (jika ada)
            $currentUseAddress = Shipping_address::where('user_id', session('id_user'))
                ->where('is_use', true)
                ->first();

            // Jika ada alamat utama saat ini, set is_main menjadi FALSE
            if ($currentUseAddress) {
                $currentUseAddress->update([
                    'is_use'    => false,
                    'updated_at' => now(),
                ]);
            }

            // Set alamat baru sebagai alamat utama
            $newUseAddress = Shipping_address::where('id', $request->address_id)
                ->where('user_id', session('id_user'))  // Pastikan alamat ini milik user yang sedang login
                ->firstOrFail();

            $newUseAddress->update([
                'is_use'    => true,
                'updated_at' => now(),
            ]);

            return response()->json(['success' => true, 'message' => 'Berhasil Mengubah Alamat Pengiriman']);
        } catch (Exception $err) {
            dd($err);
        }
    }

    // SUBSCRIBE
    public function subscribe(Request $request)
    {
        try {
            $check = Subscribe::where('email', $request->email)->exists();

            if (!$check) {
                Subscribe::create([
                    'email'      => $request->email,
                    'created_at' => now(),
                ]);
                return response()->json(['success' => true, 'message' => 'Selamat Anda Berhasil Berlangganan']);
            }
            else {
                return response()->json(['success' => false, 'message' => 'Email sudah terdaftar']);
            }

        } catch (Exception $err) {
            dd($err);
        }
    }
    
    // TAB MY PROFILE
    public function getActiveTab()
    {
        // Ambil tab aktif dari sesi
        $activeTab = session('activeTab');
        return response()->json(['activeTab' => $activeTab]);
    }

    public function setActiveTab(Request $request)
    {
        // Simpan tab aktif ke sesi
        $request->validate([
            'tab_id' => 'required|string',
        ]);

        session(['activeTab' => $request->input('tab_id')]);
        return response()->json(['success' => true]);
    }

    public function ratingAndReview(Request $request)
    {
        try {
            $userId = session('id_user');

            // Loop through each product ID from the request
            foreach ($request->ratingReviewProductId as $productId) {
                // Collect rating, description, and files from the request
                $rating = $request->star[$productId];
                $description = $request->description[$productId];
                $productVariantId = $request->productVariantId[$productId];

                // Initialize paths for images and video
                $imagePaths = [];
                $videoPath = null;

                // dd($request->hasFile("upload.$productId"));
                // Check if there are uploaded files for the current product ID
                if ($request->file("upload.$productId")) {
                    // Loop through each uploaded file for the current productId
                    foreach ($request->file("upload.$productId") as $file) {
                        // Check if the $file is a valid instance of UploadedFile
                        if ($file instanceof \Illuminate\Http\UploadedFile) {
                            // Get the MIME type of the file
                            $mimeType = $file->getMimeType();
                            $fileName = time() . '_' . $file->getClientOriginalName() . '_' . $userId . '_' . $productId;

                            // Check if the file is an image
                            if (strpos($mimeType, 'image/') === 0) {
                                // Save image
                                $imagePath = $file->storeAs('rating_review_images', $fileName, 'public');
                                $imagePaths[] = $imagePath;
                            }
                            // Check if the file is a video
                            elseif (strpos($mimeType, 'video/') === 0) {
                                // Save video
                                $videoPath = $file->storeAs('rating_review_videos', $fileName, 'public');
                            }
                        }
                    }
                }

                // Save review and rating with images and video paths
                RatingAndReview::create([
                    'user_id' => $userId,
                    'product_id' => $productId,
                    'product_variant_id' => $productVariantId,
                    'order_id' => $request->ratingReviewOrderId,
                    'rating' => $rating,
                    'description' => $description,
                    'images' => !empty($imagePaths) ? json_encode($imagePaths) : null,
                    'video' => $videoPath,
                ]);

                $product = Product::where('id', $productId)
                    ->withCount('ratingAndReviews')   // Hitung jumlah total ulasan
                    ->withAvg('ratingAndReviews', 'rating') // Hitung rata-rata rating
                    ->first();

                $averageRating = round($product->rating_and_reviews_avg_rating, 1);
                
                // Update rating dan total ulasan di tabel produk
                Product::where('id', $productId)->update([
                    'rating' => $averageRating,
                ]);
            }

            session()->flash('rating_and_review_success');

            return redirect()->back();
        } catch (Exception $err) {
            // Handle any exception and show error message
            dd($err);
        }
    }

    // ADMIN PAGE
    public function indexUserAdmin()
    {
        $users = User::where('role', 'user')->get();

        return view('admin.user.index', compact('users'));
    }


    public function detailUserAdmin()
    {
        return view('admin.user.detail');
    }
}
