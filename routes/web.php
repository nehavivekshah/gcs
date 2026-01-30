<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\backend\HomeController;
use App\Http\Controllers\backend\UserController;
use App\Http\Controllers\backend\ProductController;
use App\Http\Controllers\backend\AmcProductController;
use App\Http\Controllers\backend\AreaController;
use App\Http\Controllers\backend\EngineerController;
use App\Http\Controllers\backend\ManufactureController;
use App\Http\Controllers\backend\ProductAccessoriesController;
use App\Http\Controllers\backend\ProductTypeController;
use App\Http\Controllers\backend\StateController;
use App\Http\Controllers\backend\CityController;
use App\Http\Controllers\backend\UserTypeController;
use App\Http\Controllers\backend\YearController;
use App\Http\Controllers\backend\SupplierController;
use App\Http\Controllers\backend\CustomerController;
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

Route::get('/', function () {
    return redirect()->route('admin.login');
});
Route::get('admin/login', [HomeController::class,'login'])->name('admin.login');
Route::post('admin/usercheck', [HomeController::class,'userCheck'])->name('admin.user.check');
Route::get('admin/logout', [HomeController::class,'Logout'])->name('admin.logout');

Route::get('admin/dashboard', [HomeController::class,'dashboard'])->name('admin.dashboard');

Route::prefix('admin/user')->name('admin.user.')->controller(UserController::class)->group(function(){

    Route::get('/', 'index')->name('index');
    Route::get('/create', 'create')->name('create');
    Route::post('/store', 'store')->name('store');
    Route::get('/{uuid}/edit', 'edit')->name('edit');
    Route::patch('/{uuid}', 'update')->name('update');
    Route::get('/{uuid}', 'destroy')->name('delete');

});


// Amc Product Master 
Route::prefix('admin/amc-product')->name('admin.amc-product.')->controller(AmcProductController::class)->group(function(){

    Route::get('/', 'index')->name('index');
    Route::get('/create', 'create')->name('create');
    Route::post('/store', 'store')->name('store');
    Route::get('/{uuid}/edit', 'edit')->name('edit');
    Route::patch('/{uuid}', 'update')->name('update');
    Route::get('/{uuid}', 'destroy')->name('delete');

});


// Area Master 
Route::prefix('admin/area')->name('admin.area.')->controller(AreaController::class)->group(function(){

    Route::get('/', 'index')->name('index');
    Route::get('/create', 'create')->name('create');
    Route::post('/store', 'store')->name('store');
    Route::get('/{uuid}/edit', 'edit')->name('edit');
    Route::patch('/{uuid}', 'update')->name('update');
    Route::get('/{uuid}', 'destroy')->name('delete');
    Route::post('/state-city', 'getStateCities')->name('state.city');
    Route::post('/city-state', 'getCityStates')->name('city.state');

});

// Engineer Master 
Route::prefix('admin/engineer')->name('admin.engineer.')->controller(EngineerController::class)->group(function(){

    Route::get('/', 'index')->name('index');
    Route::get('/create', 'create')->name('create');
    Route::post('/store', 'store')->name('store');
    Route::get('/{uuid}/edit', 'edit')->name('edit');
    Route::patch('/{uuid}', 'update')->name('update');
    Route::get('/{uuid}', 'destroy')->name('delete');

});

// Product Type Master 
Route::prefix('admin/manufacture')->name('admin.manufacture.')->controller(ManufactureController::class)->group(function(){

    Route::get('/', 'index')->name('index');
    Route::get('/create', 'create')->name('create');
    Route::post('/store', 'store')->name('store');
    Route::get('/{uuid}/edit', 'edit')->name('edit');
    Route::patch('/{uuid}', 'update')->name('update');
    Route::get('/{uuid}', 'destroy')->name('delete');

});

// Product Accessories Master 
Route::prefix('admin/product-accessories')->name('admin.product-accessories.')->controller(ProductAccessoriesController::class)->group(function(){

    Route::get('/', 'index')->name('index');
    Route::get('/create', 'create')->name('create');
    Route::post('/store', 'store')->name('store');
    Route::get('/{uuid}/edit', 'edit')->name('edit');
    Route::patch('/{uuid}', 'update')->name('update');
    Route::get('/{uuid}', 'destroy')->name('delete');

});


// Product Type Master 
Route::prefix('admin/product-type')->name('admin.product-type.')->controller(ProductTypeController::class)->group(function(){

    Route::get('/', 'index')->name('index');
    Route::get('/create', 'create')->name('create');
    Route::post('/store', 'store')->name('store');
    Route::get('/{uuid}/edit', 'edit')->name('edit');
    Route::patch('/{uuid}', 'update')->name('update');
    Route::get('/{uuid}', 'destroy')->name('delete');

});


// State Master 
Route::prefix('admin/state')->name('admin.state.')->controller(StateController::class)->group(function(){

    Route::get('/', 'index')->name('index');
    Route::get('/create', 'create')->name('create');
    Route::post('/store', 'store')->name('store');
    Route::get('/{uuid}/edit', 'edit')->name('edit');
    Route::patch('/{uuid}', 'update')->name('update');
    Route::get('/{uuid}', 'destroy')->name('delete');

});


// City Master 
Route::prefix('admin/city')->name('admin.city.')->controller(CityController::class)->group(function(){

    Route::get('/', 'index')->name('index');
    Route::get('/create', 'create')->name('create');
    Route::post('/store', 'store')->name('store');
    Route::get('/{uuid}/edit', 'edit')->name('edit');
    Route::patch('/{uuid}', 'update')->name('update');
    Route::get('/{uuid}', 'destroy')->name('delete');

});

