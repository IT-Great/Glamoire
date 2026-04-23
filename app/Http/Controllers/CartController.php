<?php

// namespace App\Http\Controllers;

// use Illuminate\Http\Request;
// use App\Models\Shipping_address;
// use App\Models\User;
// use App\Models\Cart;
// use App\Models\Cart_item;
// use App\Models\Promo;
// use App\Models\Product;
// use App\Models\ProductVariations;
// use Carbon\Carbon;

// use Exception;

// class CartController extends Controller
// {
//     public function index(){
//         try {
//             $userId = session('id_user');
//             if ($userId) {
//                 // UPDATE PRICE PRODUCT KETIKA DISKON SUDAH TIDAK ADA
//                     $cartId = Cart::where('user_id', $userId)->value('id');
//                     $promoProductIds = Promo::whereRaw("STR_TO_DATE(SUBSTRING_INDEX(date_range, ' - ', -1), '%Y-%m-%d') < ?", [Carbon::today()])
//                         ->with(['products' => function ($query) {
//                             $query->wherePivot('discounted_price', '>', 0);
//                         }])
//                         ->get()
//                         ->pluck('products.*.id')
//                         ->flatten();

//                     $getRegularPrices = Product::whereIn('id', $promoProductIds)
//                         ->pluck('regular_price', 'id'); // Mengambil harga regular dengan key berupa product_id

//                     $getCartItems = Cart_item::where('cart_id', $cartId)
//                         ->whereIn('product_id', $promoProductIds)
//                         ->get(); // Mengambil item cart yang sesuai dengan promo dan cart_id

//                     foreach ($getCartItems as $cartItem) {
//                         $productId = $cartItem->product_id;

//                         // Ambil harga regular untuk product_id saat ini
//                         if (isset($getRegularPrices[$productId])) {
//                             $regularPrice = $getRegularPrices[$productId];

//                             // Update price dan total pada cart item
//                             $cartItem->price = $regularPrice;
//                             $cartItem->total = $regularPrice * $cartItem->quantity;
//                             $cartItem->save();
//                         }
//                     }
//                 // END

//                 // UPDATE PRICE DISKON KETIKA ADA PROMO BARU
//                     $promoDiscProductIds = Promo::whereRaw("STR_TO_DATE(SUBSTRING_INDEX(date_range, ' - ', 1), '%Y-%m-%d') <= ?", [Carbon::today()])
//                         ->whereRaw("STR_TO_DATE(SUBSTRING_INDEX(date_range, ' - ', -1), '%Y-%m-%d') >= ?", [Carbon::today()])
//                         ->where('status', '=', 'Active') // Pastikan status promo "Active"
//                         ->with(['products' => function ($query) {
//                             $query->wherePivot('discounted_price', '>', 0);
//                         }])
//                         ->get()
//                         ->pluck('products.*.id')
//                         ->flatten();

//                     $getDiscountedPrices = Product::whereIn('id', $promoDiscProductIds)
//                         ->with(['promos' => function ($query) {
//                             $query->select('promos.*', 'promo_products.discounted_price')
//                                 ->wherePivot('discounted_price', '>', 0)
//                                 ->whereRaw("STR_TO_DATE(SUBSTRING_INDEX(date_range, ' - ', 1), '%Y-%m-%d') <= ?", [Carbon::today()])
//                                 ->whereRaw("STR_TO_DATE(SUBSTRING_INDEX(date_range, ' - ', -1), '%Y-%m-%d') >= ?", [Carbon::today()]);
//                         }])
//                         ->get()
//                         ->mapWithKeys(function ($product) {
//                             // Mendapatkan harga promo untuk setiap produk
//                             $discountedPrice = $product->promos->first()->pivot->discounted_price ?? $product->regular_price;
//                             return [$product->id => $discountedPrice];
//                         });

//                     // dd($getDiscountedPrices);

//                     $getCartItems = Cart_item::where('cart_id', $cartId)
//                         ->whereIn('product_id', $promoDiscProductIds)
//                         ->get();

//                     // dd($getCartItems);

//                     foreach ($getCartItems as $cartItem) {
//                         $productId = $cartItem->product_id;

