<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\BillController;
use App\Http\Controllers\IncomingController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\OfficerController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\StaffController;
use App\Http\Controllers\SupplyController;
use App\Http\Controllers\WarehouseController;
use App\Http\Controllers\WorkController;
use App\Models\BillOfMaterial;
use Illuminate\Support\Facades\Artisan;
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

Route::get('/', [LoginController::class, 'index'])->name('login')->middleware('guest');
Route::post('/', [LoginController::class, 'authentication'])->name('loginAuth')->middleware('guest');

Route::get('/logout', [LoginController::class, 'logout'])->name('logout')->middleware('auth');

Route::get('/dashboard', [AdminController::class, 'index'])->name('dashboard')->middleware('auth');

// User CRUD
Route::prefix('user')->group(function () {
    // Staff
    Route::prefix('staff')->group(function () {
        Route::get('/', [AdminController::class, 'getUserStaff'])->middleware('checkAdmin')->name('staffDashboard');
        Route::get('/edit-user/{id}', [AdminController::class, 'editUserStaff'])->middleware('checkAdmin')->name('editUserStaff');
        Route::post('/edit-user/{id}/update', [AdminController::class, 'updateUserStaff'])->middleware('checkAdmin')->name('updateUserStaff');

        // Search Feature
        Route::post('/search', [SearchController::class, 'searchUserStaff'])->name('searchUserStaff');
    });

    // Gudang
    Route::prefix('warehouse')->group(function () {
        Route::get('/', [AdminController::class, 'getUserWarehouse'])->middleware('checkAdmin')->name('warehouseDashboard');
        Route::get('/edit-user/{id}', [AdminController::class, 'editUserWarehouse'])->middleware('checkAdmin')->name('editUserWarehouse');
        Route::post('/edit-user/{id}/update', [AdminController::class, 'updateUserWarehouse'])->middleware('checkAdmin')->name('updateUserWarehouse');

        // Search Feature
        Route::post('/search', [SearchController::class, 'searchUserWarehouse'])->name('searchUserWarehouse');
    });
});

// Officer CRUD
Route::prefix('officer')->group(function () {
    Route::get('/', [OfficerController::class, 'index'])->middleware('checkAdmin')->name('officerDashboard');
    Route::get('/get-officer/{id}', [OfficerController::class, 'getOfficer'])->middleware('checkAdmin')->name('getOfficer');
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
    Route::get('/', [WarehouseController::class, 'index'])->name('dashboardWarehouse')->middleware('checkAdminWarehouse');
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
    Route::get('/', [ProductController::class, 'index'])->middleware('checkAdminStaff')->name('productDashboard');
    Route::get('/add-product', [ProductController::class, 'create'])->name('addProduct')->middleware('checkAdminStaff');
    Route::post('/add-product/store', [ProductController::class, 'store'])->name('storeProduct')->middleware('checkAdminStaff');
    Route::get('/edit-product/{id}', [ProductController::class, 'edit'])->name('editProduct')->middleware('checkAdminStaff');
    Route::post('/edit-product/{id}/update', [ProductController::class, 'update'])->name('updateProduct')->middleware('checkAdminStaff');
    Route::delete('/delete/{id}', [ProductController::class, 'delete'])->name('deleteProduct')->middleware('checkAdminStaff');

    Route::post('/print-pdf', [ProductController::class, 'printPDF'])->name('printProduct')->middleware('checkAdminStaff');

    // Search Feature
    Route::post('/search', [SearchController::class, 'searchProduct'])->name('searchProduct');
});

// Incoming Goods CRUD
Route::prefix('incoming')->group(function () {
    Route::get('/', [IncomingController::class, 'index'])->name('incomingDashboard')->middleware('checkAdminWarehouse');
    Route::get('/add-incoming', [IncomingController::class, 'create'])->name('addIncoming')->middleware('checkAdminWarehouse');
    Route::post('/add-incoming/store', [IncomingController::class, 'store'])->name('storeIncoming')->middleware('checkAdminWarehouse');
    Route::get('/edit-incoming/{id}', [IncomingController::class, 'edit'])->name('editIncoming')->middleware('checkAdminWarehouse');
    Route::post('/edit-incoming/{id}/update', [IncomingController::class, 'update'])->name('updateIncoming')->middleware('checkAdminWarehouse');

    Route::post('/print-pdf', [IncomingController::class, 'printPDF'])->name('printIncoming')->middleware('checkAdminWarehouse');

    // Search Feature
    Route::post('/search', [SearchController::class, 'searchIncoming'])->name('searchIncoming');
});