// Product Type Master 
Route::prefix('admin/user-type')->name('admin.user-type.')->controller(UserTypeController::class)->group(function(){

    Route::get('/', 'index')->name('index');
    Route::get('/create', 'create')->name('create');
    Route::post('/store', 'store')->name('store');
    Route::get('/{uuid}/edit', 'edit')->name('edit');
    Route::patch('/{uuid}', 'update')->name('update');
    Route::get('/{uuid}', 'destroy')->name('delete');

});

// Year Master 
Route::prefix('admin/year')->name('admin.year.')->controller(YearController::class)->group(function(){

    Route::get('/', 'index')->name('index');
    Route::get('/create', 'create')->name('create');
    Route::post('/store', 'store')->name('store');
    Route::get('/{uuid}/edit', 'edit')->name('edit');
    Route::patch('/{uuid}', 'update')->name('update');
    Route::get('/{uuid}', 'destroy')->name('delete');

});

// Product Master 
Route::prefix('admin/product')->name('admin.product.')->controller(ProductController::class)->group(function(){

    Route::get('/', 'index')->name('index');
    Route::get('/create', 'create')->name('create');
    Route::post('/store', 'store')->name('store');
    Route::get('/{uuid}/edit', 'edit')->name('edit');
    Route::patch('/{uuid}', 'update')->name('update');
    Route::get('/{uuid}', 'destroy')->name('delete');
    Route::post('/add-manufacture', 'addManufacture')->name('add.manufacture');
    Route::post('/add-product-type', 'addProductType')->name('add.product.type');
    Route::post('/get-subproduct-type', 'getSubProductType')->name('type.subproduct');

});

// SupplierMaster 
Route::prefix('admin/supplier')->name('admin.supplier.')->controller(SupplierController::class)->group(function(){

    Route::get('/', 'index')->name('index');
    Route::get('/create', 'create')->name('create');
    Route::post('/store', 'store')->name('store');
    Route::get('/{uuid}/edit', 'edit')->name('edit');
    Route::patch('/{uuid}', 'update')->name('update');
    Route::get('/{uuid}', 'destroy')->name('delete');
    Route::post('/area-city', 'getAreaCities')->name('area.city');
    Route::post('/state-city', 'getStateCities')->name('state.city');
    Route::get('/view/{uuid}','view')->name('view');
    Route::post('/add-supplier-branch','addSupplierBranch')->name('add.branch');
    Route::post('/get-supplier-branch', 'getSupplierBranch')->name('get.supplier.branch');
    Route::post('/edit-supplier-branch', 'editSupplierBranch')->name('edit.supplier.branch');
    Route::post('/add-supplier-contact','addSupplierContact')->name('add.contact');
    Route::post('/get-supplier-contact', 'getSupplierContact')->name('get.supplier.contact');
    Route::post('/edit-supplier-contact', 'editSupplierContact')->name('edit.supplier.contact');
    Route::get('/delete-supplier-contact/{uuid}', 'deleteSupplierContact')->name('delete.supplier.contact');
    Route::get('/delete-supplier-branch/{uuid}', 'deleteSupplierBranch')->name('delete.supplier.branch');

});


// Customer Master 
Route::prefix('admin/customer')->name('admin.customer.')->controller(CustomerController::class)->group(function(){

    Route::get('/', 'index')->name('index');
    Route::get('/create', 'create')->name('create');
    Route::post('/store', 'store')->name('store');
    Route::get('/{uuid}/edit', 'edit')->name('edit');
    Route::patch('/{uuid}', 'update')->name('update');
    Route::get('/{uuid}', 'destroy')->name('delete');
    Route::post('/area-city', 'getAreaCities')->name('area.city');
    Route::post('/state-city', 'getStateCities')->name('state.city');
    Route::post('/city-area', 'getCityArea')->name('city.area');
    Route::post('/get-customer-branch', 'getCustomerBranch')->name('get.customer.branch');
    Route::post('/add-customer-branch','addCustomerBranch')->name('add.branch');
    Route::post('/edit-customer-branch', 'editCustomerBranch')->name('edit.customer.branch');

    Route::post('/get-customer-contact', 'getCustomerContact')->name('get.customer.contact');
    Route::post('/add-customer-contact','addCustomerContact')->name('add.contact');
    Route::post('/edit-customer-contact','editCustomerContact')->name('edit.contact');

    Route::get('/customer-amc-product/{uuid}', 'CustomerAmcProduct')->name('amc.product');
    Route::get('/customer-amc-product-list/{customer_id}/{branch_id}/{amc_product_id}', 'getCustomerAmcProduct')->name('amc.product.list');
    Route::post('/add-customer-amc-product', 'addCustomerAmcProduct')->name('add.amc.product');
    Route::post('/edit-customer-amc-product', 'editCustomerAmcProduct')->name('edit.amc.product');
    Route::get('/{uuid}/delete-amc-product', 'DeleteCustomerAmcProduct')->name('delete.amc.product');

    Route::get('/customer-branch-contact/{uuid}', 'CustomerBranchContact')->name('branch.contact');
    Route::post('/add-customer-branch-contact', 'addCustomerBranchContact')->name('add.branch.contact');
});

Route::get('admin/clear-cache', function() {
    Artisan::call('cache:clear');
    Artisan::call('config:cache');
    Artisan::call('view:clear');
    Artisan::call('route:clear');
    return 'DONE';
});