//                         // Ambil harga promo untuk product_id saat ini jika tersedia
//                         if (isset($getDiscountedPrices[$productId])) {
//                             $discountedPrice = $getDiscountedPrices[$productId];

//                             // Update price dan total pada cart item
//                             $cartItem->price = $discountedPrice;
//                             $cartItem->total = $discountedPrice * $cartItem->quantity;
//                             $cartItem->save();
//                         }
//                     }
//                 // END

//                 // UPDATE PRICE KETIKA ADA PERUBAHAN HARGA DARI ADMIN (BUKAN DISKON/PROMO LAINNYA)
//                     $cartId = Cart::where('user_id', $userId)->value('id');
//                     $getCartItems = Cart_item::where('cart_id', $cartId)->whereNull('product_variant_id')->get();
//                     $getCartItemsVariant = Cart_item::where('cart_id', $cartId)->whereNotNull('product_variant_id')->get();

//                     // dd($getCartItems);
//                     foreach($getCartItems as $item){
//                         $product = Product::where('id', $item->product_id)
//                         ->with(['promos' => function ($query) {
//                             $query->select('promos.*', 'promo_products.discounted_price')
//                                 ->wherePivot('discounted_price', '>', 0)
//                                 ->whereRaw("STR_TO_DATE(SUBSTRING_INDEX(date_range, ' - ', 1), '%Y-%m-%d') <= ?", [Carbon::today()])
//                                 ->whereRaw("STR_TO_DATE(SUBSTRING_INDEX(date_range, ' - ', -1), '%Y-%m-%d') >= ?", [Carbon::today()]);
//                         }])
//                         ->first();
//                         $item->price = $product->promos->first()->pivot->discounted_price ?? $product->regular_price;
//                         $item->total = $item->quantity * $item->price;
//                         $item->save();
//                     }

//                     foreach($getCartItemsVariant as $variant){
//                         $product = ProductVariations::where('id', $variant->product_variant_id)->first();
//                         $variant->price = $product->variant_price;
//                         $variant->total = $variant->quantity * $variant->price;
//                         $variant->save();
//                     }
//                 // END

//                 $data = Cart_item::where('cart_id', $cartId)
//                     ->with(['productVariant','product' => function ($query) {
//                         $query->with(['promos' => function ($promoQuery) {
//                             $promoQuery->select('promos.*', 'promo_products.discounted_price')
//                                 ->with(['products'])
//                                 ->whereRaw("STR_TO_DATE(SUBSTRING_INDEX(date_range, ' - ', 1), '%Y-%m-%d') <= ?", [Carbon::today()])
//                                 ->whereRaw("STR_TO_DATE(SUBSTRING_INDEX(date_range, ' - ', -1), '%Y-%m-%d') >= ?", [Carbon::today()]);
//                         }]);
//                     }])
//                     ->orderBy('created_at', 'desc')
//                     ->get();

//                 // dd($data);






//                 // $product = $data->map(function($product) {
//                 //     dd($product);
//                 // });


//                 // If data is found, map and process it
//                 if ($data->isNotEmpty()) {
//                     // Sort by product stock_quantity within cartItems
//                     $data = $data->sortByDesc(function ($cartItem) {
//                         // Cek apakah relasi productVariant ada
//                         if ($cartItem->productVariant) {
//                             return $cartItem->product->stock_quantity && $cartItem->productVariant->variant_stock;
//                         }
//                         // Lewati item jika tidak ada relasi productVariant
//                         return $cartItem->product->stock_quantity ?? 0;
//                     });


//                     // Calculate total by summing 'total' field in cartItems
//                     $total = $data->sum('total');

//                     // dd($data);
//                 } else {
//                     $data = collect(); // Return as an empty collection for consistency
//                     $total = 0;
//                 }

//                 return view('user.component.cart', [
//                     'data' => $data,
//                     'total' => $total,
//                 ]);
//             }
//             else {
//                 // dd(session());
//                 // $guestCart = session('guest_cart', []);
//                 // $productIds = collect($guestCart)->pluck('product_id')->unique()->toArray();

