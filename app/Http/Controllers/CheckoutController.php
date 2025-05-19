<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Models\Buynow;
use App\Models\Cart;
use App\Models\Cart_item;
use App\Models\Shipping_address;
use App\Models\User;
use App\Models\VoucherNewUser;
use App\Models\Product;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Payment;
use App\Models\Invoice;
use App\Models\Promo;
use App\Models\Province;
use App\Models\City;
use App\Models\ProductStocks;
use App\Models\ProductVariations;
use App\Models\PromoProduct;
use App\Models\ProductVariations;
use Exception;
use Carbon\Carbon;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

use App\Services\DokuService;
use PDO;

class CheckoutController extends Controller
{
    public function index(Request $request)
    {
        try {
            $userId = session('id_user');
            $date = now()->format('Y-m-d');

            if ($userId) {
                $user = Auth::user();

                // Check if user is verified
                if (!$user->hasVerifiedEmail()) {
                    return redirect('/' . $userId . '_account');
                }

                $data = Cart::where('user_id', $userId)
                    ->with('cartItems')
                    ->get();

                // HANDLE VOUCHER USER
                $checkVoucherUsage = Order::where('user_id', $userId)
                    ->where(function ($query) {
                        $query->whereNotNull('voucher_promo')
                            ->orWhereNotNull('voucher_ongkir');
                    })
                    ->select('voucher_promo', 'voucher_ongkir')
                    ->get()
                    ->flatMap(function ($order) {
                        return array_filter([$order->voucher_promo, $order->voucher_ongkir]);
                    })
                    ->unique()
                    ->values()
                    ->toArray();


                    // dd($checkVoucherUsage);
                    // Check if there are any used vouchers
                    
                    $vouchers = Promo::whereIn('type', ['limited voucher', 'ongkir voucher', 'brand voucher', 'product voucher'])
                        ->leftJoin('brands', 'brands.id', '=', 'promos.brand_id')
                        ->when('product voucher' === 'product voucher', function($query) {
                            return $query->with('products');
                        })
                        ->when('type' === 'brand voucher', function($query) {
                            return $query->with('products');
                        })
                        ->whereNotIn('promo_code', $checkVoucherUsage)
                        ->whereColumn('total_used', '<', 'usage_quota')
                        ->whereRaw("STR_TO_DATE(SUBSTRING_INDEX(date_range, ' - ', 1), '%Y-%m-%d') <= ?", [Carbon::today()])
                        ->whereRaw("STR_TO_DATE(SUBSTRING_INDEX(date_range, ' - ', -1), '%Y-%m-%d') >= ?", [Carbon::today()])
                        ->select(
                            'brands.name as brand_name',  // Nama brand
                            'promos.*'                   // Data promo
                        )
                        ->distinct()  // Menghindari duplikasi
                        ->get();

                    // dd($vouchers);
                    $productVouchers = $vouchers->filter(function ($voucher) {
                        return $voucher->type === 'product voucher';
                    });
                    
                    $brandVouchers = $vouchers->filter(function ($voucher) {
                        return $voucher->type === 'brand voucher';
                    });
                    
                    $productVoucherIds = $productVouchers->flatMap(function ($voucher) {
                        return $voucher->promoProducts->pluck('product_id');
                    })->unique(); // Mengambil semua product_id terkait dan menghilangkan duplikasi

                    $brandVoucherIds = $brandVouchers->flatMap(function ($voucher) {
                        return $voucher->promoProducts->pluck('product_id');
                    })->unique(); // Mengambil semua product_id terkait dan menghilangkan duplikasi
                    
                    // dd($productVoucherIds);
                // END HANDLE VOUCHER USER


                // AMBIL SELURUH DATA ALAMAT PENGIRIMAN USER
                $address = Shipping_address::where('user_id', session('id_user'))
                    ->orderBy('is_main', 'DESC')
                    ->get();
                // END ALL SHIPPING ADDRESS USER

                // AMBIL DATA ALAMAT PENGIRIMAN YANG DIGUNAKAN
                $shippingAddressId = Shipping_address::where('user_id', session('id_user'))
                    ->where('is_use', 1)
                    ->value('id');
                $province = Shipping_address::where('user_id', session('id_user'))
                    ->where('is_use', 1)
                    ->value('province');
                $regency = Shipping_address::where('user_id', session('id_user'))
                    ->where('is_use', 1)
                    ->value('regency');
                // END GET DATA USE SHIPPING


                // MENGAMBIL PRODUK YANG DIBELI MELALUI KERANJANG
                $cartId = Cart::where('user_id', session('id_user'))->value('id');

                $cartItems = Cart_item::where('cart_id', $cartId)
                    ->leftJoin('products', 'products.id', '=', 'cart_items.product_id')
                    ->leftJoin('brands', 'brands.id', '=', 'products.brand_id')
                    ->where('is_choose', true)
                    ->whereHas('product', function ($query) {
                        $query->where('stock_quantity', '!=', 0);
                    })
                    ->with(['product' => function ($query) {
                        $query->with(['promos' => function ($query) {
                            $query->select('promos.*')
                                ->with(['tiers'])
                                ->whereRaw("STR_TO_DATE(SUBSTRING_INDEX(date_range, ' - ', 1), '%Y-%m-%d') <= ?", [Carbon::today()])
                                ->whereRaw("STR_TO_DATE(SUBSTRING_INDEX(date_range, ' - ', -1), '%Y-%m-%d') >= ?", [Carbon::today()]);
                        }]);
                    }, 'productVariant'])
                    ->select(
                        'cart_items.*',        // Semua kolom dari tabel cart_items
                        'products.brand_id',   // brand_id dari tabel products
                        'brands.id as brand_id' // id dari tabel brands
                    )
                    ->get();
            
                    foreach ($cartItems as $item) {
                        if ($item->product && $item->product->promos) {
                            foreach ($item->product->promos as $promo) {
                                if ($promo->tiers) {
                                    foreach ($promo->tiers as $tier) {
                                        switch ($tier->discount_type) {
                                            case 'percentage':
                                                // Contoh logika untuk diskon persentase
                                                if ($item->quantity == $tier->min_quantity) {
                                                    $discountedPrice = $item->total * ((100 - $tier->discount_value) / 100);
                                                    $item->bundle_price = $discountedPrice;
                                                    $item->total = $discountedPrice;
                                                }
                                                break;
                    
                                            case 'nominal':
                                                // Contoh logika untuk diskon nominal
                                                if ($item->quantity == $tier->min_quantity) {
                                                    $discountedPrice = $item->total - $tier->discount_value;
                                                    $item->bundle_price = $discountedPrice;
                                                    $item->total = $discountedPrice;
                                                }
                                                break;
                    
                                            case 'package':
                                                if ($item->quantity == $tier->min_quantity) {
                                                    $item->bundle_price = $tier->package_price; // Tetapkan harga paket
                                                    $item->total = $tier->package_price;
                                                }
                                                break;
                    
                                            default:
                                                // Logika default jika tidak ada kasus yang cocok
                                                $item->discounted_price = $item->product->price;
                                                break;
                                            }
                                        }
                                    }
                            }
                        }
                    }
                    
                $voucherDisabled = false; // Default awal
                // dd($cartItems);
                foreach ($cartItems as $prod) {
                    $activePromo = $prod->product->promos->first(); // Mengambil promo pertama yang aktif
                    $discountedPrice = $activePromo ? $activePromo->pivot->discounted_price : null;
                    $promoTiers = $activePromo == "" ? null : $activePromo->all_discount_tiers ;
                    
                    $di = [
                        "discountedPrice" => $discountedPrice,
                        "promoTier"       => $promoTiers,
                    ];

                    // dd($di);

                    if ($discountedPrice !== null && $promoTiers !== null && $promoTiers !== "") {
                        $voucherDisabled = true;
                        // dd($promoTiers);
                        break; // Hentikan iterasi jika kondisi terpenuhi
                    }
                }

                // dd($voucherDisabled);

                // dd($promoTiers);
            

                $totalItem = $cartItems->count();
                $totalWeight = $cartItems->sum(function ($cartItem) {
                    return ($cartItem->product->weight_product ?? 0) * $cartItem->quantity; // Multiply weight by quantity
                });
                if (count($cartItems) == 0) {
                    return redirect('/');
                }
                foreach ($cartItems as $item) {
                    if ($item->product->stock_quantity == 0) {
                        return redirect('/cart')->with('stock_empty', 'Stok produk ' . $item->product->product_name . ' kosong');
                    }
                }
                $totalProduct = $cartItems->sum('quantity');
                $totalPrice = $cartItems->sum('total');
                // END PRODUK ITEM



                // dd($cartItems);
                // AMBIL METODE PENGIRIMAN DARI API RAJAONGKIR
                $provinceId = null;
                $provinces = Province::get();
                foreach ($provinces as $resprov) {
                    if (strtolower($resprov['province']) === strtolower($province)) {
                        $provinceId = $resprov['province_id'];
                        break; // Berhenti setelah ditemukan
                    }
                }

                // $responseProvince = Http::withHeaders([
                //     'key' => '8bdc162da0cd0ac8b70ac07d40f43963',
                // ])->get('https://api.rajaongkir.com/starter/province');            
                // if ($responseProvince->successful()) {
                //     $provinces = $responseProvince->json()['rajaongkir']['results'];

                //     foreach ($provinces as $resprov) {
                //         if (strtolower($resprov['province']) === strtolower($province)) {
                //             $provinceId = $resprov['province_id'];
                //             break; // Berhenti setelah ditemukan
                //         }
                //     }
                //     foreach ($provinces as $resprov) {
                //         Province::updateOrCreate(
                //             ['province_id' => $resprov['province_id']], // Check for uniqueness by province_id
                //             ['province' => $resprov['province']]
                //         );
                //     }
                // } else {
                //     Log::error('Failed to fetch provinces: ' . $responseProvince->status());
                // }

                // dd($regency);

                // $responseCities = Http::withHeaders([
                //     'key' => '8bdc162da0cd0ac8b70ac07d40f43963',
                // ])->get('https://api.rajaongkir.com/starter/city', );
                // if ($responseCities->successful()) {
                //     $cities = $responseCities->json()['rajaongkir']['results'];

                //     foreach ($cities as $rescit) {
                //         if (strtolower($rescit['city_name']) === strtolower($regency)) {
                //             $cityId = $rescit['city_id'];
                //             break; // Berhenti setelah ditemukan
                //         }
                //     }

                //     foreach ($cities as $rescity) {
                //         // Insert or update city data if it doesn't exist
                //         City::updateOrCreate(
                //             ['city_id' => $rescity['city_id']], // Unique constraint on city_id
                //             [
                //                 'province_id' => $rescity['province_id'],
                //                 'province' => $rescity['province'],
                //                 'type' => $rescity['type'],
                //                 'city_name' => $rescity['city_name'],
                //                 'postal_code' => $rescity['postal_code']
                //             ]
                //         );
                //     }
                // } else {
                //     Log::error('Failed to fetch cities: ' . $responseCities->status());
                // }

                $cityId = null;
                $cities = City::where('province_id', $provinceId)->get();
                $regency = str_replace(['KOTA ', 'KABUPATEN '], '', $regency);
                foreach ($cities as $rescit) {
                    if (strtolower($rescit['city_name']) === strtolower($regency)) {
                        $cityId = $rescit['city_id'];
                        break; // Berhenti setelah ditemukan
                    }
                }

                // dd($cityId);

                $responseShipping = Http::withHeaders([
                    'key' => '8bdc162da0cd0ac8b70ac07d40f43963',
                ])->post('https://api.rajaongkir.com/starter/cost', [
                    'origin' => 114,
                    'destination' => $cityId,
                    'weight' => $totalWeight,
                    'courier' => 'jne',
                ]);

                $sfee = [];
                if ($responseShipping->successful()) {
                    $shippingFee = $responseShipping->json()['rajaongkir']['results'];

                    foreach ($shippingFee[0]['costs'] as $index => $sf) {
                        $sfee[$index] = [
                            'id' => $sf['service'],
                            'description' => $sf['description'],
                            'value' => $sf['cost'][0]['value'],
                            'etd' => $sf['cost'][0]['etd']
                        ];
                    }
                    // foreach ($shippingFee[0]['costs'] as $service) {
                    //     ShippingFee::create([
                    //         'code' => $shippingFee[0]['code'],
                    //         'name' => $shippingFee[0]['name'],
                    //         'service' => $service['service'],
                    //         'description' => $service['description'],
                    //         'cost_value' => $service['cost'][0]['value'],
                    //         'etd' => $service['cost'][0]['etd'],
                    //         'note' => $service['cost'][0]['note'] ?? '',
                    //     ]);
                    // }
                } else {
                    Log::error('Failed to fetch shipping: ' . $responseShipping->status());
                }

                // ONGKIR
                $ongkir = null;
                if ($request->service) {
                    foreach ($sfee as $service) {
                        if (trim($service['id']) === trim($request->service)) {
                            $ongkir = $service['value'];
                            break;
                        }
                    }
                    return response()->json([
                        'success' => true,
                        'service' => $request->service,
                        'ongkir'   => $ongkir,
                    ]);
                }
                // END ONGKIR

                // dd($vouchers);
                $groupedVouchers = $vouchers->groupBy('type');
                $data = [
                    'address'       => $address,
                    'shippingAddressId' => $shippingAddressId,
                    'shippingFee'   => $sfee,
                    'province'     => $province,
                    'regency'       => $regency,
                    'cartItems'     => $cartItems,
                    'totalProduct'  => $totalProduct,
                    'totalPrice'    => $totalPrice,
                    'vouchers'      => $vouchers,
                    'totalItem'     => $totalItem,
                    'ongkir'        => $ongkir,
                    'weight'        => $totalWeight,
                    'productVoucherIds' => $productVoucherIds,
                    'brandVoucherIds' => $brandVoucherIds,
                    'voucherDisabled' => $voucherDisabled,
                ];

                $productIds = $data['cartItems']->pluck('product_id');

                // dd($productIds->intersect($data['productVoucherIds'])->isNotEmpty());
                // dd($data['cartItems']->pluck('product_id'));
                $brandIds = $cartItems->pluck('brand_id'); // Ambil semua brand_id dari cartItems
                $productIds = $cartItems->pluck('product_id');


                $unusableVouchers = $vouchers->filter(function ($voucher) use ($data, $brandIds, $productIds) {
                    // Voucher unusable jika salah satu kondisi tidak terpenuhi
                    return
                        $data['totalPrice'] < $voucher->min_transaction ||
                        $data['totalItem'] > $voucher->max_quantity_buyer ||
                        !$brandIds->contains($voucher->brand_id) ||
                        $productIds->intersect($data['productVoucherIds'])->isEmpty();
                });

                return view('user.component.checkout', [
                    'groupedVouchers' => $groupedVouchers,
                ])->with('data', $data);
            } else {
                session()->flash('register_or_login_first');
                return redirect()->back();
            }
        } catch (Exception $err) {
            dd($err);
        }
    }

