// <?php

// namespace App\Http\Controllers;

// use Illuminate\Http\Request;
// use App\Models\User;
// use App\Models\VoucherNewUser;
// use App\Models\Cart;
// use App\Models\Cart_item;

// class VoucherController extends Controller
// {
//     public function checkCodeVoucher(Request $request){
//         $voucherExists = VoucherNewUser::where('code', $request->code)->exists();

//         return response()->json(['exists' => $voucherExists]);
//     }

//     public function applyVoucher(Request $request)
// {
//     try {
//         $userId = session('id_user');
//         $voucherCode = $request->input('code_voucher');

//         if ($userId && $voucherCode) {
//             // Validasi kode promo
//             $voucher = Voucher::where('code', $voucherCode)
//                 ->where('is_active', true)
//                 ->first();

//             if ($voucher) {
//                 $cartId = Cart::where('user_id', $userId)->value('id');
//                 $cartItems = Cart_item::where('cart_id', $cartId)
//                     ->where('is_choose', true)
//                     ->with(['product.brand'])
//                     ->get();

//                 $totalProduct = $cartItems->sum('quantity');
//                 $totalPrice = $cartItems->sum('total');

//                 // Hitung diskon dari voucher
//                 $discount = $voucher->discount_type == 'percent'
//                     ? ($totalPrice * $voucher->discount_value / 100)
//                     : $voucher->discount_value;

//                 // Hitung total belanja setelah diskon
//                 $totalShopping = $totalPrice - $discount;

//                 $data = [
//                     'address'       => Shipping_address::where('user_id', $userId)->orderBy('is_main', 'DESC')->get(),
//                     'cartItems'     => $cartItems,
//                     'totalProduct'  => $totalProduct,
//                     'totalPrice'    => $totalPrice,
//                     'discount'      => $discount,
//                     'totalShopping' => $totalShopping,
//                     'is_code'       => true, // Kode promo berhasil digunakan
//                 ];

//                 return view('user.component.checkout')->with('data', $data);
//             } else {
//                 // Kode voucher tidak valid
//                 return redirect()->back()->withErrors(['code_voucher' => 'Kode promo tidak valid atau sudah tidak aktif.']);
//             }
//         }
//     } catch (Exception $err) {
//         dd($err);
//     }
// }

// }
