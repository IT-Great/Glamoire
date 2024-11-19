<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\Request;

use App\Http\Controllers\AffiliateController;
use App\Http\Controllers\ArticleController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AuthenticateController;
use App\Http\Controllers\BrandController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ChartofAccountController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\FormController;
use App\Http\Controllers\InvoiceController;
use App\Http\Controllers\PasswordResetController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\PromoController;
use App\Http\Controllers\ShopController;
use App\Http\Controllers\ContactusController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\SubscribeController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\DokuPaymentController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\PaymentController;
use Illuminate\Support\Facades\Auth;

use App\Models\NotifyMe;
use App\Models\User;

// VERIFIKASI EMAIL REGISTER
// Rute untuk halaman yang hanya bisa diakses oleh user terverifikasi
Route::get('/', [ProductController::class, 'index'])->name('home.glamoire');

Route::get('/{user}_account', [UserController::class, 'account'])
    ->name('account');

// Rute untuk memverifikasi email
// Route::get('/email-verify', function () {
//     if (auth()->user()->hasVerifiedEmail()) {
//         return redirect('/'); // Ganti dengan route yang diinginkan
//     }
//     return view('user.component.verify-email');
// })->middleware('auth')->name('verification.notice');

// Rute untuk memverifikasi email
Route::get('/email-verify', function () {
    // Cek apakah pengguna sudah login
    if (auth()->check()) {
        // Cek apakah email pengguna sudah diverifikasi
        if (auth()->user()->hasVerifiedEmail()) {
            return redirect('/'); // Ganti dengan route yang diinginkan
        }
        return view('user.component.verify-email');
    }

    // Jika pengguna belum login, redirect ke halaman login
    return redirect()->route('login');
})->middleware('auth')->name('verification.notice');


// Memproses link verifikasi
Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
    $request->fulfill(); // Verifikasi email

    // Login otomatis setelah verifikasi
    Auth::login($request->user());
    session()->flash('success_verification_email');

    return redirect('/'); // Redirect ke halaman home setelah verifikasi
})->middleware(['signed'])->name('verification.verify');

// Mengirim ulang email verifikasi
Route::post('/email/verification-notification', function (Request $request) {
    // dd($request);
    $request->user()->sendEmailVerificationNotification();
    // session()->flash('success_send_email');

    return response()->json(['success' => true, 'message' => 'Link verifikasi telah dikirim']);
    // return back()->with('message', 'Link verifikasi telah dikirim ulang!');
})->middleware(['auth', 'throttle:6,1'])->name('verification.send');

// NOTIFY ME
Route::post('/notify-me', function (Request $request) {
    $userId = session('id_user');
    $email = User::where('id', $userId)->value('email');

    if ($userId) {
        $checkIsAlreadyExists = NotifyMe::where('product_id', $request->product_id)
            ->where('email', $email)
            ->exists();

        if ($checkIsAlreadyExists) {
            return response()->json(['false' => true, 'message' => 'Email kamu sudah terdaftar']);
        }else{
            NotifyMe::create([
                'user_id' => $userId,
                'product_id' => $request->product_id,
                'email' => $email,
            ]);
            return response()->json(['success' => true, 'message' => 'Selesai.. Kami akan mengirimkan email jika produk ini sudah kami restock.']);
        }
    }
    return response()->json(['success' => false, 'message' => 'Masuk/Daftar Terlebih Dahulu Yaa']);
})->name('notify.me');

Route::get('/invoice-user_{noinvoice}', [InvoiceController::class, 'viewInvoiceUser'])->name('invoice.user');

// SEARCH
Route::get('/search', [ProductController::class, 'search'])->name('search.product');

// USER
Route::post('/login-user', [AuthController::class, 'login'])->name('login.user');
Route::post('/logout-user', [AuthController::class, 'logout'])->name('logout.user');
Route::post('/register-user', [AuthController::class, 'register'])->name('register.user');

Route::post('/check-email', [AuthController::class, 'checkEmail'])->name('check.email');
Route::post('/check-email-subscribe', [FormController::class, 'checkEmailSubscribe'])->name('check.email.subscribe');
Route::post('/check-email-voucher', [FormController::class, 'checkEmailVoucher'])->name('check.email.voucher');
Route::post('/check-handphone', [AuthController::class, 'checkHandphone'])->name('check.handphone');

