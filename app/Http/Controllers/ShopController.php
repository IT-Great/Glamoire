<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Brand;
use App\Models\Cart;
use App\Models\Cart_item;
use App\Models\Wishlist;
use App\Models\Product;
use App\Models\CategoryProduct;


class ShopController extends Controller
{
    public function allProduct(Request $request){
        try {
            $brand = Brand::where('name', $request->brand)->value('id');
            $minPrice = $request->min_price;
            $maxPrice = $request->max_price;
            $rating = $request->rating;
            $brandName = $request->brand;
            $sort = $request->sort;

            // dd($rating);
            $userId = session('id_user');

            $query = Product::where('product_name', '!=', 'NULL')
            ->when($brand !== null && $brand !== 'allbrand', function ($query) use ($brand) {
                return $query->where('brand_id', $brand);
            })
            ->when($minPrice !== null, function ($query) use ($minPrice) {
                return $query->where('regular_price', '>=', $minPrice);
            })
            ->when($maxPrice !== null, function ($query) use ($maxPrice) {
                return $query->where('regular_price', '<=', $maxPrice);
            })
            ->when($rating !== null && $rating !== 'all', function ($query) use ($rating) {
                return $query->where('rating', '=', $rating);
            });
            
    
            // Sort products based on request
            switch ($request->sort) {
                case 'latest':
                    $query->orderBy('created_at', 'desc');
                    $sort = "Terbaru";
                    break;
                // case 'popular':
                //     // Assuming you have a 'popularity' field
                //     $query->orderBy('sale', 'desc');
                //     break;
                case 'high_price':
                    $query->orderBy('regular_price', 'desc');
                    $sort = "Harga Tertinggi";
                    break;
                case 'low_price':
                    $query->orderBy('regular_price', 'asc');
                    $sort = "Harga Terendah";
                    break;
            }
    
            // Execute query and get filtered products
            $products = $query->orderBy('sale', 'desc')->paginate(15);
    
            $totalProduct = $products->count();
            $categories = CategoryProduct::whereNull('parent_id')->get();

            // Fetch subcategories grouped by parent_id
            $subCategories = CategoryProduct::whereNotNull('parent_id')->get()->groupBy('parent_id');
            $brands = Brand::get();
    
            // dd($subCategories);

            if ($userId) {
                $cartId = Cart::where('user_id', $userId)->value('id');
                $cartItems = Cart_item::where('cart_id', $cartId)->get();
                $wishlists = Wishlist::where('user_id', $userId)->get();
    
                return view('user.component.listsubcategory', [
                    'products'      => $products,
                    'totalProduct'  => $totalProduct,
                    'cartItems'     => $cartItems,
                    'wishlists'     => $wishlists,
                    'categories'    => $categories,
                    'brands'        => $brands,
                    'subCategories' => $subCategories,
                    'brandName'     => $brandName,
                    'minPrice'      => $minPrice,
                    'maxPrice'      => $maxPrice,
                    'rating'        => $rating,
                    'sort'          => $sort,
                ]);
            }
    
            return view('user.component.listsubcategory', [
                'products'      => $products,
                'categories'    => $categories,
                'subCategories' => $subCategories,
                'brands'        => $brands,
                'totalProduct'  => $totalProduct,
                'brandName'     => $brandName,
                'minPrice'      => $minPrice,
                'maxPrice'      => $maxPrice,
                'rating'        => $rating,
                'sort'          => $sort,
            ]);


        } catch (Exception $err) {
            dd($err);
        }
    }

    public function category(Request $request, $category)
    {
        try {
            // dd($request);
            $brand = Brand::where('name', $request->brand)->value('id');
            $minPrice = $request->min_price;
            $maxPrice = $request->max_price;
            $rating = $request->rating;
            $brandName = $request->brand;
            $sort = $request->sort;

            // dd($rating);
    
            $userId = session('id_user');
            $categoryId = CategoryProduct::where('name', $category)->value('id');
    
            // Base query to get products
            $query = Product::whereHas('categoryProduct', function ($query) use ($categoryId) {
                $query->where('parent_id', $categoryId);
            })->withAvg('ratingAndReviews', 'rating')
            ->when($brand !== null && $brand !== 'allbrand', function ($query) use ($brand) {
                return $query->where('brand_id', $brand);
            })
            ->when($minPrice !== null, function ($query) use ($minPrice) {
                return $query->where('regular_price', '>=', $minPrice);
            })
            ->when($maxPrice !== null, function ($query) use ($maxPrice) {
                return $query->where('regular_price', '<=', $maxPrice);
            })
            ->when($rating !== null && $rating !== 'all', function ($query) use ($rating) {
                return $query->where('rating', '=', $rating);
            });
    
            // Sort products based on request
            switch ($request->sort) {
                case 'latest':
                    $query->orderBy('created_at', 'desc');
                    $sort = "Terbaru";
                    break;
                case 'popular':
                    // Assuming you have a 'popularity' field
                    $query->orderBy('popularity', 'desc');
                    break;
                case 'high_price':
                    $query->orderBy('regular_price', 'desc');
                    $sort = "Harga Tertinggi";
                    break;
                case 'low_price':
                    $query->orderBy('regular_price', 'asc');
                    $sort = "Harga Terendah";
                    break;
            }
    
            // Execute query and get filtered products
            $products = $query->paginate(15);
    
            $totalProduct = $products->count();
            $subCategories = CategoryProduct::where('parent_id', $categoryId)->get();
            $brands = Brand::get();
    
            if ($userId) {
                $cartId = Cart::where('user_id', $userId)->value('id');
                $cartItems = Cart_item::where('cart_id', $cartId)->get();
                $wishlists = Wishlist::where('user_id', $userId)->get();
    
                return view('user.component.shop', [
                    'products'      => $products,
                    'totalProduct'  => $totalProduct,
                    'cartItems'     => $cartItems,
                    'wishlists'     => $wishlists,
                    'category'      => $category,
                    'brands'        => $brands,
                    'subCategories' => $subCategories,
                    'brandName'     => $brandName,
                    'minPrice'      => $minPrice,
                    'maxPrice'      => $maxPrice,
                    'rating'        => $rating,
                    'sort'          => $sort,
                ]);
            }
    
            return view('user.component.shop', [
                'products'      => $products,
                'category'      => $category,
                'subCategories' => $subCategories,
                'brands'        => $brands,
                'totalProduct'  => $totalProduct,
                'brandName'     => $brandName,
                'minPrice'      => $minPrice,
                'maxPrice'      => $maxPrice,
                'rating'        => $rating,
                'sort'          => $sort,
            ]);
    
        } catch (Exception $err) {
            dd($err);
        }
    }
    
