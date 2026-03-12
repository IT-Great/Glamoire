<?php

namespace App\Http\Controllers;

use Exception;
use Carbon\Carbon;
use App\Models\User;
use App\Models\Role;
use App\Models\Cart;
use App\Models\Order;
use App\Models\Promo;
use App\Models\Buynow;
use App\Models\Invoice;
use App\Models\Product;
use App\Models\Payment;
use App\Models\Wishlist;
use App\Models\Subscribe;
use App\Models\Cart_item;
use App\Models\OrderItem;
use Illuminate\Http\Request;
use App\Models\VoucherNewUser;

use App\Models\RatingAndReview;
use App\Models\Shipping_address;


use App\Models\ProductVariations;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Http;

class UserController extends Controller
{
    private $merchantKeyId;
    private $merchantId;
    private $secretKey;
    private $merchant_ref_no;
    private $plink_ref_no;
    private $status;

    public function __construct()
    {
        $this->merchantKeyId = config('services.prismalink.merch_key_id');
        $this->merchantId = config('services.prismalink.merch_id'); 
        $this->secretKey = config('services.prismalink.secret_key');
        $this->status = config('app.env');
    }

    public function account()
    {
        try {
            // dd(session()->all());
            $id      = session('id_user');
            if($id !== null) {
                $profile = User::with([
                    'shippingAddress' => function ($query) {
                        $query->orderBy('is_main', 'DESC'); // Mengurutkan shippingAddress berdasarkan is_main
                    },
                    'wishlist.product',
                    'cart.cartItems',
                    'orders.items.product.brand',
                    'orders.invoice',
                    'orders.items.productVariant',
                    'orders.ratingAndReviews',
                    'orders.payment',
                ])->where('id', $id)
                    ->with(['orders' => function ($query) {
                        $query->orderBy('created_at', 'DESC'); // Mengurutkan orders berdasarkan tanggal terbaru
                    }])->first();


                // CEK PEMBAYARAN USER
                foreach ($profile->orders as $order) {
                    if ($order->payment['status'] !== 'completed') {
                        session(['activeTab' => '#my-order']);
                        session()->flash('payment_success');
                        $payment_status = $this->getPaymentStatus($order->id);
    
                        // JIKA ORDERAN BERHASIL DIBAYAR

                        
                        if ($payment_status['transaction_status'] == 'SETLD') {
                            $data = $payment_status;
    
                            $statusMap = [
                                'SETLD' => 'completed',
                                'REJEC' => 'failed',
                                'PNDNG' => 'pending'
                            ];
    
                            Payment::where('order_id', $order->id)->update([
                                'payment_method' => $data['payment_method'],
                                'transaction_id' => $payment_status['transaction_status'],
                                'status'         => $statusMap[$payment_status['transaction_status']],
                                'amount'         => $data['transaction_amount'],
                                'payment_date'   => Carbon::parse($data['payment_date'])->format('Y-m-d H:i:s'),
                            ]);
    
                            // Update status voucher jika digunakan
                            $orderData = Order::where('id', $order->id)->first();
    
                            $useVoucherNewUser = VoucherNewUser::where('user_id', $id)
                                ->where('code', $orderData['voucherPromo'])
                                ->first();
                            
                            if ($useVoucherNewUser) {
                                $useVoucherNewUser->is_use = 1;
                                $useVoucherNewUser->save();
                            }
    
                            if($useVoucherNewUser == NULL){
                                $voucherUsed = Promo::where('promo_code', $orderData['voucherPromo'])->first();
                            }
                            else {
                                $voucherUsed = NULL;
                            }
    
                            if ($orderData['voucherOngkir'] !== null) {
                                $ongkirUsed = Promo::where('promo_code', $orderData['voucherOngkir'])->first();
                            }
    
                            $payment = Payment::where('order_id', $order->id)->first();
                            // dd($payment);
    
                            // Jika pembayaran selesai
                            if ($payment->status == "completed") {
                                $cartId = Cart::where('user_id', $id)->value('id');
                                
                                if ($voucherUsed !== NULL) {
                                    $voucherUsed->total_used += 1;
                                    $voucherUsed->save();
                                }
    
                                if ($orderData['voucherOngkir'] !== null) {
                                    if ($ongkirUsed) {
                                        $ongkirUsed->total_used += 1;
                                        $ongkirUsed->save();
                                    }
                                }
    
                                $orderItems = OrderItem::where('order_id', $order->id)->get();
    
                                foreach($orderItems as $product){
                                    // Temukan produk berdasarkan ID
                                    if($product['product_variant_id'] !== null){
                                        $productVariant = ProductVariations::find($product['product_variant_id']);
                                        $getProductId = ProductVariations::where('id', $product['product_variant_id'])->value('product_id');
                                        $productMain = Product::find($getProductId);
    
                                        // Jika produk ditemukan, lakukan update stok
                                        if ($productVariant) {
                                            $productVariant->variant_stock -= $product['quantity'];
                                            $productVariant->save();
    
                                            $productMain->sale += $product['quantity'];
                                            $productMain->save();
                                        }
                            
                                        // Hapus item dari cart berdasarkan cart_id dan product_id
                                        Cart_item::where('cart_id', $cartId)
                                            ->where('product_variant_id', $product['product_variant_id'])
                                            ->delete();
                                    }
                                    else{
                                        $products = Product::find($product['product_id']);
                                        
                                        // Jika produk ditemukan, lakukan update stok
                                        if ($products) {
                                            $products->stock_quantity -= $product['quantity'];
                                            $products->sale += $product['quantity'];
                                            $products->save();
                                        }
                            
                                        // Hapus item dari cart berdasarkan cart_id dan product_id
                                        Cart_item::where('cart_id', $cartId)
                                            ->where('product_id', $product['product_id'])
                                            ->delete();
                                    }
                                    
                                    session(['activeTab' => '#my-order']);
                                }
                            }
    
                        } else {
                            // HAPUS ORDERAN YANG GAGAL
                            Order::where('id', $order->id)->delete();
                            OrderItem::where('order_id', $order->id)->delete();
                            Invoice::where('no_invoice', $payment_status['invoice_number'])->delete();
                            Log::info("Order ID {$order->id} has been deleted due");
                        }
                    }
                }

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
                    } elseif ($variationPrices->count() == 0) {
                        $prod->priceVariation = null;
                    } else {
                        // Jika semua harga variasi sama, cukup tampilkan satu harga
                        $prod->priceVariation = 'Rp' . number_format($variationPrices->first(), 0, ',', '.');
                    }
                }
    
                return view('user.component.account', [
                    'profile' => $profile,
                    'wishlists' => $getProductWishlist,
                ]);
            } else {
                return redirect()->route('home.glamoire');
            }
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
                'subdistrict'    => $request->subdistrict_name,
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
    
