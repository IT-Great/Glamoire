<?php

namespace App\Http\Controllers;

use App\Mail\sendMailNotifyMe;
use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Models\CategoryProduct;
use App\Models\Product;
use App\Models\Partner;
use App\Models\ProductVariations;
use App\Models\User;
use App\Models\Wishlist;
use App\Models\Cart;
use App\Models\Cart_item;
use App\Models\Promo;
use App\Models\NotifyMe;
use App\Models\ProductStocks;
use Exception;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Mail;




class ProductController extends Controller
{
    public function index()
    {
        try {
            $userId = session('id_user');

            if ($userId) {
                $date = now()->format('Y-m-d');
                $data = User::where('id', $userId)->first();
                $wishlist = Wishlist::where('user_id', $userId)->get();

                $cartId = Cart::where('user_id', $userId)->value('id');
                $cartItems = Cart_item::where('cart_id', $cartId)->get();

                $topsell = Product::with(['promos' => function ($query) {
                    $query->select('promos.*', 'promo_products.discounted_price')
                        ->wherePivot('discounted_price', '>', 0)
                        ->whereRaw("STR_TO_DATE(SUBSTRING_INDEX(date_range, ' - ', 1), '%Y-%m-%d') <= ?", [Carbon::today()])
                        ->whereRaw("STR_TO_DATE(SUBSTRING_INDEX(date_range, ' - ', -1), '%Y-%m-%d') >= ?", [Carbon::today()]);
                }])
                ->orderBy('sale', 'desc')
                ->take(10)
                ->get();
                
                foreach ($topsell as $prod) {
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

                $new     = Product::with(['promos'  => function ($query) {
                    $query->select('promos.*', 'promo_products.discounted_price')
                        ->wherePivot('discounted_price', '>', 0)
                        ->whereRaw("STR_TO_DATE(SUBSTRING_INDEX(date_range, ' - ', 1), '%Y-%m-%d') <= ?", [Carbon::today()])
                        ->whereRaw("STR_TO_DATE(SUBSTRING_INDEX(date_range, ' - ', -1), '%Y-%m-%d') >= ?", [Carbon::today()]);
                }])
                ->orderBy('created_at', 'desc')->take(10)->get();

                foreach ($new as $prodnew) {
                    $variationPrices = $prodnew->productVariations->pluck('variant_price')->unique()->sort();

                    if ($variationPrices->count() > 1) {
                        // Jika ada lebih dari satu harga unik, buat rentang harga
                        $prodnew->priceVariation = 'Rp' . number_format($variationPrices->first(), 0, ',', '.') 
                                                . ' - Rp' . number_format($variationPrices->last(), 0, ',', '.');
                    }
                    elseif($variationPrices->count() == 0){
                        $prodnew->priceVariation = null;
                    } 
                    else {
                        // Jika semua harga variasi sama, cukup tampilkan satu harga
                        $prodnew->priceVariation = 'Rp' . number_format($variationPrices->first(), 0, ',', '.');
                    }
                }

                $date = now()->format('Y-m-d');
                $promos = Promo::where('type', '=', 'promo')
                    ->whereRaw("STR_TO_DATE(SUBSTRING_INDEX(date_range, ' - ', 1), '%Y-%m-%d') <= ?", [$date])
                    ->whereRaw("STR_TO_DATE(SUBSTRING_INDEX(date_range, ' - ', -1), '%Y-%m-%d') >= ?", [$date])
                    ->get();

                $mainPromo = Promo::where('type', 'promo')
                    ->whereRaw("STR_TO_DATE(SUBSTRING_INDEX(date_range, ' - ', 1), '%Y-%m-%d') <= ?", [$date])
                    ->whereRaw("STR_TO_DATE(SUBSTRING_INDEX(date_range, ' - ', -1), '%Y-%m-%d') >= ?", [$date])
                    ->latest() // Order by latest created/updated promo
                    ->first();

                $promoModal = $mainPromo;

                $data = [
                    'wishlist'  => $wishlist,
                    'cartItems' => $cartItems,
                    'promos'    => $promos,
                    'promoModal' => $promoModal,
                    'topsell' => $topsell,
                    'new'     => $new,
                ];

                return view('user.component.home')->with('data', $data);
            } else {
                $product = Product::with(['productVariations'])->get();

                foreach ($product as $product) {
                    $variationPrices = $product->productVariations->pluck('variant_price')->unique()->sort();

                    if ($variationPrices->count() > 1) {
                        // Jika ada lebih dari satu harga unik, buat rentang harga
                        $product->priceVariation = 'Rp' . number_format($variationPrices->first(), 0, ',', '.') 
                                                . ' - Rp' . number_format($variationPrices->last(), 0, ',', '.');
                    } else {
                        // Jika semua harga variasi sama, cukup tampilkan satu harga
                        $product->priceVariation = 'Rp' . number_format($variationPrices->first(), 0, ',', '.');
                    }
                }

                // dd($product);
                
                $topsell = Product::with(['promos' => function ($query) {
                    $query->select('promos.*', 'promo_products.discounted_price')
                        ->wherePivot('discounted_price', '>', 0)
                        ->whereRaw("STR_TO_DATE(SUBSTRING_INDEX(date_range, ' - ', 1), '%Y-%m-%d') <= ?", [Carbon::today()])
                        ->whereRaw("STR_TO_DATE(SUBSTRING_INDEX(date_range, ' - ', -1), '%Y-%m-%d') >= ?", [Carbon::today()]);
                }])
                ->orderBy('sale', 'desc')->take(10)->get();

                foreach ($topsell as $prod) {
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

                $new = Product::with(['promos'  => function ($query) {
                    $query->select('promos.*', 'promo_products.discounted_price')
                        ->wherePivot('discounted_price', '>', 0)
                        ->whereRaw("STR_TO_DATE(SUBSTRING_INDEX(date_range, ' - ', 1), '%Y-%m-%d') <= ?", [Carbon::today()])
                        ->whereRaw("STR_TO_DATE(SUBSTRING_INDEX(date_range, ' - ', -1), '%Y-%m-%d') >= ?", [Carbon::today()]);
                }])
                ->orderBy('created_at', 'desc')->take(10)->get();

                foreach ($new as $prodnew) {
                    $variationPrices = $prodnew->productVariations->pluck('variant_price')->unique()->sort();

                    if ($variationPrices->count() > 1) {
                        // Jika ada lebih dari satu harga unik, buat rentang harga
                        $prodnew->priceVariation = 'Rp' . number_format($variationPrices->first(), 0, ',', '.') 
                                                . ' - Rp' . number_format($variationPrices->last(), 0, ',', '.');
                    }
                    elseif($variationPrices->count() == 0){
                        $prodnew->priceVariation = null;
                    } 
                    else {
                        // Jika semua harga variasi sama, cukup tampilkan satu harga
                        $prodnew->priceVariation = 'Rp' . number_format($variationPrices->first(), 0, ',', '.');
                    }
                }
                
                $date = now()->format('Y-m-d');
                $promos = Promo::where('type', '=', 'promo')
                    ->whereRaw("STR_TO_DATE(SUBSTRING_INDEX(date_range, ' - ', 1), '%Y-%m-%d') <= ?", [$date])
                    ->whereRaw("STR_TO_DATE(SUBSTRING_INDEX(date_range, ' - ', -1), '%Y-%m-%d') >= ?", [$date])
                    ->get();

                $data = [
                    'topsell' => $topsell,
                    'new'     => $new,
                    'product' => $product,
                    'promos'  => $promos,
                ];

                // dd(count($data['wishlist']));
                // dd($data);
                return view('user.component.home')->with('data', $data);
            }

            // dd($data->whislist);
            // dd(count($data->whislist));


        } catch (Exception $err) {
            dd($err);
        }
    }

    public function detail(Request $request, $code)
    {
        try {
            $product = Product::where('product_code', $code)
                ->with(['ratingAndReviews.user', 'promos'  => function ($query) {
                $query->select('promos.*', 'promo_products.discounted_price')
                    ->wherePivot('discounted_price', '>', 0)
                    ->whereRaw("STR_TO_DATE(SUBSTRING_INDEX(date_range, ' - ', 1), '%Y-%m-%d') <= ?", [Carbon::today()])
                    ->whereRaw("STR_TO_DATE(SUBSTRING_INDEX(date_range, ' - ', -1), '%Y-%m-%d') >= ?", [Carbon::today()]);
                }])
                ->withCount('ratingAndReviews')   // Count the total number of reviews
                ->withAvg('ratingAndReviews', 'rating')
                ->first();

            $averageRating = number_format($product->rating_and_reviews_avg_rating, 1);
            $totalReviews = $product->rating_and_reviews_count;

            $categoryMainProduct = $product->category_product_id;
            $getParent = CategoryProduct::where('id', $categoryMainProduct)->value('parent_id');
            $subCategories = CategoryProduct::where('parent_id', $getParent)->pluck('id')->toArray();

            $youlike = Product::whereIn('category_product_id', $subCategories)
            ->with(['promos'  => function ($query) {
            $query->select('promos.*', 'promo_products.discounted_price')
                ->wherePivot('discounted_price', '>', 0)
                ->whereRaw("STR_TO_DATE(SUBSTRING_INDEX(date_range, ' - ', 1), '%Y-%m-%d') <= ?", [Carbon::today()])
                ->whereRaw("STR_TO_DATE(SUBSTRING_INDEX(date_range, ' - ', -1), '%Y-%m-%d') >= ?", [Carbon::today()]);
            }])
            ->orderBy('sale', 'desc')->get();
            foreach ($youlike as $prod) {
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

            // dd($youlike);
            
            $product->images = json_decode($product->images, true);
            $product->dimensions = json_decode($product->dimensions, true);

            // Cek Varian
            $checkVariant = ProductVariations::where('product_id', $product->id)->get();
            $variantType = $checkVariant->pluck('variant_type')->first();

            // dd($variantType);
            $userId = session('id_user');

            // dd(count($variant));

            if (count($checkVariant) == 0) {
                if ($userId) {
                    $wishlists = Wishlist::where('user_id', $userId)->get();
                    $cartId = Cart::where('user_id', $userId)->value('id');
                    $cartItems = Cart_item::where('cart_id', $cartId)->get();

                    return view('user.component.detail', [
                        'averageRating' => $averageRating,
                        'product'       => $product,
                        'youlike'       => $youlike,
                        'wishlists'     => $wishlists,
                        'cartItems'     => $cartItems,
                    ]);
                } else {
                    return view('user.component.detail', [
                        'averageRating' => $averageRating,
                        'product'       => $product,
                        'youlike'       => $youlike,
                    ]);
                }
            }

            // PRODUK VARIAN
            else {
                if ($userId) {
                    $wishlists = Wishlist::where('user_id', $userId)->get();
                    $cartId = Cart::where('user_id', $userId)->value('id');
                    
                    $query = Product::where('product_code', $code)
                        ->with('ratingAndReviews.user')
                        ->withCount('ratingAndReviews')
                        ->withAvg('ratingAndReviews', 'rating');

                    if ($request->varian) {
                        // Filter berdasarkan varian jika ada
                        $sku = $request->varian;
                        $query->with(['productVariations' => function ($q) use ($sku) {
                            $q->where('sku', $sku);
                        }]);
                    } else {
                        // Ambil semua varian jika tidak ada filter
                        $query->with('productVariations');
                    }

                    $product = $query->first();

                    if (!$product) {
                        abort(404);
                    }

                    $product->images = json_decode($product->images, true);
                    $product->dimensions = json_decode($product->dimensions, true);

                    $firstVariant = $product->productVariations->first();

                    $cartItems = Cart_item::where('cart_id', $cartId)
                        ->where('product_variant_id', $firstVariant->id)
                        ->get();

                    return view('user.component.detail-varian', [
                        'averageRating' => $averageRating,
                        'product'       => $product,
                        'youlike'       => $youlike,
                        'wishlists'     => $wishlists,
                        'cartItems'     => $cartItems,
                        'firstVariant'  => $firstVariant,
                        'variant'       => $checkVariant,
                        'variantType'   => $variantType,
                    ]);
                } else {
                    $query = Product::where('product_code', $code)
                        ->with('ratingAndReviews.user')
                        ->withCount('ratingAndReviews')
                        ->withAvg('ratingAndReviews', 'rating');

                    if ($request->varian) {
                        // Filter berdasarkan varian jika ada
                        $sku = $request->varian;
                        $query->with(['productVariations' => function ($q) use ($sku) {
                            $q->where('sku', $sku);
                        }]);
                    } else {
                        // Ambil semua varian jika tidak ada filter
                        $query->with('productVariations');
                    }

                    $product = $query->first();

                    if (!$product) {
                        abort(404);
                    }

                    $product->images = json_decode($product->images, true);
                    $product->dimensions = json_decode($product->dimensions, true);

                    $firstVariant = $product->productVariations->first();

                    return view('user.component.detail-varian', [
                        'averageRating' => $averageRating,
                        'product'       => $product,
                        'firstVariant'  => $firstVariant,
                        'youlike'       => $youlike,
                        'variant'       => $checkVariant,
                        'variantType'   => $variantType,
                    ]);
                }
            }
        } catch (Exception $err) {
            dd($err);
        }
    }

    public function search(Request $request)
    {
        $product_search = $request->product_search; // Get the search query
        $brand = Brand::where('name', $request->brand)->value('id');
        $minPrice = $request->min_price;
        $maxPrice = $request->max_price;
        $rating = $request->rating;
        $brandName = $request->brand;
        $sort = $request->sort;
        // dd($request);

        $products = Product::where(function ($query) use ($product_search) {
            $query->where('product_name', 'like', '%' . $product_search . '%')
                ->orWhere('description', 'like', '%' . $product_search . '%')
                ->orWhere('information_product', 'like', '%' . $product_search . '%');
        })
            ->with(['promos'  => function ($query) {
                $query->select('promos.*', 'promo_products.discounted_price')
                    ->wherePivot('discounted_price', '>', 0);
            }])
            ->when($brand !== null && $brand !== 'allbrand', function ($query) use ($brand) {
                return $query->where('brand_id', $brand);
            })
            ->when($rating !== null && $rating !== 'all', function ($query) use ($rating) {
                return $query->where('rating', $rating);
            })
            ->when($minPrice !== null, function ($query) use ($minPrice) {
                return $query->where('regular_price', '>=', $minPrice);
            })
            ->when($maxPrice !== null, function ($query) use ($maxPrice) {
                return $query->where('regular_price', '<=', $maxPrice);
            })
            ->when($brand !== null && $brand !== 'allbrand', function ($query) use ($brand) {
                return $query->where('brand_id', $brand);
            })
            ->when($rating !== null && $rating !== 'all', function ($query) use ($rating) {
                return $query->where('rating', $rating);
            })
            ->when($minPrice !== null, function ($query) use ($minPrice) {
                return $query->where('regular_price', '>=', $minPrice);
            })
            ->when($maxPrice !== null, function ($query) use ($maxPrice) {
                return $query->where('regular_price', '<=', $maxPrice);
            });

        // Apply sorting
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

        foreach ($products as $product) {
            $variationPrices = $product->productVariations->pluck('variant_price')->unique()->sort();

            if ($variationPrices->count() > 1) {
                // Jika ada lebih dari satu harga unik, buat rentang harga
                $product->priceVariation = 'Rp' . number_format($variationPrices->first(), 0, ',', '.') 
                                        . ' - Rp' . number_format($variationPrices->last(), 0, ',', '.');
            }
            elseif($variationPrices->count() == 0){
                $product->priceVariation = null;
            } 
            else {
                // Jika semua harga variasi sama, cukup tampilkan satu harga
                $product->priceVariation = 'Rp' . number_format($variationPrices->first(), 0, ',', '.');
            }
        }

        
        $userId = session('id_user');

        if ($userId) {
            $wishlists = Wishlist::where('user_id', $userId)->get();
            $cartId = Cart::where('user_id', $userId)->value('id');
            $cartItems = Cart_item::where('cart_id', $cartId)->get();
            $brands = Brand::get();

            if (count($products) !== 0) {
                $data = [
                    'products'    => $products,
                    'keyword'     => $product_search,
                    'count'       => count($products),
                    'wishlists'   => $wishlists,
                    'cartItems'   => $cartItems,
                    'brands'      => $brands,
                    'brand'       => $brandName,
                    'minPrice'    => $minPrice,
                    'maxPrice'    => $maxPrice,
                    'rating'      => $rating,
                    'sort'        => $sort,
                ];

                return view('user.component.search')->with('data', $data); // Return results to a view
            } else {
                $products = [
                    'products' => [],
                    'keyword' => $product_search,
                    'count'   => 0,
                    'brand'   => $request->brand,
                    'min_price' => $request->min_price,
                    'max_price' => $request->max_price,
                    'rating' => $request->rating,
                    'brands'      => $brands,
                    'brand'       => $brandName,
                    'minPrice'    => $minPrice,
                    'maxPrice'    => $maxPrice,
                    'rating'      => $rating,
                    'sort'        => $sort,
                ];

                return view('user.component.search')->with('data', $products);
            }
        } else {
            $brands = Brand::get();

            if (count($products) !== 0) {
                $data = [
                    'products'    => $products,
                    'keyword'     => $product_search,
                    'count'       => count($products),
                    'brands'      => $brands,
                    'brand'       => $brandName,
                    'minPrice'    => $minPrice,
                    'maxPrice'    => $maxPrice,
                    'rating'      => $rating,
                    'sort'        => $sort,
                ];

                return view('user.component.search')->with('data', $data); // Return results to a view
            } else {
                $products = [
                    'products' => [],
                    'keyword' => $product_search,
                    'count'   => 0,
                    'brand'   => $request->brand,
                    'min_price' => $request->min_price,
                    'max_price' => $request->max_price,
                    'rating' => $request->rating,
                    'brands'      => $brands,
                    'brand'       => $brandName,
                    'minPrice'    => $minPrice,
                    'maxPrice'    => $maxPrice,
                    'rating'      => $rating,
                    'sort'        => $sort,
                ];

                return view('user.component.search')->with('data', $products);
            }
        }
    }

    public function notify($id)
    {
        $product  = Product::where('id', $id)->first();
        $emails   = NotifyMe::where('product_id', $id)
            ->where('status', 0)
            ->get();

        if (count($emails) !== 0) {
            foreach ($emails as $email) {
                $fullName = User::where('id', $email->user_id)->value('fullname');
                $email_target = $email->email;

                $data = [
                    'fullname'     => $fullName,
                    'product_name' => $product->product_name,
                    'product_link' => url("http://127.0.0.1:8000/{$product->product_code}_product")
                ];

                Mail::to($email_target)->send(new sendMailNotifyMe($data));
                NotifyMe::where('product_id', $id)
                    ->where('email', $email_target)->update([
                    'status' => 1,
                    'send_at' => now(),
                ]);
            }

            return response()->json([
                'success' => true,
                'message' => 'Berhasil mengirimkan notifikasi broooo'
            ]);
        }

        return response()->json([
            'success' => false,
            'message' => 'Tidak ada email yang tersimpan'
        ]);
    }

    // START PRODUCT ADMIN
    public function indexProductAdmin()
    {
        $products = Product::with(['categoryProduct', 'brand', 'promos' => function ($query) {
            $query->select('promos.*', 'promo_products.discounted_price')
                ->wherePivot('discounted_price', '>', 0);
        }])
            ->orderBy('created_at', 'desc')
            ->paginate(100);

        return view('admin.product.index', [
            'products' => $products,
        ]);
    }


    public function createProductAdmin()
    {
        $options = CategoryProduct::whereHas('parent', function ($query) {
            $query->whereNotNull('parent_id');
        })->get();

        $categories = CategoryProduct::whereNull('parent_id')->get(); // Mengambil semua category utama


        $subcategories = CategoryProduct::whereNotNull('parent_id')->get();

        $brands = Brand::all(); // Mengambil semua data brand

        return view('admin.product.create', [
            'options' => $options,
            'subcategories' => $subcategories,
            'categories' => $categories,
            'brands' => $brands
        ]);
    }



    // lancar jaya
    public function storeProductAdmin(Request $request)
    {
        try {
            $request->validate([
                'product_name' => 'required',
                'stock_quantity' => 'required',
                'regular_price' => 'required',
                'stock_quantity' => 'required|integer',
                'weight_product' => 'required|numeric',
                'main_image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
                'images' => 'required|array|min:1|max:6', // Ubah ini
                'images.*' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
                'video' => 'nullable|mimes:mp4,avi,mov|max:5048',
                'description' => 'required',
            ]);

            // Hapus format rupiah dari regular_price
            $regularPrice = str_replace(['Rp. ', '.'], '', $request->regular_price);

            // Simpan single image
            $mainImagePath = null;
            if ($request->hasFile('main_image')) {
                $mainImage = $request->file('main_image');
                $mainImageName = time() . '_' . $mainImage->getClientOriginalName();
                // Simpan file ke storage/app/public/product_images
                $mainImagePath = $mainImage->storeAs('product_images', $mainImageName, 'public');
            }

            // Multiple Images
            $imagePaths = [];
            if ($request->hasFile('images')) {
                foreach ($request->file('images') as $image) {
                    $imageName = time() . '_' . $image->getClientOriginalName();
                    // Simpan file ke storage/app/public/product_images
                    $imagePath = $image->storeAs('product_images', $imageName, 'public');
                    $imagePaths[] = $imagePath;
                }
            }

            // Simpan video
            $videoPath = null;
            if ($request->hasFile('video')) {
                $video = $request->file('video');
                $videoName = time() . '_' . $video->getClientOriginalName();
                // Simpan file ke storage/app/public/product_videos
                $videoPath = $video->storeAs('product_videos', $videoName, 'public');
            }


            // Simpan data dimensi sebagai array JSON
            $dimensions = [
                'length' => $request->input('length'),
                'width' => $request->input('width'),
                'height' => $request->input('height'),
            ];

            // Ambil brand dari database berdasarkan brand_id
            $brand = Brand::find($request->brand_id);

            // Pastikan brand ditemukan
            if (!$brand) {
                return redirect()->back()->with('error', 'Brand not found.');
            }

            // Ambil brand_code dari brand yang dipilih
            $brandCode = strtoupper($brand->brand_code);

            // Cari produk terakhir dengan brand yang sama
            $lastProduct = Product::where('brand_id', $request->brand_id)
                ->orderBy('id', 'desc')
                ->first();

            // Jika ada produk terakhir, ambil nomor urut dari product_code-nya
            if ($lastProduct) {
                $lastCodeNumber = (int)substr($lastProduct->product_code, strlen($brandCode));
                $newCodeNumber = $lastCodeNumber + 1;
            } else {
                // Jika belum ada produk dengan brand tersebut, mulai dari 1
                $newCodeNumber = 1;
            }

            // Buat product_code dengan format urut
            $productCode = $brandCode . str_pad($newCodeNumber, 4, '0', STR_PAD_LEFT);

            // Simpan produk ke database
            $product = Product::create([
                'product_name' => $request->product_name,
                'product_code' => $productCode, // Simpan product_code yang di-generate
                'category_product_id' => $request->category_product_id,
                'brand_id' => $request->brand_id,
                'description' => $request->description,
                'information_product' => $request->information_product,
                'stock_quantity' => $request->stock_quantity,
                'regular_price' => $regularPrice,
                'date_expired' => $request->date_expired,
                'weight_product' => $request->weight_product,
                'main_image' => $mainImagePath,
                'images' => json_encode($imagePaths),
                'video' => $videoPath,
                'color' => $request->color, // Simpan warna
                'color_text' => $request->color_text, // Simpan warna
                'dimensions' => json_encode($dimensions),  // Menyimpan sebagai JSON                
            ]);


            if ($request->has('variant_type') && $request->has('variant_values')) {
                foreach ($request->variant_type as $typeIndex => $variantType) {
                    if (isset($request->variant_values[$typeIndex]) && is_array($request->variant_values[$typeIndex])) {
                        foreach ($request->variant_values[$typeIndex] as $valueIndex => $variantValue) {
                            $useVariantImage = isset($request->use_variant_image[$typeIndex][$valueIndex]) && $request->use_variant_image[$typeIndex][$valueIndex] == '1';
                            $variantImage = null;

                            if ($useVariantImage && $request->hasFile("variant_images.$typeIndex.$valueIndex")) {
                                $variantImageFile = $request->file("variant_images")[$typeIndex][$valueIndex];
                                $variantImageName = time() . '_' . $variantImageFile->getClientOriginalName();
                                $variantImage = $variantImageFile->storeAs('product_images', $variantImageName, 'public');
                            }

                            $variantPrice = str_replace(['Rp. ', '.'], '', $request->variant_price[$typeIndex][$valueIndex]);

                            ProductVariations::create([
                                'product_id' => $product->id,
                                'variant_type' => $variantType,
                                'variant_value' => $variantValue,
                                'use_variant_image' => $useVariantImage,
                                'variant_image' => $variantImage,
                                'variant_stock' => $request->variant_stock[$typeIndex][$valueIndex], // Sesuaikan
                                'variant_price' => $variantPrice, // Simpan setelah format dihapus
                                'weight_variant' => $request->variant_weight[$typeIndex][$valueIndex], // Sesuaikan
                                'variant_expired' => $request->variant_expired[$typeIndex][$valueIndex], // New field
                            ]);
                        }
                    }
                }
            }

            return redirect()->route('index-product-admin')->with('success', 'Product created successfully!');
        } catch (\Illuminate\Validation\ValidationException $e) {
            return redirect()->back()->withErrors($e->errors())->withInput();
        } catch (\Exception $e) {
            Log::error('Error creating product', ['exception' => $e->getMessage()]);
            return redirect()->back()->withErrors(['error' => 'An error occurred while creating the product: ' . $e->getMessage()])->withInput();
        }
    }



    public function detailProductAdmin($id)
    {
        $categories = CategoryProduct::all();
        $brands = Brand::all();
        $product = Product::with('productVariations')->find($id);

        if (!$product) {
            return redirect()->route('index-product-admin')->with('error', 'Product not found');
        }

        // Decode JSON images to array
        $product->images = json_decode($product->images, true);
        $product->dimensions = json_decode($product->dimensions, true);

        return view('admin.product.detail', [
            'categories' => $categories,
            'brands' => $brands,
            'product' => $product
        ]);
    }


    public function editProductAdmin($id)
    {
        $categories = CategoryProduct::all();
        $brands = Brand::all();
        $product = Product::with('productVariations')->findOrFail($id);

        $options = CategoryProduct::whereHas('parent', function ($query) {
            $query->whereNotNull('parent_id');
        })->get();

        $subcategories = CategoryProduct::whereNotNull('parent_id')->get();

        if (!$product) {
            return redirect()->route('index-product-admin')->with('error', 'Product not found');
        }

        // Decode JSON images to array if it's a string
        if (is_string($product->images)) {
            $product->images = json_decode($product->images, true);
        } else {
            $product->images = [];
        }

        if (is_string($product->dimensions)) {
            $product->dimensions = json_decode($product->dimensions, true);
        } else {
            $product->dimensions = [];
        }

        // Format variant data untuk JavaScript
        $variants = $product->productVariations->map(function ($variant) {
            return [
                'id' => $variant->id,
                'type' => $variant->variant_type,
                'value' => $variant->variant_value,
                // 'image' => $variant->variant_image ? asset('storage/' . $variant->variant_image) : null,  // Add asset() helper
                'image' => $variant->variant_image ? Storage::url($variant->variant_image) : null,
                'price' => $variant->variant_price,
                'stock' => $variant->variant_stock,
                'weight' => $variant->weight_variant,
                'use_variant_image' => $variant->use_variant_image,
                'variant_expired' => $variant->variant_expired // Ganti ke variant_expired
            ];
        })->values()->all();

        return view('admin.product.edit', [
            'categories' => $categories,
            'brands' => $brands,
            'product' => $product,
            'subcategories' => $subcategories,
            'options' => $options,
            'variants' => $variants
        ]);
    }


    public function updateProductAdmin(Request $request, $id)
    {
        try {
            // Temukan produk berdasarkan ID
            $product = Product::with('productVariations')->find($id);

            if (!$product) {
                return redirect()->route('admin.product.index')->with('error', 'Product not found');
            }

            // Validasi data yang dikirim
            $validatedData = $request->validate([
                'product_name' => 'required|string|max:255',
                'stock_quantity' => 'required',
                'regular_price' => 'required',
                'main_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
                'images' => 'nullable|array|max:6',
                'images.*' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
                'video' => 'nullable|mimes:mp4,avi,mov|max:5048',
                'weight_product' => 'required',
                'description' => 'required',
                'information_product' => 'required',
                'category_product_id' => 'required',
                'brand_id' => 'required',

                // Variant validation
                'variant_ids' => 'nullable|array',
                'variant_ids.*' => 'exists:product_variations,id',
                'variant_price' => 'nullable|array',
                'variant_stock' => 'nullable|array',
                'variant_weight' => 'nullable|array',
                'use_variant_image' => 'nullable|array',
                'variant_images' => 'nullable|array',
                'existing_variant_images' => 'nullable|array',
            ]);

            // Handle basic product updates
            // [Previous image, video, and basic product info handling remains the same]

            // Hapus format rupiah dari regular_price
            $regularPrice = str_replace(['Rp. ', '.'], '', $validatedData['regular_price']);

            // Handle Main Image Upload (Single Image)
            if ($request->hasFile('main_image')) {
                // Hapus gambar lama jika ada
                if (!empty($product->main_image) && file_exists(public_path($product->main_image))) {
                    unlink(public_path($product->main_image));
                }

                // Simpan gambar baru
                $mainImage = $request->file('main_image');
                $mainImageName = time() . '_' . $mainImage->getClientOriginalName();
                $mainImagePath = $mainImage->storeAs('product_images', $mainImageName, 'public');
                $product->main_image = $mainImagePath;
            }

            // Handle Product Gallery Upload (Multiple Images)
            if ($request->hasFile('images')) {
                // Hapus gambar lama jika ada
                if (!empty($product->images)) {
                    $existingImages = json_decode($product->images, true);

                    // Hapus gambar lama
                    foreach ($existingImages as $existingImage) {
                        if (file_exists(public_path($existingImage))) {
                            unlink(public_path($existingImage));
                        }
                    }
                }

                // Simpan gambar baru
                $newImages = [];
                foreach ($request->file('images') as $image) {
                    $imageName = time() . '_' . $image->getClientOriginalName();
                    $imagePath = $image->storeAs('product_images', $imageName, 'public');
                    $newImages[] = $imagePath;
                }

                $product->images = json_encode($newImages);
            }

            // Handle Video Upload
            if ($request->hasFile('video')) {
                // Hapus video lama jika ada
                if (!empty($product->video) && file_exists(public_path($product->video))) {
                    unlink(public_path($product->video));
                }

                // Simpan video baru
                $video = $request->file('video');
                $videoName = time() . '_' . $video->getClientOriginalName();
                $videoPath = $video->storeAs('product_videos', $videoName, 'public');
                $product->video = $videoPath;
            }

            // Update informasi produk lainnya
            $product->product_name = $validatedData['product_name'];
            $product->category_product_id = $validatedData['category_product_id'];
            $product->brand_id = $validatedData['brand_id'];
            $product->description = $validatedData['description'];
            $product->information_product = $validatedData['information_product'];
            $product->stock_quantity = $validatedData['stock_quantity'];
            $product->weight_product = $validatedData['weight_product'];
            $product->date_expired = $request->date_expired;
            $product->regular_price = $regularPrice; // Simpan harga dalam format angka

            // Simpan data dimensi sebagai array JSON jika diperlukan
            if ($request->has('length') && $request->has('width') && $request->has('height')) {
                $dimensions = [
                    'length' => $request->input('length'),
                    'width' => $request->input('width'),
                    'height' => $request->input('height'),
                ];
                $product->dimensions = json_encode($dimensions);
            }

            // // Handle variant updates
            // if ($request->has('variant_ids')) {
            //     $variantIndex = 0;
            //     foreach ($request->variant_ids as $index => $variantId) {
            //         $variant = ProductVariations::find($variantId);

            //         if ($variant) {
            //             $useVariantImage = isset($request->use_variant_image[$index]) && $request->use_variant_image[$index] == '1';
            //             $variantImage = $variant->variant_image; // Keep existing image by default

            //             // Cek apakah ada gambar variant baru
            //             if (
            //                 $useVariantImage &&
            //                 isset($request->file('variant_images')[$index]) &&
            //                 $request->file('variant_images')[$index]
            //             ) {

            //                 // Delete old image if exists
            //                 if ($variant->variant_image && Storage::exists('public/' . $variant->variant_image)) {
            //                     Storage::delete('public/' . $variant->variant_image);
            //                 }

            //                 $variantImageFile = $request->file('variant_images')[$index];
            //                 $variantImageName = time() . '_' . $variantId . '_' . $variantImageFile->getClientOriginalName();
            //                 $variantImage = $variantImageFile->storeAs('product_variant_images', $variantImageName, 'public');
            //             } elseif (!$useVariantImage) {
            //                 // Hapus gambar jika tidak digunakan
            //                 if ($variant->variant_image && Storage::exists('public/' . $variant->variant_image)) {
            //                     Storage::delete('public/' . $variant->variant_image);
            //                 }
            //                 $variantImage = null;
            //             }

            //             // Update variant with new or existing data
            //             $variant->update([
            //                 'use_variant_image' => $useVariantImage,
            //                 'variant_image' => $variantImage,
            //                 'variant_stock' => $request->variant_stock[$index] ?? $variant->variant_stock,
            //                 'variant_price' => $request->variant_price[$index] ?? $variant->variant_price,
            //                 'weight_variant' => $request->variant_weight[$index] ?? $variant->weight_variant,
            //                 'variant_expired' => $request->variant_expired[$index] ?? null, // Changed from 'expired' to 'variant_expired'
            //             ]);
            //         }
            //     }
            // }

            // // Handle new variants if any
            // if ($request->has('variant_type') && $request->has('variant_values')) {
            //     foreach ($request->variant_type as $typeIndex => $variantType) {
            //         if (isset($request->variant_values[$typeIndex]) && is_array($request->variant_values[$typeIndex])) {
            //             $existingVariantValues = $product->productVariations()
            //                 ->where('variant_type', $variantType)
            //                 ->pluck('variant_value')
            //                 ->toArray();

            //             foreach ($request->variant_values[$typeIndex] as $valueIndex => $value) {
            //                 // Only create new variant if it doesn't exist
            //                 if (!in_array($value, $existingVariantValues)) {
            //                     $useVariantImage = isset($request->new_use_variant_image[$typeIndex][$valueIndex])
            //                         && $request->new_use_variant_image[$typeIndex][$valueIndex] == '1';

            //                     $variantImage = null;

            //                     // Handle new variant image
            //                     if (
            //                         $useVariantImage &&
            //                         isset($request->file('new_variant_images')[$typeIndex][$valueIndex])
            //                     ) {
            //                         $variantImageFile = $request->file('new_variant_images')[$typeIndex][$valueIndex];
            //                         $variantImageName = time() . '_new_' . $variantImageFile->getClientOriginalName();
            //                         $variantImage = $variantImageFile->storeAs('product_variant_images', $variantImageName, 'public');
            //                     }

            //                     // Get the expired date for the new variant
            //                     $variantExpiredDate = isset($request->new_variant_expired[$typeIndex][$valueIndex])
            //                         ? $request->new_variant_expired[$typeIndex][$valueIndex]
            //                         : null;


            //                     ProductVariations::create([
            //                         'product_id' => $product->id,
            //                         'variant_type' => $variantType,
            //                         'variant_value' => $value,
            //                         'use_variant_image' => $useVariantImage,
            //                         'variant_image' => $variantImage,
            //                         'variant_stock' => 0,
            //                         'variant_price' => $product->regular_price,
            //                         'weight_variant' => $product->weight_product,
            //                         'variant_expired' => $variantExpiredDate, // Changed from 'expired' to 'variant_expired'
            //                     ]);
            //                 }
            //             }

            //             // Remove variants that are no longer in the values array
            //             $product->productVariations()
            //                 ->where('variant_type', $variantType)
            //                 ->whereNotIn('variant_value', $request->variant_values[$typeIndex])
            //                 ->delete();
            //         }
            //     }
            // }


            // Handle variant updates dengan pendekatan baru
            if ($request->has('variant_type') && $request->has('variant_values')) {
                // Hapus semua variant lama jika tipe variant berubah
                $currentVariantType = $product->productVariations()->first()?->variant_type;
                $newVariantType = $request->variant_type[0]; // Ambil tipe variant baru

                if ($currentVariantType !== $newVariantType) {
                    // Hapus semua variant lama karena tipe berubah
                    $product->productVariations()->delete();

                    // Buat variant baru dengan data yang sesuai
                    foreach ($request->variant_values[0] as $index => $value) {
                        $useVariantImage = isset($request->new_use_variant_image[0][$index])
                            && $request->new_use_variant_image[0][$index] == '1';

                        $variantImage = null;
                        if ($useVariantImage && isset($request->file('new_variant_images')[0][$index])) {
                            $variantImageFile = $request->file('new_variant_images')[0][$index];
                            $variantImageName = time() . '_new_' . $variantImageFile->getClientOriginalName();
                            $variantImage = $variantImageFile->storeAs('product_variant_images', $variantImageName, 'public');
                        }

                        ProductVariations::create([
                            'product_id' => $product->id,
                            'variant_type' => $newVariantType,
                            'variant_value' => $value,
                            'use_variant_image' => $useVariantImage,
                            'variant_image' => $variantImage,
                            'variant_stock' => $request->variant_stock[0][$index] ?? 0,
                            'variant_price' => $request->variant_price[0][$index] ?? $product->regular_price,
                            'weight_variant' => $request->variant_weight[0][$index] ?? $product->weight_product,
                            'variant_expired' => $request->new_variant_expired[0][$index] ?? null,
                        ]);
                    }
                } else {
                    if ($request->has('variant_ids')) {
                        $variantIndex = 0;
                        foreach ($request->variant_ids as $index => $variantId) {
                            $variant = ProductVariations::find($variantId);

                            // Update variant with new or existing data
                            if ($variant) {
                                $useVariantImage = isset($request->use_variant_image[$index]) && $request->use_variant_image[$index] == '1';
                                $variantImage = $variant->variant_image; // Keep existing image by default

                                // Cek apakah ada gambar variant baru
                                if ($useVariantImage) {
                                    if (isset($request->file('variant_images')[$index])) {
                                        // Ada file gambar baru yang diupload
                                        $variantImageFile = $request->file('variant_images')[$index];

                                        // Delete old image if exists
                                        if ($variant->variant_image && Storage::exists('public/' . $variant->variant_image)) {
                                            Storage::delete('public/' . $variant->variant_image);
                                        }

                                        $variantImageName = time() . '_' . $variantId . '_' . $variantImageFile->getClientOriginalName();
                                        $variantImage = $variantImageFile->storeAs('product_variant_images', $variantImageName, 'public');
                                    }
                                    // Jika tidak ada file baru, gunakan gambar yang sudah ada (tidak perlu diubah)
                                } else {
                                    // User unchecked use_variant_image, remove the image
                                    if ($variant->variant_image && Storage::exists('public/' . $variant->variant_image)) {
                                        Storage::delete('public/' . $variant->variant_image);
                                    }
                                    $variantImage = null;
                                }

                                $variant->update([
                                    'use_variant_image' => $useVariantImage,
                                    'variant_image' => $useVariantImage ? ($variantImage ?? $variant->variant_image) : null,
                                    'variant_stock' => $request->variant_stock[$index] ?? $variant->variant_stock,
                                    'variant_price' => $request->variant_price[$index] ?? $variant->variant_price,
                                    'weight_variant' => $request->variant_weight[$index] ?? $variant->weight_variant,
                                    'variant_expired' => $request->variant_expired[$index] ?? null,
                                ]);
                            }
                        }
                    }
                }
            }

            // Save the updated product
            $product->save();

            return redirect()->route('index-product-admin')->with('success', 'Product updated successfully');
        } catch (\Exception $e) {
            Log::error('Error updating product', ['exception' => $e->getMessage()]);
            return redirect()->route('index-product-admin')->with('error', 'An error occurred while updating the product: ' . $e->getMessage());
        }
    }

    public function checkStockAlerts()
    {
        $lowStockCount = 0;
        $outOfStockCount = 0;

        // Check main products
        $products = Product::with(['stocks', 'productVariations.stocks'])->get();

        foreach ($products as $product) {
            $totalStock = $product->total_stock;

            if ($totalStock === 0) {
                $outOfStockCount++;
                Log::info("Added to out of stock");
            } elseif ($totalStock <= 15) {
                $lowStockCount++;
                Log::info("Added to low stock");
            }

            // Check variants
            foreach ($product->productVariations as $variant) {
                $variantStock = $variant->variant_stock ?? 0;
                $variantTotalStock = $variant->stocks->sum('quantity');
                $totalVariantStock = $variantStock + $variantTotalStock;

                if ($totalVariantStock === 0) {
                    $outOfStockCount++;
                } elseif ($totalVariantStock <= 15) {
                    $lowStockCount++;
                }
            }
        }

        $totalAlerts = $lowStockCount + $outOfStockCount;

        return response()->json([
            'totalAlerts' => $totalAlerts,
            'lowStockCount' => $lowStockCount,
            'outOfStockCount' => $outOfStockCount
        ]);
    }


    // modif by claude
    public function indexStockProductAdmin()
    {
        $products = Product::with([
            'categoryProduct',
            'brand',
            'productVariations' => function ($query) {
                // Load product variations with their stocks
                $query->with(['stocks' => function ($stockQuery) {
                    $stockQuery->where('quantity', '>', 0)
                        ->orderBy('date_expired', 'desc')
                        ->take(2);
                }]);
            },
            'stocks' => function ($query) {
                $query->where('quantity', '>', 0)
                    ->orderBy('date_expired', 'desc')
                    ->take(2);
            }
        ])
            ->orderBy('created_at', 'desc')
            ->paginate(100);

        return view('admin.product.stock.index', [
            'products' => $products,
        ]);
    }


    public function outOfStockProductAdmin()
    {
        // Mengambil produk dengan stok 0
        $products = Product::with(['categoryProduct', 'brand'])
            ->where('stock_quantity', 0)
            ->orderBy('created_at', 'desc')
            ->paginate(100);

        return view('admin.product.stock.outofstock', [
            'products' => $products,
        ]);
    }

    public function lowStockProductAdmin()
    {
        // Mengambil produk dengan stok antara 10-15
        $products = Product::with(['categoryProduct', 'brand'])
            ->whereBetween('stock_quantity', [1, 15])
            ->orderBy('created_at', 'desc')
            ->paginate(100);

        return view('admin.product.stock.lowstock', [
            'products' => $products,
        ]);
    }

    // update code yang benar dan sesuai
    // public function updateStock(Request $request, $id)
    // {
    //     $request->validate([
    //         'stock_quantity' => 'required|integer|min:1',
    //         'date_expired' => 'required|date',
    //         'variant_id' => 'nullable|exists:product_variations,id'
    //     ]);

    //     DB::beginTransaction();

    //     try {
    //         if ($request->variant_id) {
    //             $variant = ProductVariations::findOrFail($request->variant_id);
    //             $variant->stocks()->create([
    //                 'product_id' => $id,
    //                 'quantity' => $request->stock_quantity,
    //                 'date_expired' => $request->date_expired,
    //             ]);

    //             // Tambahkan logika update stok yang benar
    //             $variant->update([
    //                 'variant_stock' => $variant->variant_stock + $request->stock_quantity
    //             ]);
    //         } else {
    //             $product = Product::findOrFail($id);
    //             $product->stocks()->create([
    //                 'quantity' => $request->stock_quantity,
    //                 'date_expired' => $request->date_expired,
    //             ]);

    //             // Update stok dengan menambahkan jumlah baru
    //             $product->update([
    //                 'stock_quantity' => $product->stock_quantity + $request->stock_quantity
    //             ]);
    //         }

    //         DB::commit();
    //         return response()->json(['message' => 'Stock updated successfully']);
    //     } catch (\Exception $e) {
    //         DB::rollback();
    //         return response()->json(['message' => 'Error updating stock: ' . $e->getMessage()], 500);
    //     }
    // }

    // public function updateStock(Request $request, $id)
    // {
    //     $request->validate([
    //         'stock_quantity' => 'required|integer|min:1',
    //         'date_expired' => 'required|date',
    //         'variant_id' => 'nullable|exists:product_variations,id',
    //     ]);

    //     DB::beginTransaction();

    //     try {
    //         if ($request->variant_id) {
    //             // Update stok untuk varian produk
    //             $variant = ProductVariations::findOrFail($request->variant_id);

    //             // Tambahkan stok ke tabel `stocks`
    //             $variant->stocks()->create([
    //                 'variant_id' => $request->variant_id,
    //                 'quantity' => $request->stock_quantity,
    //                 'date_expired' => $request->date_expired,
    //             ]);

    //             // Perbarui jumlah stok di tabel `product_variations`
    //             $variant->update([
    //                 'variant_stock' => $variant->variant_stock + $request->stock_quantity,
    //             ]);
    //         } else {
    //             // Update stok untuk produk utama
    //             $product = Product::findOrFail($id);

    //             // Tambahkan stok ke tabel `stocks`
    //             $product->stocks()->create([
    //                 'product_id' => $id,
    //                 'quantity' => $request->stock_quantity,
    //                 'date_expired' => $request->date_expired,
    //             ]);

    //             // Perbarui jumlah stok di tabel `products`
    //             $product->update([
    //                 'stock_quantity' => $product->stock_quantity + $request->stock_quantity,
    //             ]);
    //         }

    //         DB::commit();
    //         return response()->json(['message' => 'Stock updated successfully']);
    //     } catch (\Exception $e) {
    //         DB::rollback();
    //         return response()->json(['message' => 'Error updating stock: ' . $e->getMessage()], 500);
    //     }
    // }

    public function updateStock(Request $request, $id)
    {
        $request->validate([
            'stock_quantity' => 'required|integer|min:1',
            'date_expired' => 'required|date',
            'variant_id' => 'nullable|exists:product_variations,id',
        ]);

        DB::beginTransaction();

        try {
            if ($request->variant_id) {
                // Update stok untuk varian produk
                $variant = ProductVariations::findOrFail($request->variant_id);

                // Tambahkan stok ke tabel `stocks`
                $variant->stocks()->create([
                    'variant_id' => $request->variant_id,
                    'quantity' => $request->stock_quantity,
                    'date_expired' => $request->date_expired,
                ]);

                // Perbarui jumlah stok dan tanggal kadaluarsa di tabel `product_variations`
                $variant->update([
                    'variant_stock' => $variant->variant_stock + $request->stock_quantity,
                    'variant_expired' => $request->date_expired, // Tambahkan baris ini
                ]);
            } else {
                // Update stok untuk produk utama (tetap sama)
                $product = Product::findOrFail($id);

                $product->stocks()->create([
                    'product_id' => $id,
                    'quantity' => $request->stock_quantity,
                    'date_expired' => $request->date_expired,
                ]);

                $product->update([
                    'stock_quantity' => $product->stock_quantity + $request->stock_quantity,
                ]);
            }

            DB::commit();
            return response()->json(['message' => 'Stock updated successfully']);
        } catch (\Exception $e) {
            DB::rollback();
            return response()->json(['message' => 'Error updating stock: ' . $e->getMessage()], 500);
        }
    }


    public function getStockDetails($id)
    {
        $product = Product::findOrFail($id);

        // Ambil stok produk utama
        $mainProductStocks = $product->stocks()
            ->where('quantity', '>', 0)
            ->orderBy('date_expired', 'desc')
            ->get();

        return response()->json([
            'mainProduct' => $mainProductStocks
        ]);
    }

    public function getVariantStockDetails($variantId)
    {
        $variant = ProductVariations::findOrFail($variantId);

        $variantStocks = ProductStocks::where('variation_id', $variantId)
            ->where('quantity', '>', 0)
            ->orderBy('date_expired', 'desc')
            ->take(2)
            ->get();

        return response()->json([
            'variantStocks' => $variantStocks,
            'variant_expired' => $variant->variant_expired // Tambahkan baris ini
        ]);
    }


    public function deleteProductAdmin($id)
    {
        $product = Product::find($id);

        if (!$product) {
            return response()->json([
                'success' => false,
                'message' => 'Product not found.'
            ]);
        }

        // Hapus gambar utama dari storage (jika ada)
        if (!empty($product->main_image)) {
            $mainImagePath = 'product_images/' . basename($product->main_image);
            if (Storage::disk('public')->exists($mainImagePath)) {
                Log::info('Deleting main image: ' . $mainImagePath);
                Storage::disk('public')->delete($mainImagePath);
            } else {
                Log::info('Main image not found: ' . $mainImagePath);
            }
        }

        // Hapus multiple images (jika ada)
        if (!empty($product->images)) {
            // Decode JSON string to an array
            $images = json_decode($product->images, true);

            if (is_array($images)) {
                foreach ($images as $image) {
                    $imagePath = 'product_images/' . basename($image);
                    if (Storage::disk('public')->exists($imagePath)) {
                        Log::info('Deleting image: ' . $imagePath);
                        Storage::disk('public')->delete($imagePath);
                    } else {
                        Log::info('Image not found: ' . $imagePath);
                    }
                }
            }
        }

        // Hapus video dari storage (jika ada)
        if (!empty($product->video)) {
            $videoPath = 'product_videos/' . basename($product->video);
            if (Storage::disk('public')->exists($videoPath)) {
                Log::info('Deleting video: ' . $videoPath);
                Storage::disk('public')->delete($videoPath);
            } else {
                Log::info('Video not found: ' . $videoPath);
            }
        }

        // Hapus produk dari database
        $product->delete();

        return response()->json([
            'success' => true,
            'message' => 'Product deleted successfully.'
        ]);
    }



    public function storeVariantType(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'code' => 'required|string|max:255|unique:variant_types,code'
        ]);

        $variantType = ProductVariations::create($validated);

        return response()->json([
            'success' => true,
            'data' => $variantType
        ]);
    }

    public function storeVariantValue(Request $request)
    {
        $validated = $request->validate([
            'value' => 'required|string|max:255',
            'variant_type_id' => 'required|exists:variant_types,id'
        ]);

        $variantValue = ProductVariations::create($validated);

        return response()->json([
            'success' => true,
            'data' => $variantValue
        ]);
    }
}