//                 // $expiredPromoProductIds = Promo::whereRaw("STR_TO_DATE(SUBSTRING_INDEX(date_range, ' - ', -1), '%Y-%m-%d') < ?", [Carbon::today()])
//                 //     ->with(['products' => function ($query) {
//                 //         $query->wherePivot('discounted_price', '>', 0);
//                 //     }])
//                 //     ->get()
//                 //     ->pluck('products.*.id')
//                 //     ->flatten()
//                 //     ->intersect($productIds); // hanya yang ada di cart guest

//                 // $regularPrices = Product::whereIn('id', $expiredPromoProductIds)
//                 //     ->pluck('regular_price', 'id');


//                 // $activePromoProductIds = Promo::whereRaw("STR_TO_DATE(SUBSTRING_INDEX(date_range, ' - ', 1), '%Y-%m-%d') <= ?", [Carbon::today()])
//                 //     ->whereRaw("STR_TO_DATE(SUBSTRING_INDEX(date_range, ' - ', -1), '%Y-%m-%d') >= ?", [Carbon::today()])
//                 //     ->where('status', 'Active')
//                 //     ->with(['products' => function ($query) {
//                 //         $query->wherePivot('discounted_price', '>', 0);
//                 //     }])
//                 //     ->get()
//                 //     ->pluck('products.*.id')
//                 //     ->flatten()
//                 //     ->intersect($productIds);

//                 // $discountedPrices = Product::whereIn('id', $activePromoProductIds)
//                 //     ->with(['promos' => function ($query) {
//                 //         $query->select('promos.*', 'promo_products.discounted_price')
//                 //             ->wherePivot('discounted_price', '>', 0)
//                 //             ->whereRaw("STR_TO_DATE(SUBSTRING_INDEX(date_range, ' - ', 1), '%Y-%m-%d') <= ?", [Carbon::today()])
//                 //             ->whereRaw("STR_TO_DATE(SUBSTRING_INDEX(date_range, ' - ', -1), '%Y-%m-%d') >= ?", [Carbon::today()]);
//                 //     }])
//                 //     ->get()
//                 //     ->mapWithKeys(function ($product) {
//                 //         $discounted = $product->promos->first()->pivot->discounted_price ?? $product->regular_price;
//                 //         return [$product->id => $discounted];
//                 //     });

//                 // $updatedGuestCart = [];

//                 // foreach ($guestCart as $item) {
//                 //     $productId = $item['product_id'];
//                 //     $quantity = $item['quantity'];

//                 //     // Tentukan harga
//                 //     if (isset($discountedPrices[$productId])) {
//                 //         $price = $discountedPrices[$productId];
//                 //     } elseif (isset($regularPrices[$productId])) {
//                 //         $price = $regularPrices[$productId];
//                 //     } else {
//                 //         // fallback ke harga sekarang dari produk
//                 //         $price = Product::find($productId)->regular_price ?? 0;
//                 //     }

//                 //     $updatedGuestCart[] = [
//                 //         'product_id' => $productId,
//                 //         'quantity' => $quantity,
//                 //         'price' => $price,
//                 //         'total' => $price * $quantity
//                 //     ];
//                 // }

//                 // session()->put('guest_cart', $updatedGuestCart);
//                 // return view('user.component.cart-guest');

//                 session()->flash('register_or_login_first');
//                 return redirect()->back();
//             }
//         } catch (Exception $err) {
//             dd($err);
//         }
//     }

//     // DELETE PRODUCT ITEM IN CART
//     public function deleteProductItem(Request $request){
//         try {
//             $cartId = Cart::where('user_id', session('id_user'))->value('id');
//             Cart_item::where('cart_id', $cartId)
//                 ->where('product_id', $request->product_id)
//                 ->delete();

//             return response()->json(['success' => true, 'message' => 'Berhasil Menghapus Barang Dari Keranjang']);
//         } catch (Exception $err) {
//             //throw $th;
//         }
//     }


//     public function deleteProductVariantItem(Request $request){
//         try {
//             $cartId = Cart::where('user_id', session('id_user'))->value('id');
//             Cart_item::where('cart_id', $cartId)
//                 ->where('product_variant_id', $request->product_variant_id)
//                 ->delete();

