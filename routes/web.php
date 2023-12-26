<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Backend\AdminController;
use App\Http\Controllers\Backend\InventoryController;
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
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';


Route::controller(AdminController::class)->group(function(){

    Route::prefix('admin/dashboard')->group(function(){

        Route::get('/', 'AdminDashboard')->name('admin.dashboard');


    }); 


    

    

});


Route::controller(InventoryController::class)->group(function(){
    Route::prefix('/admin/inventory')->group(function(){

        ///////////// --------------- inventory unit routes ----------- ///////////////////
        Route::get('/units', 'ShowUnits')->name('show.units');
        Route::get('/addUnits', 'AddUnits')->name('add.units');
        Route::post('/insertUnits', 'InsertUnits')->name('insert.units');
        Route::get('/editUnits/{id}', 'EditUnits')->name('edit.units');
        Route::put('/updateUnits/{id}', 'UpdateUnits')->name('update.units');
        Route::delete('/deleteUnits/{id}', 'DeleteUnits')->name('delete.units');

        
        ///////////// --------------- inventory suppliers routes ----------- ///////////////////
        Route::get('/suppliers', 'ShowSuppliers')->name('show.suppliers');
        Route::get('/addSuppliers', 'AddSuppliers')->name('add.suppliers');
        Route::post('/insertSuppliers', 'InsertSuppliers')->name('insert.suppliers');
        Route::get('/editSupliers/{id}', 'EditSuppliers')->name('edit.suppliers');
        Route::put('/updateSupliers/{id}', 'UpdateSuppliers')->name('update.suppliers');
        Route::delete('/deleteSupliers/{id}', 'DeleteSuppliers')->name('delete.suppliers');


        ///////////// --------------- inventory manufacturer routes ----------- ///////////////////
        Route::get('/manufacturers', 'ShowManufacturers')->name('show.manufacturers');
        Route::get('/addManufacturers', 'AddManufacturers')->name('add.manufacturers');
        Route::post('/insertManufacturers', 'InsertManufacturers')->name('insert.manufacturers');
        Route::get('/editManufacturers/{id}', 'EditManufacturers')->name('edit.manufacturers');
        Route::put('/updateManufacturers/{id}', 'UpdateManufacturers')->name('update.manufacturers');
        Route::delete('/deleteManufacturers/{id}', 'DeleteManufacturers')->name('delete.manufacturers');
        

        ///////////// --------------- inventory product category routes ----------- ///////////////////
        Route::get('/productCategory', 'ShowProductCategory')->name('show.productCatagory');
        Route::get('/addProductCategory', 'AddProductCategory')->name('add.productCatagory');
        Route::post('/insertProductCategory', 'InsertProductCategory')->name('insert.productCatagory');
        Route::get('/editProductCategory/{id}', 'EditProductCategory')->name('edit.productCatagory');
        Route::put('/updateProductCategory/{id}', 'UpdateProductCategory')->name('update.productCatagory');
        Route::delete('/deleteProductCategory/{id}', 'DeleteProductCategory')->name('delete.productCatagory');



        ///////////// --------------- inventory product Sub Category routes ----------- ///////////////////
        Route::get('/subCategory', 'ShowSubCategory')->name('show.subCatagory');
        Route::get('/addSubCategory', 'AddSubCategory')->name('add.subCatagory');
        // Route::get('/getSubCategory/{category}', 'GetSubCategory')->name('get.subCategory');
        Route::get('/getSubCategory', 'GetSubCategory')->name('get.subCategory');
        Route::post('/insertSubCategory', 'InsertSubCategory')->name('insert.subCatagory');
        Route::get('/editSubCategory/{id}', 'EditSubCategory')->name('edit.subCatagory');
        Route::put('/updateSubCategory/{id}', 'UpdateSubCategory')->name('update.subCatagory');
        Route::delete('/deleteSubCategory/{id}', 'DeleteSubCategory')->name('delete.subCatagory');


        
        ///////////// --------------- inventory products routes ----------- ///////////////////
        Route::get('/products', 'ShowProducts')->name('show.products');
        Route::get('/addProducts', 'AddProducts')->name('add.products');
        Route::post('/insertProducts', 'InsertProducts')->name('insert.products');
        Route::get('/editProducts/{id}', 'EditProducts')->name('edit.products');
        Route::put('/updateProducts/{id}', 'UpdateProducts')->name('update.products');
        Route::delete('/deleteProducts/{id}', 'DeleteProducts')->name('delete.products');

    });

    Route::get('admin/status/{table_name}/{id}/{status}','Status')->name('status');
});

