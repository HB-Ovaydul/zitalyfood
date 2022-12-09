<?php

use App\Http\Controllers\backend\AboutController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\backend\TagContoller;
use App\Http\Controllers\backend\AuthController;
use App\Http\Controllers\backend\RoleController;
use App\Http\Controllers\backend\SliderController;
use App\Http\Controllers\backend\HiddingController;
use App\Http\Controllers\backend\ProfileController;
use App\Http\Controllers\backend\AdminAuthConroller;
use App\Http\Controllers\backend\DashboardContoller;
use App\Http\Controllers\backend\PermissionController;
use App\Http\Controllers\backend\PostController;
use App\Http\Controllers\frontend\ViwePagesController;

// Groupe Middleware AuthMiddleware
Route::group(['middleware' => 'dashboard.redirect'],function(){
// Admin Login Page
Route::get('/admin-login-page',[AuthController::class,'ShowLoginPage'])->name('admin.login.page');
Route::post('/admin-login',[AuthController::class,'AdminLogin'])->name('admin.login');
Route::get('/admin-forgot',[AuthController::class,'ForgotPassword'])->name('admin.forgot');
Route::post('/admin-forgot-email-vary',[AuthController::class,'ForgotEmailVary'])->name('admin.forgot.vay');
Route::get('/admin-forgot-viwe-page/{email}/{token}',[AuthController::class,'ForgotViwePage'])->name('admin.forgot.viwe.page');
Route::post('/admin-forgot-change-password',[AuthController::class,'ChangePassword'])->name('admin.change.pass');

});

// Groupe Middleware AuthDashboardMiddleware
Route::group(['middleware' => 'dashboard'], function(){
// Dashboard 
Route::get('/dashboard',[DashboardContoller::class,'ShowDeshboard'])->name('dashboard.index');
// LogOut Routes
Route::get('/admin-logout',[AuthController::class,'AdminLogout'])->name('admin.logout');
/**
 * Admin Options Route
 */

 // User Profile Routes
 Route::get('/admin-profile',[ProfileController::class,'ShowProfilePage'])->name('admin.profile');
 Route::post('/admin-profile-update',[ProfileController::class,'UserDataEdit'])->name('admin.update.profile');
 // Change User Password
 Route::post('/change-password',[ProfileController::class,'ChangePassword'])->name('change.password');
// Permission routes
Route::resource('/permission', PermissionController::class);
Route::get('/permission-status{id}',[PermissionController::class,'permissionStatusUpdate'])->name('permission.status');
Route::get('/permission-trash-page',[PermissionController::class,'PermissionTrashPage'])->name('permission.trash');
Route::get('/permission-trash/{id}',[PermissionController::class,'PermissionTrashUpdate'])->name('permission.trash.update');
// Role routes
Route::resource('/role', RoleController::class);
Route::get('/role-status{id}',[RoleController::class,'RoleStatusUpdate'])->name('role.status');
Route::get('/role-trash-page',[RoleController::class,'RoleTrashPage'])->name('role.trash');
Route::get('/role-trash/{id}',[RoleController::class,'RoleTrashUpdate'])->name('role.trash.update');

// User Create Account Routes
Route::resource('/user', AdminAuthConroller::class);
Route::get('/user-status{id}',[AdminAuthConroller::class,'UserStatusUpdate'])->name('user.status');
Route::get('/user-trash-page',[AdminAuthConroller::class,'UserTrashPage'])->name('user.trash');
Route::get('/user-trash/{id}',[AdminAuthConroller::class,'UserTrashUpdate'])->name('user.trash.update');

// Slider Routes
Route::resource('/slider', SliderController::class);
Route::get('/slider-status{id}',[SliderController::class,'sliderStatusUpdate'])->name('slider.status');
Route::get('/slider-trash-page',[SliderController::class,'ShowTrashPage'])->name('slider.trash');
Route::get('/slider-trash/{id}',[SliderController::class,'sliderTrashUpdate'])->name('slider.trash.update');

// Slider Routes
Route::resource('/heading', HiddingController::class);
Route::get('/heading-status{id}',[HiddingController::class,'HeadingStatusUpdate'])->name('heading.status');
Route::get('/heading-trash-page',[HiddingController::class,'ShowTrashPage'])->name('heading.trash');
Route::get('/heading-trash/{id}',[HiddingController::class,'HeadingTrashUpdate'])->name('heading.trash.update');

// Blog Tags Routes
Route::resource('/tag', TagContoller::class);
Route::get('tag-status{id}',[TagContoller::class,'TagStatusUpdate'])->name('tag.status');
Route::get('tag-trash-page',[TagContoller::class,'ShowTrashPage'])->name('tag.trash');
Route::get('tag-trash/{id}',[TagContoller::class,'TagTrashUpdate'])->name('tag.trash.update');

// gallery Delete

// Blog Tags Routes
Route::resource('/post', PostController::class);
Route::get('post-status{id}',[PostController::class,'PostStatusUpdate'])->name('post.status');
Route::get('post-trash-page',[PostController::class,'ShoePostTrashPage'])->name('post.trash');
Route::get('post-trash/{id}',[PostController::class,'PostTrashUpdate'])->name('post.trash.update');

// About Routes
Route::resource('/about', AboutController::class);
Route::get('about-status{id}',[AboutController::class,'AboutStatusUpdate'])->name('about.status');
Route::get('about-trash-page',[AboutController::class,'ShoeAboutTrashPage'])->name('about.trash');
Route::get('about-trash/{id}',[AboutController::class,'AboutTrashUpdate'])->name('about.trash.update');

    
});

/**
 *  Frontend Routes
 */
Route::get('/home',[ViwePagesController::class,'ShowHomePage'])->name('home.page');
Route::get('/blog',[ViwePagesController::class,'ShowBlogPage'])->name('blog.page');
Route::get('/news/{slug}',[ViwePagesController::class,'ShowNewsSinglePage'])->name('news.page');
Route::get('/news',[ViwePagesController::class,'ShowNewsPage'])->name('news.main.page');