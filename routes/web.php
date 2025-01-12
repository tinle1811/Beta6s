<?php

use App\Http\Controllers\SearchController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\AccountController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CheckoutController;

//admin
use App\Http\Controllers\Admin\AdminAccountController;
use App\Http\Controllers\Admin\AdminAnalysisController;
use App\Http\Controllers\Admin\AdminBlogController;
use App\Http\Controllers\Admin\AdminProductController;
use App\Http\Controllers\Admin\AdminCatagoryController;
use App\Http\Controllers\Admin\AdminFormController;
use App\Http\Controllers\Admin\AdminInfoWebController;
use App\Http\Controllers\Admin\AdminPayController;
use App\Http\Controllers\Admin\AdminRoleController;
use App\Http\Controllers\Admin\AdminContactController;
use App\Http\Controllers\Admin\AdminRefundController;
use App\Http\Controllers\Admin\AdminOrderController;
use App\Http\Controllers\Admin\AdminClientController;
use App\Http\Controllers\Admin\AdminCommentController;

// Route login, logout & register
Route::get('/register', [AuthController::class, 'index'])->name('user.auth.register');
Route::post('/register/add', [AuthController::class, 'register'])->name('register');
Route::post('/login', [AuthController::class, 'login'])->name('login');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// route không yêu cầu đăng nhập
Route::get('/', [HomeController::class, 'index'])->name('user.home.index');
Route::get('/product-detail', [HomeController::class, 'show'])->name('user.home.show');
Route::get('/product-detail/{slug}', [HomeController::class, 'show'])->name('user.home.show');
Route::get('/contact', [HomeController::class, 'contact'])->name('user.home.contact');
Route::get('/wishlist', [HomeController::class, 'wishlist'])->name('user.home.wishlist');
Route::get('/search', [SearchController::class, 'index'])->name('user.search.index');

//KN- Trang giới thiệu - trang blog
Route::get('/about', [HomeController::class, 'about'])->name('user.home.about');
Route::get('/blog', [BlogController::class, 'index'])->name('user.blog.index');
Route::get('/blog-detail/{id?}', [BlogController::class, 'show'])->name('user.blog.show');

// các route chung cho cả hai phân hệ
Route::middleware('checkRole:shared')->group(function () {
    Route::get('/cart', [CartController::class, 'index'])->name('user.cart.index');
    Route::post('/cart/add/{id}', [CartController::class, 'addToCart'])->name('user.cart.add');
    Route::delete('/cart/remove/{id}', [CartController::class, 'remove'])->name('user.cart.remove');
    Route::post('/cart/update/{id}', [CartController::class, 'update'])->name('user.cart.update');

    Route::get('/checkout', [CheckoutController::class, 'checkout'])->name('user.cart.checkout');
    Route::post('/checkout/payment', [CheckoutController::class, 'payment'])->name('user.cart.payment');

    Route::get('/wishlist', [HomeController::class, 'wishlist'])->name('user.home.wishlist');
    Route::post('/wishlist/add/{id}', [HomeController::class, 'addToWishlist'])->name('user.home.addWishlist');
    Route::delete('/wishlist/remove/{id}', [HomeController::class, 'removeToWishlist'])->name('user.home.removeWishlist');

    Route::get('/account', [AccountController::class, 'index'])->name('user.account.index');
    Route::get('/purchase', [AccountController::class, 'purchase'])->name('user.account.purchase');
    Route::get('/orderlist', [AccountController::class, 'orderlist'])->name('test');
    Route::post('/addReview', [AccountController::class, 'addReview'])->name('user.account.addReview');
    Route::get('/purchaseHistory',[AccountController::class,'purchaseHistory'])->name('user.account.purchaseHistory');
    Route::get('/historyEvaluate',[AccountController::class,'historyEvaluate'])->name('user.account.historyEvaluate');
   
});

