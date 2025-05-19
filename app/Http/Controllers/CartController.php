<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Shipping_address;
use App\Models\User;
use App\Models\Cart;
use App\Models\Cart_item;
use App\Models\Promo;
use App\Models\Product;
use App\Models\ProductVariations;
use Carbon\Carbon;

use Exception;

class CartController extends Controller
{
    public function index(){
        try {
            $userId = session('id_user');
            if ($userId) {
                // UPDATE PRICE PRODUCT KETIKA DISKON SUDAH TIDAK ADA
                    $cartId = Cart::where('user_id', $userId)->value('id');
                    $promoProductIds = Promo::whereRaw("STR_TO_DATE(SUBSTRING_INDEX(date_range, ' - ', -1), '%Y-%m-%d') < ?", [Carbon::today()])
                        ->with(['products' => function ($query) {
                            $query->wherePivot('discounted_price', '>', 0);
                        }])
                        ->get()
                        ->pluck('products.*.id')
                        ->flatten();

                    $getRegularPrices = Product::whereIn('id', $promoProductIds)
                        ->pluck('regular_price', 'id'); // Mengambil harga regular dengan key berupa product_id

                    $getCartItems = Cart_item::where('cart_id', $cartId)
                        ->whereIn('product_id', $promoProductIds)
                        ->get(); // Mengambil item cart yang sesuai dengan promo dan cart_id

                    foreach ($getCartItems as $cartItem) {
                        $productId = $cartItem->product_id;
                        
                        // Ambil harga regular untuk product_id saat ini
                        if (isset($getRegularPrices[$productId])) {
                            $regularPrice = $getRegularPrices[$productId];
                            
                            // Update price dan total pada cart item
                            $cartItem->price = $regularPrice;
                            $cartItem->total = $regularPrice * $cartItem->quantity;
                            $cartItem->save();
                        }
                    }
                // END


                // UPDATE PRICE DISKON KETIKA ADA PROMO BARU
                    $promoDiscProductIds = Promo::whereRaw("STR_TO_DATE(SUBSTRING_INDEX(date_range, ' - ', 1), '%Y-%m-%d') <= ?", [Carbon::today()])
                        ->whereRaw("STR_TO_DATE(SUBSTRING_INDEX(date_range, ' - ', -1), '%Y-%m-%d') >= ?", [Carbon::today()])
                        ->where('status', '=', 'Active') // Pastikan status promo "Active"
                        ->with(['products' => function ($query) {
                            $query->wherePivot('discounted_price', '>', 0);
                        }])
                        ->get()
                        ->pluck('products.*.id')
                        ->flatten();

                    $getDiscountedPrices = Product::whereIn('id', $promoDiscProductIds)
                        ->with(['promos' => function ($query) {
                            $query->select('promos.*', 'promo_products.discounted_price')
                                ->wherePivot('discounted_price', '>', 0)
                                ->whereRaw("STR_TO_DATE(SUBSTRING_INDEX(date_range, ' - ', 1), '%Y-%m-%d') <= ?", [Carbon::today()])
                                ->whereRaw("STR_TO_DATE(SUBSTRING_INDEX(date_range, ' - ', -1), '%Y-%m-%d') >= ?", [Carbon::today()]);
                        }])
                        ->get()
                        ->mapWithKeys(function ($product) {
                            // Mendapatkan harga promo untuk setiap produk
                            $discountedPrice = $product->promos->first()->pivot->discounted_price ?? $product->regular_price;
                            return [$product->id => $discountedPrice];
                        });

                    // dd($getDiscountedPrices);
                    
                    $getCartItems = Cart_item::where('cart_id', $cartId)
                        ->whereIn('product_id', $promoDiscProductIds)
                        ->get();

                    // dd($getCartItems);

                    foreach ($getCartItems as $cartItem) {
                        $productId = $cartItem->product_id;
                        
                        // Ambil harga promo untuk product_id saat ini jika tersedia
                        if (isset($getDiscountedPrices[$productId])) {
                            $discountedPrice = $getDiscountedPrices[$productId];

                            // Update price dan total pada cart item
                            $cartItem->price = $discountedPrice;
                            $cartItem->total = $discountedPrice * $cartItem->quantity;
                            $cartItem->save();
                        }
                    }
                // END 

                // UPDATE PRICE KETIKA ADA PERUBAHAN HARGA DARI ADMIN (BUKAN DISKON/PROMO LAINNYA)
                    $cartId = Cart::where('user_id', $userId)->value('id');
                    $getCartItems = Cart_item::where('cart_id', $cartId)->whereNull('product_variant_id')->get();
                    $getCartItemsVariant = Cart_item::where('cart_id', $cartId)->whereNotNull('product_variant_id')->get();

                    // dd($getCartItems);
                    foreach($getCartItems as $item){
                        $product = Product::where('id', $item->product_id)
                        ->with(['promos' => function ($query) {
                            $query->select('promos.*', 'promo_products.discounted_price')
                                ->wherePivot('discounted_price', '>', 0)
                                ->whereRaw("STR_TO_DATE(SUBSTRING_INDEX(date_range, ' - ', 1), '%Y-%m-%d') <= ?", [Carbon::today()])
                                ->whereRaw("STR_TO_DATE(SUBSTRING_INDEX(date_range, ' - ', -1), '%Y-%m-%d') >= ?", [Carbon::today()]);
                        }])
                        ->first();
                        $item->price = $product->promos->first()->pivot->discounted_price ?? $product->regular_price;
                        $item->total = $item->quantity * $item->price;
                        $item->save();
                    }
                    
                    foreach($getCartItemsVariant as $variant){
                        $product = ProductVariations::where('id', $variant->product_variant_id)->first();
                        $variant->price = $product->variant_price;
                        $variant->total = $variant->quantity * $variant->price;
                        $variant->save();
                    }
                // END 

                $data = Cart_item::where('cart_id', $cartId)
                    ->with(['productVariant','product' => function ($query) {
                        $query->with(['promos' => function ($promoQuery) {
                            $promoQuery->select('promos.*', 'promo_products.discounted_price')
                                ->with(['products'])
                                ->whereRaw("STR_TO_DATE(SUBSTRING_INDEX(date_range, ' - ', 1), '%Y-%m-%d') <= ?", [Carbon::today()])
                                ->whereRaw("STR_TO_DATE(SUBSTRING_INDEX(date_range, ' - ', -1), '%Y-%m-%d') >= ?", [Carbon::today()]);
                        }]);
                    }])
                    ->orderBy('created_at', 'desc')
                    ->get();

                // dd($data);


                


                
                // $product = $data->map(function($product) {
                //     dd($product);
                // });


                // If data is found, map and process it
                if ($data->isNotEmpty()) {
                    // Sort by product stock_quantity within cartItems
                    $data = $data->sortByDesc(function ($cartItem) {
                        // Cek apakah relasi productVariant ada
                        if ($cartItem->productVariant) {
                            return $cartItem->product->stock_quantity && $cartItem->productVariant->variant_stock;
                        }
                        // Lewati item jika tidak ada relasi productVariant
                        return $cartItem->product->stock_quantity ?? 0;
                    });
                    

                    // Calculate total by summing 'total' field in cartItems
                    $total = $data->sum('total');
                    
                    // dd($data);
                } else {
                    $data = collect(); // Return as an empty collection for consistency
                    $total = 0;
                }

                return view('user.component.cart', [
                    'data' => $data,
                    'total' => $total,
                ]);
            }
            else {
                session()->flash('register_or_login_first');
                return redirect()->back();
            }
        } catch (Exception $err) {
            dd($err);
        }
    }

