<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Shipping_address;
use App\Models\User;
use App\Models\Cart;
use App\Models\Cart_item;


class CartController extends Controller
{
    public function index(){
        $userId = session('id_user');

        if ($userId) {
            $data = Cart::where('user_id', $userId)
            ->with('cartItems.product') // Ambil relasi cartItems dengan produk
            ->get()
            ->map(function ($cart) {
                // Urutkan cartItems berdasarkan stock_quantity dari produk
                $cart->cartItems = $cart->cartItems->sortByDesc(function ($cartItem) {
                    return $cartItem->product->stock_quantity;
                });
                return $cart;
            });

            
            $total = $data->sum(function($cart) {
                return $cart->cartItems->sum('total'); // Menjumlahkan total setiap cartItems dalam setiap cart
            });
        }
        else {
            session()->flash('register_or_login_first');
            return redirect()->back();
        }

        // dd($data);
        return view('user.component.cart', [
            'data' => $data,
            'total' => $total,
        ]);
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

    // UPDATE QUANTITY PRODUCT ITEM IN CART
    public function updateCartQuantity(Request $request)
    {
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

    public function chooseProductCart(Request $request)
    {
        try {
            $userId = session('id_user');
            $cartId = Cart::where('user_id', $userId)->value('id');
    
            // Jika "Pilih Semua" diklik
            if ($request->has('select_all')) {
                // Update semua item di keranjang
                Cart_item::where('cart_id', $cartId)->update([
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
    

}
