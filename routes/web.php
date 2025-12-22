<?php


use App\Http\Controllers\AuthController;
use App\Http\Controllers\BerandaController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\BookingValidationController;
use App\Http\Controllers\HistoryController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\RefundController;
use App\Http\Controllers\pendingController;
use App\Http\Controllers\TicketController;
use App\Http\Controllers\validationController;
use Illuminate\Support\Facades\Route;

Route::get('/', [BerandaController::class, 'index'])->name('beranda.index');
Route::post('/search', [BerandaController::class, 'search'])->name('beranda.search');
Route::get('/search/result', [BerandaController::class, 'searchResult'])->name('beranda.search.result');

Route::get('/PageLogin', [AuthController::class, 'PageLogin'])->name('PageLogin');
Route::get('/PageRegister', [AuthController::class, 'PageRegister'])->name('PageRegister');

Route::post('/Login', [AuthController::class, 'login'])->name('login');
Route::post('/Register', [AuthController::class, 'Register'])->name('Register');
Route::get('/PageVerify', [AuthController::class, 'PageVerify'])->name('PageVerify');
Route::post('/Verify', [AuthController::class, 'Verify'])->name('Verify');
Route::post('/ResendCode', [AuthController::class, 'resendCode'])->name('ResendCode');
Route::post('/Logout', [AuthController::class, 'logout'])->name('logout');

Route::get('/beranda/payment/{id}', [PaymentController::class, 'paymentPage'])->name('beranda.payment');
Route::post('/beranda/payment/{booking_id}', [PaymentController::class, 'create'])->name('beranda.payment.create');
Route::get('/ajax/booking-status/{id}', [PaymentController::class, 'ajaxStatus']);

Route::get('/beranda/pending', [pendingController::class, 'index'])->name('beranda.pending');

Route::get('/beranda/validasi', [validationController::class, 'index'])->name('beranda.validasi');
Route::get('/booking/{id}', [BookingController::class, 'show'])->name('beranda.booking.show');

Route::post('/booking', [BookingController::class, 'store'])->name('beranda.booking.store');

Route::delete('/beranda/bookingValidation/cancel/{id}', [BookingValidationController::class, 'cancel'])->name('beranda.bookingValidation.cancel');
Route::get('/beranda/bookingValidation/{id}', [BookingValidationController::class, 'show'])->name('beranda.bookingValidation');

Route::get('/beranda/refund/{id}', [RefundController::class, 'index'])->name('beranda.refund');
Route::post('/beranda/refund', [RefundController::class, 'store'])->name('beranda.refund.store');

Route::get('/ticket/{id}', [TicketController::class, 'show'])->name('ticket.show');
Route::get('/ticket/download/{id}', [TicketController::class, 'download'])->name('ticket.download');

Route::get('/history', [HistoryController::class, 'index'])->name('history.index');
// Route::get('/history/{id}', [HistoryController::class, 'show'])->name('history.show');

Route::get('forgotpassword', [AuthController::class, 'PageForgotPassword'])->name('forgotpassword');
Route::post('forgotpassword', [AuthController::class, 'ForgotPassword'])->name('forgotpassword.post');

Route::get('verifyresetcode', [AuthController::class, 'PageResetCode'])->name('verifyresetcode');
Route::post('verifyresetcode', [AuthController::class, 'VerifyResetCode'])->name('verifyresetcode.post');
Route::post('verifyresetcode/resend', [AuthController::class, 'ResendResetCode'])->name('verifyresetcode.resend');

Route::get('resetpassword', [AuthController::class, 'PageResetPassword'])->name('resetpassword');
Route::post('resetpassword/resend', [AuthController::class, 'ResendResetCode'])->name('resetpassword.resend');
Route::post('resetpassword', [AuthController::class, 'ResetPassword'])->name('resetpassword.post');
