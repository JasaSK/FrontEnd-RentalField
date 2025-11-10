<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\BerandaController;
use Illuminate\Support\Facades\Route;

Route::get('/PageLogin' , [AuthController::class, 'PageLogin'])->name('PageLogin');
Route::get('/PageRegister' , [AuthController::class, 'PageRegister'])->name('PageRegister');

Route::post('/Login' , [AuthController::class, 'login'])->name('login');
Route::post('/Register' , [AuthController::class, 'Register'])->name('Register');
Route::get('/PageVerify' , [AuthController::class, 'PageVerify'])->name('PageVerify');
Route::post('/Verify' , [AuthController::class, 'Verify'])->name('Verify');

Route::get('/PageIndex' , [BerandaController::class, 'PageIndex'])->name('PageIndex');