<?php

use App\Http\Controllers\BannerController;
use App\Http\Controllers\CategoryProductController;
use App\Http\Controllers\Controller;
use App\Http\Controllers\GallerieController;
use App\Http\Controllers\LineButtonController;
use App\Http\Controllers\LogController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\MainProductController;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\SingleBannerController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\UploadController;
use App\Http\Controllers\VideoController;
use App\Models\Courses;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
 */

//////////////////////////////////////////web no route group/////////////////////////////////////////////////////
//Login Admin
Route::post('/login', [LoginController::class, 'login']);

Route::post('/check_login', [LoginController::class, 'checkLogin']);

//user
Route::post('/create_admin', [UserController::class, 'createUserAdmin']);
Route::post('/forgot_password_user', [UserController::class, 'ForgotPasswordUser']);

// // Course Category
// Route::resource('course_category', CourseCategoryController::class);
// Route::post('/course_category_page', [CourseCategoryController::class, 'getPage']);
// Route::get('/get_course_category', [CourseCategoryController::class, 'getList']);
// Route::post('/update_course_category', [CourseCategoryController::class, 'updateData']);

// gallery
// Route::resource('gallery', GalleryController::class);
// Route::post('/gallery_page', [GalleryController::class, 'getPage']);
// Route::get('/get_gallery', [GalleryController::class, 'getList']);
// Route::post('/update_gallery', [GalleryController::class, 'updateData']);


// Banner
Route::resource('banner', BannerController::class);
Route::post('/banner_page', [BannerController::class, 'getPage']);
Route::get('/get_banner', [BannerController::class, 'getList']);
Route::post('/update_banner', [BannerController::class, 'updateData']);

// Menu
Route::resource('menu', MenuController::class);
Route::post('/menu_page', [MenuController::class, 'getPage']);
Route::get('/get_menu', [MenuController::class, 'getList']);

// Main
Route::resource('main_product', MainProductController::class);
Route::post('/main_product_page', [MainProductController::class, 'getPage']);
Route::get('/get_main_product', [MainProductController::class, 'getList']);
Route::post('/update_main_product', [MainProductController::class, 'updateData']);

// Product
Route::resource('product', ProductController::class);
Route::post('/product_page', [ProductController::class, 'getPage']);
Route::get('/get_product', [ProductController::class, 'getList']);
Route::post('/update_product', [ProductController::class, 'updateData']);

// Video List
Route::resource('video', VideoController::class);
Route::post('/video_page', [VideoController::class, 'getPage']);
Route::get('/get_video', [VideoController::class, 'getList']);
Route::post('/update_video', [VideoController::class, 'updateData']);

// Gallerie
Route::resource('gallerie', GallerieController::class);
Route::post('/gallerie_page', [GallerieController::class, 'getPage']);
Route::get('/get_gallerie', [GallerieController::class, 'getList']);
Route::post('/update_gallerie', [GallerieController::class, 'updateData']);

// Single
Route::resource('single', SingleBannerController::class);
Route::post('/single_page', [SingleBannerController::class, 'getPage']);
Route::get('/get_single', [SingleBannerController::class, 'getList']);
Route::post('/update_single', [SingleBannerController::class, 'updateData']);

// Line
Route::resource('line', LineButtonController::class);
Route::post('/line_page', [LineButtonController::class, 'getPage']);
Route::get('/get_line', [LineButtonController::class, 'getList']);
Route::post('/update_line', [LineButtonController::class, 'updateData']);

// Product Category
Route::resource('product_category', CategoryProductController::class);
Route::post('/product_category_page', [CategoryProductController::class, 'getPage']);
Route::get('/get_product_category', [CategoryProductController::class, 'getList']);
Route::post('/update_product_category', [CategoryProductController::class, 'updateData']);


// Main
Route::resource('review', ReviewController::class);
Route::post('/review_page', [ReviewController::class, 'getPage']);
Route::get('/get_review', [ReviewController::class, 'getList']);
Route::post('/update_review', [ReviewController::class, 'updateData']);

/////////////////////////////////////////////////////////////////////////////////////////////////////////////////

Route::group(['middleware' => 'checkjwt'], function () {

    //controller
    Route::post('upload_images', [Controller::class, 'uploadImages']);
    Route::post('upload_file', [Controller::class, 'uploadFile']);

    //user
    Route::resource('user', UserController::class);
    Route::get('/get_user', [UserController::class, 'getUser']);
    Route::get('/user_profile', [UserController::class, 'getProfileUser']);
    Route::post('/update_user', [UserController::class, 'update']);
    Route::post('/user_page', [UserController::class, 'UserPage']);
    Route::put('/reset_password_user/{id}', [UserController::class, 'ResetPasswordUser']);
    Route::post('/update_profile_user', [UserController::class, 'updateProfileUser']);
    Route::get('/get_profile_user', [UserController::class, 'getProfileUser']);

    Route::put('/update_password_user/{id}', [UserController::class, 'updatePasswordUser']);
});

//upload

Route::post('/upload_file', [UploadController::class, 'uploadFile']);
