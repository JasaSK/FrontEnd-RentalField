<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\BannerController;
use App\Http\Controllers\BerandaController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\GalleryController;
use Illuminate\Support\Facades\Route;

Route::get('/' , [BerandaController::class, 'PageIndex'])->name('PageIndex');

Route::get('/PageLogin' , [AuthController::class, 'PageLogin'])->name('PageLogin');
Route::get('/PageRegister' , [AuthController::class, 'PageRegister'])->name('PageRegister');

Route::post('/Login' , [AuthController::class, 'login'])->name('login');
Route::post('/Register' , [AuthController::class, 'Register'])->name('Register');
Route::get('/PageVerify' , [AuthController::class, 'PageVerify'])->name('PageVerify');
Route::post('/Verify' , [AuthController::class, 'Verify'])->name('Verify');
Route::post('/ResendCode' , [AuthController::class, 'resendCode'])->name('ResendCode');

Route::get('/admin/dashboard', [DashboardController::class, 'index'])->name('admin.dashboard');

Route::get('/admin/banner', [BannerController::class, 'index'])->name('admin.banner');
Route::post('/admin/banner/store', [BannerController::class, 'store'])->name('admin.banner.store');

Route::get('/admin/gallery', [GalleryController::class, 'index'])->name('admin.gallery');