    // DELETE PRODUCT ITEM IN CART
    public function deleteProductItem(Request $request){
        try {
            $cartId = Cart::where('user_id', session('id_user'))->value('id');
            Cart_item::where('cart_id', $cartId)
                ->where('product_id', $request->product_id)
                ->delete();

            return response()->json(['success' => true, 'message' => 'Berhasil Menghapus Barang Dari Keranjang']);
        } catch (Exception $err) {
            //throw $th;
        }
    }
    
    public function deleteProductVariantItem(Request $request){
        try {
            $cartId = Cart::where('user_id', session('id_user'))->value('id');
            Cart_item::where('cart_id', $cartId)
                ->where('product_variant_id', $request->product_variant_id)
                ->delete();

            return response()->json(['success' => true, 'message' => 'Berhasil Menghapus Barang Dari Keranjang']);
        } catch (Exception $err) {
            //throw $th;
        }
    }

    public function deleteAllProductItem(Request $request){
        try {
            $cartId = Cart::where('user_id', session('id_user'))->value('id');
            Cart_item::where('cart_id', $cartId)
                ->where('is_choose', '=', 1)
                ->delete();

            return response()->json(['success' => true, 'message' => 'Berhasil Menghapus Barang Dari Keranjang']);
        } catch (Exception $err) {
            //throw $th;
        }
    }

