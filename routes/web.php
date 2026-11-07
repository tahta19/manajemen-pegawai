<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PegawaiController;

// Jadikan dashboard sebagai halaman pertama yang terbuka
Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

// Rute untuk CRUD pegawai
Route::resource('pegawai', PegawaiController::class);