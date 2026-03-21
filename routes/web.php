<?php

use App\Models\User;
use App\Models\AboutUs;
use App\Models\NotifyMe;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Auth;
use Illuminate\Auth\Events\Verified;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FaqController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\FormController;
use App\Http\Controllers\ShopController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\BrandController;
use App\Http\Controllers\PromoController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\PopupController;
use App\Http\Controllers\AboutusController;
use App\Http\Controllers\ArticleController;
use App\Http\Controllers\InvoiceController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\JournalController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\BiteshipController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\AffiliateController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ContactusController;
use App\Http\Controllers\SubscribeController;
use App\Http\Controllers\FinancialController;
use App\Http\Controllers\PrismalinkController;
use App\Http\Controllers\DokuPaymentController;

use App\Http\Controllers\TransactionController;
use App\Http\Controllers\AuthenticateController;
use App\Http\Controllers\PasswordResetController;

use App\Http\Controllers\ChartofAccountController;
use App\Http\Controllers\StockExportImportController;
use Illuminate\Foundation\Auth\EmailVerificationRequest;

// PRISMALINK ROUTE
Route::get('/views-payment/submit', [PrismalinkController::class, 'viewsSubmitPayment'])->name('views-payment.submit');
Route::post('/payment/submit', [PrismalinkController::class, 'submitPayment'])->name('payment.submit');
Route::get('/callback-payment', [PrismalinkController::class, 'callback'])->name('callback');
// Route::get('/callback-payment/frontend', [PrismalinkController::class, 'callbackFrontend'])->name('callback');
Route::get('/callback-backend-create-new-order', [PrismalinkController::class, 'callbackCreateOrder']);
// Route::post('/initiate-prismalink-payment', [PrismalinkController::class, 'initiatePayment'])->name('prismalink.initiate');
// Route::match(['get', 'post'], '/prismalink-callback', [PrismalinkController::class, 'callback'])->name('prismalink.callback');

// BITESHIP ROUTE WEBHOOK
Route::post('/callback-glamoire-with-biteship', [BiteshipController::class, 'callback']);


// VERIFIKASI EMAIL REGISTER
// Rute untuk halaman yang hanya bisa diakses oleh user terverifikasi
Route::get('/', [ProductController::class, 'index'])->name('home.glamoire');

Route::get('/account', [UserController::class, 'account'])->name('account');

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
// Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
//     $request->fulfill(); // Verifikasi email

//     // Login otomatis setelah verifikasi
//     Auth::login($request->user());
//     session()->flash('success_verification_email');

//     return redirect('/'); // Redirect ke halaman home setelah verifikasi
// })->middleware(['signed'])->name('verification.verify');

