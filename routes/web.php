<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\AccountController;
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

Route::get('/', [HomeController::class, 'index'])->name('user.home.index');
Route::get('/product-detail', [HomeController::class, 'show'])->name('user.home.show');
Route::get('/about', [HomeController::class, 'about'])->name('user.home.about');
Route::get('/contact', [HomeController::class, 'contact'])->name('user.home.contact');
Route::get('/wishlist', [HomeController::class, 'wishlist'])->name('user.home.wishlist');

Route::get('/blog', [BlogController::class, 'index'])->name('user.blog.index');
Route::get('/blog-detail', [BlogController::class, 'show'])->name('user.blog.show');

Route::get('/cart', [CartController::class, 'index'])->name('user.cart.index');
Route::get('/checkout', [CartController::class, 'checkout'])->name('user.cart.checkout');

Route::get('/account', [AccountController::class, 'index'])->name('user.account.index');

//admin
Route::get("/admin", [AdminAnalysisController::class, "index"])->name("admin.analysis");

Route::get('/admin/product', [AdminProductController::class, "index"])->name("admin.product");
Route::get('/admin/product/create', [AdminProductController::class, "create"])->name("admin.product.create");
Route::get('/admin/product/edit', [AdminProductController::class, "edit"])->name("admin.product.edit");

Route::get('/admin/catagory', [AdminCatagoryController::class, "index"])->name("admin.catagory");
Route::get('/admin/catagory/create', [AdminCatagoryController::class, "create"])->name("admin.catagory.create");
Route::get('/admin/catagory/edit', [AdminCatagoryController::class, "edit"])->name("admin.catagory.edit");

Route::get('/admin/account', [AdminAccountController::class, 'index'])->name("admin.account");
Route::get('/admin/account/create', [AdminAccountController::class, 'create'])->name("admin.account.create");
Route::get('/admin/account/edit', [AdminAccountController::class, 'edit'])->name("admin.account.edit");

Route::get("/admin/role", [AdminRoleController::class, "index"])->name("admin.role");
Route::get("/admin/role/create", [AdminRoleController::class, "create"])->name("admin.role.create");
Route::get("/admin/role/edit", [AdminRoleController::class, "edit"])->name("admin.role.edit");


Route::get("/admin/form", [AdminFormController::class, "index"])->name("admin.form");
Route::get("/admin/form/create", [AdminFormController::class, "create"])->name("admin.form.create");
Route::get("/admin/form/edit", [AdminFormController::class, "edit"])->name("admin.form.edit");

Route::get("/admin/order", [AdminOrderController::class, "index"])->name("admin.order");
Route::get("/admin/order/create", [AdminOrderController::class, "create"])->name("admin.order.create");
Route::get("/admin/order/edit", [AdminOrderController::class, "edit"])->name("admin.order.edit");

Route::get("/admin/client", [AdminClientController::class, "index"])->name("admin.client");
Route::get("/admin/client/create", [AdminClientController::class, "create"])->name("admin.client.create");
Route::get("/admin/client/edit", [AdminClientController::class, "edit"])->name("admin.client.edit");

Route::get("/admin/refund", [AdminRefundController::class, "index"])->name("admin.refund");
Route::get("/admin/refund/create", [AdminRefundController::class, "create"])->name("admin.refund.create");
Route::get("/admin/refund/edit", [AdminRefundController::class, "edit"])->name("admin.refund.edit");


//---Ngan - thong tin website
Route::get("/admin/infoweb", [AdminInfoWebController::class, "index"])->name("admin.infoweb");
Route::get("/admin/infoweb/create", [AdminInfoWebController::class, "create"])->name("admin.infoweb.create");
Route::get("/admin/infoweb/edit", [AdminInfoWebController::class, "edit"])->name("admin.infoweb.edit");
Route::put("/admin/infoweb/update", [AdminInfoWebController::class, "update"])->name("admin.infoweb.update");

Route::get("/admin/contact", [AdminContactController::class, "index"])->name("admin.contact");
Route::get("/admin/contact/create", [AdminContactController::class, "create"])->name("admin.contact.create");
Route::get("/admin/contact/edit", [AdminContactController::class, "edit"])->name("admin.contact.edit");

Route::get("/admin/pay", [AdminPayController::class, "index"])->name("admin.pay");
Route::get("/admin/pay/create", [AdminPayController::class, "create"])->name("admin.pay.create");
Route::get("/admin/pay/edit", [AdminPayController::class, "edit"])->name("admin.pay.edit");

Route::get("/admin/blog", [AdminBlogController::class, "index"])->name("admin.blog");
Route::get("/admin/blog/create", [AdminBlogController::class, "create"])->name("admin.blog.create");
Route::get("/admin/blog/edit", [AdminBlogController::class, "edit"])->name("admin.blog.edit");


Route::get("/admin/comment", [AdminCommentController::class, "index"])->name("admin.comment");
Route::get("/admin/comment/create", [AdminCommentController::class, "create"])->name("admin.comment.create");
Route::get("/admin/comment/edit", [AdminCommentController::class, "edit"])->name("admin.comment.edit");