//             return response()->json(['success' => true, 'message' => 'Berhasil Menghapus Barang Dari Keranjang']);
//         } catch (Exception $err) {
//             //throw $th;
//         }
//     }

//     public function deleteProductItemGuest(Request $request)
//     {
//         try {
//             $productId = $request->input('product_id');

//             $guestCart = session('guest_cart', []);

//             // Filter: hapus produk dengan ID yang sesuai
//             $updatedCart = collect($guestCart)->reject(function ($item) use ($productId) {
//                 return $item['product_id'] == $productId;
//             })->values()->toArray(); // pastikan index ter-reset

//             session(['guest_cart' => $updatedCart]);

//             return response()->json(['success' => true, 'message' => 'Berhasil Menghapus Barang Dari Keranjang']);
//         } catch (\Exception $err) {
//             return response()->json(['success' => false, 'message' => 'Gagal menghapus produk']);
//         }
//     }


//     public function deleteAllProductItem(Request $request){
//         try {
//             $cartId = Cart::where('user_id', session('id_user'))->value('id');
//             Cart_item::where('cart_id', $cartId)
//                 ->where('is_choose', '=', 1)
//                 ->delete();

//             return response()->json(['success' => true, 'message' => 'Berhasil Menghapus Barang Dari Keranjang']);
//         } catch (Exception $err) {
//             //throw $th;
//         }
//     }

//     // UPDATE QUANTITY PRODUCT ITEM IN CART
//     public function updateCartQuantity(Request $request){
//         // Find the product in the cart or wherever the quantity is stored
//         $cartId = Cart::where('user_id', session('id_user'))->value('id');

//         $cartItem = Cart_item::where('cart_id', $cartId)
//             ->where('product_id', $request->product_id)
//             ->first();

//         if ($cartItem) {
//             $cartItem->update([
//                 'quantity' => $request->quantity,
//                 'total'    => ($request->quantity)*($cartItem->price),
//             ]);

//             return response()->json(['success' => true, 'message' => 'Quantity updated successfully']);
//         }

//         return response()->json(['success' => false, 'message' => 'Product not found in cart']);
//     }

//     public function updateCartQuantityVariant(Request $request){
//         // Find the product in the cart or wherever the quantity is stored
//         $cartId = Cart::where('user_id', session('id_user'))->value('id');

//         $cartItem = Cart_item::where('cart_id', $cartId)
//             ->where('product_variant_id', $request->product_variant_id)
//             ->first();

//         if ($cartItem) {
//             $cartItem->update([
//                 'quantity' => $request->quantity,
//                 'total'    => ($request->quantity)*($cartItem->price),
//             ]);

//             return response()->json(['success' => true, 'message' => 'Quantity updated successfully']);
//         }

//         return response()->json(['success' => false, 'message' => 'Product not found in cart']);
//     }

//     // UPDATE QUANTITY PRODUCT ITEM IN CART GUEST
//     public function updateCartQuantityGuest(Request $request)
//     {
//         try {
//             $productId = $request->input('product_id');
//             $newQuantity = (int) $request->input('quantity');

//             $guestCart = session('guest_cart', []);

//             foreach ($guestCart as &$item) {
//                 if ($item['product_id'] == $productId) {
//                     $item['quantity'] = max(1, $newQuantity);
//                     $item['total'] = $item['price'] * $newQuantity; // pastikan min qty 1
//                     $subtotalItem = $item['total'];
//                     $newQuantity = $item['quantity'];
//                     break;
//                 }
//             }

//             session(['guest_cart' => $guestCart]);

//             $totalPrice = collect(session('guest_cart'))->sum('total');

//             return response()->json([
//                 'success' => true,
//                 'message' => 'Quantity updated successfully',
//                 'total_price' => $totalPrice,
//                 'subtotal_item' => $subtotalItem,
//                 'newQuantity' => $newQuantity,
//             ]);

//         } catch (\Exception $e) {
//             return response()->json([
//                 'success' => false,
//                 'message' => 'Failed to update quantity',
//                 'error'   => $e->getMessage(),
//                 'line'    => $e->getLine(),
//                 'file'    => $e->getFile(),
//             ]);
//         }

