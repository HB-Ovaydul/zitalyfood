<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\backend\AuthController;
use App\Http\Controllers\backend\DashboardContoller;

// Groupe Middleware AuthMiddleware
Route::group(['middleware' => 'dashboard.redirect'],function(){
// Admin Login Page
Route::get('/admin-login-page',[AuthController::class,'ShowLoginPage'])->name('admin.login.page');
Route::post('/admin-login',[AuthController::class,'AdminLogin'])->name('admin.login');

});

// Groupe Middleware AuthDashboardMiddleware
Route::group(['middleware' => 'dashboard'], function(){
// Dashboard 
Route::get('/dashboard',[DashboardContoller::class,'ShowDeshboard'])->name('dashboard.index');
// LogOut Routes
Route::get('/admin-logout',[AuthController::class,'AdminLogout'])->name('admin.logout');
    
});