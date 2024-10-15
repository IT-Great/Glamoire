<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

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



class CheckoutController extends Controller
{
    public function index(){
        try {
            $userId = session('id_user');
    
            if ($userId) {
                $data = Cart::where('user_id', $userId)
                    ->with('cartItems')
                    ->get();

                $vouchers = Promo::whereIn('type', ['voucher', 'ongkir'])->get();


                // dd($vouchers);

                $address = Shipping_address::where('user_id', session('id_user'))
                    ->orderBy('is_main', 'DESC')
                    ->get();

                $cartId = Cart::where('user_id', session('id_user'))->value('id');

                $cartItems = Cart_item::where('cart_id', $cartId)
                    ->where('is_choose', TRUE)
                    ->with(['product.brand'])
                    ->get();

                $totalProduct = $cartItems->sum('quantity');
                // Hitung total harga
                $totalPrice = $cartItems->sum('total');


                $data = [
                    'address'       => $address,
                    'cartItems'     => $cartItems,
                    'totalProduct'  => $totalProduct,
                    'totalPrice'    => $totalPrice,
                    'totalShopping' => $totalPrice,
                    'vouchers'      => $vouchers,
                ];
                
                return view('user.component.checkout')->with('data', $data);
            }
            else {
                session()->flash('register_or_login_first');
                return redirect()->back();
            }
        } catch (Exception $err) {
            dd($err);
        }
    }

    public function checkCodeVoucher(Request $request){
        $voucherExists = VoucherNewUser::where('code', $request->code)
        ->where('is_use', '=', 0)
        ->exists();

        return response()->json(['exists' => $voucherExists]);
    }

    public function applyVoucher(Request $request)
    {
        try {
            $userId = session('id_user');
            $voucherCode = $request->code_voucher;

            if ($userId && $voucherCode) {
                // Validasi kode promo
                $voucher = VoucherNewUser::where('code', $voucherCode)
                    ->first();

                if ($voucher) {
                    $cartId = Cart::where('user_id', $userId)->value('id');
                    $cartItems = Cart_item::where('cart_id', $cartId)
                        ->where('is_choose', true)
                        ->with(['product.brand'])
                        ->get();

                    $totalProduct = $cartItems->sum('quantity');
                    $totalPrice = $cartItems->sum('total');

                    // Hitung diskon dari voucher
                    $discount = $totalPrice * 10 / 100;

                    // Hitung total belanja setelah diskon
                    $totalShopping = $totalPrice - $discount;

                    $data = [
                        'address'       => Shipping_address::where('user_id', $userId)->orderBy('is_main', 'DESC')->get(),
                        'cartItems'     => $cartItems,
                        'totalProduct'  => $totalProduct,
                        'totalPrice'    => $totalPrice,
                        'discount'      => $discount,
                        'totalShopping' => $totalShopping,
                    ];

                    return response()->json([
                        'success' => true, 
                        'totalPriceFormatted' => $totalPrice,
                        'discountFormatted' => $discount,
                        'totalShoppingFormatted' => $totalShopping,
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
                $price = Product::where('id', $request->product_id)->value('regular_price');

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

    public function updateCartQuantityBuyNow(Request $request)
    {
        // Find the product in the cart or wherever the quantity is stored
        $productBuyNow = Buynow::where('user_id', session('id_user'))->first();

        if ($productBuyNow) {
            $productBuyNow->update([
                'quantity' => $request->quantity,
                'total'    => ($request->quantity)*($productBuyNow->price),
            ]);

            return response()->json(['success' => true, 'message' => 'Quantity updated successfully']);
        }

        return response()->json(['success' => false, 'message' => 'Terjadi Masalah Dengan Sistem']);
    }

    public function buyNow(){
        try {
            $userId = session('id_user');
    
            if ($userId) {
                $product = Buynow::where('user_id', $userId)
                    ->with(['product.brand'])
                    ->get();

                $address = Shipping_address::where('user_id', session('id_user'))
                ->orderBy('is_main', 'DESC')
                ->get();
                

                foreach ($product as $key => $prod) {
                    $totalProduct = $prod->quantity;
                    $totalPrice = $prod->total;
                }

                $data = [
                    'product'       => $product,
                    'address'       => $address,
                    'totalProduct'  => $totalProduct,
                    'totalPrice'    => $totalPrice,
                ];
                return view('user.component.buynow')->with('data', $data);
            }
            else {
                return redirect()->back();
            }

        } catch (Exception $err) {
            error(404);
        }
    }

    public function applyVoucherBuyNow(Request $request)
    {
        try {
            $userId = session('id_user');
            $voucherCode = $request->code_voucher;

            if ($userId && $voucherCode) {
                // Validasi kode promo
                $voucher = VoucherNewUser::where('code', $voucherCode)
                    ->where('user_id', $userId)
                    ->where('is_use', '=', 0)
                    ->first();

                if ($voucher) {
                    $product = Buynow::where('user_id', $userId)
                        ->with(['product.brand'])
                        ->get();

                    foreach ($product as $key => $prod) {
                        $totalProduct = $prod->quantity;
                        $totalPrice = $prod->total;
                    }

                    // Hitung diskon dari voucher
                    $discount = $totalPrice * 10 / 100;

                    // Hitung total belanja setelah diskon
                    $totalShopping = $totalPrice - $discount;

                    return response()->json([
                        'success' => true, 
                        'totalPriceFormatted' => $totalPrice,
                        'discountFormatted' => $discount,
                        'totalShoppingFormatted' => $totalShopping,
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

    public function orderPayment(Request $request){
        $userId = session('id_user');
        $shipping_cost = 20000;
        
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
            'shipping_cost'       => $shipping_cost,
            'voucher_promo'       => $request->code_voucher,
            'discount_amount'     => $request->discount_amount,
            'total_amount'        => $request->subtotal,
            'order_date'          => now(),
        ]);
    
        // Buat order item
        foreach($request->product as $id => $productId){
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
            ->where('code', $request->code_voucher)
            ->first();
        
        if ($useVoucherNewUser) {
            $useVoucherNewUser->is_use = 1;
            $useVoucherNewUser->save();
        }
    
        // Jika pembayaran selesai
        if ($payment->status == "completed") {
            // Ambil cart berdasarkan user_id sekali di luar loop
            $cartId = Cart::where('user_id', $userId)->value('id');
            
            foreach($request->product as $id => $productId){
                // Temukan produk berdasarkan ID
                $product = Product::find($productId);
                
                // Jika produk ditemukan, lakukan update stok
                if ($product) {
                    $product->stock_quantity -= $request->product_quantity[$productId];
                    $product->save();
                }
    
                // Hapus item dari cart berdasarkan cart_id dan product_id
                Cart_item::where('cart_id', $cartId)
                    ->where('product_id', $productId)
                    ->delete();
            }
        }
    
        session()->flash('payment_success');
    
        return redirect("/{$userId}_account");
    }
    
}