Route::get('/forgot-password-user', [PasswordResetController::class, 'showForgotPasswordForm'])->name('forgot.password.form');
Route::post('/forgot-password-user', [PasswordResetController::class, 'sendResetLink'])->withoutMiddleware('throttle:60,1')->name('forgot.password.link');
Route::get('/reset-password-user-form/{email}', [PasswordResetController::class, 'showResetPasswordForm'])->name('password.reset');
Route::post('/reset-password-user', [PasswordResetController::class, 'resetPassword'])->name('reset.password');

Route::post('/voucher-new-user', [FormController::class, 'voucherNewUser'])->name('voucher.new.user');

// ACCOUNT
// Route::get('/{user}_account', [UserController::class, 'account'])->name('account');
Route::put('/edit-account', [UserController::class, 'updateProfile'])->name('edit.account');
Route::post('/add-shipping-address', [UserController::class, 'actionAddShippingAddress'])->name('add.shipping.address');
Route::put('/edit-shipping-address', [UserController::class, 'updateShippingAddress'])->name('edit.shipping.address');
Route::post('/delete-shipping-address', [UserController::class, 'deleteShippingAddress'])->name('delete.shipping.address');
Route::post('/set-main-address', [UserController::class, 'setMainAddress'])->name('main.shipping.address');
Route::post('/use-address', [UserController::class, 'useAddress'])->name('use.shipping.address');
Route::get('/get-active-tab', [UserController::class, 'getActiveTab'])->name('get.active.tab');
Route::post('/set-active-tab', [UserController::class, 'setActiveTab'])->name('set.active.tab');

// CART
Route::get('/get-total-cart', [CartController::class, 'getTotalCart'])->name('get.total.cart');
Route::post('/choose-product-cart', [CartController::class, 'chooseProductCart'])->name('choose.product.cart');

// FORM 
Route::post('/subscribe', [UserController::class, 'subscribe'])->name('subscribe');
Route::post('/send-question', [FormController::class, 'sendQuestion'])->name('send.question');
Route::post('/partnership', [FormController::class, 'files'])->name('partnership');
Route::post('/comment', [FormController::class, 'comment'])->name('comment.article');

// SHOP
Route::get('/shop', [ShopController::class, 'allProduct'])->name('shop.all');
Route::get('/belanja-{category}-{subcategory}', [ShopController::class, 'subCategory'])->name('shop.category.sub');
Route::get('/belanja-{category}', [ShopController::class, 'category'])->name('shop.category');

// DETAIL PRODUCT
Route::get('/{code}_product/{varian?}', [ProductController::class, 'detail'])->name('detail.product');

// SHIPPING 
Route::get('/provinces', [CheckoutController::class, 'getProvinces']);
Route::get('/expeditions', [CheckoutController::class, 'getExpeditions']);
Route::get('/cities/{id}', [CheckoutController::class, 'getCities']);

Route::get('/contact', function () {
    return view('user.component.contact');
});

Route::get('/about', function () {
    return view('user.component.about');
});

// DETAIL PRODUK
Route::get('/{id}_product', [ProductController::class, 'detail'])->name('detail.product');

// DETAIL BRAND
Route::get('/{nameBrand}_brand', [BrandController::class, 'brands'])->name('detail.brand.user');

// ADD REMOVE CART ITEMS
Route::post('/chart', [UserController::class, 'addToChart'])->name('add.to.chart');
Route::post('/chart-with-quantity', [UserController::class, 'addToChartWithQuantity'])->name('add.to.chart.with.quantity');
Route::post('/remove-product-cart', [CartController::class, 'deleteProductItem'])->name('delete.product.cart');
Route::post('/update-cart-quantity', [CartController::class, 'updateCartQuantity'])->name('update.cart.quantity');

// ADD & REMOVE WISHLIST
Route::post('/wishlist', [UserController::class, 'addToWishlist'])->name('add.to.wishlist');
Route::post('/remove-wishlist', [UserController::class, 'removeFromWishlist'])->name('remove.from.wishlist');


// BUY NOW
Route::post('/add-product-buy-now', [CheckoutController::class, 'addProductBuyNow'])->name('add.product.buy.now');
Route::get('/buy-now', [CheckoutController::class, 'buyNow'])->middleware(['auth', 'verified'])->name('buy.now');
Route::post('/update-cart-quantity-buy-now', [CheckoutController::class, 'updateCartQuantityBuyNow'])->name('update.cart.quantity.buy.now');

