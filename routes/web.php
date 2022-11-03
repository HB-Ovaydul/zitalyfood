<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\backend\AuthController;
use App\Http\Controllers\backend\DashboardContoller;

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
    
});