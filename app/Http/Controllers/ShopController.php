<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cart;
use App\Models\Cart_item;
use App\Models\Wishlist;
use App\Models\Product;

class ShopController extends Controller
{
    public function category($category){
        try {
            $userId = session('id_user');
            $product = Product::get();

            if ($userId) {

                $products = Product::withAvg('ratingAndReviews', 'rating')->get();

                $cartId = Cart::where('user_id', $userId)->value('id');
                $cartItems = Cart_item::where('cart_id', $cartId)->get();
                $wishlists = Wishlist::where('user_id', $userId)->get();
               
                return view('user.component.shop',[
                    'products'  => $products,
                    'cartItems' => $cartItems,
                    'wishlists' => $wishlists,
                    'category'  => $category,
                ]);
            }
            else{
                $products = Product::get();

                return view('user.component.shop',[
                    'products' => $products ,
                    'category' => $category,
                ]);
            }

            // dd($category);
        } catch (Exception $th) {
            dd($th);
        }
    }

    public function subCategory($category, $subcategory){
        try {
            // dd($subcategory);
            return view('user.component.subcategory', compact('category', 'subcategory'));
        } catch (\Throwable $th) {
            //throw $th;
        }
    }

    public function listSubCategory($category, $subcategory, $listsubcategory){
        try {
            return view('user.component.listsubcategory', compact('category', 'subcategory', 'listsubcategory'));
        } catch (\Throwable $th) {
            //throw $th;
        }
    }
}
