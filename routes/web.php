<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\productController as ProductPage;
use App\Http\Controllers\dashboardController as DashboardPage;
use App\Http\Controllers\indexController as IndexPage;
use App\Http\Controllers\exportController as ExportController;
use App\Http\Controllers\loginController as LoginController;
use App\Http\Controllers\importController as ImportController;
use App\Http\Controllers\AdminController as AdminController;
use App\Http\Controllers\UserController as UserController;
use App\Http\Controllers\ManagerController as ManagerController;
use App\Http\Controllers\PromotionController as PromotionController;
use App\Http\Controllers\PageController as PageController;
use App\Http\Controllers\CartController as CartController;
use App\Http\Controllers\MailController as MailController;
use App\Http\Controllers\NewController as NewController;
use GuzzleHttp\Middleware;
use Illuminate\Support\Facades\Auth;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
// Page
Route::get('/index', [PageController::class, 'IndexPage']);
Route::get('/', [PageController::class, 'HomePage'])->name('pages.home');
Route::get('/about', [PageController::class, 'AboutPage'])->name('pages.about');
Route::get('/contact', [PageController::class, 'ContactPage'])->name('pages.contact');
Route::get('/men', [PageController::class, 'MenPage'])->name('pages.men');
Route::get('/all', [PageController::class, 'AllPage'])->name('all.search');
Route::get('/kid', [PageController::class, 'KidPage'])->name('pages.kid');
Route::get('/detail_product/{name}', [PageController::class, 'DeTailPage'])->name('pages.detail');
Route::get('/cart', [PageController::class, 'CartPage'])->name('pages.cart');
Route::post('/add-to-cart', [CartController::class, 'addToCart'])->name('Addtocart');
Route::get('/remove-from-cart/{id}/{color}/{size}', [CartController::class, 'deletetoCart'])->name('Deletetocart');
Route::get('/post', [PageController::class, 'Post']);
Route::post('/update-cart', [CartController::class, 'updateCart'])->name('update-cart');
Route::post('/send-mail', [MailController::class, 'sendMail'])->name('send.mail');
Route::get('/checkout', [PageController::class, 'CheckoutPage'])->name('checkout');
//////////////////////////////
Route::get('/login', [loginController::class, 'loginview'])->name('loginview');
Route::post('/login', [loginController::class, 'login'])->name('login');
Route::post('/logout', [loginController::class, 'logout'])->name('logout');
Route::get('export', [ExportController::class, 'export'])->name('export');
Route::post('import', [ImportController::class, 'import'])->name('import');
Route::get('reset', [IndexPage::class, 'reset'])->name('reset');
Route::get('history/{id}', [IndexPage::class, 'historypage'])->name('history');
Route::post('pro_request', [PromotionController::class, 'sendRequest'])->name('send_promotion_request');
Route::post('create_promotion', [PromotionController::class, 'createPromotion'])->name('createPromotion');
Route::get('/changesform/{barcode}/{price}', [PromotionController::class, 'promotionForm'])->name('changesform');
Route::get('reset', [IndexPage::class, 'reset'])->name('reset');
// Route::get('makeChanges', [PromotionController::class, 'promotionForm'])->name('changesform');
Route::group(['prefix' => 'admin', 'middleware' => ['role:Nguyễn Thành Danh']], function () {
    Route::get('dashboard', [AdminController::class, 'dashboardpage_adm'])->name('admin.pages.dashboard');
    Route::get('pages', [NewController::class, 'HomeP'])->name('admin.pages.pager');
    Route::post('changeslink_pages', [NewController::class, 'changesLink_pages'])->name('admin.changesLink_pages');
    Route::get('categories', [IndexPage::class, 'categoriespage'])->name('pages.categories');
    Route::get('brand', [IndexPage::class, 'brandpage'])->name('pages.brand');
    Route::get('setting', [IndexPage::class, 'dashboardPage'])->name('pages.setting');
    Route::get('urls', [IndexPage::class, 'urlpage'])->name('admin.pages.urls');
    Route::get('list_user', [AdminController::class, 'userlist'])->name('pages.user_list');
    Route::post('list_user/delete-selected', [AdminController::class, 'user_deleteSelected'])->name('user.delete.selected');
    Route::get('product', [IndexPage::class, 'productsRoot'])->name('admin.pages.product');
    Route::get('history/{id}/link', [IndexPage::class, 'showUpdateForm'])->name('changesLink');
    Route::post('history/{id}/link', [IndexPage::class, 'changesLink'])->name('changesLink');
    Route::delete('products/delete-selected', [IndexPage::class, 'deleteSelected'])->name('product.delete.selected');
    Route::post('/products/update-link', [IndexPage::class, 'updateLink'])->name('product.update.link');
    Route::get('product/new', [IndexPage::class, 'createpage'])->name('product.create');
    Route::post('product/add_them', [IndexPage::class, 'store'])->name('admin.product.product');
    Route::get('list_user/new', [IndexPage::class, 'createUserpage'])->name('user.create');
    Route::post('product/add_user', [IndexPage::class, 'updateUserlist'])->name('admin.user');
    Route::get('get_appr', [PromotionController::class, 'getApporve'])->name('admin.approved.approve');
    Route::get('get_accept', [PromotionController::class, 'getApporveAccept'])->name('pages.approve_accept');
    Route::get('get_refuse', [PromotionController::class, 'getApporveRefused'])->name('pages.approve_refushed');
    Route::post('refuse_promotion', [PromotionController::class, 'refusePromotion'])->name('refusePromotion');
    Route::post('create_promotion', [PromotionController::class, 'createPromotion'])->name('createPromotion');
    Route::post('product/add_new', [IndexPage::class, 'store'])->name('admin.product.add');
    Route::post('product/changes_link', [IndexPage::class, 'store'])->name('admin.product.add');
});

Route::group(['prefix' => 'manager', 'middleware' => ['role:Lê Minh Quốc']], function () {
    Route::get('dashboard', [ManagerController::class, 'dashboardpage_mng'])->name('manager.pages.dashboard');
    Route::get('product', [IndexPage::class, 'productsRoot'])->name('manager.pages.product');
    Route::get('urls', [IndexPage::class, 'urlpage'])->name('manager.pages.urls');
    Route::get('get_appr', [PromotionController::class, 'getApporve'])->name('manager.approved.approve');
});

Route::group(['prefix' => 'user'], function () {
    Route::get('dashboard', [UserController::class, 'dashboardpage_user'])->name('user.pages.dashboard');
    Route::get('/product', [IndexPage::class, 'productsRoot'])->name('user.pages.product');
});