// Các route admin sử dụng middleware
Route::middleware('checkRole:admin')->group(function () {
   Route::get("/admin", [AdminAnalysisController::class, "index"])->name("admin.analysis");

    Route::get('/admin/product', [AdminProductController::class, "index"])->name("admin.product");
    Route::get('/admin/product/create', [AdminProductController::class, "create"])->name("admin.product.create");
    Route::post('/admin/product/createPost', [AdminProductController::class, "createPost"])->name("admin.product.createPost");

    Route::get('/admin/product/edit/{MaSP}', [AdminProductController::class, "edit"])->name("admin.product.edit");
    Route::post('/admin/product/update/{MaSP}', [AdminProductController::class, 'update'])->name('admin.product.update');

    Route::delete('/admin/product/delete/{MaSP}', [AdminProductController::class, "destroy"])->name("admin.product.delete");


   Route::get('/admin/catagory', [AdminCatagoryController::class, "index"])->name("admin.catagory");
   Route::get('/admin/catagory/create', [AdminCatagoryController::class, "create"])->name("admin.catagory.create");
   Route::post('/admin/catagory/create', [AdminCatagoryController::class, "createSubmitForm"])->name("admin.catagory.createSubmitForm");
   Route::get('/admin/catagory/{id}/edit', [AdminCatagoryController::class, "edit"])->name("admin.catagory.edit");
   Route::put('/admin/catagory/{id}/edit', [AdminCatagoryController::class, "editSubmitForm"])->name("admin.catagory.editSubmitForm");
   Route::delete('/admin/catagory/{id}/delete', [AdminCatagoryController::class, "delete"])->name("admin.catagory.delete");

    Route::get('/admin/account', [AdminAccountController::class, 'index'])->name("admin.account");
    Route::get('/admin/account/create', [AdminAccountController::class, 'create'])->name("admin.account.create");
    Route::get('/admin/account/edit', [AdminAccountController::class, 'edit'])->name("admin.account.edit");

    Route::get("/admin/role", [AdminRoleController::class, "index"])->name("admin.role");
    Route::get("/admin/role/create", [AdminRoleController::class, "create"])->name("admin.role.create");
    Route::get("/admin/role/edit", [AdminRoleController::class, "edit"])->name("admin.role.edit");

    Route::get("/admin/form", [AdminFormController::class, "index"])->name("admin.form");
    Route::get("/admin/form/create", [AdminFormController::class, "create"])->name("admin.form.create");
    Route::get("/admin/form/edit", [AdminFormController::class, "edit"])->name("admin.form.edit");


    Route::get("/admin/client", [AdminClientController::class, "index"])->name("admin.client");
    Route::get("/admin/client/create", [AdminClientController::class, "create"])->name("admin.client.create");
    Route::get("/admin/client/edit", [AdminClientController::class, "edit"])->name("admin.client.edit");

    Route::get("/admin/refund", [AdminRefundController::class, "index"])->name("admin.refund");
    Route::get("/admin/refund/create", [AdminRefundController::class, "create"])->name("admin.refund.create");
    Route::get("/admin/refund/edit", [AdminRefundController::class, "edit"])->name("admin.refund.edit");

    Route::get("/admin/contact", [AdminContactController::class, "index"])->name("admin.contact");
    Route::get("/admin/contact/create", [AdminContactController::class, "create"])->name("admin.contact.create");
    Route::get("/admin/contact/edit", [AdminContactController::class, "edit"])->name("admin.contact.edit");

    Route::get("/admin/pay", [AdminPayController::class, "index"])->name("admin.pay");
    Route::get("/admin/pay/create", [AdminPayController::class, "create"])->name("admin.pay.create");
    Route::get("/admin/pay/edit", [AdminPayController::class, "edit"])->name("admin.pay.edit");

    Route::get("/admin/blog", [AdminBlogController::class, "index"])->name("admin.blog");
    Route::get("/admin/blog/create", [AdminBlogController::class, "create"])->name("admin.blog.create");
    Route::get("/admin/blog/edit", [AdminBlogController::class, "edit"])->name("admin.blog.edit");


    //---Ngan - thong tin website
    Route::get("/admin/infoweb", [AdminInfoWebController::class, "index"])->name("admin.infoweb");
    Route::get("/admin/infoweb/create", [AdminInfoWebController::class, "create"])->name("admin.infoweb.create");
    Route::get("/admin/infoweb/edit", [AdminInfoWebController::class, "edit"])->name("admin.infoweb.edit");
    Route::put("/admin/infoweb/update", [AdminInfoWebController::class, "update"])->name("admin.infoweb.update");

    //bình luận
    Route::get("/admin/comment", [AdminCommentController::class, "index"])->name("admin.comment");
    Route::post("/admin/comment/update", [AdminCommentController::class, "updateStatus"])->name("admin.comment.update");
    Route::post("/admin/comment/delete", [AdminCommentController::class, "delete"])->name("admin.comment.delete");

    //thống kê
    Route::get("/admin", [AdminAnalysisController::class, "index"])->name("admin.analysis");
    Route::post("/admin/date", [AdminAnalysisController::class, "filter_by_date"])->name("admin.analysis.filter_by_date");
    Route::get('/export-thong-ke', [AdminAnalysisController::class, 'export'])->name("admin.analysis.export");
    Route::get("/admin/thisweek", [AdminAnalysisController::class, "filter_by_thisweek"])->name("admin.analysis.filter_by_thisweek");
    Route::get("/admin/lastweek", [AdminAnalysisController::class, "filter_by_lastweek"])->name("admin.analysis.filter_by_lastweek");

    //cập nhật đơn hàng
    Route::get("/admin/order", [AdminOrderController::class, "index"])->name("admin.order");
    Route::get("/admin/order/create", [AdminOrderController::class, "create"])->name("admin.order.create");
    Route::get("/admin/order/edit/{maHD}", [AdminOrderController::class, "edit"])->name("admin.order.edit"); //xem hóa đơn cần chỉnh sửa
    Route::put('/admin/order/update/{maHD}', [AdminOrderController::class, 'update'])->name('admin.order.update'); //update hóa đơn

    // Route để cập nhật trạng thái thanh toán
    Route::post('/admin/order/toggle-status', [AdminOrderController::class, 'togglePaymentStatus'])->name('order.toggleStatus');
});