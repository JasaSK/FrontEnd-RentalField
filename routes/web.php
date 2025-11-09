<?php

use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;

Route::get('/PageLogin' , [AuthController::class, 'PageLogin'])->name('PageLogin');
Route::get('/PageIndex' , [AuthController::class, 'PageIndex'])->name('PageIndex');
Route::get('/PageRegister' , [AuthController::class, 'PageRegister'])->name('PageRegister');

Route::post('/Login' , [AuthController::class, 'login'])->name('login');
