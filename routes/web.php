<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\OfficerController;
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

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/login', [LoginController::class, 'index']);

Route::get('/dashboard', [AdminController::class, 'index']);

// Officer CRUD
Route::prefix('officer')->group(function () {
    Route::get('/add-officer', [OfficerController::class, 'create']);
    Route::post('/add-officer/store', [OfficerController::class, 'store'])->name('storeOfficer');
    Route::get('/edit-officer/{id}', [OfficerController::class, 'edit']);
    Route::post('/edit-officer/{id}/update', [OfficerController::class, 'update'])->name('updateOfficer');
    Route::delete('/delete/{id}', [OfficerController::class, 'delete'])->name('deleteOfficer');
});

// Warehouse CRUD
Route::prefix('warehouse')->group(function () {
    Route::get('/add-warehouse', [OfficerController::class, 'create']);
    Route::post('/add-warehouse/store', [OfficerController::class, 'store'])->name('storeWarehouse');
    Route::get('/edit-warehouse/{id}', [OfficerController::class, 'edit']);
    Route::post('/edit-warehouse/{id}/update', [OfficerController::class, 'update'])->name('updateWarehouse');
    Route::delete('/delete/{id}', [OfficerController::class, 'delete'])->name('deleteOfficer');
});