// Supply CRUD
Route::prefix('supply')->group(function () {
    Route::get('/', [SupplyController::class, 'index'])->name('supplyDashboard')->middleware('checkAdminStaff');
    Route::get('/add-supply', [SupplyController::class, 'create'])->name('addSupply')->middleware('checkAdmin');
    Route::post('/add-supply/store', [SupplyController::class, 'store'])->name('storeSupply')->middleware('checkAdmin');
    Route::get('/edit-supply/{id}', [SupplyController::class, 'edit'])->name('editSupply')->middleware('checkAdmin');
    Route::post('/edit-supply/{id}/update', [SupplyController::class, 'update'])->name('updateSupply')->middleware('checkAdmin');
    Route::delete('/delete/{id}', [SupplyController::class, 'delete'])->name('deleteSupply')->middleware('checkAdmin');

    Route::post('/print-pdf', [SupplyController::class, 'printPDF'])->name('printSupply')->middleware('checkAdmin');

    // Search Feature
    Route::post('/search', [SearchController::class, 'searchSupply'])->name('searchSupply');
});

// Bill Of Materials CRUD
Route::prefix('bill-of-materials')->group(function () {
    Route::get('/', [BillController::class, 'index'])->name('billDashboard')->middleware('checkAdminStaff');
    Route::get('/add-bill-of-materials', [BillController::class, 'create'])->name('addBill')->middleware('checkAdminStaff');
    Route::post('/add-bill-of-materials/store', [BillController::class, 'store'])->name('storeBill')->middleware('checkAdminStaff');
    Route::get('/edit-bill-of-materials/{id}', [BillController::class, 'edit'])->name('editBill')->middleware('checkAdminStaff');
    Route::post('/edit-bill-of-materials/{id}/update', [BillController::class, 'update'])->name('updateBill')->middleware('checkAdminStaff');
    Route::delete('/delete/{id}', [BillController::class, 'delete'])->name('deleteBill')->middleware('checkAdminStaff');
    Route::get('/delete-bill-of-materials-supply/{id}', [BillController::class, 'deleteSupply'])->name('deleteBillSupply')->middleware('checkAdminStaff');

    Route::post('/print-pdf', [BillOfMaterial::class, 'printPDF'])->name('printBOM')->middleware('checkAdminStaff');

    // Search Feature
    Route::post('/search', [SearchController::class, 'searchBill'])->name('searchBill');
});

// Work Order CRUD
Route::prefix('work-order')->group(function () {
    Route::get('/', [WorkController::class, 'index'])->name('workDashboard')->middleware('checkAdminStaff');
    Route::get('/add-work-order', [WorkController::class, 'create'])->name('addWork')->middleware('checkAdminStaff');
    Route::post('/add-work-order/store', [WorkController::class, 'store'])->name('storeWork')->middleware('checkAdminStaff');
    Route::get('/edit-work-order/{id}', [WorkController::class, 'edit'])->name('editWork')->middleware('checkAdminStaff');
    Route::post('/edit-work-order/{id}/update', [WorkController::class, 'update'])->name('updateWork')->middleware('checkAdminStaff');
    Route::delete('/delete/{id}', [WorkController::class, 'delete'])->name('deleteWork')->middleware('checkAdminStaff');

    Route::post('/print-pdf', [WorkController::class, 'printPDF'])->name('printWork')->middleware('checkAdminStaff');

    // Search Feature
    Route::post('/search', [SearchController::class, 'searchWork'])->name('searchWork');
});


Route::get('/storage-link', function () {
   $command = 'php artisan storage:link';
    $output = null;
    $status = null;
    exec($command, $output, $status);
    
    if ($status === 0) {
        return 'Storage link created successfully!';
    } else {
        return 'Failed to create storage link.';
    }
});