    public function actionAddShippingAddressGuest(Request $request)
    {
        try {
            $information = [
                'email'          => $request->email,
                'label'          => $request->label,
                'recipient_name' => $request->recipient_name,
                'handphone'      => $request->handphone,
                'province'       => $request->province_name,
                'regency'        => $request->regency_name,
                'district'       => $request->district_name,
                'subdistrict'    => $request->subdistrict_name,
                'address'        => $request->address,
                'benchmark'      => $request->benchmark,
                'id_province'    => $request->province,
                'id_regency'     => $request->regency,
                'id_district'    => $request->district,
                'id_subdistrict' => $request->subdistrict,
            ];

            session()->put('guest_information', $information);

            session()->flash('after_add_address');
            return redirect()->back();
        } catch (\Exception $err) {
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
                if ($checkCartUser) {
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
            else {
                $productId   = $request->product_id;
                $quantity    = 1;
                $maxQuantity = Product::where('id', $productId)->value('stock_quantity');

                $guestCart = session()->get('guest_cart', []);

                // Cek apakah produk sudah ada di cart
                $index = collect($guestCart)->search(function ($item) use ($productId) {
                    return $item['product_id'] == $productId;
                });

                if ($index !== false) {
                    // Produk sudah ada → update jumlah)
                    $guestCart[$index]['quantity'] += $quantity;
                    if($guestCart[$index]['quantity'] >= $maxQuantity){
                        $guestCart[$index]['quantity'] = $maxQuantity-1;
                    }
                } else {
                    // Produk belum ada → tambah baru
                    $guestCart[] = [
                        'product_id' => $productId,
                        'product_variant_id' => null,
                        'quantity' => $quantity,
                    ];
                }

                // Simpan kembali ke session
                session()->put('guest_cart', $guestCart);

                return response()->json(['success' => true, 'message' => 'Berhasil Menambahkan Produk ke Keranjang']);
            }  
        } catch (Exception $err) {
            return response()->json(['success' => false, 'message' => $err]);
        }
    }

    public function addToCartBuyNow(Request $request)
    {
        $cartId = Cart::where('user_id', session('id_user'))->value('id');
        $orderItems = OrderItem::where('order_id', $request->product_id)->get();
        $productOutOfStock = [];

        foreach ($orderItems as $products) {
            // PRODUK BIASA
            if ($products->product_variant_id == NULL) {
                $checkStockProduct = Product::where('id', $products->product_id)->value('stock_quantity');
                if ($checkStockProduct != 0) {
                    $cartItem = Cart_item::where('cart_id', $cartId)
                        ->where('product_id', $products->product_id)
                        ->exists();

                    if (!$cartItem) {
                        $price = Product::where('id', $products->product_id)->value('regular_price');
                        Cart_item::create([
                            'cart_id'    => $cartId,
                            'product_id' => $products->product_id,
                            'quantity'   => 1,
                            'is_choose'  => TRUE,
                            'price'      => $price,
                            'total'      => $price,
                        ]);
                    }
                } else {
                    $productName = Product::where('id', $products->product_id)->value('product_name');
                    $productOutOfStock[] = $productName;
                }
            }

            // PRODUK VARIAN
            else {
                $checkStockProduct = ProductVariations::where('id', $products->product_variant_id)->value('variant_stock');
                if ($checkStockProduct != 0) {
                    $cartItem = Cart_item::where('cart_id', $cartId)
                        ->where('product_id', $products->product_variant_id)
                        ->exists();

                    if (!$cartItem) {
                        $price = ProductVariations::where('id', $products->product_variant_id)->value('variant_price');

                        Cart_item::create([
                            'cart_id'           => $cartId,
                            'product_id'        => $products->product_id,
                            'product_variant_id' => $products->product_variant_id,
                            'quantity'          => 1,
                            'is_choose'         => TRUE,
                            'price'             => $price,
                            'total'             => $price,
                        ]);
                    }
                } else {
                    $productName = Product::where('id', $products->product_id)->value('product_name');
                    $varian = ProductVariations::where('id', $products->product_variant_id)->value('variant_value');
                    $productOutOfStock[] = "$productName - $varian";
                }
            }
        }

        Log::info(['outStock' => $productOutOfStock]);

        return response()->json([
            'success' => true,
            'message' => 'Cek Keranjang Belanjamu',
            'outOfStock' => $productOutOfStock,
        ]);
    }

    public function addToChartWithQuantity(Request $request)
    {
        try {
            $userId = session('id_user');

            // USER LOGIN
            if (session('id_user')) {
                $checkCartUser = Cart::where('user_id', session('id_user'))->exists();
                $cartId = Cart::where('user_id', session('id_user'))->value('id');

                // JIKA CART SUDAH ADA MAKA TIDAK PERLU CREATE CART
                if ($checkCartUser) {
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
                    else {
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
                } else {
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
            // GUEST
            else {
                // $productId   = $request->product_id;
                // $quantity    = $request->quantity;
                // $maxQuantity = Product::where('id', $productId)->value('stock_quantity');

                // $guestCart = session()->get('guest_cart', []);

                // // Cek apakah produk sudah ada di cart
                // $index = collect($guestCart)->search(function ($item) use ($productId) {
                //     return $item['product_id'] == $productId;
                // });

                // if ($index !== false) {
                //     // Produk sudah ada → update jumlah)
                //     $guestCart[$index]['quantity'] += $quantity;
                //     if($guestCart[$index]['quantity'] >= $maxQuantity){
                //         $guestCart[$index]['quantity'] = $maxQuantity-1;
                //     }
                // } else {
                //     // Produk belum ada → tambah baru
                //     $guestCart[] = [
                //         'product_id' => $productId,
                //         'product_variant_id' => null,
                //         'quantity' => $quantity,
                //     ];
                // }

                // Simpan kembali ke session
                // session()->put('guest_cart', $guestCart);

                // return response()->json(['success' => true, 'message' => 'Berhasil Menambahkan Produk ke Keranjang']);\
                return response()->json(['success' => false, 'message' => 'Masuk/Daftar Terlebih Dahulu']);
            }   


        } catch (Exception $err) {
            return response()->json(['success' => false, 'message' => $err]);
        }
    }

    public function addToChartWithQuantityVariant(Request $request)
    {
        try {
            $userId = session('id_user');

            if (session('id_user')) {
                $checkCartUser = Cart::where('user_id', session('id_user'))->exists();
                $cartId = Cart::where('user_id', session('id_user'))->value('id');

                // JIKA CART SUDAH ADA MAKA TIDAK PERLU CREATE CART
                if ($checkCartUser) {
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
                    else {
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
                } else {
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

    public function addToWishlist(Request $request)
    {
        try {

            if (session('id_user')) {
                $userId = session('id_user');

                if ($request->product_variant_id !== null) {
                    Wishlist::create([
                        'user_id'    => $userId,
                        'product_id' => $request->product_id,
                        'product_variant_id' => $request->product_variant_id,
                    ]);
                } else {
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

                if ($request->product_variant_id) {
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
        // dd($request);
        $address = Shipping_address::find($request->input('address-id'));

        // dd($address);

        if (!$address) {
            return response()->json(['success' => false, 'message' => 'Address not found.']);
        } else {
            $address->update($request->all());
        }

        session()->flash('after_update_address');

        return redirect()->back();
    }
    
    public function updateShippingAddressGuest(Request $request)
    {
        try {
            // dd($request);
            $information = [
                'email'          => $request->email,
                'label'          => $request->label,
                'recipient_name' => $request->recipient_name,
                'handphone'      => $request->handphone,
                'province'       => $request->province_name,
                'regency'        => $request->regency_name,
                'district'       => $request->district_name,
                'subdistrict'    => $request->subdistrict_name,
                'address'        => $request->address,
                'benchmark'      => $request->benchmark,
                'id_province'    => $request->province,
                'id_regency'     => $request->regency,
                'id_district'    => $request->district,
                'id_subdistrict' => $request->subdistrict,
            ];

            session()->put('guest_information', $information);

            session()->flash('after_edit_info');
            return redirect()->back();
        } catch (\Exception $err) {
            dd($err);
        }
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
            } else {
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

            // dd($request);
            // Loop through each product ID from the request
            foreach ($request->ratingReviewProductId as $index => $productId) {
                // Collect rating, description, and files from the request
                $rating = $request->star[$index];
                $description = $request->description[$index];
                $productVariantId = $request->productVariantId[$index];
                // dd($productVariantId);

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

    public function requestReturn(Request $request, $id)
    {
        $request->validate([
            'return_reason' => 'required|string',
            'return_image' => 'required|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        try {
            $order = \App\Models\Order::where('id', $id)->where('user_id', session('id_user'))->firstOrFail();

            // Simpan gambar bukti return
            $imagePath = null;
            if ($request->hasFile('return_image')) {
                $imagePath = $request->file('return_image')->store('return_images', 'public');
            }

            $order->update([
                'return_status' => 'requested',
                'return_reason' => $request->return_reason,
                'return_image' => $imagePath
            ]);

            return response()->json(['success' => true, 'message' => 'Pengajuan return berhasil dikirim. Menunggu konfirmasi admin.']);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => 'Gagal mengajukan return: ' . $e->getMessage()]);
        }
    }

    

    // ADMIN PAGE
    public function indexUserAdmin()
    {
        $users = User::where('role', 'user')->get();

        return view('admin.user.index', compact('users'));
    }

    public function detailUserAdmin($id)
    {
        $user = User::findOrFail($id);
        return view('admin.user.detail', compact('user'));
    }

    // public function passwordUserAdmin()
    // {
    //     $users = User::where('role', 'user')->get();

    //     return view('admin.user.index-password', compact('users'));
    // }

    public function passwordUserAdmin()
    {
        $adminUsers = User::whereIn('role', ['admin', 'superadmin', 'accounting', 'gudang'])->get();
        $normalUsers = User::where('role', 'user')->get();

        return view('admin.user.index-password', compact('adminUsers', 'normalUsers'));
    }

    public function changePasswordUserAdmin(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'new_password' => 'required|min:8|confirmed',
        ]);

        $user = User::findOrFail($request->user_id);
        $user->password = Hash::make($request->new_password);
        $user->save();

        return response()->json([
            'success' => true,
            'message' => 'Password successfully updated.'
        ]);
    }

    private function getPaymentStatus($orderId){
        try{
            if($this->status == 'local'){
                $url = 'https://api-staging.plink.co.id/gateway/v2/payment/integration/transaction/api/inquiry-transaction';
            }
            else{
                $url = 'https://api3.plink.co.id/gateway/v2/payment/integration/transaction/api/inquiry-transaction';
            }

            $invoiceId = Order::where('id',$orderId)->value('invoice_id');

            $this->merchant_ref_no  = Invoice::where('id', $invoiceId)->value('no_invoice'); 
            $this->plink_ref_no     = Invoice::where('id', $invoiceId)->value('plink_ref_no');
            $transmission_date_time = Invoice::where('id', $invoiceId)->value('transmission_date_time');

            $body = [
                "merchant_key_id" => $this->merchantKeyId,
                "merchant_id" => $this->merchantId,
                "merchant_ref_no" => $this->merchant_ref_no,
                "plink_ref_no" => $this->plink_ref_no,
                "transmission_date_time" => now()->format('Y-m-d H:i:s.v O'),
            ];
    
            $jsonBody = json_encode($body);
            $secretKey = $this->secretKey;
            $mac = hash_hmac('sha256', $jsonBody, $secretKey);
            
            // Log::info(['Body Check Status getPaymentStatus' => $body]);
            // Log::info(['mac Check Status getPaymentStatus : ' => $mac]);
            // Log::info(['secretkey Check Status getPaymentStatus : ' => $this->secretKey]);

            $response = Http::withHeaders([
                'mac' => $mac,
                'Content-Type' => 'application/json',
            ])->post($url, $body);
    
            $result = json_decode($response->getBody(), true);
            // Log::info(['Hasil Pembayaran getPaymentStatus : ' => $result]);
            return $result;
        }
        catch(Exception $err){
            dd($err->getMessage());
            Log::error('Error getPaymentStatus: ' . $err->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Error occurred while getting payment status.',
            ]);
        }
    }
}
