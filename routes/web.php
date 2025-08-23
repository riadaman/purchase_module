<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

Route::get('/', function () {
    return redirect('/login');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [App\Http\Controllers\DashboardController::class, 'index'])->name('dashboard');
    Route::get('/suppliers/create', [App\Http\Controllers\SupplierController::class, 'create'])->name('suppliers.create');
    Route::post('/suppliers', [App\Http\Controllers\SupplierController::class, 'store'])->name('suppliers.store');
    Route::get('/suppliers/{id}/edit', [App\Http\Controllers\SupplierController::class, 'edit'])->name('suppliers.edit');
    Route::put('/suppliers/{id}', [App\Http\Controllers\SupplierController::class, 'update'])->name('suppliers.update');
    Route::get('/suppliers', [App\Http\Controllers\SupplierController::class, 'index'])->name('suppliers.index');
});
