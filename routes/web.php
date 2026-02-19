<?php

use App\Http\Controllers\mahasiswaController;
use App\Http\Controllers\mataKuliahController;
use Illuminate\Support\Facades\Route;

Route::get('/', [mahasiswaController::class, 'index']);

Route::resource('mahasiswa', mahasiswaController::class);

Route::resource('mataKuliah', mataKuliahController::class);
