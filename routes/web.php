<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Backend\AdminController;
use App\Http\Controllers\Backend\TemplateController;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();


// frontend
Route::get('/template', [TemplateController::class, 'show'])->name('template');


// backend
Route::middleware(['auth'])->group(function () {
    Route::get('/admin', [AdminController::class, 'index'])->name('admin');
    Route::get('/admin/template', [TemplateController::class, 'index']);
});