    public function buyNow(Request $request)
    {
        try {
            $userId = session('id_user');
            $date = now()->format('Y-m-d');

            if ($userId) {
                $user = Auth::user();

                // Check if user is verified
                if (!$user->hasVerifiedEmail()) {
                    return redirect('/' . $userId . '_account');
                }
                
                $data = Cart::where('user_id', $userId)
                    ->with('cartItems')
                    ->get();

                // HANDLE VOUCHER USER
                    $checkVoucherUsage = Order::where('user_id', $userId)
                        ->where(function ($query) {
                            $query->whereNotNull('voucher_promo')
                                ->orWhereNotNull('voucher_ongkir');
                        })
                        ->select('voucher_promo', 'voucher_ongkir')
                        ->get()
                        ->flatMap(function ($order) {
                            return array_filter([$order->voucher_promo, $order->voucher_ongkir]);
                        })
                        ->unique()
                        ->values()
                        ->toArray();
    

                    // dd($checkVoucherUsage);
                    // Check if there are any used vouchers
                    
                    $vouchers = Promo::whereIn('type', ['limited voucher', 'ongkir voucher', 'brand voucher', 'product voucher'])
                        ->leftJoin('brands', 'brands.id', '=', 'promos.brand_id')
                        ->when('product voucher' === 'product voucher', function($query) {
                            return $query->with('products');
                        })
                        ->when('type' === 'brand voucher', function($query) {
                            return $query->with('products');
                        })
                        ->whereNotIn('promo_code', $checkVoucherUsage)
                        ->whereColumn('total_used', '<', 'usage_quota')
                        ->whereRaw("STR_TO_DATE(SUBSTRING_INDEX(date_range, ' - ', 1), '%Y-%m-%d') <= ?", [Carbon::today()])
                        ->whereRaw("STR_TO_DATE(SUBSTRING_INDEX(date_range, ' - ', -1), '%Y-%m-%d') >= ?", [Carbon::today()])
                        ->select(
                            'brands.name as brand_name',  // Nama brand
                            'promos.*'                   // Data promo
                        )
                        ->distinct()  // Menghindari duplikasi
                        ->get();

                    // dd($vouchers);
                    $productVouchers = $vouchers->filter(function ($voucher) {
                        return $voucher->type === 'product voucher';
                    });
                    
                    $brandVouchers = $vouchers->filter(function ($voucher) {
                        return $voucher->type === 'brand voucher';
                    });
                    
                    $productVoucherIds = $productVouchers->flatMap(function ($voucher) {
                        return $voucher->promoProducts->pluck('product_id');
                    })->unique(); // Mengambil semua product_id terkait dan menghilangkan duplikasi

                    $brandVoucherIds = $brandVouchers->flatMap(function ($voucher) {
                        return $voucher->promoProducts->pluck('product_id');
                    })->unique(); // Mengambil semua product_id terkait dan menghilangkan duplikasi
                    
                    // dd($productVoucherIds);
                // END HANDLE VOUCHER USER


                // AMBIL SELURUH DATA ALAMAT PENGIRIMAN USER
                $address = Shipping_address::where('user_id', session('id_user'))
                    ->orderBy('is_main', 'DESC')
                    ->get();
                
                // AMBIL DATA ALAMAT PENGIRIMAN YANG DIGUNAKAN
                $shippingAddressId = Shipping_address::where('user_id', session('id_user'))
                    ->where('is_use', 1)
                    ->value('id');
                $province = Shipping_address::where('user_id', session('id_user'))
                    ->where('is_use', 1)
                    ->value('province');
                $regency = Shipping_address::where('user_id', session('id_user'))
                    ->where('is_use', 1)
                    ->value('regency');
                // END GET DATA USE SHIPPING


                // MENGAMBIL PRODUK YANG DIBELI MELALUI KERANJANG
                
                $cartItems = buyNow::where('user_id', $userId)
                    ->leftJoin('products', 'products.id', '=', 'buy_nows.product_id')
                    ->leftJoin('brands', 'brands.id', '=', 'products.brand_id')
                    ->where('is_buy', false)
                    ->whereHas('product', function ($query) {
                        $query->where('stock_quantity', '!=', 0);
                    })
                    ->with(['product' => function ($query) {
                        $query->with(['promos' => function ($query) {
                            $query->select('promos.*')
                                ->with(['tiers'])
                                ->whereRaw("STR_TO_DATE(SUBSTRING_INDEX(date_range, ' - ', 1), '%Y-%m-%d') <= ?", [Carbon::today()])
                                ->whereRaw("STR_TO_DATE(SUBSTRING_INDEX(date_range, ' - ', -1), '%Y-%m-%d') >= ?", [Carbon::today()]);
                        }]);
                    }, 'productVariant'])
                    ->select(
                        'buy_nows.*',        // Semua kolom dari tabel cart_items
                        'products.brand_id',   // brand_id dari tabel products
                        'brands.id as brand_id' // id dari tabel brands
                    )
                    ->get();
                    
                    // dd($cartItems);
            
                    foreach ($cartItems as $item) {
                        if ($item->product && $item->product->promos) {
                            foreach ($item->product->promos as $promo) {
                                if ($promo->tiers) {
                                    foreach ($promo->tiers as $tier) {
                                        switch ($tier->discount_type) {
                                            case 'percentage':
                                                // Contoh logika untuk diskon persentase
                                                if ($item->quantity == $tier->min_quantity) {
                                                    $discountedPrice = $item->total * ((100 - $tier->discount_value) / 100);
                                                    $item->bundle_price = $discountedPrice;
                                                    $item->total = $discountedPrice;
                                                }
                                                break;
                    
                                            case 'nominal':
                                                // Contoh logika untuk diskon nominal
                                                if ($item->quantity == $tier->min_quantity) {
                                                    $discountedPrice = $item->total - $tier->discount_value;
                                                    $item->bundle_price = $discountedPrice;
                                                    $item->total = $discountedPrice;
                                                }
                                                break;
                    
                                            case 'package':
                                                if ($item->quantity == $tier->min_quantity) {
                                                    $item->bundle_price = $tier->package_price; // Tetapkan harga paket
                                                    $item->total = $tier->package_price;
                                                }
                                                break;
                    
                                            default:
                                                // Logika default jika tidak ada kasus yang cocok
                                                $item->discounted_price = $item->product->price;
                                                break;
                                            }
                                        }
                                    }
                            }
                        }
                    }
                    
                $voucherDisabled = false; // Default awal

                // dd($cartItems);
                foreach ($cartItems as $prod) {
                    $activePromo = $prod->product->promos->first(); // Mengambil promo pertama yang aktif
                    $discountedPrice = $activePromo ? $activePromo->pivot->discounted_price : null;
                    $promoTiers = $activePromo == "" ? null : $activePromo->all_discount_tiers ;
                
                    if ($discountedPrice !== null || $promoTiers !== "") {
                        $voucherDisabled = true;
                        // dd($promoTiers);
                        break; // Hentikan iterasi jika kondisi terpenuhi
                    }

                }

                // dd($promoTiers);
            

                $totalItem = $cartItems->count();
                $totalWeight = $cartItems->sum(function ($cartItem) {
                    return ($cartItem->product->weight_product ?? 0) * $cartItem->quantity; // Multiply weight by quantity
                });
                if (count($cartItems) == 0) {
                    return redirect('/');
                }
                foreach ($cartItems as $item) {
                    if ($item->product->stock_quantity == 0) {
                        return redirect('/cart')->with('stock_empty', 'Stok produk ' . $item->product->product_name . ' kosong');
                    }
                }                
                $totalProduct = $cartItems->sum('quantity');
                $totalPrice = $cartItems->sum('total');
                // END PRODUK ITEM



                // dd($cartItems);
                // AMBIL METODE PENGIRIMAN DARI API RAJAONGKIR
                $provinceId = null;
                $provinces = Province::get();
                foreach ($provinces as $resprov) {
                    if (strtolower($resprov['province']) === strtolower($province)) {
                        $provinceId = $resprov['province_id'];
                        break; // Berhenti setelah ditemukan
                    }
                }

                // $responseProvince = Http::withHeaders([
                //     'key' => '8bdc162da0cd0ac8b70ac07d40f43963',
                // ])->get('https://api.rajaongkir.com/starter/province');            
                // if ($responseProvince->successful()) {
                //     $provinces = $responseProvince->json()['rajaongkir']['results'];

                //     foreach ($provinces as $resprov) {
                //         if (strtolower($resprov['province']) === strtolower($province)) {
                //             $provinceId = $resprov['province_id'];
                //             break; // Berhenti setelah ditemukan
                //         }
                //     }
                //     foreach ($provinces as $resprov) {
                //         Province::updateOrCreate(
                //             ['province_id' => $resprov['province_id']], // Check for uniqueness by province_id
                //             ['province' => $resprov['province']]
                //         );
                //     }
                // } else {
                //     Log::error('Failed to fetch provinces: ' . $responseProvince->status());
                // }

                // dd($regency);

                // $responseCities = Http::withHeaders([
                //     'key' => '8bdc162da0cd0ac8b70ac07d40f43963',
                // ])->get('https://api.rajaongkir.com/starter/city', );
                // if ($responseCities->successful()) {
                //     $cities = $responseCities->json()['rajaongkir']['results'];

                //     foreach ($cities as $rescit) {
                //         if (strtolower($rescit['city_name']) === strtolower($regency)) {
                //             $cityId = $rescit['city_id'];
                //             break; // Berhenti setelah ditemukan
                //         }
                //     }

                //     foreach ($cities as $rescity) {
                //         // Insert or update city data if it doesn't exist
                //         City::updateOrCreate(
                //             ['city_id' => $rescity['city_id']], // Unique constraint on city_id
                //             [
                //                 'province_id' => $rescity['province_id'],
                //                 'province' => $rescity['province'],
                //                 'type' => $rescity['type'],
                //                 'city_name' => $rescity['city_name'],
                //                 'postal_code' => $rescity['postal_code']
                //             ]
                //         );
                //     }
                // } else {
                //     Log::error('Failed to fetch cities: ' . $responseCities->status());
                // }

                $cityId = null;
                $cities = City::where('province_id', $provinceId)->get();
                $regency = str_replace(['KOTA ', 'KABUPATEN '], '', $regency);
                foreach ($cities as $rescit) {
                    if (strtolower($rescit['city_name']) === strtolower($regency)) {
                        $cityId = $rescit['city_id'];
                        break; // Berhenti setelah ditemukan
                    }
                }

                // dd($cityId);

                $responseShipping = Http::withHeaders([
                    'key' => '8bdc162da0cd0ac8b70ac07d40f43963',
                ])->post('https://api.rajaongkir.com/starter/cost', [
                    'origin' => 114,
                    'destination' => $cityId,
                    'weight' => $totalWeight,
                    'courier' => 'jne',
                ]);

                $sfee = [];
                if ($responseShipping->successful()) {
                    $shippingFee = $responseShipping->json()['rajaongkir']['results'];

                    foreach ($shippingFee[0]['costs'] as $index => $sf) {
                        $sfee[$index] = [
                            'id' => $sf['service'],
                            'description' => $sf['description'],
                            'value' => $sf['cost'][0]['value'],
                            'etd' => $sf['cost'][0]['etd']
                        ];
                    }
                    // foreach ($shippingFee[0]['costs'] as $service) {
                    //     ShippingFee::create([
                    //         'code' => $shippingFee[0]['code'],
                    //         'name' => $shippingFee[0]['name'],
                    //         'service' => $service['service'],
                    //         'description' => $service['description'],
                    //         'cost_value' => $service['cost'][0]['value'],
                    //         'etd' => $service['cost'][0]['etd'],
                    //         'note' => $service['cost'][0]['note'] ?? '',
                    //     ]);
                    // }
                } else {
                    Log::error('Failed to fetch shipping: ' . $responseShipping->status());
                }

                // ONGKIR
                $ongkir = null;
                if ($request->service) {
                    foreach ($sfee as $service) {
                        if (trim($service['id']) === trim($request->service)) {
                            $ongkir = $service['value'];
                            break;
                        }
                    }
                    return response()->json([
                        'success' => true,
                        'service' => $request->service,
                        'ongkir'   => $ongkir,
                    ]);
                }
                // END ONGKIR

                // dd($vouchers);
                $groupedVouchers = $vouchers->groupBy('type');
                $data = [
                    'address'       => $address,
                    'shippingAddressId' => $shippingAddressId,
                    'shippingFee'   => $sfee,
                    'province'     => $province,
                    'regency'       => $regency,
                    'cartItems'     => $cartItems,
                    'totalProduct'  => $totalProduct,
                    'totalPrice'    => $totalPrice,
                    'vouchers'      => $vouchers,
                    'totalItem'     => $totalItem,
                    'ongkir'        => $ongkir,
                    'weight'        => $totalWeight,
                    'productVoucherIds' => $productVoucherIds,
                    'brandVoucherIds' => $brandVoucherIds,
                    'voucherDisabled' => $voucherDisabled,
                ];

                $productIds = $data['cartItems']->pluck('product_id');
                
                // dd($productIds->intersect($data['productVoucherIds'])->isNotEmpty());
                // dd($data['cartItems']->pluck('product_id'));
                $brandIds = $cartItems->pluck('brand_id'); // Ambil semua brand_id dari cartItems
                $productIds = $cartItems->pluck('product_id');


                $unusableVouchers = $vouchers->filter(function ($voucher) use ($data, $brandIds, $productIds) {
                    // Voucher unusable jika salah satu kondisi tidak terpenuhi
                    return 
                        $data['totalPrice'] < $voucher->min_transaction || 
                        $data['totalItem'] > $voucher->max_quantity_buyer || 
                        !$brandIds->contains($voucher->brand_id) ||
                        $productIds->intersect($data['productVoucherIds'])->isEmpty();
                });

                // dd($data['cartItems']);

                // dd($unusableVouchers);
                
                return view('user.component.buynow', [
                    'groupedVouchers' => $groupedVouchers,
                ])->with('data', $data);
            }
            else {
                session()->flash('register_or_login_first');
                return redirect()->back();
            }
        } catch (Exception $err) {
            dd($err);
        }
    }