// BUY AGAIN
Route::post('/buy-again', [UserController::class, 'addToCartBuyNow'])->name('buy.again');


Route::get('/help', function () {
    return view('user.component.help');
});

Route::get('/promotion', [PromoController::class, 'index'])->name('promo.user');
Route::get('/{name}-detail-promo', [PromoController::class, 'detailPromoUser'])->name('detail.promo.user');

Route::get('/newsletter', function () {
    return view('user.component.newsletter');
});

Route::get('/newsletter', [ArticleController::class, 'articleUser'])->name('newsletter.user');
Route::get('/{nameArticle}_detailnewsletter', [ArticleController::class, 'detailArticleUser'])->name('detail.newsletter.user');

// LAKUKAN PEMBAYARAN
Route::post('/order-paynow', [CheckoutController::class, 'orderPayment'])->name('order.payment');
Route::post('/order-buynow', [CheckoutController::class, 'orderBuyNow'])->name('order.buynow');
Route::post('/rating-and-review', [UserController::class, 'ratingAndReview'])->name('rating.and.review');

// testdoku
Route::post('/initiate-doku-payment', [DokuPaymentController::class, 'initiatePayment'])->name('doku.initiate');
// Route::post('/doku-callback', [DokuPaymentController::class, 'callback'])->name('doku.callback');
Route::match(['get', 'post'], '/doku-callback', [DokuPaymentController::class, 'callback'])->name('doku.callback');

// payment
Route::get('/payment/success', [PaymentController::class, 'success'])->name('payment.success');
Route::get('/payment/failed', [PaymentController::class, 'failed'])->name('payment.failed');




Route::prefix('/cart')->group(function () {
    Route::get('/', [CartController::class, 'index']);
});


// CHECKOUT
Route::get('/checkout', [CheckoutController::class, 'index'])->name('checkout');
Route::post('/check-apply-voucher', [CheckoutController::class, 'checkApplyVoucher'])->name('check.apply.voucher');
Route::post('/check-apply-voucher-buy-now', [CheckoutController::class, 'checkApplyVoucherBuyNow'])->name('check.apply.voucher.buy.now');
Route::post('/apply-voucher', [CheckoutController::class, 'applyVoucher'])->name('apply.voucher');
Route::post('/apply-voucher-new-user', [CheckoutController::class, 'applyVoucherNewUser'])->name('apply.voucher.new.user');
Route::post('/apply-voucher-buy-now', [CheckoutController::class, 'applyVoucherBuyNow'])->name('apply.voucher.buy.now');
// CHECK VOUCHER
Route::post('/check-code-voucher', [CheckoutController::class, 'checkCodeVoucher'])->name('check.code.voucher');

Route::get('/partner', function () {
    return view('user.component.partner');
});

Route::get('/privacy', function () {
    return view('user.component.privacy');
});

Route::get('/terms', function () {
    return view('user.component.terms');
});


// ADMIN PAGE
Route::get('/error-403', function () {
    return view('error-403');
})->name('error-403');



// DASHBOARD
Route::get('/login-admin', [AuthenticateController::class, 'indexlogin'])->name('index-login');
Route::post('/login-admin', [AuthenticateController::class, 'login'])->name('login-admin');
Route::post('/logout', [AuthenticateController::class, 'logout'])->name('logout');

Route::get('/forgot-password', [AuthenticateController::class, 'forgotPassword'])->name('index-forgotpassword');


Route::middleware('auth')->get('/dashboard', [DashboardController::class, 'indexDashboard'])->name('dashboard');
Route::middleware(['auth', 'role:admin,superadmin,accounting'])->get('/dashboard', [DashboardController::class, 'indexDashboard'])->name('dashboard');


