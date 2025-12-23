<?php

use App\Http\Controllers\SinhVienController;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\PageController;

Route::get('/', [PageController::class, 'showHomePage']);

Route::get('about', [PageController::class, 'showHomePage']);

// use App\Http\Controllers\SinhVienController;
Route::get('/sinhvien', [SinhVienController::class, 'index'])->name('sinhvien.index');

Route::post('/sinhvien', [SinhVienController::class, 'store'])->name('sinhvien.store');