Route::get('/email/verify/{id}/{hash}', function (Request $request, $id, $hash) {
    $user = User::find($id);

    if (! $user) {
        abort(404);
    }

    if (! hash_equals((string) $hash, sha1($user->getEmailForVerification()))) {
        abort(403); // hash tidak cocok
    }

    if (! $user->hasVerifiedEmail()) {
        $user->markEmailAsVerified();
        event(new Verified($user));
    }

    session()->flash('success_verification_email');
    Auth::login($user); // Optional: login otomatis setelah verifikasi
    return redirect('/');
})->name('verification.verify');


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
        if ($request->product_variant_id !== null) {
            $checkIsAlreadyExists = NotifyMe::where('product_id', $request->product_id)
                ->where('product_variant_id', $request->product_variant_id)
                ->where('email', $email)
                ->exists();
        } else {
            $checkIsAlreadyExists = NotifyMe::where('product_id', $request->product_id)
                ->where('email', $email)
                ->exists();
        }

        if ($checkIsAlreadyExists) {
            return response()->json(['false' => true, 'message' => 'Email kamu sudah terdaftar']);
        } else {
            if ($request->product_variant_id !== null) {
                NotifyMe::create([
                    'user_id' => $userId,
                    'product_id' => $request->product_id,
                    'product_variant_id' => $request->product_variant_id,
                    'email' => $email,
                ]);
                return response()->json(['success' => true, 'message' => 'Selesai.. Kami akan mengirimkan email jika produk ini sudah kami restock.']);
            } else {
                NotifyMe::create([
                    'user_id' => $userId,
                    'product_id' => $request->product_id,
                    'email' => $email,
                ]);
                return response()->json(['success' => true, 'message' => 'Selesai.. Kami akan mengirimkan email jika produk ini sudah kami restock.']);
            }
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
Route::post('/forgot-password-link', [PasswordResetController::class, 'sendResetLink'])->withoutMiddleware('throttle:60,1')->name('forgot.password.link');
Route::get('/reset-password-user-form/{email}', [PasswordResetController::class, 'showResetPasswordForm'])->name('password.reset');
Route::post('/reset-password-user', [PasswordResetController::class, 'resetPassword'])->name('reset.password');

Route::post('/voucher-new-user', [FormController::class, 'voucherNewUser'])->name('voucher.new.user');

// ACCOUNT
// Route::get('/{user}_account', [UserController::class, 'account'])->name('account');
Route::put('/edit-account', [UserController::class, 'updateProfile'])->name('edit.account');
Route::post('/add-shipping-address', [UserController::class, 'actionAddShippingAddress'])->name('add.shipping.address');
Route::post('/add-shipping-address-guest', [UserController::class, 'actionAddShippingAddressGuest'])->name('add.shipping.address.guest');
Route::put('/edit-shipping-address', [UserController::class, 'updateShippingAddress'])->name('edit.shipping.address');
Route::post('/edit-shipping-address-guest', [UserController::class, 'updateShippingAddressGuest'])->name('edit.shipping.address.guest');
Route::post('/delete-shipping-address', [UserController::class, 'deleteShippingAddress'])->name('delete.shipping.address');
Route::post('/set-main-address', [UserController::class, 'setMainAddress'])->name('main.shipping.address');
Route::post('/use-address', [UserController::class, 'useAddress'])->name('use.shipping.address');
Route::get('/get-active-tab', [UserController::class, 'getActiveTab'])->name('get.active.tab');
Route::post('/set-active-tab', [UserController::class, 'setActiveTab'])->name('set.active.tab');

// CART
Route::get('/get-total-cart', [CartController::class, 'getTotalCart'])->name('get.total.cart');
Route::post('/choose-product-cart', [CartController::class, 'chooseProductCart'])->name('choose.product.cart');
Route::post('/choose-product-variant-cart', [CartController::class, 'chooseProductVariantCart'])->name('choose.product.variant.cart');

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
Route::get('/{code}_product/{varian?}', [ProductController::class, 'detail'])->name('detail.product.varian');

// SHIPPING
Route::get('/provinces', [CheckoutController::class, 'getProvinces']);
Route::get('/expeditions', [CheckoutController::class, 'getExpeditions']);
Route::get('/cities/{id}', [CheckoutController::class, 'getCities']);

Route::get('/contact', function () {
    return view('user.component.contact');
});

Route::get('/about', function () {
    $data = AboutUs::first();
    return view('user.component.about')->with('data', $data);
});

// DETAIL PRODUK
Route::get('/{id}_product', [ProductController::class, 'detail'])->name('detail.product');

// DETAIL BRAND
Route::get('/{nameBrand}_brand', [BrandController::class, 'brands'])->name('detail.brand.user');

// ADD REMOVE CART ITEMS
Route::post('/chart', [UserController::class, 'addToChart'])->name('add.to.chart');
Route::post('/chart-with-quantity', [UserController::class, 'addToChartWithQuantity'])->name('add.to.chart.with.quantity');
Route::post('/chart-with-quantity-variant', [UserController::class, 'addToChartWithQuantityVariant'])->name('add.to.chart.with.quantity.variant');
Route::post('/remove-product-cart', [CartController::class, 'deleteProductItem'])->name('delete.product.cart');
Route::post('/remove-all-product-cart', [CartController::class, 'deleteAllProductItem'])->name('delete.all.product.cart');
Route::post('/remove-product-variant-cart', [CartController::class, 'deleteProductVariantItem'])->name('delete.product.variant.cart');
Route::post('/update-cart-quantity', [CartController::class, 'updateCartQuantity'])->name('update.cart.quantity');
Route::post('/update-cart-quantity-variant', [CartController::class, 'updateCartQuantityVariant'])->name('update.cart.quantity.variant');
Route::post('/remove-product-cart-guest', [CartController::class, 'deleteProductItemGuest'])->name('delete.product.cart.guest');
Route::post('/remove-product-variant-cart-guest', [CartController::class, 'deleteProductVariantItemGuest'])->name('delete.product.variant.cart.guest');
Route::post('/update-cart-quantity-guest', [CartController::class, 'updateCartQuantityGuest'])->name('update.cart.quantity.guest');
Route::post('/update-cart-quantity-variant-guest', [CartController::class, 'updateCartQuantityVariantGuest'])->name('update.cart.quantity.variant.guest');

// ADD & REMOVE WISHLIST
Route::post('/wishlist', [UserController::class, 'addToWishlist'])->name('add.to.wishlist');
Route::post('/remove-wishlist', [UserController::class, 'removeFromWishlist'])->name('remove.from.wishlist');


// BUY NOW
Route::post('/add-product-buy-now', [CheckoutController::class, 'addProductBuyNow'])->name('add.product.buy.now');
Route::post('/add-product-variant-buy-now', [CheckoutController::class, 'addProductVariantBuyNow'])->name('add.product.variant.buy.now');
Route::get('/buy-now', [CheckoutController::class, 'buyNow'])->middleware(['auth', 'verified'])->name('buy.now');
Route::post('/update-cart-quantity-buy-now', [CheckoutController::class, 'updateCartQuantityBuyNow'])->name('update.cart.quantity.buy.now');

// BUY AGAIN
Route::post('/buy-again', [UserController::class, 'addToCartBuyNow'])->name('buy.again');


// Route::get('/help', function () {
//     return view('user.component.help');
// });

Route::get('/help', [FaqController::class, 'index']);


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
// Tambahkan di area Route User
Route::post('/add-rating-review', [UserController::class, 'ratingAndReview'])->name('add.rating.review');
Route::post('/order/request-return/{id}', [UserController::class, 'requestReturn'])->name('order.request-return');

// testdoku
Route::post('/initiate-doku-payment', [DokuPaymentController::class, 'initiatePayment'])->name('doku.initiate');
// Route::post('/doku-callback', [DokuPaymentController::class, 'callback'])->name('doku.callback');
Route::match(['get', 'post'], '/doku-callback', [DokuPaymentController::class, 'callback'])->name('doku.callback');

// payment
Route::get('/payment/success', [PaymentController::class, 'paymentSuccess'])->name('payment.success');
Route::get('/payment/failed', [PaymentController::class, 'paymentFailed'])->name('payment.failed');




Route::prefix('/cart')->group(function () {
    Route::get('/', [CartController::class, 'index']);
});


// CHECKOUT
Route::get('/checkout', [CheckoutController::class, 'index'])->name('checkout');
Route::post('/check-apply-voucher', [CheckoutController::class, 'checkApplyVoucher'])->name('check.apply.voucher');
Route::post('/check-apply-voucher-buy-now', [CheckoutController::class, 'checkApplyVoucherBuyNow'])->name('check.apply.voucher.buy.now');
Route::post('/apply-voucher', [CheckoutController::class, 'applyVoucher'])->name('apply.voucher');
Route::post('/apply-voucher-new-user', [CheckoutController::class, 'applyVoucherNewUser'])->name('apply.voucher.new.user');
Route::post('/apply-voucher-buy-now', [CheckoutController::class, 'applyVoucherNewUserBuyNow'])->name('apply.voucher.buy.now');
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

// FORGOT PASSWORD
Route::get('/forgot-password', [AuthenticateController::class, 'forgotPassword'])->name('index-forgotpassword');
Route::post('/send-reset-link', [AuthenticateController::class, 'sendResetLink'])->name('send.reset.link');
Route::get('/reset-password/{token}', [AuthenticateController::class, 'showResetForm'])->name('password.reset.admin');
Route::post('/reset-password', [AuthenticateController::class, 'resetPassword'])->name('reset.password.admin');

// TAMPILKAN PROFILE ADMIN
Route::get('/admin/profile', [AuthenticateController::class, 'adminProfile'])->name('admin.profile');

// PROSES UPDATE PROFILE ADMIN
Route::put('/admin/profile/update', [AuthenticateController::class, 'updateProfile'])->name('admin.profile.update');
Route::put('/admin/profile/password', [AuthenticateController::class, 'updatePassword'])->name('admin.profile.password');
Route::get('/admin/settings', [AuthenticateController::class, 'settings'])->name('admin.settings');
Route::post('/admin/settings', [AuthenticateController::class, 'updateSettings'])->name('admin.settings.update');

// Route::middleware('auth')->get('/dashboard', [DashboardController::class, 'indexDashboard'])->name('dashboard');
Route::middleware(['auth', 'role:admin,superadmin,accounting,gudang'])->get('/dashboard', [DashboardController::class, 'indexDashboard'])->name('dashboard');


Route::middleware(['auth', 'role:admin,superadmin'])->group(function () {
    Route::get('/dashboard/get-sales-data', [DashboardController::class, 'getSalesData']);

    // product
    Route::get('/product-admin', [ProductController::class, 'indexProductAdmin'])->name('index-product-admin');
    Route::get('/product-admin-create', [ProductController::class, 'createProductAdmin'])->name('create-product-admin');
    Route::post('/store-product', [ProductController::class, 'storeProductAdmin'])->name('store-product-admin');
    Route::get('/product-admin-edit/{id}', [ProductController::class, 'editProductAdmin'])->name('edit-product-admin');
    Route::put('/update/product/{id}', [ProductController::class, 'updateProductAdmin'])->name('update-product-admin');
    Route::post('/upload-temp-image', [ProductController::class, 'uploadTempImage'])->name('upload-temp-image');
    Route::post('/upload-temp-image', [ProductController::class, 'uploadTempImage'])->name('upload-temp-image');
    Route::post('/delete-temp-image', [ProductController::class, 'deleteTempImage'])->name('delete-temp-image');
    // Routes untuk Main Image Temporary Upload
    Route::post('/upload-temp-main-image', [ProductController::class, 'uploadTempMainImage'])->name('upload-temp-main-image');
    Route::post('/delete-temp-main-image', [ProductController::class, 'deleteTempMainImage'])->name('delete-temp-main-image');

    Route::delete('/delete-product/{id}', [ProductController::class, 'deleteProductAdmin'])->name('delete-product-admin');
    Route::get('/product-admin-detail/{id}', [ProductController::class, 'detailProductAdmin'])->name('detail-product-admin');
    Route::post('/send-notify/{id}', [ProductController::class, 'notify'])->name('send-notify');


    // STOCK PRODUCT
    Route::get('/stock-product-admin', [ProductController::class, 'indexStockProductAdmin'])->name('index-stock-product-admin');
    Route::get('/stock-product-admin-outofstock', [ProductController::class, 'outOfStockProductAdmin'])->name('outof-stock-product-admin');
    Route::get('/stock-product-admin-low', [ProductController::class, 'lowStockProductAdmin'])->name('low-stock-product-admin');

    Route::get('/check-stock-alerts', [ProductController::class, 'checkStockAlerts'])
        ->name('check-stock-alerts');

    // product update stock
    Route::get('/get-stock-details/{id}', [ProductController::class, 'getStockDetails']);
    Route::put('/update-stock/{id}', [ProductController::class, 'updateStock'])->name('update-stock');

    // product variant update stock
    Route::get('/get-variant-stock-details/{variantId}', [ProductController::class, 'getVariantStockDetails']);

    // import export stock
    Route::get('/download-product-stock-template', [StockExportImportController::class, 'downloadProductStockTemplate'])
        ->name('download.product.stock.template');
    Route::get('/download-product-variant-stock-template', [StockExportImportController::class, 'downloadProductStockVariantTemplate'])
        ->name('download.product.variant.stock.template');

    // Stock Export Routes
    Route::get('/export/product-stocks', [StockExportImportController::class, 'exportProductStocks'])
        ->name('export.product.stocks');
    Route::get('/export/product-variants', [StockExportImportController::class, 'exportProductVariants'])
        ->name('export.product.variants');

    // Stock Import Routes
    Route::post('/import/product-stocks', [StockExportImportController::class, 'importProductStocks'])
        ->name('import.product.stocks');
    Route::post('/import/product-variants', [StockExportImportController::class, 'importProductStockVariants'])
        ->name('import.product.variants');
    // Route::post('/import/product-variants', [StockExportImportController::class


    // product-variant
    Route::get('/product-admin-variant', [ProductController::class, 'indexProductVariantAdmin'])->name('index-product-variant-admin');
    Route::get('/create-product-variant', [ProductController::class, 'createProductVariantAdmin'])->name('create-product-variant-admin');
    Route::post('/store-product-variant', [ProductController::class, 'storeProductVariantAdmin'])->name('store-product-variant-admin');
    Route::get('/edit-product-variant/{id}', [ProductController::class, 'editProductVariantAdmin'])->name('edit-product-variant-admin');
    Route::put('/update/product-variant/{id}', [ProductController::class, 'updateProductVariantAdmin'])->name('update-product-variant-admin');

    // category product
    Route::get('/category-product', [CategoryController::class, 'indexCategoryProduct'])->name('index-category-product');
    Route::post('/create-category-product', [CategoryController::class, 'createCategoryProduct'])->name('create-category-product');
    Route::delete('/delete-category-product/{id}', [CategoryController::class, 'deleteCategoryProduct'])->name('delete-category-product');

    // order
    Route::get('/order-admin', [OrderController::class, 'indexOrder'])->name('index-admin-order');
    Route::get('/order-sent-admin', [OrderController::class, 'sentAdmin'])->name('index-admin-order-sent');
    Route::get('/order-need-sent-admin', [OrderController::class, 'needSentAdmin'])->name('index-admin-order-need-sent');
    Route::get('/order-complete-sent-admin', [OrderController::class, 'completeOrder'])->name('index-admin-order-complete-sent');
    Route::get('/order-returned-admin', [OrderController::class, 'returnedOrder'])->name('index-admin-order-returned');
    Route::get('/order-detail/{id}', [OrderController::class, 'detailOrder'])->name('detail-admin-order');

    Route::post('/admin/order/{id}/change-status', [OrderController::class, 'changeOrderStatus'])->name('change-order-status');
    Route::post('/admin/order/{id}/pick-up', [OrderController::class, 'pickUpBiteship'])->name('pick-up-biteship');
    Route::post('/orders/{orderId}/complete', [OrderController::class, 'changeDeliveryStatusOrder'])->name('orders.complete');
    Route::post('/orders/{orderId}/confirm-shipping', [OrderController::class, 'confirmShipping'])->name('orders.confirm-shipping');
    // Untuk return product
    Route::post('/admin/order/return/{id}/approve', [OrderController::class, 'approveReturn'])->name('admin.order.return.approve');
    Route::post('/admin/order/return/{id}/reject', [OrderController::class, 'rejectReturn'])->name('admin.order.return.reject');


    // GENERATE LABEL RESI BUAT SENDIRI
    Route::get('/orders/{id}/generate-shipping-label', [App\Http\Controllers\OrderController::class, 'generateShippingLabel'])->name('generate-shipping-label');
    // Route for viewing an existing shipping label
    Route::get('/orders/{id}/view-shipping-label', [App\Http\Controllers\OrderController::class, 'viewShippingLabel'])->name('view-shipping-label');
    // Route for updating shipping status
    Route::post('/orders/{id}/update-shipping-status', [App\Http\Controllers\OrderController::class, 'updateShippingStatus'])->name('update-shipping-status');

    // brand
    Route::get('/brand-admin', [BrandController::class, 'indexbrand'])->name('index-brand-admin');
    Route::get('/brand-admin-create', [BrandController::class, 'createBrand'])->name('create-brand-admin');
    Route::post('/brand-admin-store', [BrandController::class, 'storeBrand'])->name('store-brand-admin');
    Route::get('/brand-admin-detail/{id}', [BrandController::class, 'detailBrand'])->name('detail-brand-admin');
    Route::put('/update/brand/{id}', [BrandController::class, 'updateBrandAdmin'])->name('update-brand-admin');
    Route::get('/brands/{id}', [BrandController::class, 'showBrand'])->name('show-brand-admin');

    Route::delete('/delete-brand/{id}', [BrandController::class, 'deleteBrand'])->name('delete-brand-admin');
    Route::get('/search-brands', [BrandController::class, 'searchBrands']);

    // ARTICLE
    Route::get('/article-admin', [ArticleController::class, 'indexArticleAdmin'])->name('index-article');
    Route::get('/article-admin-create', [ArticleController::class, 'createArticle'])->name('create-article');
    Route::post('/create-article-admin', [ArticleController::class, 'storeArticle'])->name('store-article');
    Route::get('/article-admin/{id}/edit', [ArticleController::class, 'editArticle'])->name('edit-article');
    Route::put('/articles/{id}', [ArticleController::class, 'updateArticle'])->name('update-article');

    Route::get('/article-admin-review/{id}', [ArticleController::class, 'reviewArticle'])->name('review-article');
    Route::delete('/article-admin/{id}', [ArticleController::class, 'deleteArticle'])->name('delete-article');

    // category article
    Route::get('/article-admin-category', [CategoryController::class, 'indexCategoryArticle'])->name('index-category-article');
    Route::post('/create-category-article', [CategoryController::class, 'createCategoryArticle'])->name('create-category-article');
    Route::delete('/category-article/{id}', [CategoryController::class, 'deleteCategoryArticle'])->name('delete-category-article');

    // PROMO
    Route::get('/promo', [PromoController::class, 'indexPromo'])->name('index-promo');
    Route::get('/create-promo', [PromoController::class, 'createPromo'])->name('create-promo');
    Route::post('promo/toggle-status/{id}', [PromoController::class, 'toggleStatus'])->name('promo.toggle-status');

    Route::post('/create-promo', [PromoController::class, 'storePromo'])->name('store-promo');
    Route::get('/edit-promo/{id}', [PromoController::class, 'editPromo'])->name('edit-promo');
    Route::put('/update-promo/{id}', [PromoController::class, 'updatePromo'])->name('update-promo');
    Route::get('/detail-promo/{id}', [PromoController::class, 'detailPromo'])->name('detail-promo');

    // promo voucher toko
    Route::get('/create-promo-brand-voucher', [PromoController::class, 'createPromoBrandVoucher'])->name('create-promo-brand-voucher');
    Route::post('/create-promo-brand-voucher', [PromoController::class, 'storePromoBrandVoucher'])->name('store-promo-brand-voucher');

    // routes/web.php
    Route::get('/get-products-by-brand/{brand}', [PromoController::class, 'getProductsByBrand'])->name('get.products.by.brand');
    Route::get('/admin/promo/get-brand-products/{brandId}', [PromoController::class, 'getBrandProducts']);

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
    Route::get('/detail-diskon/{id}', [PromoController::class, 'detailDiskon'])->name('detail-diskon');

    // new user
    Route::get('/promo-new-user', [PromoController::class, 'indexPromoNewUser'])->name('index-promo-new-user');
    Route::get('/create-promo-new-user', [PromoController::class, 'createPromoNewUser'])->name('create-promo-voucher-new-user');
    Route::post('/create-promo-new-user', [PromoController::class, 'storePromoNewUser'])->name('store-promo-new-user');
    Route::put('update-promo-voucher-newuser/{id}', [PromoController::class, 'updatePromoVoucherNewUser'])->name('update-promo-voucher-newuser');

    Route::delete('/delete-promo/{id}', [PromoController::class, 'deletePromo'])->name('delete-promo');

    // PROMO GIFT
    Route::get('/promo-gift', [PromoController::class, 'indexPromoGift'])->name('index-promo-gift');
    Route::get('/create-promo-gift', [PromoController::class, 'createPromoGift'])->name('create-promo-gift');
    Route::post('/create-promo-gift', [PromoController::class, 'storePromoGift'])->name('store-promo-gift');
    Route::get('/detail-promo-gift/{id}', [PromoController::class, 'detailGift'])->name('detail-gift');
    Route::delete('/delete-promo-gift/{id}', [PromoController::class, 'deleteGift'])->name('delete-gift');

    // AFFILIATE
    Route::get('/affiliate-admin', [AffiliateController::class, 'indexAffiliateAdmin'])->name('index-affiliate-admin');
    Route::get('/affiliate-admin-detail/{id}', [AffiliateController::class, 'detailAffiliateAdmin'])->name('detail-affiliate-admin');
    Route::post('/admin/affiliate/{id}', [AffiliateController::class, 'sendResponseAffiliate'])->name('send-response-affiliate');
    Route::delete('/delete-affiliate-admin/{id}', [AffiliateController::class, 'deleteAffiliate'])->name('delete-affiliate');


    // faq
    Route::get('/faq-admin', [FaqController::class, 'indexFaqAdmin'])->name('index-faq-admin');
    Route::post('/faqs-create', [FaqController::class, 'store'])->name('faqs.store');
    Route::get('/faqs/render-row/{faq}', [FaqController::class, 'renderRow']);
    Route::delete('/faqs/{id}', [FaqController::class, 'delete'])->name('faqs.delete');


    Route::get('/chat-admin', function () {
        return view('admin.chat.index');
    });

    // USER & KELOLA PASSWORD
    Route::get('/user-admin', [UserController::class, 'indexUserAdmin'])->name('index-user-admin');
    Route::get('/user-admin-detail/{id}', [UserController::class, 'detailUserAdmin'])->name('detail-user-admin');
    Route::get('/user-admin-password', [UserController::class, 'passwordUserAdmin'])->name('password-user-admin');
    Route::post('/user-admin-password/change', [UserController::class, 'changePasswordUserAdmin'])->name('change-password-user-admin');

    // TENTANG KAMI
    Route::get('/aboutus-admin', [AboutusController::class, 'indexAboutusAdmin'])->name('index-aboutus-admin');
    Route::get('/aboutus-create-admin', [AboutusController::class, 'createAboutusAdmin'])->name('create-aboutus-admin');
    Route::post('/aboutus-create-admin', [AboutusController::class, 'storeAboutusAdmin'])->name('store-aboutus-admin');
    Route::get('/aboutus-edit-admin/{id}', [AboutusController::class, 'editAboutusAdmin'])->name('edit-aboutus-admin');
    Route::put('/aboutus-update-admin/{id}', [AboutusController::class, 'updateAboutusAdmin'])->name('update-aboutus-admin');
    Route::delete('/aboutus-delete-admin/delete-field', [AboutusController::class, 'deleteAboutUsField'])
        ->name('delete-aboutus-field-admin');

    // POP UP
    Route::get('/popup-admin', [PopupController::class, 'indexPopupAdmin'])->name('index-popup-admin');
    Route::get('/popup/{id}', [PopupController::class, 'show'])->name('popup.show');
    Route::post('/popup-create-admin', [PopupController::class, 'storePopupAdmin'])->name('store-popup-admin');
    Route::post('/popup/{id}/toggle', [PopupController::class, 'toggle'])->name('popup.toggle');
    Route::delete('/popup/{id}', [PopupController::class, 'destroy'])->name('popup.destroy');


    // shipping fee
    Route::get('/shipping-fee', function () {
        return view('admin.shippingfee.index');
    });

    Route::get('/create-shipping-fee', function () {
        return view('admin.shippingfee.create');
    });


    // contact us
    Route::get('/contact-us-admin', [ContactusController::class, 'indexContactusAdmin'])->name('index-contactus-admin');
    Route::get('/contact-us-admin/{id}', [ContactusController::class, 'show'])->name('show-contactus-admin');
    Route::post('/admin/contacts/{id}/respond', [ContactusController::class, 'sendResponse'])->name('send-response');
    Route::delete('/delete-contact/{id}', [ContactusController::class, 'deleteResponse'])->name('delete-contact');

    // Route::get('/notifications/contact-us', [ContactusController::class, 'getUnreadQuestionsCount'])
    //     ->name('unread-questions-count');

    // subscribe
    Route::get('/subscribe-admin', [SubscribeController::class, 'indexSubscribeAdmin'])->name('index-subscribe-admin');
    Route::post('/admin/subscribe/send-email', [SubscribeController::class, 'sendEmail'])->name('subscribe.send.email');
});

// ACCOUNTING
Route::middleware(['auth', 'role:accounting,superadmin'])->group(function () {
    // COA
    Route::get('/coa', [ChartofAccountController::class, 'indexChartofAccount'])->name('index-chartofaccount');
    Route::get('/coa-create', [ChartofAccountController::class, 'createChartofAccount'])->name('create-chartofaccount');
    Route::post('/create-coa', [ChartofAccountController::class, 'storeChartofAccount'])->name('store-chartofaccount');
    Route::post('/create-categorycoa', [ChartofAccountController::class, 'storeCategoryCoa'])->name('store-categorycoa');
    Route::get('/coa-edit/{id}', [ChartofAccountController::class, 'editChartofAccount'])->name('edit-chartofaccount');
    Route::post('/coa-edit/{id}', [ChartofAccountController::class, 'updateChartofAccount'])->name('update-chartofaccount');
    Route::delete('/coa/{id}', [ChartofAccountController::class, 'deleteChartofAccount'])->name('delete-chartofaccount');
    Route::get('/category-coa', [ChartofAccountController::class, 'indexCategoryChartofAccount'])->name('index-category-chartofaccount');

    // INVOICE
    Route::get('/invoice', [InvoiceController::class, 'indexInvoice'])->name('index-invoice');
    Route::get('/invoice-create', [InvoiceController::class, 'createInvoice'])->name('create-invoice');
    Route::post('/invoice-create', [InvoiceController::class, 'storeInvoice'])->name('store-invoice');
    // Invoice payment routes
    Route::get('/invoice/{id}/process-payment', [InvoiceController::class, 'viewProcessPayment'])->name('view-process-payment');
    Route::post('/invoices/process-payment', [InvoiceController::class, 'processPayment'])->name('process-invoice-payment');

    Route::get('/invoices/{id}/payment-history', [InvoiceController::class, 'paymentHistory'])->name('invoice-payment-history');
    Route::get('/invoices/{id}/details', [InvoiceController::class, 'getInvoiceDetails'])->name('get-invoice-details');


    Route::get('/invoice/{id}/edit', [InvoiceController::class, 'editInvoice'])->name('edit-invoice');
    Route::post('/invoice-edit', [InvoiceController::class, 'updateInvoice'])->name('update-invoice');
    Route::delete('/invoice-suppliers/{id}', [InvoiceController::class, 'deleteInvoice'])->name('delete-invoice');


    // SUPPLIER-INVOICE
    Route::get('/invoice-supplier', [InvoiceController::class, 'indexSupplier'])->name('index-supplier');
    Route::get('/invoice-create-supplier', [InvoiceController::class, 'createSupplier'])->name('create-supplier');
    Route::post('/create-supplier', [InvoiceController::class, 'storeSupplier'])->name('store-supplier');
    Route::get('/supplier-data/{id}', [InvoiceController::class, 'getSupplierDetails']);

    Route::get('/invoice-supplier/{id}/edit', [InvoiceController::class, 'editSupplier'])->name('edit-supplier');
    Route::post('/invoice-edit-supplier', [InvoiceController::class, 'updateSupplier'])->name('update-supplier');
    Route::delete('/invoice-delete-suppliers/{id}', [InvoiceController::class, 'deleteSupplier'])->name('delete-supplier');


    // TRANSACTION
    Route::get('/transaction', [TransactionController::class, 'indexTransaction'])->name('index-transaction');
    Route::get('/transaction-create', [TransactionController::class, 'createTransaction'])->name('create-transaction');
    Route::post('/transaction-transfer-create', [TransactionController::class, 'storeTransactionTransfer'])->name('store-transaction-transfer');
    Route::post('/transaction-receive-create', [TransactionController::class, 'storeTransactionReceive'])->name('store-transaction-receive');

    Route::get('/transaction-edit/{id}', [TransactionController::class, 'editTransaction'])->name('edit-transaction');
    Route::put('/transaction-transfer-update/{id}', [TransactionController::class, 'updateTransactionTransfer'])->name('update-transaction-transfer');
    Route::put('/transaction-receive-update/{id}', [TransactionController::class, 'updateTransactionReceive'])->name('update-transaction-receive');

    Route::get('/transactions/{id}', [TransactionController::class, 'getTransaction'])->name('get-transaction');

    Route::delete('/transaction/{id}', [TransactionController::class, 'deleteTransaction'])->name('delete-transaction');

    // FINANCIAL
    Route::get('/financial-income', [FinancialController::class, 'indexFinancialIncome'])->name('index-financial-income');
    Route::get('/income/{id}', [FinancialController::class, 'showPayment']);

    Route::get('/financial-expense', [FinancialController::class, 'indexFinancialExpense'])->name('index-financial-expense');
    Route::get('/expense/{id}', [FinancialController::class, 'showExpense']);

    // JOURNAL
    Route::get('/journal', [JournalController::class, 'indexJournal'])->name('index-journal');
});

// GUDANG
Route::middleware(['auth', 'role:gudang,admin,superadmin'])->group(function () {
    // product
    Route::get('/product-admin', [ProductController::class, 'indexProductAdmin'])->name('index-product-admin');
    Route::get('/product-admin-create', [ProductController::class, 'createProductAdmin'])->name('create-product-admin');
    Route::post('/store-product', [ProductController::class, 'storeProductAdmin'])->name('store-product-admin');
    Route::get('/product-admin-edit/{id}', [ProductController::class, 'editProductAdmin'])->name('edit-product-admin');
    Route::put('/update/product/{id}', [ProductController::class, 'updateProductAdmin'])->name('update-product-admin');
    Route::post('/upload-temp-image', [ProductController::class, 'uploadTempImage'])->name('upload-temp-image');
    Route::post('/upload-temp-image', [ProductController::class, 'uploadTempImage'])->name('upload-temp-image');
    Route::post('/delete-temp-image', [ProductController::class, 'deleteTempImage'])->name('delete-temp-image');
    // Routes untuk Main Image Temporary Upload
    Route::post('/upload-temp-main-image', [ProductController::class, 'uploadTempMainImage'])->name('upload-temp-main-image');
    Route::post('/delete-temp-main-image', [ProductController::class, 'deleteTempMainImage'])->name('delete-temp-main-image');

    Route::delete('/delete-product/{id}', [ProductController::class, 'deleteProductAdmin'])->name('delete-product-admin');
    Route::get('/product-admin-detail/{id}', [ProductController::class, 'detailProductAdmin'])->name('detail-product-admin');
    Route::post('/send-notify/{id}', [ProductController::class, 'notify'])->name('send-notify');


    // STOCK PRODUCT
    Route::get('/stock-product-admin', [ProductController::class, 'indexStockProductAdmin'])->name('index-stock-product-admin');
    Route::get('/stock-product-admin-outofstock', [ProductController::class, 'outOfStockProductAdmin'])->name('outof-stock-product-admin');
    Route::get('/stock-product-admin-low', [ProductController::class, 'lowStockProductAdmin'])->name('low-stock-product-admin');

    Route::get('/check-stock-alerts', [ProductController::class, 'checkStockAlerts'])
        ->name('check-stock-alerts');

    // product update stock
    Route::get('/get-stock-details/{id}', [ProductController::class, 'getStockDetails']);
    Route::put('/update-stock/{id}', [ProductController::class, 'updateStock'])->name('update-stock');

    // product variant update stock
    Route::get('/get-variant-stock-details/{variantId}', [ProductController::class, 'getVariantStockDetails']);

    // import export stock
    Route::get('/download-product-stock-template', [StockExportImportController::class, 'downloadProductStockTemplate'])
        ->name('download.product.stock.template');
    Route::get('/download-product-variant-stock-template', [StockExportImportController::class, 'downloadProductStockVariantTemplate'])
        ->name('download.product.variant.stock.template');

    // Stock Export Routes
    Route::get('/export/product-stocks', [StockExportImportController::class, 'exportProductStocks'])
        ->name('export.product.stocks');
    Route::get('/export/product-variants', [StockExportImportController::class, 'exportProductVariants'])
        ->name('export.product.variants');

    // Stock Import Routes
    Route::post('/import/product-stocks', [StockExportImportController::class, 'importProductStocks'])
        ->name('import.product.stocks');
    Route::post('/import/product-variants', [StockExportImportController::class, 'importProductStockVariants'])
        ->name('import.product.variants');
    // Route::post('/import/product-variants', [StockExportImportController::class


    // product-variant
    Route::get('/product-admin-variant', [ProductController::class, 'indexProductVariantAdmin'])->name('index-product-variant-admin');
    Route::get('/create-product-variant', [ProductController::class, 'createProductVariantAdmin'])->name('create-product-variant-admin');
    Route::post('/store-product-variant', [ProductController::class, 'storeProductVariantAdmin'])->name('store-product-variant-admin');
    Route::get('/edit-product-variant/{id}', [ProductController::class, 'editProductVariantAdmin'])->name('edit-product-variant-admin');
    Route::put('/update/product-variant/{id}', [ProductController::class, 'updateProductVariantAdmin'])->name('update-product-variant-admin');
});