Route::middleware(['auth', 'role:admin,superadmin'])->group(function () {
    Route::get('/dashboard/get-sales-data', [DashboardController::class, 'getSalesData']);

    // product
    Route::get('/product-admin', [ProductController::class, 'indexProductAdmin'])->name('index-product-admin');
    Route::get('/create-product', [ProductController::class, 'createProductAdmin'])->name('create-product-admin');
    Route::post('/store-product', [ProductController::class, 'storeProductAdmin'])->name('store-product-admin');
    Route::get('/edit-product-admin/{id}', [ProductController::class, 'editProductAdmin'])->name('edit-product-admin');
    Route::put('/update/product/{id}', [ProductController::class, 'updateProductAdmin'])->name('update-product-admin');

    Route::get('/stock-product-admin', [ProductController::class, 'indexStockProductAdmin'])->name('index-stock-product-admin');
    Route::get('/outof-stock-product-admin', [ProductController::class, 'outOfStockProductAdmin'])->name('outof-stock-product-admin');
    Route::get('/low-stock-product-admin', [ProductController::class, 'lowStockProductAdmin'])->name('low-stock-product-admin');

    Route::put('/update-stock/{id}', [ProductController::class, 'updateStock'])->name('update-stock');

    Route::delete('/delete-product/{id}', [ProductController::class, 'deleteProductAdmin'])->name('delete-product-admin');
    Route::get('/detail-product-admin/{id}', [ProductController::class, 'detailProductAdmin'])->name('detail-product-admin');
    Route::post('/send-notify/{id}', [ProductController::class, 'notify'])->name('send-notify');

    // product-variant
    Route::get('/product-admin-variant', [ProductController::class, 'indexProductVariantAdmin'])->name('index-product-variant-admin');
    Route::get('/create-product-variant', [ProductController::class, 'createProductVariantAdmin'])->name('create-product-variant-admin');
    Route::post('/store-product-variant', [ProductController::class, 'storeProductVariantAdmin'])->name('store-product-variant-admin');
    Route::get('/edit-product-variant/{id}', [ProductController::class, 'editProductVariantAdmin'])->name('edit-product-variant-admin');
    Route::put('/update/product-variant/{id}', [ProductController::class, 'updateProductVariantAdmin'])->name('update-product-variant-admin');

    // category product
    Route::get('/category-product', [CategoryController::class, 'indexCategoryProduct'])->name('index-category-product');
    Route::post('/create-category-product', [CategoryController::class, 'createCategoryProduct'])->name('create-category-product');
    Route::delete('/category-product/{id}', [CategoryController::class, 'deleteCategoryProduct'])->name('delete-category-product');

    // order
    Route::get('/order-admin', [OrderController::class, 'indexOrder'])->name('index-admin-order');
    Route::get('/order-sent-admin', [OrderController::class, 'sentAdmin'])->name('index-admin-order-sent');
    Route::get('/order-need-sent-admin', [OrderController::class, 'needSentAdmin'])->name('index-admin-order-need-sent');
    Route::get('/order-detail/{id}', [OrderController::class, 'detailOrder'])->name('detail-admin-order');

    // brand
    Route::get('/brand-admin', [BrandController::class, 'indexbrand'])->name('index-brand-admin');
    Route::get('/create-brand', [BrandController::class, 'createBrand'])->name('create-brand-admin');
    Route::post('/store-brand', [BrandController::class, 'storeBrand'])->name('store-brand-admin');
    Route::get('/detail-brand/{id}', [BrandController::class, 'detailBrand'])->name('detail-brand-admin');
    Route::put('/update/brand/{id}', [BrandController::class, 'updateBrandAdmin'])->name('update-brand-admin');
    Route::delete('/delete-brand/{id}', [BrandController::class, 'deleteBrand'])->name('delete-brand-admin');
    Route::get('/search-brands', [BrandController::class, 'searchBrands']);

    // ARTICLE
    Route::get('/article-admin', [ArticleController::class, 'indexArticleAdmin'])->name('index-article');
    Route::get('/create-article-admin', [ArticleController::class, 'createArticle'])->name('create-article');
    Route::post('/create-article-admin', [ArticleController::class, 'storeArticle'])->name('store-article');
    Route::get('/edit-article-admin', [ArticleController::class, 'editArticle'])->name('edit-article');
    Route::post('/edit-article-admin', [ArticleController::class, 'updateArticle'])->name('update-article');
    Route::get('/review-article-admin/{id}', [ArticleController::class, 'reviewArticle'])->name('review-article');
    Route::delete('/article-admin/{id}', [ArticleController::class, 'deleteArticle'])->name('delete-article');

    // category article
    Route::get('/category-article', [CategoryController::class, 'indexCategoryArticle'])->name('index-category-article');
    Route::post('/create-category-article', [CategoryController::class, 'createCategoryArticle'])->name('create-category-article');
    Route::delete('/category-article/{id}', [CategoryController::class, 'deleteCategoryArticle'])->name('delete-category-article');

    // PROMO
    Route::get('/promo', [PromoController::class, 'indexPromo'])->name('index-promo');
    Route::get('/create-promo', [PromoController::class, 'createPromo'])->name('create-promo');
    // Route::post('/promo/toggle-status/{id}', [PromoController::class, 'toggleStatus'])->name('promo.toggle-status');
    Route::post('promo/toggle-status/{id}', [PromoController::class, 'toggleStatus'])->name('promo.toggle-status');




    Route::post('/create-promo', [PromoController::class, 'storePromo'])->name('store-promo');
    Route::get('/edit-promo/{id}', [PromoController::class, 'editPromo'])->name('edit-promo');
    Route::put('/update-promo/{id}', [PromoController::class, 'updatePromo'])->name('update-promo');
    // Route::put('update-promo-voucher/{id}', [PromoController::class, 'updatePromoVoucher'])->name('update-promo-voucher');


    // promo voucher toko
    Route::get('/create-promo-brand-voucher', [PromoController::class, 'createPromoBrandVoucher'])->name('create-promo-brand-voucher');
    Route::post('/create-promo-brand-voucher', [PromoController::class, 'storePromoBrandVoucher'])->name('store-promo-brand-voucher');
    // Route::get('/create-promo-shop-voucher', [PromoController::class, 'createPromoShopVoucher'])->name('create-promo-shop-voucher');
    // Route::post('/create-promo-shop-voucher', [PromoController::class, 'storePromoShopVoucher'])->name('store-promo-shop-voucher');

    // routes/web.php
    // web.php atau routes file Anda
    Route::get('/get-products-by-brand/{brand}', [PromoController::class, 'getProductsByBrand'])->name('get.products.by.brand');

    // promo voucher produk tertentu
    Route::get('/create-promo-product-voucher', [PromoController::class, 'createPromoProductVoucher'])->name('create-promo-product-voucher');
    Route::post('/create-promo-product-voucher', [PromoController::class, 'storePromoProductVoucher'])->name('store-promo-product-voucher');

    // promo voucher terbatas
    Route::get('/promo-voucher', [PromoController::class, 'indexPromoVoucher'])->name('index-promo-voucher');
    Route::get('/create-promo-voucher', [PromoController::class, 'createPromoVoucher'])->name('create-promo-voucher');
    Route::post('/create-promo-voucher', [PromoController::class, 'storePromoVoucher'])->name('store-promo-voucher');
    Route::put('update-promo-voucher-limited/{id}', [PromoController::class, 'updatePromoVoucherLimited'])->name('update-promo-voucher-limited');


    // detail promo voucher
    Route::get('/detail-promo-voucher/{id}', [PromoController::class, 'detailPromoVoucher'])->name('detail-promo-voucher');

    // edit promo voucher
    Route::get('edit-promo-voucher/{id}', [PromoController::class, 'editPromoVoucher'])->name('edit-promo-voucher');
    Route::put('update-promo-brand-voucher/{id}', [PromoController::class, 'updatePromoBrandVoucher'])->name('update-promo-brand-voucher');
    Route::put('update-promo-product-voucher/{id}', [PromoController::class, 'updatePromoProductVoucher'])->name('update-promo-product-voucher');
    Route::put('update-promo-voucher/{id}', [PromoController::class, 'updatePromoVoucher'])->name('update-promo-voucher');

    // shiping fee voucher promo
    Route::get('/create-promo-voucher-shippingfee', [PromoController::class, 'createPromoVoucherShippingFee'])->name('create-promo-voucher-shippingfee');
    Route::post('/create-promo-voucher-shippingfee', [PromoController::class, 'storePromoVoucherShippingFee'])->name('store-promo-voucher-shippingfee');
    // Route::get('/promo-ongkir', [PromoController::class, 'indexPromoOngkir'])->name('index-promo-ongkir');

    // diskon
    Route::get('/promo-diskon', [PromoController::class, 'indexPromoDiskon'])->name('index-promo-diskon');
    Route::get('/create-promo-diskon', [PromoController::class, 'createPromoDiskon'])->name('create-promo-diskon');
    Route::post('/create-promo-diskon', [PromoController::class, 'storePromoDiskon'])->name('store-promo-diskon');

    // new user
    Route::get('/promo-new-user', [PromoController::class, 'indexPromoNewUser'])->name('index-promo-new-user');
    Route::get('/create-promo-new-user', [PromoController::class, 'createPromoNewUser'])->name('create-promo-voucher-new-user');
    Route::post('/create-promo-new-user', [PromoController::class, 'storePromoNewUser'])->name('store-promo-new-user');
    Route::put('update-promo-voucher-newuser/{id}', [PromoController::class, 'updatePromoVoucherNewUser'])->name('update-promo-voucher-newuser');

    Route::get('/detail-promo/{id}', [PromoController::class, 'detailPromo'])->name('detail-promo');
    Route::put('/update/promo/{id}', [PromoController::class, 'updatePromo'])->name('update-promo');

    Route::delete('/delete-promo/{id}', [PromoController::class, 'deletePromo'])->name('delete-promo');

    // AFFILIATE
    Route::get('/affiliate-admin', [AffiliateController::class, 'indexAffiliateAdmin'])->name('index-affiliate-admin');
    Route::get('/detail-affiliate-admin/{id}', [AffiliateController::class, 'detailAffiliateAdmin'])->name('detail-affiliate-admin');
    Route::post('/admin/affiliate/{id}', [AffiliateController::class, 'sendResponseAffiliate'])->name('send-response-affiliate');


    Route::get('/chat-admin', function () {
        return view('admin.chat.index');
    });

    // user detail
    Route::get('/user-admin', [UserController::class, 'indexUserAdmin'])->name('index-user-admin');
    Route::get('/user-admin-detail', [UserController::class, 'detailUserAdmin'])->name('detail-user-admin');

    // shipping fee
    Route::get('/shipping-fee', function () {
        return view('admin.shippingfee.index');
    });

    Route::get('/create-shipping-fee', function () {
        return view('admin.shippingfee.create');
    });

    Route::get('/contact-us-admin', [ContactusController::class, 'indexContactusAdmin'])->name('index-contactus-admin');
    Route::get('/contact-us-admin/{id}', [ContactusController::class, 'showContactusAdmin'])->name('show-contactus-admin');

    // SEND EMAIL RESPONSE
    Route::get('/admin/contacts/{id}', [ContactusController::class, 'show'])->name('show-contactus-admin');
    Route::post('/admin/contacts/{id}/respond', [ContactusController::class, 'sendResponse'])->name('send-response');

    Route::get('/subscribe-admin', [SubscribeController::class, 'indexSubscribeAdmin'])->name('index-subscribe-admin');
});

