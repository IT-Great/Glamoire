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
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
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
                ->get();

            $brandVouchers   = Promo::where('type', '=' , 'brand voucher')
                ->whereRaw("STR_TO_DATE(SUBSTRING_INDEX(date_range, ' - ', 1), '%Y-%m-%d') <= ?", [$date])
                ->whereRaw("STR_TO_DATE(SUBSTRING_INDEX(date_range, ' - ', -1), '%Y-%m-%d') >= ?", [$date])
                ->get();

            $limitedVouchers = Promo::where('type', '=' , 'limited voucher')
                ->whereRaw("STR_TO_DATE(SUBSTRING_INDEX(date_range, ' - ', 1), '%Y-%m-%d') <= ?", [$date])
                ->whereRaw("STR_TO_DATE(SUBSTRING_INDEX(date_range, ' - ', -1), '%Y-%m-%d') >= ?", [$date])
                ->get();
            
            $ongkirVouchers  = Promo::where('type', '=' , 'ongkir voucher')
                ->whereRaw("STR_TO_DATE(SUBSTRING_INDEX(date_range, ' - ', 1), '%Y-%m-%d') <= ?", [$date])
                ->whereRaw("STR_TO_DATE(SUBSTRING_INDEX(date_range, ' - ', -1), '%Y-%m-%d') >= ?", [$date])
                ->get();

            $productVouchers  = Promo::where('type', '=' , 'product voucher')
                ->with(['products'])
                ->whereRaw("STR_TO_DATE(SUBSTRING_INDEX(date_range, ' - ', 1), '%Y-%m-%d') <= ?", [$date])
                ->whereRaw("STR_TO_DATE(SUBSTRING_INDEX(date_range, ' - ', -1), '%Y-%m-%d') >= ?", [$date])
                ->get();

            $promoBundlings  = Promo::where('type', '=' , 'discount')
                ->with(['products'])
                ->whereRaw("STR_TO_DATE(SUBSTRING_INDEX(date_range, ' - ', 1), '%Y-%m-%d') <= ?", [$date])
                ->whereRaw("STR_TO_DATE(SUBSTRING_INDEX(date_range, ' - ', -1), '%Y-%m-%d') >= ?", [$date])
                ->get();

            // dd($promoBundling);

            $userId = session('id_user');
            if ($userId) {
                $wishlist = Wishlist::where('user_id', $userId)->get();

                $cartId = Cart::where('user_id', $userId)->value('id');
                $cartItems = Cart_item::where('cart_id', $cartId)->get();
                
                return view('user.component.promo', [
                    'promos' => $promos,
                    'brandVouchers' => $brandVouchers,
                    'limitedVouchers' => $limitedVouchers,
                    'ongkirVouchers' => $ongkirVouchers,
                    'productVouchers' => $productVouchers,
                    'promoBundlings' => $promoBundlings,
                    'wishlist'  => $wishlist,
                    'cartItems' => $cartItems,
                ]);
            }
            else{
                return view('user.component.promo', [
                    'promos' => $promos,
                    'brandVouchers' => $brandVouchers,
                    'limitedVouchers' => $limitedVouchers,
                    'ongkirVouchers' => $ongkirVouchers,
                    'productVouchers' => $productVouchers,
                    'promoBundlings' => $promoBundlings,
                ]);
            }


        } catch (Exception $err) {
            dd($err);
        }
    }

    public function detailPromoUser($name)
    {
        // dd($name);
        $userId = session('id_user');

        if ($userId) {
            $promo = Promo::where('promo_name', $name)
                ->with(['products'  => function ($query) {
                $query->select('products.*', 'promo_products.discounted_price')
                    ->wherePivot('discounted_price', '>', 0);
                }])
                ->get();

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
        $promo = Promo::where('type', 'promo')
            ->orderBy('created_at', 'desc')
            ->get()
            ->map(function ($item) {
                // Set status berdasarkan end_date
                $item->isActive = $item->end_date
                    ? \Carbon\Carbon::parse($item->end_date)->isFuture()
                    : false;
                return $item;
            });

        $products = Product::with(['promos' => function ($query) {
            $query->whereRaw("STR_TO_DATE(SUBSTRING_INDEX(date_range, ' - ', 1), '%d/%m/%Y') <= CURDATE()")
                ->whereRaw("STR_TO_DATE(SUBSTRING_INDEX(date_range, ' - ', -1), '%d/%m/%Y') >= CURDATE()");
        }])->get();

        $brands = Brand::all();
        return view('admin.promo.index', [
            'promo' => $promo,
            'products' => $products,
            'brands' => $brands,
        ]);
    }

    // public function toggleStatus($id)
    // {
    //     try {
    //         $promo = Promo::findOrFail($id);

    //         // Update status promo
    //         $promo->togglePromoStatus();

    //         // Update date_range berdasarkan status baru
    //         if ($promo->status === 'Active') {
    //             $startDate = now()->format('Y-m-d');
    //             $endDate = now()->addDays(30)->format('Y-m-d');
    //         } else {
    //             $startDate = now()->format('Y-m-d');
    //             $endDate = now()->format('Y-m-d');
    //         }

    //         $promo->date_range = "{$startDate} - {$endDate}";
    //         $promo->save();

    //         return response()->json([
    //             'success' => true,
    //             'message' => 'Status promo berhasil diubah'
    //         ]);
    //     } catch (\Exception $e) {
    //         Log::error("Gagal mengubah status promo: " . $e->getMessage());

    //         return response()->json([
    //             'success' => false,
    //             'message' => 'Gagal mengubah status promo'
    //         ], 500);
    //     }
    // }

    public function toggleStatus($id)
    {
        try {
            $promo = Promo::findOrFail($id);

            // Toggle status
            $currentStatus = $promo->status;
            $promo->status = ($currentStatus === 'Active') ? 'Expired' : 'Active';

            // Update date_range berdasarkan status baru
            if ($promo->status === 'Active') {
                $startDate = now()->format('d/m/Y');
                $endDate = now()->addDays(30)->format('d/m/Y');
            } else {
                $startDate = now()->format('d/m/Y');
                $endDate = now()->format('d/m/Y');
            }

            $promo->date_range = "{$startDate} - {$endDate}";
            $promo->save();

            return response()->json([
                'success' => true,
                'message' => 'Status promo berhasil diubah menjadi ' . $promo->status
            ]);
        } catch (\Exception $e) {
            Log::error("Gagal mengubah status promo: " . $e->getMessage());

            return response()->json([
                'success' => false,
                'message' => 'Gagal mengubah status promo'
            ], 500);
        }
    }


    public function createPromo()
    {
        // Ambil data produk dari database
        $products = Product::with(['promos'])->get()->map(function ($product) {
            // Ambil tipe promo dari request (asumsi tipe promo dikirim via form)
            $promoType = request('type', 'default_type');
            $product->has_active_promo = $product->hasActivePromoByType($promoType);
            return $product;
        });

        return view('admin.promo.create', compact('products'));
    }


    // default code
    // public function storePromo(Request $request)
    // {
    //     try {
    //         $request->validate([
    //             'promo_name' => 'required|string|max:255',
    //             'date_range' => 'required|string|max:255',
    //             'min_transaction' => 'required',
    //             'usage_quota' => 'required',
    //             'max_quantity_buyer' => 'required',
    //             'promo_code' => 'required',
    //             'discount' => 'required|numeric',
    //             'global_discount_type' => 'required|in:nominal,percentage',
    //             'product_ids' => 'required|array',
    //             'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048'
    //         ]);

    //         // Simpan data diskon
    //         $discount = $request->input('discount');
    //         $discountType = $request->input('global_discount_type');

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
    //             'discount' => $discount,
    //             'discount_type' => $discountType,
    //             'image' => $imagePath ?? null,
    //             'type' => $request->type, // Isi field 'type' dari input tersembunyi
    //         ]);

    //         $promo->products()->attach($request->product_ids);

    //         // Redirect dengan pesan sukses
    //         return redirect()->route('index-promo')->with('success', 'Promo created successfully!');
    //     } catch (\Illuminate\Validation\ValidationException $e) {
    //         return redirect()->back()->withErrors($e->errors())->withInput();
    //     } catch (\Exception $e) {
    //         Log::error('Error creating Voucher', ['exception' => $e->getMessage()]);
    //         return redirect()->back()->withErrors(['error' => 'An error occurred while creating the Promo: ' . $e->getMessage()])->withInput();
    //     }
    // }


    // code from claude
    // public function storePromo(Request $request)
    // {
    //     try {
    //         $request->validate([
    //             'promo_name' => 'required|string|max:255',
    //             'date_range' => 'required|string|max:255',
    //             'min_transaction' => 'required',
    //             'usage_quota' => 'required',
    //             'max_quantity_buyer' => 'required',
    //             'promo_code' => 'required',
    //             'discount' => 'required|numeric',
    //             'global_discount_type' => 'required|in:nominal,percentage',
    //             'product_ids' => 'required|array',
    //             'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048'
    //         ]);

    //         DB::beginTransaction();

    //         // Cek apakah produk yang dipilih sudah memiliki diskon dengan tipe yang sama
    //         $alreadyDiscountedProducts = Product::whereIn('id', $request->product_ids)
    //             ->whereHas('promos', function ($query) use ($request) {
    //                 $query->where('type', $request->type); // Cek apakah promo dengan tipe yang sama sudah ada
    //             })
    //             ->pluck('product_name')
    //             ->toArray();

    //         if (count($alreadyDiscountedProducts) > 0) {
    //             return redirect()->back()->withErrors([
    //                 'product_ids' => 'The following products already have a discount applied for this promo type: ' . implode(', ', $alreadyDiscountedProducts)
    //             ])->withInput();
    //         }

    //         // Simpan data diskon
    //         $discount = $request->input('discount');
    //         $discountType = $request->input('global_discount_type');

    //         $minTransaction = str_replace(['Rp. ', '.'], '', $request->min_transaction);

    //         $randomCode = strtoupper(substr(str_shuffle('abcdefghijklmnopqrstuvwxyz123456789'), 0, 5));
    //         $promoCode = 'Glamo' . $randomCode;

    //         // Simpan gambar
    //         $imagePath = null;
    //         if ($request->hasFile('image')) {
    //             $image = $request->file('image');
    //             $imageName = time() . '_' . $image->getClientOriginalName();
    //             $imagePath = $image->storeAs('promo', $imageName, 'public');
    //         }

    //         // Simpan data promo
    //         $promo = Promo::create([
    //             'promo_name' => $request->promo_name,
    //             'date_range' => $request->date_range,
    //             'min_transaction' => $minTransaction,
    //             'promo_code' => $promoCode,
    //             'usage_quota' => $request->usage_quota,
    //             'max_quantity_buyer' => $request->max_quantity_buyer,
    //             'discount' => $discount,
    //             'discount_type' => $discountType,
    //             'image' => $imagePath ?? null,
    //             'type' => $request->type,
    //         ]);

    //         // Proses diskon untuk setiap produk
    //         foreach ($request->product_ids as $productId) {
    //             $product = Product::find($productId);

    //             if ($product) {
    //                 $discountedPrice = $this->calculateDiscountedPrice(
    //                     $product->regular_price,
    //                     $discount,
    //                     $discountType
    //                 );

    //                 // Simpan detail diskon ke tabel pivot
    //                 $promo->products()->attach($productId, [
    //                     'discount_product_voucher_item' => $discount,
    //                     'discount_type' => $discountType,
    //                     'discounted_price' => $discountedPrice
    //                 ]);
    //             }
    //         }

    //         DB::commit();

    //         return redirect()->route('index-promo')->with('success', 'Promo created successfully!');
    //     } catch (\Exception $e) {
    //         DB::rollBack();
    //         Log::error('Error creating Voucher', ['exception' => $e->getMessage()]);
    //         return redirect()->back()->withErrors(['error' => 'An error occurred while creating the Promo: ' . $e->getMessage()])->withInput();
    //     }
    // }

    public function storePromo(Request $request)
    {
        try {
            $request->validate([
                'promo_name' => 'required|string|max:255',
                'date_range' => 'required|string|max:255',
                'min_transaction' => 'required',
                'max_quantity_buyer' => 'required',
                'promo_code' => 'required',
                'discount' => 'required|numeric',
                'global_discount_type' => 'required|in:nominal,percentage',
                'product_ids' => 'required|array',
                'product_ids.*' => 'required|exists:products,id',
                'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048'
            ]);

            // Validasi limit stock untuk setiap produk yang dipilih
            foreach ($request->product_ids as $productId) {
                if (!isset($request->limit_stock[$productId])) {
                    throw new \Exception("Please enter limit stock for selected products");
                }

                $product = Product::findOrFail($productId);
                $limitStock = $request->limit_stock[$productId];

                if (!is_numeric($limitStock) || $limitStock <= 0) {
                    throw new \Exception("Please enter a valid limit stock for product: {$product->product_name}");
                }

                if ($limitStock > $product->stock_quantity) {
                    throw new \Exception("Limit stock cannot exceed available stock ({$product->stock_quantity}) for product: {$product->product_name}");
                }
            }

            DB::beginTransaction();

            // Cek produk yang sudah memiliki diskon
            $alreadyDiscountedProducts = Product::whereIn('id', $request->product_ids)
                ->whereHas('promos', function ($query) use ($request) {
                    $query->where('type', $request->type);
                })
                ->pluck('product_name')
                ->toArray();

            if (count($alreadyDiscountedProducts) > 0) {
                return redirect()->back()->withErrors([
                    'product_ids' => 'The following products already have a discount applied: ' . implode(', ', $alreadyDiscountedProducts)
                ])->withInput();
            }

            $minTransaction = str_replace(['Rp. ', '.'], '', $request->min_transaction);

            // Generate promo code
            $randomCode = strtoupper(substr(str_shuffle('abcdefghijklmnopqrstuvwxyz123456789'), 0, 5));
            $promoCode = 'Glamo' . $randomCode;

            // Handle image upload
            $imagePath = null;
            if ($request->hasFile('image')) {
                $image = $request->file('image');
                $imageName = time() . '_' . $image->getClientOriginalName();
                $imagePath = $image->storeAs('promo', $imageName, 'public');
            }

            // Create promo
            $promo = Promo::create([
                'promo_name' => $request->promo_name,
                'date_range' => $request->date_range,
                'min_transaction' => $minTransaction,
                'promo_code' => $promoCode,
                'usage_quota' => $request->usage_quota,
                'max_quantity_buyer' => $request->max_quantity_buyer,
                'discount' => $request->discount,
                'discount_type' => $request->global_discount_type,
                'image' => $imagePath,
                'type' => $request->type,
            ]);

            // Attach products with their respective limits
            foreach ($request->product_ids as $productId) {
                $product = Product::find($productId);
                if ($product) {
                    $discountedPrice = $this->calculateDiscountedPrice(
                        $product->regular_price,
                        $request->discount,
                        $request->global_discount_type
                    );

                    $promo->products()->attach($productId, [
                        'discount_product_voucher_item' => $request->discount,
                        'discount_type' => $request->global_discount_type,
                        'discounted_price' => $discountedPrice,
                        'limit_stock' => (int)$request->limit_stock[$productId] // Simpan limit stock
                    ]);
                }
            }

            DB::commit();

            return redirect()->route('index-promo')->with('success', 'Promo created successfully!');
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Error creating Promo', ['exception' => $e->getMessage()]);
            return redirect()->back()->withErrors(['error' => $e->getMessage()])->withInput();
        }
    }




    private function calculateDiscountedPrice($originalPrice, $discount, $discountType)
    {
        if ($discountType === 'percentage') {
            return $originalPrice - ($originalPrice * ($discount / 100));
        } else { // nominal
            return $originalPrice - $discount;
        }
    }

    public function editPromo($id)
    {

        $promo = Promo::with(['products'])->findOrFail($id);
        $products = Product::withCount(['promos'])->get();

        // Transform products to include current selection status
        $products = $products->map(function ($product) use ($promo) {
            $product->is_selected = $promo->products->contains('id', $product->id);
            $product->has_other_active_promo = $product->getHasActivePromoAttribute() && !$product->is_selected;
            return $product;
        });

        return view('admin.promo.edit', [
            'promo' => $promo,
            'products' => $products,
        ]);
    }


    public function updatePromo(Request $request, $id)
    {
        try {
            $request->validate([
                'promo_name' => 'required|string|max:255',
                'date_range' => 'required|string|max:255',
                'min_transaction' => 'required',
                'usage_quota' => 'required',
                'max_quantity_buyer' => 'required',
                'promo_code' => 'required',
                'discount' => 'required|numeric',
                'global_discount_type' => 'required|in:nominal,percentage',
                'product_ids' => 'required|array',
                'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
            ]);

            DB::beginTransaction();

            // Fetch existing promo
            $promo = Promo::findOrFail($id);

            // Check if any selected products already have a promo of the same type
            $alreadyDiscountedProducts = Product::whereIn('id', $request->product_ids)
                ->whereHas('promos', function ($query) use ($request, $promo) {
                    $query->where('type', $request->type)->where('promo_id', '!=', $promo->id);
                })
                ->pluck('product_name')
                ->toArray();

            if (count($alreadyDiscountedProducts) > 0) {
                return redirect()->back()->withErrors([
                    'product_ids' => 'The following products already have a discount applied for this promo type: ' . implode(', ', $alreadyDiscountedProducts)
                ])->withInput();
            }

            // Update discount details
            $discount = $request->input('discount');
            $discountType = $request->input('global_discount_type');
            $minTransaction = str_replace(['Rp. ', '.'], '', $request->min_transaction);

            // Handle image update
            if ($request->hasFile('image')) {
                if ($promo->image) {
                    Storage::disk('public')->delete($promo->image); // Delete the old image
                }

                $image = $request->file('image');
                $imageName = time() . '_' . $image->getClientOriginalName();
                $imagePath = $image->storeAs('promo', $imageName, 'public');
            } else {
                $imagePath = $promo->image; // Keep the existing image if no new one is uploaded
            }

            // Update promo data
            $promo->update([
                'promo_name' => $request->promo_name,
                'date_range' => $request->date_range,
                'min_transaction' => $minTransaction,
                'promo_code' => $request->promo_code,
                'usage_quota' => $request->usage_quota,
                'max_quantity_buyer' => $request->max_quantity_buyer,
                'discount' => $discount,
                'discount_type' => $discountType,
                'image' => $imagePath,
                'type' => $request->type,
            ]);

            // Update promo products
            $promo->products()->detach(); // Detach existing products
            foreach ($request->product_ids as $productId) {
                $product = Product::find($productId);

                if ($product) {
                    $discountedPrice = $this->calculateDiscountedPrice(
                        $product->regular_price,
                        $discount,
                        $discountType
                    );

                    // Attach updated discount details to pivot table
                    $promo->products()->attach($productId, [
                        'discount_product_voucher_item' => $discount,
                        'discount_type' => $discountType,
                        'discounted_price' => $discountedPrice
                    ]);
                }
            }

            DB::commit();

            return redirect()->route('index-promo')->with('success', 'Promo updated successfully!');
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Error updating Promo', ['exception' => $e->getMessage()]);
            return redirect()->back()->withErrors(['error' => 'An error occurred while updating the Promo: ' . $e->getMessage()])->withInput();
        }
    }










    // PROMO VOUCHER
    public function indexPromoVoucher()
    {
        // Mengambil promo dengan tipe yang ditentukan dan mengurutkannya berdasarkan created_at
        $promo = Promo::whereIn('type', ['limited voucher', 'brand voucher', 'product voucher', 'shipping fee voucher', 'new user voucher'])
            ->orderBy('created_at', 'desc') // Mengurutkan berdasarkan waktu pembuatan
            ->get();

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
                'discount' => 'required|numeric',
                'global_discount_type' => 'required|in:nominal,percentage',
                'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048'
            ]);

            // Simpan data diskon
            $discount = $request->input('discount');
            $discountType = $request->input('global_discount_type');

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
            Promo::create([
                'promo_name' => $request->promo_name,
                'date_range' => $request->date_range, // Tidak perlu explode, mutator akan menangani
                'min_transaction' => $minTransaction,
                'promo_code' => $promoCode,
                'usage_quota' => $request->usage_quota,
                'max_quantity_buyer' => $request->max_quantity_buyer,
                'discount' => $discount,
                'discount_type' => $discountType,
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
    public function createPromoBrandVoucher()
    {
        $brands = Brand::with('products')->get();
        return view('admin.promo.voucher.create-voucher-brand', compact('brands'));
    }

    public function storePromoBrandVoucher(Request $request)
    {
        try {
            $request->validate([
                'promo_name' => 'required|string|max:255',
                'date_range' => 'required|string|max:255',
                'min_transaction' => 'required',
                'usage_quota' => 'required',
                'max_quantity_buyer' => 'required',
                'promo_code' => 'required',
                'discount' => 'required|numeric',
                'global_discount_type' => 'required|in:nominal,percentage',
                'brand_id' => 'required|exists:brands,id',
                'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048'
            ]);

            // Simpan data diskon
            $discount = $request->input('discount');
            $discountType = $request->input('global_discount_type');

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
                'discount' => $discount,
                'discount_type' => $discountType,
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
                'discount' => 'required|numeric',
                'global_discount_type' => 'required|in:nominal,percentage',
                'product_ids' => 'required|array',
                'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            ]);

            // Simpan data diskon
            $discount = $request->input('discount');
            $discountType = $request->input('global_discount_type');

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
                'discount' => $discount,
                'discount_type' => $discountType,
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

        // Transform products to include current selection status
        $products = $products->map(function ($product) use ($promo) {
            $product->is_selected = $promo->products->contains('id', $product->id);
            $product->has_other_active_promo = $product->getHasActivePromoAttribute() && !$product->is_selected;
            return $product;
        });

        // Parse date range yang tersimpan menjadi format yang sesuai
        $start_date = Carbon::parse($promo->start_date)->format('m/d/Y');
        $end_date = Carbon::parse($promo->end_date)->format('m/d/Y');
        $promo->date_range = $start_date . ' - ' . $end_date;

        // Tambahkan diskon dan tipe diskon
        $promo->discount_type = $promo->discount_type ?? 'nominal';
        $promo->discount_value = $promo->discount;

        switch ($promo->type) {
            case 'brand voucher':
                return view('admin.promo..voucher.edit-voucher-brand', compact('promo', 'brands'));
            case 'product voucher':
                return view('admin.promo.voucher.edit-voucher-product', compact('promo', 'products'));
            case 'limited voucher':
                return view('admin.promo.voucher.edit-voucher-limited', compact('promo'));
            case 'new user voucher':
                return view('admin.promo.voucher.edit-voucher-newuser', compact('promo'));
            default:
                return redirect()->back()->with('error', 'Invalid voucher type');
        }
    }

    public function updatePromoVoucherLimited(Request $request, $id)
    {
        try {
            $request->validate([
                'promo_name' => 'required|string|max:255',
                'date_range' => 'required|string|max:255',
                'min_transaction' => 'required',
                'usage_quota' => 'required',
                'max_quantity_buyer' => 'required',
                'discount' => 'required|numeric',
                'global_discount_type' => 'required|in:nominal,percentage',
                'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
            ]);

            $promo = Promo::findOrFail($id);

            // Simpan data diskon
            $discount = $request->input('discount');
            $discountType = $request->input('global_discount_type');

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
                'discount' => $discount,
                'discount_type' => $discountType,
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
    public function createPromoVoucherShippingFee()
    {
        $products = Product::all(); // Pastikan kamu menggunakan model Product
        return view('admin.promo.voucher.create-voucher-ongkir', compact('products'));
    }

    public function storePromoVoucherShippingFee(Request $request)
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
            return redirect()->route('index-promo-voucher')->with('success', 'Promo Shipping Fee Voucher created successfully!');
        } catch (\Illuminate\Validation\ValidationException $e) {
            return redirect()->back()->withErrors($e->errors())->withInput();
        } catch (\Exception $e) {
            Log::error('Error creating Voucher', ['exception' => $e->getMessage()]);
            return redirect()->back()->withErrors(['error' => 'An error occurred while creating the Voucher: ' . $e->getMessage()])->withInput();
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

        // Hapus gambar utama dari folder storage
        if (!empty($promo->image) && Storage::disk('public')->exists($promo->image)) {
            Storage::disk('public')->delete($promo->image);
        }

        // Hapus promo dari database
        $promo->delete();

        return response()->json([
            'success' => true,
            'message' => 'Promo deleted successfully.'
        ]);
    }






    // PROMO DISKON
    public function indexPromoDiskon()
    {
        $promo = Promo::where('type', 'discount')->with('tiers')
            ->orderBy('created_at', 'desc') // Mengurutkan berdasarkan waktu pembuatan
            ->get();
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
            ]);

            // Simpan data promo tanpa discount_type karena akan disimpan di promo_tiers
            $promo = Promo::create([
                'promo_name' => $request->promo_name,
                'date_range' => $request->date_range,
                'type' => 'discount', // ini untuk membedakan jenis promo
                // tidak perlu menyimpan discount_type di sini karena sudah ada di promo_tiers
            ]);

            // Simpan tier diskon sesuai tipe
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

            return redirect()->route('index-promo-diskon')
                ->with('success', 'Promo Diskon created successfully!');
        } catch (\Illuminate\Validation\ValidationException $e) {
            return redirect()->back()
                ->withErrors($e->errors())
                ->withInput();
        } catch (\Exception $e) {
            Log::error('Error creating product', ['exception' => $e->getMessage()]);
            return redirect()->back()
                ->withErrors(['error' => 'An error occurred while creating the product: ' . $e->getMessage()])
                ->withInput();
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
        // Mengambil promo dengan tipe 'new user' dan mengurutkannya berdasarkan created_at
        $promo = Promo::where('type', 'new user')
            ->orderBy('created_at', 'desc') // Mengurutkan berdasarkan waktu pembuatan
            ->get();
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
        return view('admin.promo.voucher.create-voucher-newuser');
    }

    public function storePromoNewUser(Request $request)
    {
        try {

            $request->validate([
                'promo_name' => 'required|string|max:255',
                'date_range' => 'required|string|max:255',
                'min_transaction' => 'required',
                'usage_quota' => 'required',
                'max_quantity_buyer' => 'required',
                'promo_code' => 'required',
                'discount' => 'required|numeric',
                'global_discount_type' => 'required|in:nominal,percentage',
                'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048'
            ]);

            // Simpan data diskon
            $discount = $request->input('discount');
            $discountType = $request->input('global_discount_type');

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
            Promo::create([
                'promo_name' => $request->promo_name,
                'date_range' => $request->date_range, // Tidak perlu explode, mutator akan menangani
                'min_transaction' => $minTransaction,
                'promo_code' => $promoCode,
                'usage_quota' => $request->usage_quota,
                'max_quantity_buyer' => $request->max_quantity_buyer,
                'discount' => $discount,
                'discount_type' => $discountType,
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

    public function updatePromoVoucherNewUser(Request $request, $id)
    {
        try {
            $request->validate([
                'promo_name' => 'required|string|max:255',
                'date_range' => 'required|string|max:255',
                'min_transaction' => 'required',
                'usage_quota' => 'required',
                'max_quantity_buyer' => 'required',
                'discount' => 'required|numeric',
                'global_discount_type' => 'required|in:nominal,percentage',
                'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
            ]);

            $promo = Promo::findOrFail($id);

            // Simpan data diskon
            $discount = $request->input('discount');
            $discountType = $request->input('global_discount_type');

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
                'discount' => $discount,
                'discount_type' => $discountType,
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
}
