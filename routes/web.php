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

        ///////////// --------------- Inventory Unit routes ----------- ///////////////////
        Route::get('/units', 'ShowUnits')->name('show.units');
        Route::post('/insertUnits', 'InsertUnits')->name('insert.units');
        Route::get('/editUnits/{id}', 'EditUnits')->name('edit.units');
        Route::put('/updateUnits/{id}', 'UpdateUnits')->name('update.units');
        Route::delete('/deleteUnits/{id}', 'DeleteUnits')->name('delete.units');
        Route::get('/searchUnits', 'SearchUnits')->name('search.units');
        Route::get('/unit/pagination', 'UnitPagination');
        Route::get('/unit/searchPagination', 'SearchUnits');
        

        
        ///////////// --------------- Inventory Suppliers routes ----------- ///////////////////
        Route::get('/suppliers', 'ShowSuppliers')->name('show.suppliers');
        Route::post('/insertSuppliers', 'InsertSuppliers')->name('insert.suppliers');
        Route::get('/editSuppliers/{id}', 'EditSuppliers')->name('edit.suppliers');
        Route::put('/updateSuppliers/{id}', 'UpdateSuppliers')->name('update.suppliers');
        Route::delete('/deleteSuppliers/{id}', 'DeleteSuppliers')->name('delete.suppliers');
        Route::get('/searchSuppliers', 'SearchSuppliers')->name('search.suppliers');
        Route::get('/supplier/pagination', 'SupplierPagination');
        Route::get('/supplier/searchPagination', 'SearchSuppliers');



        ///////////// --------------- Inventory manufacturer routes ----------- ///////////////////
        Route::get('/manufacturers', 'ShowManufacturers')->name('show.manufacturers');
        Route::post('/insertManufacturers', 'InsertManufacturers')->name('insert.manufacturers');
        Route::get('/editManufacturers/{id}', 'EditManufacturers')->name('edit.manufacturers');
        Route::put('/updateManufacturers/{id}', 'UpdateManufacturers')->name('update.manufacturers');
        Route::delete('/deleteManufacturers/{id}', 'DeleteManufacturers')->name('delete.manufacturers');
        Route::get('/searchManufacturers', 'SearchManufacturer')->name('search.manufacturers');
        Route::get('/manufacturer/pagination', 'ManufacturerPagination');
        Route::get('/manufacturer/searchPagination', 'SearchManufacturer');

        

        ///////////// --------------- Inventory product category routes ----------- ///////////////////
        Route::get('/productCategory', 'ShowProductCategory')->name('show.productCatagory');
        Route::post('/insertProductCategory', 'InsertProductCategory')->name('insert.productCatagory');
        Route::get('/editProductCategory/{id}', 'EditProductCategory')->name('edit.productCatagory');
        Route::put('/updateProductCategory/{id}', 'UpdateProductCategory')->name('update.productCatagory');
        Route::delete('/deleteProductCategory/{id}', 'DeleteProductCategory')->name('delete.productCatagory');
        Route::get('/searchProductCategory', 'SearchProductCategory')->name('search.productCategory');
        Route::get('/productCategory/pagination', 'ProductCategoryPagination');
        Route::get('/productCategory/searchPagination', 'SearchProductCategory');



        ///////////// --------------- Inventory product Sub Category routes ----------- ///////////////////
        Route::get('/productSubCategory', 'ShowSubCategory')->name('show.subCatagory');
        Route::get('/productSubCategoryByCategory/{category}', 'ShowSubCategoryByCategory')->name('show.subCatagory.by.category');
        Route::post('/insertProductSubCategory', 'InsertSubCategory')->name('insert.subCatagory');
        Route::get('/editProductSubCategory/{id}', 'EditSubCategory')->name('edit.subCatagory');
        Route::put('/updateProductSubCategory/{id}', 'UpdateSubCategory')->name('update.subCatagory');
        Route::delete('/deleteProductSubCategory/{id}', 'DeleteSubCategory')->name('delete.subCatagory');
        Route::get('/searchProductSubCategory', 'SearchSubCategory')->name('search.subCategory');
        Route::get('/productSubCategory/pagination', 'SubCategoryPagination');
        Route::get('/productSubCategory/searchPagination', 'SearchSubCategory');


        
        ///////////// --------------- Inventory products routes ----------- ///////////////////
        Route::get('/products', 'ShowProducts')->name('show.products');
        Route::get('/getProductById/{id}', 'GetProductByID')->name('get.product.by.id');
        Route::post('/insertProducts', 'InsertProducts')->name('insert.products');
        Route::get('/editProducts/{id}', 'EditProducts')->name('edit.products');
        Route::put('/updateProducts/{id}', 'UpdateProducts')->name('update.products');
        Route::delete('/deleteProducts/{id}', 'DeleteProducts')->name('delete.products');
        Route::get('/searchProducts', 'SearchProduct')->name('search.products');
        Route::get('/product/pagination', 'ProductPagination');
        Route::get('/product/searchPagination', 'SearchProduct');
        Route::get('/getProductByName', 'GetProductByName')->name('get.product.by.name');



        ///////////// --------------- Inventory Clients routes ----------- ///////////////////
        Route::get('/clients', 'ShowClients')->name('show.clients');
        Route::post('/insertClients', 'InsertClients')->name('insert.clients');
        Route::get('/editClients/{id}', 'EditClients')->name('edit.clients');
        Route::put('/updateClients/{id}', 'UpdateClients')->name('update.clients');
        Route::delete('/deleteClients/{id}', 'DeleteClients')->name('delete.clients');
        Route::get('/searchClients', 'SearchClients')->name('search.clients');
        Route::get('/client/pagination', 'ClientPagination');
        Route::get('/client/searchPagination', 'SearchClients');



        ///////////// --------------- Inventory Location routes ----------- ///////////////////
        Route::get('/locations', 'ShowLocations')->name('show.locations');
        Route::post('/insertLocations', 'InsertLocations')->name('insert.locations');
        Route::get('/editLocations/{id}', 'EditLocations')->name('edit.locations');
        Route::put('/updateLocations/{id}', 'UpdateLocations')->name('update.locations');
        Route::delete('/deleteLocations/{id}', 'DeleteLocations')->name('delete.locations');
        Route::get('/searchLocations', 'SearchLocations')->name('search.locations');
        Route::get('/location/pagination', 'LocationPagination');
        Route::get('/location/searchPagination', 'SearchLocations');



        ///////////// --------------- Inventory Store routes ----------- ///////////////////
        Route::get('/stores', 'ShowStores')->name('show.stores');
        Route::post('/insertStores', 'InsertStores')->name('insert.stores');
        Route::get('/editStores/{id}', 'EditStores')->name('edit.stores');
        Route::put('/updateStores/{id}', 'UpdateStores')->name('update.stores');
        Route::delete('/deleteStores/{id}', 'DeleteStores')->name('delete.stores');
        Route::get('/searchStores', 'SearchStores')->name('search.stores');
        Route::get('/store/pagination', 'StorePagination');
        Route::get('/store/searchPagination', 'SearchStores');
        

        //////////// -------------- Inventory Receive Details Routes ------------ ///////////////////////
        Route::get('/receiveDetails', 'ShowReceiveDetails')->name('show.receive.details');
        Route::post('/insertReceiveDetails', 'InsertReceiveDetails')->name('insert.receive.details');
        Route::get('/editReceiveDetails/{id}', 'EditReceiveDetails')->name('edit.receive.details');
        Route::put('/updateReceiveDetails/{id}', 'UpdateReceiveDetails')->name('update.receive.details');
        Route::delete('/deleteReceiveDetails/{id}', 'DeleteReceiveDetails')->name('delete.receive.details');
        Route::get('/searchReceiveDetails', 'SearchReceiveDetails')->name('search.receive.details');
        Route::get('/receiveDetail/pagination', 'ReceiveDetailPagination');
        Route::get('/receiveDetail/searchPagination', 'SearchReceiveDetails');


    });

    Route::get('admin/status/{table_name}/{id}/{status}','Status')->name('status');
});