    public function checkCodeVoucher(Request $request)
    {
        $voucherExists = VoucherNewUser::where('code', $request->code)
            ->where('user_id', session('id_user'))
            ->where('is_use', '=', 0)
            ->exists();

        return response()->json(['exists' => $voucherExists]);
    }

    public function checkApplyVoucher(Request $request)
    {
        try {
            $userId = session('id_user');
            $voucherCode = $request->code_voucher_promo;
            $ongkirCode = $request->code_voucher_ongkir;

            // Basic response if user ID is not found
            if (!$userId) {
                return response()->json([
                    'success' => false,
                    'message' => 'User not found.'
                ]);
            }

            // Initialize variables
            $totalPrice = 0;
            $discount = 0;
            $ongkirVoucher = 0;
            $ongkirDiscount = 0;
            $voucher = null;
            $ongkir = null;
            $discountOngkir = 0;
            $ongkirAfter = $request->shipping_cost;


            // Retrieve promo voucher if `voucherCode` is provided
            if (!empty($voucherCode)) {
                $voucher = Promo::where('promo_code', $voucherCode)->first();
            }

            // Retrieve ongkir discount if `ongkirCode` is provided
            if (!empty($ongkirCode)) {
                $ongkir = Promo::where('promo_code', $ongkirCode)->first();
                $ongkirDiscount = $ongkir ? $ongkir->discount : 0;
                if ($ongkirDiscount <= 100) {
                    $discountOngkir = $request->shipping_cost * ($ongkirDiscount / 100);
                    $ongkirAfter = $request->shipping_cost - $discountOngkir;
                } else {
                    $discountOngkir = min($request->shipping_cost, $ongkirDiscount);
                    $ongkirAfter = $request->shipping_cost - $discountOngkir;
                }
            }

            // Return error if neither `voucher` nor `ongkir` is valid
            if (!$voucher && !$ongkir) {
                return response()->json([
                    'success' => false,
                    'message' => 'Kode promo tidak valid atau sudah tidak aktif.'
                ]);
            }

            // Fetch cart items and calculate `totalPrice`
            $cartId = Cart::where('user_id', $userId)->value('id');
            $cartItems = Cart_item::where('cart_id', $cartId)
                ->where('is_choose', true)
                ->with(['product.brand'])
                ->get();

            $totalPrice = $cartItems->sum('total');
            $totalProduct = $cartItems->sum('quantity');

            // Calculate discount if `voucher` exists
            if ($voucher) {
                $percent = $voucher->discount;

                if ($voucher->type == 'limited voucher') {
                    $discount = ($percent <= 100) ? $totalPrice * ($percent / 100) : $percent;
                    $totalShopping = $totalPrice - $discount + $request->shipping_cost - $discountOngkir;
                } elseif ($voucher->type == 'product voucher') {
                    $getIdVoucher = Promo::where('promo_code', '=', $voucherCode)->value('id');
                    $eligibleProductIds = PromoProduct::where('promo_id', '=', $getIdVoucher)->pluck('product_id');

                    // Filter cart items yang eligible untuk diskon
                    $eligibleCartItems = $cartItems->filter(function ($cartItem) use ($eligibleProductIds) {
                        return $eligibleProductIds->contains($cartItem->product_id);
                    });

                    // Hitung total harga dari semua produk yang eligible
                    $eligibleCartTotal = $eligibleCartItems->sum('total');

                    // Hitung diskon (dibatasi oleh nilai maksimal diskon pada voucher)
                    $percent = $voucher->discount;

                    if ($percent <= 100) {
                        // Logika diskon presentase
                        $totalEligibleProduct = $eligibleCartItems->sum(function ($product) use ($percent) {
                            $product->discPrice = $product->price - ($product->price * $percent / 100);
                            $product->afterPrecentage = $product->quantity * ($product->price * $percent / 100);
                            return $product->quantity * $product->discPrice;
                        });

                        $discount = $eligibleCartItems->sum('afterPrecentage');
                        $nonDiscountedItemsTotal = $cartItems->diff($eligibleCartItems)->sum('total');
                        $totalShopping = $nonDiscountedItemsTotal + $totalEligibleProduct  + $request->shipping_cost - $discountOngkir;
                    } else {
                        // Logika diskon nominal
                        $totalEligibleProduct = $eligibleCartItems->sum(function ($product) use ($percent) {
                            $product->discPrice =  $product->price - min($percent, $product->price);
                            $product->afterPrecentage = $product->quantity * min($percent, $product->price);
                            return $product->quantity * $product->discPrice;
                        });

                        $discount =  $eligibleCartItems->sum('afterPrecentage');
                        $nonDiscountedItemsTotal = $cartItems->diff($eligibleCartItems)->sum('total');
                        $totalShopping = $nonDiscountedItemsTotal + $totalEligibleProduct  + $request->shipping_cost - $discountOngkir;
                    }
                } elseif ($voucher->type == 'brand voucher') {
                    $getIdVoucher = Promo::where('promo_code', '=', $voucherCode)->value('id');
                    $eligibleProductIds = PromoProduct::where('promo_id', '=', $getIdVoucher)->pluck('product_id');

                    // Filter cart items yang eligible untuk diskon
                    $eligibleCartItems = $cartItems->filter(function ($cartItem) use ($eligibleProductIds) {
                        return $eligibleProductIds->contains($cartItem->product_id);
                    });

                    // Hitung total harga dari semua produk yang eligible
                    $eligibleCartTotal = $eligibleCartItems->sum('total');

                    // Hitung diskon (dibatasi oleh nilai maksimal diskon pada voucher)
                    $percent = $voucher->discount;

                    if ($percent <= 100) {
                        // Logika diskon presentase
                        $totalEligibleProduct = $eligibleCartItems->sum(function ($product) use ($percent) {
                            $product->discPrice = $product->price - ($product->price * $percent / 100);
                            $product->afterPrecentage = $product->quantity * ($product->price * $percent / 100);
                            return $product->quantity * $product->discPrice;
                        });

                        $discount = $eligibleCartItems->sum('afterPrecentage');
                        $nonDiscountedItemsTotal = $cartItems->diff($eligibleCartItems)->sum('total');
                        $totalShopping = $nonDiscountedItemsTotal + $totalEligibleProduct  + $request->shipping_cost - $discountOngkir;
                    } else {
                        // Logika diskon nominal
                        $totalEligibleProduct = $eligibleCartItems->sum(function ($product) use ($percent) {
                            $product->discPrice =  $product->price - $percent;
                            $product->afterPrecentage = $product->quantity * $percent;
                            return $product->quantity * $product->discPrice;
                        });

                        $discount =  $eligibleCartItems->sum('afterPrecentage');
                        $nonDiscountedItemsTotal = $cartItems->diff($eligibleCartItems)->sum('total');
                        $totalShopping = $nonDiscountedItemsTotal + $totalEligibleProduct  + $request->shipping_cost - $discountOngkir;
                    }
                }
            } else {
                // Cuma Ongkir
                $totalShopping = $totalPrice + $request->shipping_cost - $discountOngkir;
            }

            // Calculate `totalShopping`

            // Format outputs

            $totalPriceFormatted = number_format($totalPrice, 0, ',', '.');
            $discountFormatted = $voucher ? number_format($discount, 0, ',', '.') : null;
            $totalShoppingFormatted = number_format($totalShopping, 0, ',', '.');
            $ongkirFormatted = $ongkirCode ? number_format($discountOngkir, 0, ',', '.') : null;
            $ongkirCalculated = $ongkirCode ? number_format($ongkirAfter, 0, ',', '.') : null;

            // Calculate 'hemat' based on `voucherCode` and `ongkirCode`
            $hemat = ($voucherCode && $ongkirCode) ? $discount + $ongkirDiscount : ($voucherCode ? $discount : $ongkirDiscount);
            $hematFormatted = number_format($hemat, 0, ',', '.');

            return response()->json([
                'success' => true,
                'tes' => $discount,
                'discountFormatted' => $discountFormatted,
                'totalShoppingFormatted' => $totalShopping,
                'discount' => $discountFormatted,  // Null if no promo voucher
                'ongkir' => $ongkirFormatted,       // Null if no ongkir voucher
                'hemat' => $hematFormatted,
                'ongkirCalculate' => $ongkirCalculated,
                'ongkirVoucher' => $ongkirVoucher,
                'request' => $request->all(),
            ]);
        } catch (Exception $err) {
            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan saat menerapkan kode voucher.',
                'error' => $err->getMessage(),
            ]);
        }
    }

    // public function checkApplyVoucherBuyNow(Request $request) 
    // {
    //     try {
    //         $userId = session('id_user');
    //         $voucherCode = $request->code_voucher_promo;
    //         $ongkirCode = $request->code_voucher_ongkir;

    //         // Basic response if user ID is not found
    //         if (!$userId) {
    //             return response()->json([
    //                 'success' => false,
    //                 'message' => 'User not found.'
    //             ]);
    //         }

    //         // Initialize variables
    //         $totalPrice = 0;
    //         $discount = 0;
    //         $ongkirVoucher = 0;
    //         $ongkirDiscount = 0;
    //         $voucher = null;
    //         $ongkir = null;
    //         $ongkirAfter = $request->ongkir;


    //         // Fetch cart items and calculate `totalPrice`
    //         $cartItems = Buynow::where('user_id', $userId)
    //             ->with(['product.brand'])
    //             ->get();

    //         $totalProduct = $cartItems->sum('quantity');
    //         $totalPrice = $cartItems->sum('total');

    //         // Calculate discount if `voucher` exists
    //         if ($voucher) {
    //             $percent = $voucher->discount;

    //             // Apply percentage discount if `percent` <= 100, otherwise fixed amount
    //             $discount = ($percent <= 100) ? $totalPrice * ($percent / 100) : $percent;
    //         }

    //         // Retrieve promo voucher if `voucherCode` is provided
    //         if (!empty($voucherCode)) {
    //             $voucher = Promo::where('promo_code', $voucherCode)->first();
    //         }

    //         // Retrieve ongkir discount if `ongkirCode` is provided
    //         if (!empty($ongkirCode)) {
    //             $ongkir = Promo::where('promo_code', $ongkirCode)->first();
    //             $ongkirDiscount = $ongkir ? $ongkir->discount : 0;
    //             $ongkirVoucher = $ongkir ? $ongkir->discount : 0;
    //             if($ongkirDiscount <= 100)
    //             {
    //                 $discount = $request->shipping_cost * ($ongkirDiscount/100);
    //                 $ongkirAfter = $request->shipping_cost - $discount;
    //             }
    //             else{
    //                 if ($request->shipping_cost < $ongkirDiscount) {
    //                     $ongkirDiscount = $request->shipping_cost;
    //                 }
    //                 $ongkirAfter = $request->shipping_cost - $ongkirDiscount;
    //             }
    //         }

    //         // Return error if neither `voucher` nor `ongkir` is valid
    //         if (!$voucher && !$ongkir) {
    //             return response()->json([
    //                 'success' => false,
    //                 'message' => 'Kode promo tidak valid atau sudah tidak aktif.'
    //             ]);
    //         }

    //         // Calculate `totalShopping`
    //         $totalShopping = $totalPrice - $discount + $request->ongkir - $ongkirDiscount;

    //         // Format outputs
    //         $totalPriceFormatted = number_format($totalPrice, 0, ',', '.');
    //         $discountFormatted = $voucher ? number_format($discount, 0, ',', '.') : null;
    //         $totalShoppingFormatted = number_format($totalShopping, 0, ',', '.');
    //         $ongkirFormatted = $ongkirCode ? number_format($ongkirDiscount, 0, ',', '.') : null;
    //         $ongkirCalculated = $ongkirCode ? number_format($ongkirAfter, 0, ',', '.') : null;

    //         // Calculate 'hemat' based on `voucherCode` and `ongkirCode`
    //         $hemat = ($voucherCode && $ongkirCode) ? $discount + $ongkirDiscount : ($voucherCode ? $discount : $ongkirDiscount);
    //         $hematFormatted = number_format($hemat, 0, ',', '.');

    //         return response()->json([
    //             'success' => true,
    //             'discount' => $discountFormatted,  // Null if no promo voucher
    //             'ongkir' => $ongkirFormatted,       // Null if no ongkir voucher
    //             'hemat' => $hematFormatted,
    //             'ongkirCalculate' => $ongkirCalculated,
    //             'request' => $request->all(),
    //         ]);

    //     } catch (Exception $err) {
    //         return response()->json([
    //             'success' => false,
    //             'message' => 'Terjadi kesalahan saat menerapkan kode voucher.',
    //             'error' => $err->getMessage(),
    //         ]);
    //     }
    // }

    public function applyVoucher(Request $request)
    {
        try {
            $userId = session('id_user');
            $voucherCode = $request->code_voucher_promo;
            $ongkirCode = $request->code_voucher_ongkir;

            // Basic response in case of user ID not found
            if (!$userId) {
                return response()->json([
                    'success' => false,
                    'message' => 'User not found.'
                ]);
            }

            // Initialize variables
            $totalPrice = 0;
            $discount = 0;
            $ongkirDiscount = 0;

            // Retrieve voucher based on promo code if provided
            $voucher = $voucherCode ? Promo::where('code', $voucherCode)->first() : null;
            $ongkir = $ongkirCode ? Promo::where('code', $ongkirCode)->first() : null;

            // Check if both vouchers are invalid
            if (!$voucher && !$ongkir) {
                return response()->json([
                    'success' => false,
                    'message' => 'Kode promo tidak valid atau sudah tidak aktif.'
                ]);
            }

            // Retrieve cart items
            $cartId = Cart::where('user_id', $userId)->value('id');
            $cartItems = Cart_item::where('cart_id', $cartId)
                ->where('is_choose', true)
                ->with(['product.brand'])
                ->get();

            // Calculate total price of chosen cart items
            $totalPrice = $cartItems->sum('total');

            // Apply discount if a valid voucher is provided
            if ($voucher !== null) {
                $percent = $voucher->discount;

                if ($percent <= 100) {
                    $discount = $totalPrice * ($percent / 100);
                } else {
                    $discount = $percent;
                }
            } else {
                $discount = null;
            }

            // Apply ongkir discount if valid ongkir voucher is provided
            if ($ongkir) {
                $ongkirDiscount = $ongkir->discount;
            }

            // Calculate the total shopping amount based on selected vouchers
            $totalShopping = $totalPrice - ($discount ?? 0) + $request->shipping_cost - $ongkirDiscount;

            // Format discount and total price for response
            $totalPriceFormatted = number_format($totalPrice, 0, ',', '.');
            $discountFormatted = $voucherCode ? number_format($discount, 0, ',', '.') : null;
            $totalShoppingFormatted = number_format($totalShopping, 0, ',', '.');
            $ongkirFormatted = $ongkirCode ? number_format($ongkirDiscount, 0, ',', '.') : null;

            // Determine 'hemat' (total savings) based on the vouchers selected
            $hemat = ($voucherCode && $ongkirCode)
                ? $discount + $ongkirDiscount
                : ($voucherCode ? $discount : $ongkirDiscount);
            $hematFormatted = number_format($hemat, 0, ',', '.');

            return response()->json([
                'success' => true,
                'totalPriceFormatted' => $totalPriceFormatted,
                'discountFormatted' => $discountFormatted,
                'totalShoppingFormatted' => $totalShopping,
                'discount' => $discount,
                'code' => $voucherCode,
                'ongkir' => $ongkirDiscount,
                'hemat' => $hemat,
                'voucherOngkir' => $ongkirCode ? $ongkirCode : null,
            ]);
        } catch (Exception $err) {
            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan saat menerapkan kode voucher.',
                'error' => $err->getMessage(),
            ]);
        }
    }

    public function applyVoucherNewUser(Request $request)
    {
        try {
            $userId = session('id_user');
            $voucherCode = $request->code_voucher;

            if ($userId && $voucherCode) {
                $voucher = VoucherNewUser::where('code', $voucherCode)
                    ->first();

                if ($voucher) {
                    $cartId = Cart::where('user_id', $userId)->value('id');
                    $cartItems = Cart_item::where('cart_id', $cartId)
                        ->where('is_choose', true)
                        ->with(['product.brand'])
                        ->get();

                    foreach ($cartItems as $item) {
                        if ($item->product && $item->product->promos) {
                            foreach ($item->product->promos as $promo) {
                                if ($promo->tiers) {
                                    foreach ($promo->tiers as $tier) {
                                        switch ($tier->discount_type) {
                                            case 'percentage':
                                                // Contoh logika untuk diskon persentase
                                                if ($item->quantity == $tier->min_quantity) {
                                                    $discountedPrice = $item->total * ((100 - $tier->discount_value) / 100);
                                                    $item->bundle_price = $discountedPrice;
                                                    $item->total = $discountedPrice;
                                                }
                                                break;
                    
                                            case 'nominal':
                                                // Contoh logika untuk diskon nominal
                                                if ($item->quantity == $tier->min_quantity) {
                                                    $discountedPrice = $item->total - $tier->discount_value;
                                                    $item->bundle_price = $discountedPrice;
                                                    $item->total = $discountedPrice;
                                                }
                                                break;
                    
                                            case 'package':
                                                if ($item->quantity == $tier->min_quantity) {
                                                    $item->bundle_price = $tier->package_price; // Tetapkan harga paket
                                                    $item->total = $tier->package_price;
                                                }
                                                break;
                    
                                            default:
                                                // Logika default jika tidak ada kasus yang cocok
                                                $item->discounted_price = $item->product->price;
                                                break;
                                            }
                                        }
                                    }
                            }
                        }
                    }

                    $totalProduct = $cartItems->sum('quantity');
                    $totalPrice = $cartItems->sum('total');

                    // Hitung diskon dari voucher
                    if ($voucherCode) {
                        $voucher = Promo::where('type', '=', 'new user voucher')->first();
                        $percent = $voucher->discount;

                        if ($percent <= 100) {
                            $discount = $totalPrice * ($percent / 100);
                        } elseif ($percent > 100) {
                            $discount = $percent;
                        }
                        // Format discount menjadi rupiah dengan 3 angka di belakang koma
                        $discountFormatted = number_format($discount, 0, ',', '.');
                    }


                    if ($voucher->type == 'new user') {
                        $maxDiscountAmount = Promo::where('promo_name', '=', 'new user')->value('max_discount');
                        if ($discount >= $maxDiscountAmount) {
                            $discount = $maxDiscountAmount;
                        }
                    }

                    $totalShopping = $totalPrice - $discount;

                    return response()->json([
                        'success' => true,
                        'totalPriceFormatted' => $totalPrice,
                        'discountFormatted' => $voucherCode ? $discount : null,
                        'totalShoppingFormatted' => $totalShopping,
                        'code' => $voucherCode,
                        'request' => $request->all(),
                    ]);
                } else {
                    // Kode voucher tidak valid
                    return redirect()->back()->withErrors(['code_voucher' => 'Kode promo tidak valid atau sudah tidak aktif.']);
                }
            }
        } catch (Exception $err) {
            dd($err);
        }
    }

    // BUYNOW
    public function addProductBuyNow(Request $request)
    {
        try {
            $userId = session('id_user');
            
            if ($userId) {
                $checkBuyNow = Buynow::where('user_id', $userId)->exists();
                $product = Product::with(['promos'  => function ($query) {
                    $query->select('promos.*', 'promo_products.discounted_price')
                        ->whereRaw("STR_TO_DATE(SUBSTRING_INDEX(date_range, ' - ', 1), '%Y-%m-%d') <= ?", [Carbon::today()])
                        ->whereRaw("STR_TO_DATE(SUBSTRING_INDEX(date_range, ' - ', -1), '%Y-%m-%d') >= ?", [Carbon::today()])
                        ->wherePivot('discounted_price', '>', 0);
                    }])
                    ->where('id', $request->product_id)->first();

                $activePromo = $product->promos->first();
                $price = $activePromo ? $activePromo->pivot->discounted_price : $product->regular_price;
                
                // $total = $price;
                // $price = Product::where('id', $request->product_id)->value('regular_price');

                // Periksa apakah user sudah memiliki data di tabel Buynow
                if ($checkBuyNow) {
                    $buynow = Buynow::where('user_id', $userId)->first();
                    $buynow->update([
                        'user_id'    => $userId,
                        'product_id' => $request->product_id,
                        'quantity'   => $request->quantity,
                        'price'      => $price, // Kamu bisa mengganti harga ini secara dinamis
                        'total'      => $request->quantity * $price,
                        'is_buy'     => 0,    
                    ]);
                } else {
                    Buynow::create([
                        'user_id'    => $userId,
                        'product_id' => $request->product_id,
                        'quantity'   => $request->quantity,
                        'price'      => $price, // Harga default, bisa diganti dinamis
                        'total'      => $request->quantity * $price,
                        'is_buy'     => 0,
                    ]);
                }

                // Return response success jika proses berhasil
                return response()->json(['success' => true, 'message' => 'Produk berhasil ditambahkan ke Buy Now']);
            } else {
                return response()->json(['success' => false, 'message' => 'Masuk/Daftar Terlebih Dahulu']);
            }
        } catch (Exception $err) {
            // Return error dengan pesan yang lebih spesifik
            return response()->json(['success' => false, 'message' => $err->getMessage()]);
        }
    }

    // public function addProductBuyNow(Request $request)
    // {
    //     try {
    //         $userId = session('id_user');
            
    //         if (session('id_user')) {
    //             $checkCartUser = Cart::where('user_id', session('id_user'))->exists();
    //             $cartId = Cart::where('user_id', session('id_user'))->value('id');

    //             // JIKA CART SUDAH ADA MAKA TIDAK PERLU CREATE CART
    //             if($checkCartUser){
    //                 $checkCartItem = Cart_item::where('cart_id', $cartId)
    //                 ->where('product_id', $request->product_id)->exists();

    //                 // JIKA PRODUK SUDAH ADA DI CART USER
    //                 if ($checkCartItem) {
    //                     $cartItem  = Cart_item::where('cart_id', $cartId)
    //                     ->where('product_id', $request->product_id)->first();

    //                     $itemPrice = $cartItem->price; 
    //                     $itemQuantity = $cartItem->quantity;

    //                     // Tingkatkan kuantitas item dengan 1
    //                     $newQuantity = $itemQuantity + $request->quantity;
    
    //                     // Hitung total harga baru berdasarkan harga satuan dan kuantitas baru
    //                     $newPrice = $itemPrice * $newQuantity;

    //                     // Update kuantitas dan harga di database
    //                     $cartItem->update([
    //                         'quantity' => $newQuantity,
    //                         'total'    => $newPrice, 
    //                     ]);
    //                 }
    //                 // JIKA PRODUK BELUM ADA DI CART USER
    //                 else{
    //                     $cartId = Cart::where('user_id', session('id_user'))->value('id');
    //                     $product = Product::where('id', $request->product_id)->first();
    //                     $total = $product->regular_price;

    //                     Cart_item::create([
    //                         'cart_id'    => $cartId,
    //                         'product_id' => $request->product_id,
    //                         'quantity'   => $request->quantity ? $request->quantity : 1,
    //                         'is_choose'  => TRUE,
    //                         'price'      => $product->regular_price,
    //                         'total'      => $total,
    //                     ]);
    //                 }

    //             // JIKA BARU PERTAMA KALI MENAMBAHKAN CART ITEM
    //             }else{
    //                 $cart = Cart::create([
    //                     'user_id' => $userId,
    //                 ]);

    //                 $cartId = Cart::where('user_id', session('id_user'))->value('id');
    //                 $product = Product::where('id', $request->product_id)->first();
    //                 $total = $product->regular_price;

    //                 Cart_item::create([
    //                     'cart_id'    => $cart->id,
    //                     'product_id' => $request->product_id,
    //                     'quantity'   => $request->quantity ? $request->quantity : 1,
    //                     'is_choose'  => TRUE,
    //                     'price'      => $product->regular_price,
    //                     'total'      => $total,
    //                 ]);
                    
    //             }

    //             return response()->json(['success' => true, 'message' => 'Berhasil Menambahkan Produk ke Keranjang']);
    //         }
    //         return response()->json(['success' => false, 'message' => 'Masuk/Daftar Terlebih Dahulu Yaa']);

    //     } catch (Exception $err) {
    //         return response()->json(['success' => false, 'message' => $err]);
    //     }
    // }

    public function addProductVariantBuyNow(Request $request)
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

    public function updateCartQuantityBuyNow(Request $request)
    {
        // Find the product in the cart or wherever the quantity is stored
        $productBuyNow = Buynow::where('user_id', session('id_user'))->first();

        if ($productBuyNow) {
            $productBuyNow->update([
                'quantity' => $request->quantity,
                'total'    => ($request->quantity) * ($productBuyNow->price),
            ]);

            return response()->json(['success' => true, 'message' => 'Quantity updated successfully']);
        }

        return response()->json(['success' => false, 'message' => 'Terjadi Masalah Dengan Sistem']);
    }

    // public function orderPayment(Request $request){
    //     $userId = session('id_user');
    //     $shipping_cost = $request->shipping_cost;

    //     // dd($request);
    //     $lastInvoice = Invoice::orderBy('id', 'desc')->value('no_invoice');

    //     if ($lastInvoice) {
    //         // Split the invoice by '/' and take the last part
    //         $lastNoInvoice = (int) substr($lastInvoice, strrpos($lastInvoice, '/') + 1);

    //         // Increment the number
    //         $invoiceNumber = $lastNoInvoice + 1;
    //     } else {
    //         // Start from 1 if there is no previous invoice
    //         $invoiceNumber = 1;
    //     }

    //     // Get the current day, month, and year
    //     $day = date('d');
    //     $month = date('m');
    //     $year = date('Y');

    //     // Format the new invoice number
    //     $formattedInvoice = sprintf('INV/%s%s%s/GLM/%s', $day, $month, $year, $invoiceNumber);

    //     // Create a new invoice with the formatted invoice number
    //     $invoiceCreate = Invoice::create([
    //         'no_invoice' => $formattedInvoice,
    //     ]);

    //     // Buat order
    //     $order = Order::create([
    //         'user_id'             => $userId,
    //         'invoice_id'          => $invoiceCreate->id,
    //         'shipping_address_id' => $request->shipping_address_id,
    //         'total_item'          => $request->total_item,
    //         'total_item_price'    => $request->total_item_price,
    //         'shipping_cost'       => $shipping_cost,
    //         'voucher_promo'       => $request->voucher_promo,
    //         'voucher_ongkir'      => $request->voucher_ongkir,
    //         'discount_amount'     => $request->discount_amount,
    //         'discount_ongkir'     => $request->discount_ongkir,
    //         'total_amount'        => $request->subtotal,
    //         'order_date'          => now(),
    //     ]);

    //     // Buat order item
    //     foreach($request->product as $id => $productId){
    //         OrderItem::create([
    //             'order_id'      => $order->id,
    //             'product_id'    => $productId,
    //             'quantity'      => $request->product_quantity[$productId],
    //             'price'         => $request->product_price[$productId],
    //             'subtotal'      => $request->product_quantity[$productId] * $request->product_price[$productId],
    //         ]);
    //     }

    //     // Buat pembayaran
    //     $payment = Payment::create([
    //         'user_id'        => $userId,
    //         'order_id'       => $order->id,
    //         'payment_method' => "UJICOBA",
    //         'transaction_id' => "",
    //         'status'         => 'completed',
    //         'amount'         => $request->subtotal,
    //         'payment_date'   => now(),
    //     ]);

    //     // Update status voucher jika digunakan
    //     $useVoucherNewUser = VoucherNewUser::where('user_id', $userId)
    //         ->where('code', $request->voucher_promo)
    //         ->first();

    //     if ($useVoucherNewUser) {
    //         $useVoucherNewUser->is_use = 1;
    //         $useVoucherNewUser->save();
    //     }

    //     if($useVoucherNewUser == NULL){
    //         $voucherUsed = Promo::where('promo_code', $request->voucher_promo)->first();
    //     }
    //     else {
    //         $voucherUsed = NULL;
    //     }

    //     if ($request->voucher_ongkir !== null) {
    //         $ongkirUsed = Promo::where('promo_code', $request->voucher_ongkir)->first();
    //     }

    //     // Jika pembayaran selesai
    //     if ($payment->status == "completed") {
    //         // Ambil cart berdasarkan user_id sekali di luar loop
    //         $cartId = Cart::where('user_id', $userId)->value('id');

    //         if ($voucherUsed !== NULL) {
    //             $voucherUsed->total_used += 1;
    //             $voucherUsed->save();
    //         }

    //         if ($request->voucher_ongkir !== null) {
    //             if ($ongkirUsed) {
    //                 $ongkirUsed->total_used += 1;
    //                 $ongkirUsed->save();
    //             }
    //         }

    //         foreach($request->product as $id => $productId){
    //             // Temukan produk berdasarkan ID
    //             $product = Product::find($productId);

    //             // Jika produk ditemukan, lakukan update stok
    //             if ($product) {
    //                 $product->stock_quantity -= $request->product_quantity[$productId];
    //                 $product->sale += $request->product_quantity[$productId];
    //                 $product->save();
    //             }

    //             // Hapus item dari cart berdasarkan cart_id dan product_id
    //             Cart_item::where('cart_id', $cartId)
    //                 ->where('product_id', $productId)
    //                 ->delete();
    //         }
    //         // session()->flash('payment_success');

    //         return response()->json([
    //         'user_id' => $userId,
    //         ]);
    //     }


    //     // return redirect("/{$userId}_account");
    // }

    public function orderPayment(Request $request)
    {
        $userId = session('id_user');
        $shipping_cost = $request->shipping_cost;

        // Generate invoice number (kode sebelumnya tetap sama)
        $lastInvoice = Invoice::orderBy('id', 'desc')->value('no_invoice');

        if ($lastInvoice) {
            $lastNoInvoice = (int) substr($lastInvoice, strrpos($lastInvoice, '/') + 1);
            $invoiceNumber = $lastNoInvoice + 1;
        } else {
            $invoiceNumber = 1;
        }

        $day = date('d');
        $month = date('m');
        $year = date('Y');

        $formattedInvoice = sprintf('INV/%s%s%s/GLM/%s', $day, $month, $year, $invoiceNumber);

        $invoiceCreate = Invoice::create([
            'no_invoice' => $formattedInvoice,
        ]);

        // Buat order
        $order = Order::create([
            'user_id'             => $userId,
            'invoice_id'          => $invoiceCreate->id,
            'shipping_address_id' => $request->shipping_address_id,
            'total_item'          => $request->total_item,
            'total_item_price'    => $request->total_item_price,
            'shipping_cost'       => $shipping_cost,
            'voucher_promo'       => $request->voucher_promo,
            'voucher_ongkir'      => $request->voucher_ongkir,
            'discount_amount'     => $request->discount_amount,
            'discount_ongkir'     => $request->discount_ongkir,
            'total_amount'        => $request->subtotal,
            'order_date'          => now(),
        ]);

        // Buat order item
        $cartId = Cart::where('user_id', session('id_user'))->value('id');
        $cartItems = Cart_item::where('cart_id', $cartId)
            ->where('is_choose', true)
            ->with(['product.brand'])
            ->get();

        foreach ($cartItems as $item) {
            if ($item->product && $item->product->promos) {
                foreach ($item->product->promos as $promo) {
                    if ($promo->tiers) {
                        foreach ($promo->tiers as $tier) {
                            switch ($tier->discount_type) {
                                case 'percentage':
                                    // Contoh logika untuk diskon persentase
                                    if ($item->quantity == $tier->min_quantity) {
                                        $discountedPrice = $item->total * ((100 - $tier->discount_value) / 100);
                                        $item->bundle_price = $discountedPrice;
                                        $item->total = $discountedPrice;
                                    }
                                    break;
        
                                case 'nominal':
                                    // Contoh logika untuk diskon nominal
                                    if ($item->quantity == $tier->min_quantity) {
                                        $discountedPrice = $item->total - $tier->discount_value;
                                        $item->bundle_price = $discountedPrice;
                                        $item->total = $discountedPrice;
                                    }
                                    break;
        
                                case 'package':
                                    if ($item->quantity == $tier->min_quantity) {
                                        $item->bundle_price = $tier->package_price; // Tetapkan harga paket
                                        $item->total = $tier->package_price;
                                    }
                                    break;
        
                                default:
                                    // Logika default jika tidak ada kasus yang cocok
                                    $item->discounted_price = $item->product->price;
                                    break;
                                }
                            }
                        }
                }
            }

            OrderItem::create([
                'order_id'      => $order->id,
                'product_id' => $item->product_id,
                'product_variant_id' => $item->product_variant_id,
                'quantity' => $item->quantity,
                'price' => $item->price,
                'is_tier' => $item->bundle_price,
                'subtotal' => $item->bundle_price !== null ? $item->bundle_price : $item->quantity * $item->price,
            ]);
        }

        // foreach($request->products as $product){
        //     OrderItem::create([
        //         'order_id'      => $order->id,
        //         'product_id' => $product['product_id'],
        //         'product_variant_id' => $product['product_variant_id'],
        //         'quantity' => $product['quantity'],
        //         'price' => $product['price'],
        //         'subtotal' => $product['quantity'] * $product['price'],
        //     ]);
        // }
    
        // Buat pembayaran
        $payment = Payment::create([
            'user_id'        => $userId,
            'order_id'       => $order->id,
            'payment_method' => "UJICOBA",
            'transaction_id' => "",
            'status'         => 'completed',
            'amount'         => $request->subtotal,
            'payment_date'   => now(),
        ]);

        // Update status voucher jika digunakan
        $useVoucherNewUser = VoucherNewUser::where('user_id', $userId)
            ->where('code', $request->voucher_promo)
            ->first();

        if ($useVoucherNewUser) {
            $useVoucherNewUser->is_use = 1;
            $useVoucherNewUser->save();
        }

        $voucherUsed = $useVoucherNewUser == NULL
            ? Promo::where('promo_code', $request->voucher_promo)->first()
            : NULL;

        $ongkirUsed = $request->voucher_ongkir !== null
            ? Promo::where('promo_code', $request->voucher_ongkir)->first()
            : NULL;

        // Jika pembayaran selesai
        if ($payment->status == "completed") {
            $cartId = Cart::where('user_id', $userId)->value('id');

            // Update voucher usage
            if ($voucherUsed !== NULL) {
                $voucherUsed->total_used += 1;
                $voucherUsed->save();
            }

            if ($ongkirUsed) {
                $ongkirUsed->total_used += 1;
                $ongkirUsed->save();
            }
            
            foreach($request->products as $product){
                // Temukan produk berdasarkan ID\
                if($product['product_variant_id'] !== null){
                    $productVariant = ProductVariations::find($product['product_variant_id']);
                    
                    // Jika produk ditemukan, lakukan update stok
                    if ($productVariant) {
                        $productVariant->variant_stock -= $product['quantity'];
                        $productVariant->sale += $product['quantity'];
                        $productVariant->save();
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
                 

            }

            return response()->json([
                'user_id' => $userId,
            ]);
        }
    }

    public function orderBuyNow(Request $request)
    {
        $userId = session('id_user');
        $shipping_cost = $request->shipping_cost;

        // dd($request);
        $lastInvoice = Invoice::orderBy('id', 'desc')->value('no_invoice');

        if ($lastInvoice) {
            // Split the invoice by '/' and take the last part
            $lastNoInvoice = (int) substr($lastInvoice, strrpos($lastInvoice, '/') + 1);

            // Increment the number
            $invoiceNumber = $lastNoInvoice + 1;
        } else {
            // Start from 1 if there is no previous invoice
            $invoiceNumber = 1;
        }

        // Get the current day, month, and year
        $day = date('d');
        $month = date('m');
        $year = date('Y');

        // Format the new invoice number
        $formattedInvoice = sprintf('INV/%s%s%s/GLM/%s', $day, $month, $year, $invoiceNumber);

        // Create a new invoice with the formatted invoice number
        $invoiceCreate = Invoice::create([
            'no_invoice' => $formattedInvoice,
        ]);

        // Buat order
        $order = Order::create([
            'user_id'             => $userId,
            'invoice_id'          => $invoiceCreate->id,
            'shipping_address_id' => $request->shipping_address_id,
            'total_item'          => $request->total_item,
            'total_item_price'    => $request->total_item_price,
            'shipping_cost'       => $shipping_cost,
            'voucher_promo'       => $request->voucher_promo,
            'voucher_ongkir'      => $request->voucher_ongkir,
            'discount_amount'     => $request->discount_amount,
            'discount_ongkir'     => $request->discount_ongkir,
            'total_amount'        => $request->subtotal,
            'order_date'          => now(),
        ]);

        // Buat order item
        foreach ($request->product as $id => $productId) {
            OrderItem::create([
                'order_id'      => $order->id,
                'product_id'    => $productId,
                'quantity'      => $request->product_quantity[$productId],
                'price'         => $request->product_price[$productId],
                'subtotal'      => $request->product_quantity[$productId] * $request->product_price[$productId],
            ]);
        }

        // Buat pembayaran
        $payment = Payment::create([
            'user_id'        => $userId,
            'order_id'       => $order->id,
            'payment_method' => "UJICOBA",
            'transaction_id' => "",
            'status'         => 'completed',
            'amount'         => $request->subtotal,
            'payment_date'   => now(),
        ]);

        // Update status voucher jika digunakan
        $useVoucherNewUser = VoucherNewUser::where('user_id', $userId)
            ->where('code', $request->voucher_promo)
            ->first();

        if ($useVoucherNewUser) {
            $useVoucherNewUser->is_use = 1;
            $useVoucherNewUser->save();
        }

        if ($useVoucherNewUser == NULL) {
            $voucherUsed = Promo::where('promo_code', $request->voucher_promo)->first();
        } else {
            $voucherUsed = NULL;
        }

        if ($request->voucher_ongkir !== null) {
            $ongkirUsed = Promo::where('promo_code', $request->voucher_ongkir)->first();
        }

        // Jika pembayaran selesai
        if ($payment->status == "completed") {

            // Hapus dari Buynow
            $buynow = Buynow::where('user_id', $userId)->first();
            $buynow->update([
                'is_buy',
                true
            ]);

            // Ambil cart berdasarkan user_id sekali di luar loop
            $cartId = Cart::where('user_id', $userId)->value('id');

            if ($voucherUsed !== NULL) {
                $voucherUsed->total_used += 1;
                $voucherUsed->save();
            }

            if ($request->voucher_ongkir !== null) {
                if ($ongkirUsed) {
                    $ongkirUsed->total_used += 1;
                    $ongkirUsed->save();
                }
            }

            foreach ($request->product as $id => $productId) {
                // Temukan produk berdasarkan ID
                $product = Product::find($productId);

                // Jika produk ditemukan, lakukan update stok
                if ($product) {
                    $product->stock_quantity -= $request->product_quantity[$productId];
                    $product->sale += $request->product_quantity[$productId];
                    $product->save();
                }

                // Hapus item dari cart berdasarkan cart_id dan product_id
                Cart_item::where('cart_id', $cartId)
                    ->where('product_id', $productId)
                    ->delete();
            }
            // session()->flash('payment_success');

            return response()->json([
                'user_id' => $userId,
            ]);
        }


        // return redirect("/{$userId}_account");
    }

    public function orderPaymentDOKU(Request $request)
    {
        $userId = session('id_user');
        $shipping_cost = 20000;

        // Generate the invoice number logic remains the same
        $lastInvoice = Invoice::orderBy('id', 'desc')->value('no_invoice');
        $invoiceNumber = $lastInvoice ? ((int) substr($lastInvoice, strrpos($lastInvoice, '/') + 1) + 1) : 1;
        $formattedInvoice = sprintf('INV/%s%s%s/GLM/%s', date('d'), date('m'), date('Y'), $invoiceNumber);

        $invoiceCreate = Invoice::create(['no_invoice' => $formattedInvoice]);

        // Order creation remains the same
        $order = Order::create([
            'user_id' => $userId,
            'invoice_id' => $invoiceCreate->id,
            'shipping_address_id' => $request->shipping_address_id,
            'total_item' => $request->total_item,
            'total_item_price' => $request->total_item_price,
            'shipping_cost' => $shipping_cost,
            'voucher_promo' => $request->code_coupont ?? $request->code_voucher,
            'voucher_ongkir' => $request->code_ongkir,
            'discount_amount' => $request->discount_amount,
            'discount_ongkir' => $request->discount_ongkir,
            'total_amount' => $request->subtotal,
            'order_date' => now(),
        ]);

        // Prepare the request payload
        $payload = [
            "order" => [
                "amount" => $request->subtotal, // total order amount
                "invoice_number" => $formattedInvoice
            ],
            "payment" => [
                "payment_due_date" => 60 // Payment due in minutes
            ]
        ];

        $clientId = env('DOKU_CLIENT_ID');
        $requestId = uniqid();
        $requestTimestamp = now()->utc()->format('Y-m-d\TH:i:s.v\Z');
        $requestTarget = '/doku-virtual-account/v2/payment-code';
        $secretKey = env('DOKU_SIGNATURE_KEY');

        // Payload dan Digest
        $payloadJson = json_encode($payload);
        $digest = base64_encode(hash('sha256', $payloadJson, true));

        // String yang akan di-sign
        $stringToSign = "Client-Id:$clientId\nRequest-Id:$requestId\nRequest-Timestamp:$requestTimestamp\nRequest-Target:$requestTarget\nDigest:$digest";

        // Hasilkan signature dengan HMAC-SHA256
        $signature = base64_encode(hash_hmac('sha256', $stringToSign, $secretKey, true));

        // Kirim permintaan dengan header
        $response = Http::withHeaders([
            'Client-Id' => $clientId,
            'Request-Id' => $requestId,
            'Request-Timestamp' => $requestTimestamp,
            'Request-Target' => $requestTarget,
            'Digest' => $digest,
            'Signature' => "HMACSHA256=$signature=",
            'Content-Type' => 'application/json',
        ])->POST('https://api-sandbox.doku.com/checkout/v1/payment', json_encode($payload));

        dd($response->json());


        if ($response->successful()) {
            // Process successful response, e.g., storing payment URL if returned
            $paymentUrl = $response->json('payment.url');

            // Proceed with order, order items, payment entries as usual here
            Payment::create([
                'user_id' => $userId,
                'order_id' => $order->id,
                'payment_method' => "DOKU",
                'transaction_id' => $formattedInvoice,
                'status' => 'pending',
                'amount' => $request->subtotal,
                'payment_date' => now(),
            ]);

            return redirect()->back()->with(['response' => $paymentUrl]); // Redirect user to DOKU payment page
        } else {
            // Handle failure case
            return redirect()->back()->withErrors(['payment' => 'Payment initiation failed, please try again.']);
        }
    }

    // SHIPPING
    public function getProvinces()
    {
        $response = Http::withHeaders([
            'key' => '8bdc162da0cd0ac8b70ac07d40f43963',
        ])->get('https://api.rajaongkir.com/starter/province');

        if ($response->successful()) {
            return response()->json($response->json());
        } else {
            return response()->json(['error' => 'Failed to fetch data'], 500);
        }
    }

    public function getExpeditions(Request $request)
    {
        $response = Http::withHeaders([
            'key' => '8bdc162da0cd0ac8b70ac07d40f43963',
        ])->post('https://api.rajaongkir.com/starter/cost', [
            'origin' => 114,
            'destination' => $request->destination,
            'weight' => 100,
            'courier' => "jne",
        ]);

        if ($response->successful()) {
            return response()->json($response->json());
        } else {
            return response()->json(['error' => 'Failed to fetch data'], 500);
        }
    }

    public function getCities($provinceId)
    {
        $response = Http::withHeaders([
            'key' => '8bdc162da0cd0ac8b70ac07d40f43963',
        ])->get('https://api.rajaongkir.com/starter/city', [
            'province' => $provinceId,
        ]);

        if ($response->successful()) {
            return response()->json($response->json());
        } else {
            return response()->json(['error' => 'Failed to fetch data'], 500);
        }
    }
}