//     }



//     // GET TOTAL CHART
//     public function getTotalCart(){
//         try {
//             if (session('id_user')) {
//                 $userId = session('id_user');

//                 // Ambil cart berdasarkan user_id dan hitung item yang terkait
//                 $cart = Cart::where('user_id', $userId)
//                     ->withCount('cartItems')
//                     ->first();

//                 $totalQuantity = $cart->cartItems->sum('quantity');

//                 // Jika cart ditemukan, return jumlah item
//                 return response()->json($totalQuantity);
//             }
//             return response()->json("-");
//         } catch (\Throwable $th) {
//             // Log error jika diperlukan
//             return response()->json(0);
//         }
//     }

//     public function chooseProductCart(Request $request){
//         try {
//             $userId = session('id_user');
//             $cartId = Cart::where('user_id', $userId)->value('id');

//             // Jika "Pilih Semua" diklik
//             if ($request->has('select_all')) {
//                 // Update semua item di keranjang
//                 Cart_item::where('cart_id', $cartId)
//                 ->whereHas('product', function ($query) {
//                     $query->where('stock_quantity', '!=', 0);
//                 })
//                 ->update([
//                     'is_choose' => $request->is_choose
//                 ]);
//             } else {
//                 // Update produk individu
//                 $cartItem = Cart_item::where('cart_id', $cartId)
//                     ->where('product_id', $request->product_id)
//                     ->first();

//                 if ($cartItem) {
//                     $cartItem->update([
//                         'is_choose' => $request->is_choose,
//                     ]);
//                 }
//             }

//             return response()->json(['success' => true]);

//         } catch (\Throwable $th) {
//             return response()->json(['success' => false, 'message' => $th->getMessage()]);
//         }
//     }

//     public function chooseProductVariantCart(Request $request){
//         try {
//             $userId = session('id_user');
//             $cartId = Cart::where('user_id', $userId)->value('id');

//             $cartItem = Cart_item::where('cart_id', $cartId)
//                 ->where('product_variant_id', $request->product_variant_id)
//                 ->first();

//             if ($cartItem) {
//                 $cartItem->update([
//                     'is_choose' => $request->is_choose,
//                 ]);
//             }

//             return response()->json(['success' => true]);

//         } catch (\Throwable $th) {
//             return response()->json(['success' => false, 'message' => $th->getMessage()]);
//         }
//     }

