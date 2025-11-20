<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\BannerController;
use App\Http\Controllers\BerandaController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\FieldController;
use App\Http\Controllers\GalleryController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\RefundController;
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
Route::put('/admin/banner/update/{id}', [BannerController::class, 'update'])->name('admin.banner.update');
Route::delete('/admin/banner/destroy/{id}', [BannerController::class, 'destroy'])->name('admin.banner.destroy');

Route::get('/admin/galleries', [GalleryController::class, 'index'])->name('admin.gallery');
Route::post('/admin/galleries/store', [GalleryController::class, 'store'])->name('admin.gallery.store');
Route::put('/admin/galleries/update/{id}', [GalleryController::class, 'update'])->name('admin.gallery.update');
Route::delete('/admin/galleries/destroy/{id}', [GalleryController::class, 'destroy'])->name('admin.gallery.destroy');

Route::get('/admin/refund', [RefundController::class, 'index'])->name('admin.refund');

Route::get('/admin/field', [FieldController::class, 'index'])->name('admin.field');
Route::post('/admin/field/store', [FieldController::class, 'store'])->name('admin.field.store');
Route::put('/admin/field/update/{id}', [FieldController::class, 'update'])->name('admin.field.update');
Route::delete('/admin/field/destroy/{id}', [FieldController::class, 'destroy'])->name('admin.field.destroy');

Route::get('/admin/order', [OrderController::class, 'index'])->name('admin.order');