<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\User\ManagerController;
use App\Http\Controllers\User\SupplierController;
use App\Http\Controllers\Admin\SupplierController as AdminSupplierController;
use App\Http\Controllers\Admin\ManagerController as AdminManagerController;
use App\Http\Controllers\Admin\CriteriaController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\User\SupplierReviewController;
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


    Route::get('/admin/manager/{manager}', [AdminManagerController::class, 'edit'])->name('admin.manager.edit');
    Route::post('/admin/manager', [AdminManagerController::class, 'store'])->name('admin.manager.store');
    Route::put('/admin/manager/{manager}', [AdminManagerController::class, 'update'])->name('admin.manager.update');
    Route::delete('/admin/manager/{manager}', [AdminManagerController::class, 'destroy'])->name('admin.manager.destroy');

    Route::get('/admin/managers/{search?}', [AdminManagerController::class, 'index'])
    ->where('search', '.*')
    ->name('admin.manager.index');

    Route::get('/admin/users/{user}/edit', [UserController::class, 'edit'])->name('admin.users.edit');
    Route::post('/admin/users', [UserController::class, 'store'])->name('admin.users.store');
    Route::put('/admin/users/{user}', [UserController::class, 'update'])->name('admin.users.update');
    Route::delete('/admin/users/{user}', [UserController::class, 'destroy'])->name('admin.users.destroy');

    Route::get('/admin/users/{search?}', [UserController::class, 'index'])->name('admin.users.index');


    Route::get('/admin/criteria', [CriteriaController::class, 'edit'])->name('admin.criteria.edit');
    Route::put('/admin/criteria/{criteria}', [CriteriaController::class, 'update'])->name('admin.criteria.update');

    Route::post('/admin/supplier-review', [SupplierReviewController::class, 'store'])->name('supplier-review.store');

    Route::get('/admin/{search?}', [AdminSupplierController::class, 'index'])
    ->where('search', '.*')
    ->name('admin');
});

require __DIR__ . '/auth.php';
