<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\User\ManagerController;
use App\Http\Controllers\User\SupplierController;
use App\Http\Controllers\Admin\SupplierController as AdminSupplierController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::middleware(['auth', 'role:admin,editor,user'])->group(function () {
    Route::get('/', [SupplierController::class, 'index'])->name('user.index');

    Route::get('/supplier/{supplier}', [SupplierController::class, 'show'])->name('user.supplier');

    Route::get('/manager/{manager}', [ManagerController::class, 'show'])->name('user.manager');
});

Route::middleware(['auth', 'role:admin,editor'])->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::put('/admin/supplier/{supplier}', [AdminSupplierController::class, 'update'])->name('supplier.update');

    Route::delete('/admin/supplier/{supplier}', [AdminSupplierController::class, 'destroy'])->name('supplier.destroy');
    Route::get('/admin/supplier/{supplier}', [AdminSupplierController::class, 'edit'])->name('supplier.edit');
    Route::post('/supplier/create', [AdminSupplierController::class, 'store'])->name('supplier.create');

    Route::get('/admin/{search?}', [AdminSupplierController::class, 'index'])
        ->where('search', '.*')
        ->name('admin');
});

require __DIR__.'/auth.php';
