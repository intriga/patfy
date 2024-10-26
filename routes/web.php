<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Backend\AdminController;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();


Route::middleware(['auth'])->group(function () {
    Route::get('/admin', [AdminController::class, 'index'])->name('admin');
});