Route::middleware(['auth', 'role:accounting,superadmin'])->group(function () {
    // ACCOUNTING
    // COA
    Route::get('/coa', [ChartofAccountController::class, 'indexChartofAccount'])->name('index-chartofaccount');
    Route::get('/create-coa', [ChartofAccountController::class, 'createChartofAccount'])->name('create-chartofaccount');
    Route::post('/create-coa', [ChartofAccountController::class, 'storeChartofAccount'])->name('store-chartofaccount');
    Route::get('/edit-coa', [ChartofAccountController::class, 'editChartofAccount'])->name('edit-chartofaccount');
    Route::post('/edit-coa', [ChartofAccountController::class, 'updateChartofAccount'])->name('update-chartofaccount');
    Route::delete('/coa/{id}', [ChartofAccountController::class, 'deleteChartofAccount'])->name('delete-chartofaccount');
    Route::get('/category-coa', [ChartofAccountController::class, 'indexCategoryChartofAccount'])->name('index-category-chartofaccount');

    // INVOICE
    Route::get('/invoice', [InvoiceController::class, 'indexInvoice'])->name('index-invoice');
    Route::get('/create-invoice', [InvoiceController::class, 'createInvoice'])->name('create-invoice');
    Route::post('/create-invoice', [InvoiceController::class, 'storeInvoice'])->name('store-invoice');
    Route::get('/edit-invoice', [InvoiceController::class, 'editInvoice'])->name('edit-invoice');
    Route::post('/edit-invoice', [InvoiceController::class, 'updateInvoice'])->name('update-invoice');
    Route::delete('/invoice/{id}', [InvoiceController::class, 'deleteInvoice'])->name('delete-invoice');
    // TRANSACTION
});