    public function subCategory(Request $request, $category, $subcategory){
        try {
            $brand = Brand::where('name', $request->brand)->value('id');
            $minPrice = $request->min_price;
            $maxPrice = $request->max_price;
            $rating = $request->rating;
            $brandName = $request->brand;
            $sort = $request->sort;

            $userId = session('id_user');

            if ($userId) {
                $categoryId = CategoryProduct::where('name', $category)->value('id');
                $subCategoryId = CategoryProduct::where('name', $subcategory)->value('id');

                $products = Product::where('category_product_id', $subCategoryId)
                    ->withAvg('ratingAndReviews', 'rating')
                    ->when($brand !== null && $brand !== 'allbrand', function ($query) use ($brand) {
                        return $query->where('brand_id', $brand);
                    })
                    ->when($minPrice !== null, function ($query) use ($minPrice) {
                        return $query->where('regular_price', '>=', $minPrice);
                    })
                    ->when($maxPrice !== null, function ($query) use ($maxPrice) {
                        return $query->where('regular_price', '<=', $maxPrice);
                    })
                    ->when($rating !== null, function ($query) use ($rating) {
                        return $query->where('rating', '=', $rating);
                    });

                switch ($request->sort) {
                    case 'latest':
                        $products->orderBy('created_at', 'desc');
                        $sort = "Terbaru";
                        break;
                    case 'popular':
                        // Assuming you have a 'popularity' field
                        $products->orderBy('popularity', 'desc');
                        break;
                    case 'high_price':
                        $products->orderBy('regular_price', 'desc');
                        $sort = "Harga Tertinggi";
                        break;
                    case 'low_price':
                        $products->orderBy('regular_price', 'asc');
                        $sort = "Harga Terendah";
                        break;
                }
                $products = $products->paginate(15);


                $brands = Brand::get();

                $cartId = Cart::where('user_id', $userId)->value('id');
                $cartItems = Cart_item::where('cart_id', $cartId)->get();
                $wishlists = Wishlist::where('user_id', $userId)->get();
                $subCategories = CategoryProduct::where('parent_id', $categoryId)->get();
                $totalProduct = Product::where('category_product_id', $subCategoryId)->count();

                return view('user.component.subcategory',[
                    'products'    => $products,
                    'cartItems'   => $cartItems,
                    'wishlists'   => $wishlists,
                    'category'    => $category,
                    'subcategory' => $subcategory,
                    'brands'      => $brands,
                    'subCategories' => $subCategories,
                    'totalProduct'  => $totalProduct,
                    'brandName'       => $brandName,
                    'minPrice'    => $minPrice,
                    'maxPrice'    => $maxPrice,
                    'rating'      => $rating,
                    'sort'        => $sort,
                ]);
            }
            else{
                $categoryId = CategoryProduct::where('name', $category)->value('id');
                $subCategoryId = CategoryProduct::where('name', $subcategory)->value('id');

                // Ambil produk yang memiliki category_product_id dengan parent_id = $categoryId
                $products = Product::where('category_product_id', $subCategoryId)
                    ->when($brand !== null && $brand !== 'allbrand', function ($query) use ($brand) {
                        return $query->where('brand_id', $brand);
                    })
                    ->when($minPrice !== null, function ($query) use ($minPrice) {
                        return $query->where('regular_price', '>=', $minPrice);
                    })
                    ->when($maxPrice !== null, function ($query) use ($maxPrice) {
                        return $query->where('regular_price', '<=', $maxPrice);
                    });
                
                switch ($request->sort) {
                    case 'latest':
                        $products->orderBy('created_at', 'desc');
                        $sort = "Terbaru";
                        break;
                    case 'popular':
                        // Assuming you have a 'popularity' field
                        $products->orderBy('popularity', 'desc');
                        break;
                    case 'high_price':
                        $products->orderBy('regular_price', 'desc');
                        $sort = "Harga Tertinggi";
                        break;
                    case 'low_price':
                        $products->orderBy('regular_price', 'asc');
                        $sort = "Harga Terendah";
                        break;
                }
                $products = $products->get();
                
                $totalProduct = $totalProducts = Product::where('category_product_id', $subCategoryId)->count();

                $brands        = Brand::get();
                $subCategories = CategoryProduct::where('parent_id', $categoryId)->get();
                // dd($subCategories);
                return view('user.component.subcategory',[
                    'products'      => $products,
                    'category'      => $category,
                    'subcategory'   => $subcategory,
                    'subCategories' => $subCategories,
                    'brands'        => $brands,
                    'totalProduct'  => $totalProduct,
                    'brandName'       => $brandName,
                    'minPrice'    => $minPrice,
                    'maxPrice'    => $maxPrice,
                    'rating'      => $rating,
                    'sort'        => $sort,
                ]);
            }

        } catch (Exception $th) {
            //throw $th;
        }
    }
}