    // UPDATE QUANTITY PRODUCT ITEM IN CART
    public function updateCartQuantity(Request $request){
        // Find the product in the cart or wherever the quantity is stored
        $cartId = Cart::where('user_id', session('id_user'))->value('id');

        $cartItem = Cart_item::where('cart_id', $cartId)
            ->where('product_id', $request->product_id)
            ->first();

        if ($cartItem) {
            $cartItem->update([
                'quantity' => $request->quantity,
                'total'    => ($request->quantity)*($cartItem->price),
            ]);

            return response()->json(['success' => true, 'message' => 'Quantity updated successfully']);
        }

        return response()->json(['success' => false, 'message' => 'Product not found in cart']);
    }
    
    public function updateCartQuantityVariant(Request $request){
        // Find the product in the cart or wherever the quantity is stored
        $cartId = Cart::where('user_id', session('id_user'))->value('id');

        $cartItem = Cart_item::where('cart_id', $cartId)
            ->where('product_variant_id', $request->product_variant_id)
            ->first();

        if ($cartItem) {
            $cartItem->update([
                'quantity' => $request->quantity,
                'total'    => ($request->quantity)*($cartItem->price),
            ]);

            return response()->json(['success' => true, 'message' => 'Quantity updated successfully']);
        }

        return response()->json(['success' => false, 'message' => 'Product not found in cart']);
    }

    // GET TOTAL CHART
    public function getTotalCart(){
        try {
            if (session('id_user')) {
                $userId = session('id_user');
    
                // Ambil cart berdasarkan user_id dan hitung item yang terkait
                $cart = Cart::where('user_id', $userId)
                    ->withCount('cartItems')
                    ->first();

                $totalQuantity = $cart->cartItems->sum('quantity');
            
                // Jika cart ditemukan, return jumlah item
                return response()->json($totalQuantity);
            }
            return response()->json("-");
        } catch (\Throwable $th) {
            // Log error jika diperlukan
            return response()->json(0);
        }
    }

    public function chooseProductCart(Request $request){
        try {
            $userId = session('id_user');
            $cartId = Cart::where('user_id', $userId)->value('id');
    
            // Jika "Pilih Semua" diklik
            if ($request->has('select_all')) {
                // Update semua item di keranjang
                Cart_item::where('cart_id', $cartId)
                ->whereHas('product', function ($query) {
                    $query->where('stock_quantity', '!=', 0);
                })
                ->update([
                    'is_choose' => $request->is_choose
                ]);
            } else {
                // Update produk individu
                $cartItem = Cart_item::where('cart_id', $cartId)
                    ->where('product_id', $request->product_id)
                    ->first();
    
                if ($cartItem) {
                    $cartItem->update([
                        'is_choose' => $request->is_choose,
                    ]);
                }
            }
    
            return response()->json(['success' => true]);
    
        } catch (\Throwable $th) {
            return response()->json(['success' => false, 'message' => $th->getMessage()]);
        }
    }

    public function chooseProductVariantCart(Request $request){
        try {
            $userId = session('id_user');
            $cartId = Cart::where('user_id', $userId)->value('id');
    
            $cartItem = Cart_item::where('cart_id', $cartId)
                ->where('product_variant_id', $request->product_variant_id)
                ->first();

            if ($cartItem) {
                $cartItem->update([
                    'is_choose' => $request->is_choose,
                ]);
            }
            
            return response()->json(['success' => true]);
    
        } catch (\Throwable $th) {
            return response()->json(['success' => false, 'message' => $th->getMessage()]);
        }
    }

}