// }

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
use App\Models\Wishlist; // Don't forget to import this

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
                    ->pluck('regular_price', 'id');

                $getCartItems = Cart_item::where('cart_id', $cartId)
                    ->whereIn('product_id', $promoProductIds)
                    ->get();

                foreach ($getCartItems as $cartItem) {
                    $productId = $cartItem->product_id;

                    if (isset($getRegularPrices[$productId])) {
                        $regularPrice = $getRegularPrices[$productId];

                        $cartItem->price = $regularPrice;
                        $cartItem->total = $regularPrice * $cartItem->quantity;
                        $cartItem->save();
                    }
                }
                // END

                // UPDATE PRICE DISKON KETIKA ADA PROMO BARU
                $promoDiscProductIds = Promo::whereRaw("STR_TO_DATE(SUBSTRING_INDEX(date_range, ' - ', 1), '%Y-%m-%d') <= ?", [Carbon::today()])
                    ->whereRaw("STR_TO_DATE(SUBSTRING_INDEX(date_range, ' - ', -1), '%Y-%m-%d') >= ?", [Carbon::today()])
                    ->where('status', '=', 'Active')
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
                        $discountedPrice = $product->promos->first()->pivot->discounted_price ?? $product->regular_price;
                        return [$product->id => $discountedPrice];
                    });

                $getCartItems = Cart_item::where('cart_id', $cartId)
                    ->whereIn('product_id', $promoDiscProductIds)
                    ->get();

                foreach ($getCartItems as $cartItem) {
                    $productId = $cartItem->product_id;

                    if (isset($getDiscountedPrices[$productId])) {
                        $discountedPrice = $getDiscountedPrices[$productId];

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

                if ($data->isNotEmpty()) {
                    $data = $data->sortByDesc(function ($cartItem) {
                        if ($cartItem->productVariant) {
                            return $cartItem->product->stock_quantity && $cartItem->productVariant->variant_stock;
                        }
                        return $cartItem->product->stock_quantity ?? 0;
                    });
                    $total = $data->sum('total');
                } else {
                    $data = collect();
                    $total = 0;
                }

                // =========================================================================
                // NEW SECTION: Fetch Top Selling Products for "You May Also Like"
                // =========================================================================
                $recommendedProducts = Product::with(['brand', 'productVariations', 'promos' => function ($query) {
                    $query->select('promos.*', 'promo_products.discounted_price')
                        ->whereRaw("STR_TO_DATE(SUBSTRING_INDEX(date_range, ' - ', 1), '%Y-%m-%d') <= ?", [Carbon::today()])
                        ->whereRaw("STR_TO_DATE(SUBSTRING_INDEX(date_range, ' - ', -1), '%Y-%m-%d') >= ?", [Carbon::today()])
                        ->wherePivot('discounted_price', '>', 0);
                }])
                ->where('stock_quantity', '>', 0) // Only show available products
                ->orderBy('sale', 'desc') // Order by highest sales
                ->take(5) // Limit to 5 products
                ->get();

                // Format price variants for recommended products
                foreach ($recommendedProducts as $prod) {
                    $variationPrices = $prod->productVariations->pluck('variant_price')->unique()->sort();
                    if ($variationPrices->count() > 1) {
                        $prod->priceVariation = 'Rp' . number_format($variationPrices->first(), 0, ',', '.') . ' - Rp' . number_format($variationPrices->last(), 0, ',', '.');
                    } elseif ($variationPrices->count() == 1) {
                        $prod->priceVariation = 'Rp' . number_format($variationPrices->first(), 0, ',', '.');
                    } else {
                        $prod->priceVariation = null;
                    }
                }

                // Get Wishlist & Cart arrays to toggle button states in the UI
                $wishlistArray = Wishlist::where('user_id', $userId)->pluck('product_id')->toArray();
                $cartItemsArray = $data->pluck('product_id')->toArray();

                return view('user.component.cart', [
                    'data' => $data,
                    'total' => $total,
                    'recommendedProducts' => $recommendedProducts,
                    'wishlistArray' => $wishlistArray,
                    'cartItemsArray' => $cartItemsArray
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

    public function deleteProductItemGuest(Request $request)
    {
        try {
            $productId = $request->input('product_id');

            $guestCart = session('guest_cart', []);

            // Filter: hapus produk dengan ID yang sesuai
            $updatedCart = collect($guestCart)->reject(function ($item) use ($productId) {
                return $item['product_id'] == $productId;
            })->values()->toArray(); // pastikan index ter-reset

            session(['guest_cart' => $updatedCart]);

            return response()->json(['success' => true, 'message' => 'Berhasil Menghapus Barang Dari Keranjang']);
        } catch (\Exception $err) {
            return response()->json(['success' => false, 'message' => 'Gagal menghapus produk']);
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

    // UPDATE QUANTITY PRODUCT ITEM IN CART GUEST
    public function updateCartQuantityGuest(Request $request)
    {
        try {
            $productId = $request->input('product_id');
            $newQuantity = (int) $request->input('quantity');

            $guestCart = session('guest_cart', []);

            foreach ($guestCart as &$item) {
                if ($item['product_id'] == $productId) {
                    $item['quantity'] = max(1, $newQuantity);
                    $item['total'] = $item['price'] * $newQuantity; // pastikan min qty 1
                    $subtotalItem = $item['total'];
                    $newQuantity = $item['quantity'];
                    break;
                }
            }

            session(['guest_cart' => $guestCart]);

            $totalPrice = collect(session('guest_cart'))->sum('total');

            return response()->json([
                'success' => true,
                'message' => 'Quantity updated successfully',
                'total_price' => $totalPrice,
                'subtotal_item' => $subtotalItem,
                'newQuantity' => $newQuantity,
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to update quantity',
                'error'   => $e->getMessage(),
                'line'    => $e->getLine(),
                'file'    => $e->getFile(),
            ]);
        }

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
