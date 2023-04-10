<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\OfficerController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\StaffController;
use App\Http\Controllers\WarehouseController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/login', [LoginController::class, 'index'])->name('login')->middleware('guest');
Route::post('/login', [LoginController::class, 'authentication'])->name('loginAuth')->middleware('guest');

Route::get('/logout',[LoginController::class, 'logout'])->name('logout');

Route::get('/dashboard', [AdminController::class, 'index'])->name('dashboard')->middleware('checkAdmin');

// User CRUD
Route::prefix('user')->group(function () {
    // Staff
    Route::prefix('staff')->group(function () {
        Route::get('/', [AdminController::class, 'getUserStaff'])->middleware('checkAdmin')->name('staffDashboard');
        Route::get('/edit-user/{id}', [AdminController::class, 'editUserStaff'])->name('editUserStaff');
        Route::post('/edit-user/{id}/update', [AdminController::class, 'updateUserStaff'])->name('updateUserStaff');
    });
   
    // Gudang
    Route::prefix('warehouse')->group(function () {
        Route::get('/', [AdminController::class, 'getUserWarehouse'])->middleware('checkAdmin')->name('warehouseDashboard');
        Route::get('/edit-user/{id}', [AdminController::class, 'editUserWarehouse'])->name('editUserWarehouse');
        Route::post('/edit-user/{id}/update', [AdminController::class, 'updateUserWarehouse'])->name('updateUserWarehouse');
    });
});

// Officer CRUD
Route::prefix('officer')->group(function () {
    Route::get('/', [OfficerController::class, 'index'])->middleware('checkAdmin')->name('officerDashboard');
    Route::get('/get-officer', [OfficerController::class, 'getOfficer'])->middleware('checkAdmin')->name('getOfficer');
    Route::get('/add-officer', [OfficerController::class, 'create'])->name('addOfficer')->middleware('checkAdmin');
    Route::post('/add-officer/store', [OfficerController::class, 'store'])->name('storeOfficer')->middleware('checkAdmin');
    Route::get('/edit-officer/{id}', [OfficerController::class, 'edit'])->name('editOfficer')->middleware('checkAdmin');
    Route::post('/edit-officer/{id}/update', [OfficerController::class, 'update'])->name('updateOfficer')->middleware('checkAdmin');
    Route::delete('/delete/{id}', [OfficerController::class, 'delete'])->name('deleteOfficer')->middleware('checkAdmin');

    // Search Feature
    Route::post('/search', [SearchController::class, 'searchOfficer'])->name('searchOfficer');
});

// Warehouse CRUD
Route::prefix('warehouse')->group(function () {
    Route::get('/', [WarehouseController::class, 'index'])->name('dashboardWarehouse');
    Route::get('/add-warehouse', [WarehouseController::class, 'create'])->name('addWarehouse')->middleware('checkAdmin');
    Route::post('/add-warehouse/store', [WarehouseController::class, 'store'])->name('storeWarehouse')->middleware('checkAdmin');
    Route::get('/edit-warehouse/{id}', [WarehouseController::class, 'edit'])->name('editWarehouse')->middleware('checkAdmin');
    Route::post('/edit-warehouse/{id}/update', [WarehouseController::class, 'update'])->name('updateWarehouse')->middleware('checkAdmin');
    Route::delete('/delete/{id}', [WarehouseController::class, 'delete'])->name('deleteWarehouse')->middleware('checkAdmin');

    // Search Feature
    Route::post('/search', [SearchController::class, 'searchWarehouse'])->name('searchWarehouse');
});

// Product CRUD
Route::prefix('product')->group(function () {
    Route::get('/add-product', [ProductController::class, 'create'])->middleware('checkAdmin');
    Route::post('/add-product/store', [ProductController::class, 'store'])->name('storeProduct')->middleware('checkAdmin');
    Route::get('/edit-product/{id}', [ProductController::class, 'edit'])->name('editProduct')->middleware('checkAdmin');
    Route::post('/edit-product/{id}/update', [ProductController::class, 'update'])->name('updateProduct')->middleware('checkAdmin');
    Route::delete('/delete/{id}', [ProductController::class, 'delete'])->name('deleteProduct')->middleware('checkAdmin');
});