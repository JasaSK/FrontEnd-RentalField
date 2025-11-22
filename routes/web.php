<?php

use App\Http\Controllers\Admin\BannerController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\FieldController;
use App\Http\Controllers\Admin\GalleryController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\Admin\RefundController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\BerandaController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\HystoryController;
use App\Http\Controllers\OrderValidationController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\pendingController;
use App\Http\Controllers\riwayatController;
use App\Http\Controllers\validasiController;
use App\Http\Controllers\validationController;
use Illuminate\Support\Facades\Route;

Route::get('/', [BerandaController::class, 'index'])->name('beranda.index');
Route::post('/search', [BerandaController::class, 'search'])->name('beranda.search');

Route::get('/PageLogin', [AuthController::class, 'PageLogin'])->name('PageLogin');
Route::get('/PageRegister', [AuthController::class, 'PageRegister'])->name('PageRegister');

Route::post('/Login', [AuthController::class, 'login'])->name('login');
Route::post('/Register', [AuthController::class, 'Register'])->name('Register');
Route::get('/PageVerify', [AuthController::class, 'PageVerify'])->name('PageVerify');
Route::post('/Verify', [AuthController::class, 'Verify'])->name('Verify');
Route::post('/ResendCode', [AuthController::class, 'resendCode'])->name('ResendCode');
Route::post('/Logout', [AuthController::class, 'logout'])->name('logout');

Route::get('/beranda/order-validation', [OrderValidationController::class, 'index'])->name('beranda.order-validation');

Route::get('/beranda/payment', [PaymentController::class, 'index'])->name('beranda.payment');

Route::get('/beranda/pending', [pendingController::class, 'index'])->name('beranda.pending');

Route::get('/beranda/riwayat', [HystoryController::class, 'index'])->name('beranda.riwayat');

Route::get('/beranda/validasi', [validationController::class, 'index'])->name('beranda.validasi');

Route::get('/booking/{id}', [BookingController::class, 'show'])->name('beranda.booking.show');

Route::middleware(['auth'])->group(function () {
    Route::post('/booking', [BookingController::class, 'store'])->name('beranda.booking.store');
    Route::delete('/booking/cancel/{bookingId}', [BookingController::class, 'cancel'])->name('beranda.booking.cancel');
    Route::get('/booking/history', [BookingController::class, 'history'])->name('beranda.booking.history');
});

Route::middleware(['admin'])->group(function () {

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

    Route::get('/admin/fields', [FieldController::class, 'index'])->name('admin.fields');
    Route::post('/admin/fields/store', [FieldController::class, 'store'])->name('admin.fields.store');
    Route::put('/admin/fields/update/{id}', [FieldController::class, 'update'])->name('admin.fields.update');
    Route::delete('/admin/fields/destroy/{id}', [FieldController::class, 'destroy'])->name('admin.fields.destroy');

    Route::get('/admin/order', [OrderController::class, 'index'])->name('admin.order');
});
