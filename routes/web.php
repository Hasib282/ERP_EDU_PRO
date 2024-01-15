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
        //crud routes start
        Route::get('/units', 'ShowUnits')->name('show.units');
        Route::post('/insertUnits', 'InsertUnits')->name('insert.units');
        Route::get('/editUnits/{id}', 'EditUnits')->name('edit.units');
        Route::put('/updateUnits/{id}', 'UpdateUnits')->name('update.units');
        Route::delete('/deleteUnits/{id}', 'DeleteUnits')->name('delete.units');
        //search routes start
        Route::get('/searchUnits', 'SearchUnits')->name('search.units');
        //pagination routes start
        Route::get('/unit/pagination', 'UnitPagination');
        Route::get('/unit/searchPagination', 'SearchUnits');
        //search list routs
        Route::get('/getUnitByName', 'GetUnitByName')->name('get.unit.by.name');
        Route::get('/getUnitById', 'GetUnitById')->name('get.unit.by.id');


        
        ///////////// --------------- Inventory Suppliers routes ----------- ///////////////////
        //crud routes start
        Route::get('/suppliers', 'ShowSuppliers')->name('show.suppliers');
        Route::post('/insertSuppliers', 'InsertSuppliers')->name('insert.suppliers');
        Route::get('/editSuppliers/{id}', 'EditSuppliers')->name('edit.suppliers');
        Route::put('/updateSuppliers/{id}', 'UpdateSuppliers')->name('update.suppliers');
        Route::delete('/deleteSuppliers/{id}', 'DeleteSuppliers')->name('delete.suppliers');
        //search routes start
        Route::get('/searchSupplier/name', 'SearchSuppliers')->name('search.supplier.name');
        Route::get('/searchSupplier/email', 'SearchSupplierByEmail')->name('search.supplier.email');
        Route::get('/searchSupplier/contact', 'SearchSupplierByContact')->name('search.supplier.contact');
        Route::get('/searchSupplier/address', 'SearchSupplierByAddress')->name('search.supplier.address');
        //pagination routes start
        Route::get('/supplier/pagination', 'SupplierPagination');
        Route::get('/supplier/namePagination', 'SearchSuppliers');
        Route::get('/supplier/emailPagination', 'SearchSupplierByEmail');
        Route::get('/supplier/contactPagination', 'SearchSupplierByContact');
        Route::get('/supplier/addressPagination', 'SearchSupplierByAddress');
        //search list routs
        Route::get('/getSupplierByName', 'GetSupplierByName')->name('get.supplier.by.name');
        Route::get('/getSupplierById', 'GetSupplierById')->name('get.supplier.by.id');




        ///////////// --------------- Inventory manufacturer routes ----------- ///////////////////
        //crud routes start
        Route::get('/manufacturers', 'ShowManufacturers')->name('show.manufacturers');
        Route::post('/insertManufacturers', 'InsertManufacturers')->name('insert.manufacturers');
        Route::get('/editManufacturers/{id}', 'EditManufacturers')->name('edit.manufacturers');
        Route::put('/updateManufacturers/{id}', 'UpdateManufacturers')->name('update.manufacturers');
        Route::delete('/deleteManufacturers/{id}', 'DeleteManufacturers')->name('delete.manufacturers');
        //search routes start
        Route::get('/searchManufacturer/name', 'SearchManufacturer')->name('search.manufacturers');
        Route::get('/searchManufacturer/email', 'SearchManufacturerByEmail')->name('search.manufacturer.email');
        Route::get('/searchManufacturer/contact', 'SearchManufacturerByContact')->name('search.manufacturer.contact');
        //pagination routes start
        Route::get('/manufacturer/pagination', 'ManufacturerPagination');
        Route::get('/manufacturer/namePagination', 'SearchManufacturer');
        Route::get('/manufacturer/emailPagination', 'SearchManufacturerByEmail');
        Route::get('/manufacturer/contactPagination', 'SearchManufacturerByContact');
        //search list routs
        Route::get('/getManufacturerByName', 'GetManufacturerByName')->name('get.manufacturer.by.name');
        Route::get('/getManufacturerById', 'GetManufacturerById')->name('get.manufacturer.by.id');
        

        

        ///////////// --------------- Inventory product category routes ----------- ///////////////////
        //crud routes start
        Route::get('/productCategory', 'ShowProductCategory')->name('show.productCatagory');
        Route::post('/insertProductCategory', 'InsertProductCategory')->name('insert.productCatagory');
        Route::get('/editProductCategory/{id}', 'EditProductCategory')->name('edit.productCatagory');
        Route::put('/updateProductCategory/{id}', 'UpdateProductCategory')->name('update.productCatagory');
        Route::delete('/deleteProductCategory/{id}', 'DeleteProductCategory')->name('delete.productCatagory');
        //search routes start
        Route::get('/searchProductCategory', 'SearchProductCategory')->name('search.productCategory');
        //pagination routes start
        Route::get('/productCategory/pagination', 'ProductCategoryPagination');
        Route::get('/productCategory/searchPagination', 'SearchProductCategory');
        //search list routs
        Route::get('/getCategoryByName', 'GetCategoryByName')->name('get.category.by.name');
        Route::get('/getCategoryById', 'GetCategoryById')->name('get.category.by.id');




        ///////////// --------------- Inventory product Sub Category routes ----------- ///////////////////
        //crud routes start
        Route::get('/productSubCategory', 'ShowSubCategory')->name('show.subCatagory');
        Route::post('/insertProductSubCategory', 'InsertSubCategory')->name('insert.subCatagory');
        Route::get('/editProductSubCategory/{id}', 'EditSubCategory')->name('edit.subCatagory');
        Route::put('/updateProductSubCategory/{id}', 'UpdateSubCategory')->name('update.subCatagory');
        Route::delete('/deleteProductSubCategory/{id}', 'DeleteSubCategory')->name('delete.subCatagory');
        //search routes start
        Route::get('/searchProductSubCategory/name', 'SearchSubCategory')->name('search.subCategory.name');
        Route::get('/productSubCategory/categoryName', 'SearchSubCategoryByCategoryName')->name('show.subCatagory.category');
        //pagination routes start
        Route::get('/productSubCategory/pagination', 'SubCategoryPagination');
        Route::get('/productSubCategory/namePagination', 'SearchSubCategory');
        Route::get('/productSubCategory/categoryNamePagination', 'SearchSubCategoryByCategoryName');
        //search list routs
        Route::get('/productSubCategoryByCategory', 'GetSubCategoryByCategory')->name('show.subCatagory.by.category');
        Route::get('/getSubCategoryById', 'GetSubCategoryById')->name('show.subCatagory.by.category');




        
        ///////////// --------------- Inventory products routes ----------- ///////////////////
        //crud routes start
        Route::get('/products', 'ShowProducts')->name('show.products');
        Route::post('/insertProducts', 'InsertProducts')->name('insert.products');
        Route::get('/editProducts/{id}', 'EditProducts')->name('edit.products');
        Route::put('/updateProducts/{id}', 'UpdateProducts')->name('update.products');
        Route::delete('/deleteProducts/{id}', 'DeleteProducts')->name('delete.products');
        //search routes start
        Route::get('/searchProduct/name', 'SearchProduct')->name('search.product.name');
        Route::get('/searchProduct/category', 'SearchProductByCategory')->name('search.product.category');
        Route::get('/searchProduct/subCategory', 'SearchProductBySubCategory')->name('search.product.subCategory');
        Route::get('/searchProduct/manufacturer', 'SearchProductByManufacturer')->name('search.products.manufacturer');
        Route::get('/searchProduct/mrp', 'SearchProductByMrp')->name('search.product.mrp');
        //pagination routes start
        Route::get('/product/pagination', 'ProductPagination');
        Route::get('/product/namePagination', 'SearchProduct');
        Route::get('/product/categoryPagination', 'SearchProductByCategory');
        Route::get('/product/subCategoryPagination', 'SearchProductBySubCategory');
        Route::get('/product/manufacturerPagination', 'SearchProductByManufacturer');
        Route::get('/product/mrpPagination', 'SearchProductByMrp');
        //search list routs
        Route::get('/getProductByName', 'GetProductByName')->name('get.product.by.name');
        Route::get('/getProductById/{id}', 'GetProductByID')->name('get.product.by.id');
        



        ///////////// --------------- Inventory Clients routes ----------- ///////////////////
        //crud routes start
        Route::get('/clients', 'ShowClients')->name('show.clients');
        Route::post('/insertClients', 'InsertClients')->name('insert.clients');
        Route::get('/editClients/{id}', 'EditClients')->name('edit.clients');
        Route::put('/updateClients/{id}', 'UpdateClients')->name('update.clients');
        Route::delete('/deleteClients/{id}', 'DeleteClients')->name('delete.clients');
        //search routes start
        Route::get('/searchClient/name', 'SearchClients')->name('search.client.name');
        Route::get('/searchClient/email', 'SearchClientByEmail')->name('search.client.email');
        Route::get('/searchClient/contact', 'SearchClientByContact')->name('search.client.contact');
        Route::get('/searchClient/address', 'SearchClientByAddress')->name('search.client.address');
        //pagination routes start
        Route::get('/client/pagination', 'ClientPagination');
        Route::get('/client/namePagination', 'SearchClients');
        Route::get('/client/emailPagination', 'SearchClientByEmail');
        Route::get('/client/contactPagination', 'SearchClientByContact');
        Route::get('/client/addressPagination', 'SearchClientByAddress');
        //search list routs
        



        ///////////// --------------- Inventory Location routes ----------- ///////////////////
        //crud routes start
        Route::get('/locations', 'ShowLocations')->name('show.locations');
        Route::post('/insertLocations', 'InsertLocations')->name('insert.locations');
        Route::get('/editLocations/{id}', 'EditLocations')->name('edit.locations');
        Route::put('/updateLocations/{id}', 'UpdateLocations')->name('update.locations');
        Route::delete('/deleteLocations/{id}', 'DeleteLocations')->name('delete.locations');
        //search routes start
        Route::get('/searchLocation/division', 'SearchLocations')->name('search.locations');
        Route::get('/searchLocation/district', 'SearchLocationByDistrict')->name('search.location.district');
        Route::get('/searchLocation/city', 'SearchLocationByCity')->name('search.location.city');
        Route::get('/searchLocation/area', 'SearchLocationByArea')->name('search.location.area');
        Route::get('/searchLocation/roadno', 'SearchLocationByRoadno')->name('search.location.roadno');
        //pagination routes start
        Route::get('/location/pagination', 'LocationPagination');
        Route::get('/location/divisionPagination', 'SearchLocations');
        Route::get('/location/districtPagination', 'SearchLocationByDistrict');
        Route::get('/location/cityPagination', 'SearchLocationByCity');
        Route::get('/location/areaPagination', 'SearchLocationByArea');
        Route::get('/location/roadnoPagination', 'SearchLocationByRoadno');
        //search list routs
        Route::get('/getLocationByDivision', 'GetLocationByDivision')->name('get.location.by.division');
        Route::get('/getLocationById', 'GetLocationById')->name('get.location.by.id');



        ///////////// --------------- Inventory Store routes ----------- ///////////////////
        //crud routes start
        Route::get('/stores', 'ShowStores')->name('show.stores');
        Route::post('/insertStores', 'InsertStores')->name('insert.stores');
        Route::get('/editStores/{id}', 'EditStores')->name('edit.stores');
        Route::put('/updateStores/{id}', 'UpdateStores')->name('update.stores');
        Route::delete('/deleteStores/{id}', 'DeleteStores')->name('delete.stores');
        //search routes start
        Route::get('/searchStore/name', 'SearchStores')->name('search.store.name');
        Route::get('/searchStore/location', 'SearchStoreByLocation')->name('search.store.location');
        //pagination routes start
        Route::get('/store/pagination', 'StorePagination');
        Route::get('/store/namePagination', 'SearchStores');
        Route::get('/store/locationPagination', 'SearchStoreByLocation');
        //search list routs



        //////////// -------------- Inventory Receive Details Routes ------------ ///////////////////////
        //crud routes start
        Route::get('/receiveDetails', 'ShowReceiveDetails')->name('show.receive.details');
        Route::post('/insertReceiveDetails', 'InsertReceiveDetails')->name('insert.receive.details');
        Route::get('/editReceiveDetails/{id}', 'EditReceiveDetails')->name('edit.receive.details');
        Route::put('/updateReceiveDetails/{id}', 'UpdateReceiveDetails')->name('update.receive.details');
        Route::delete('/deleteReceiveDetails/{id}', 'DeleteReceiveDetails')->name('delete.receive.details');
        //search routes start
        Route::get('/searchReceiveDetail/supplier', 'SearchReceiveDetailBySupplier')->name('search.receive.details.supplier');
        Route::get('/searchReceiveDetail/invoice', 'SearchReceiveDetailByInvoice')->name('search.receive.details.invoice');
        Route::get('/searchReceiveDetail/batch', 'SearchReceiveDetailByBatch')->name('search.receive.details.batch');
        Route::get('/searchReceiveDetail/cp', 'SearchReceiveDetailByCp')->name('search.receive.details.cp');
        Route::get('/searchReceiveDetail/discount', 'SearchReceiveDetailByDiscount')->name('search.receive.details.discount');
        Route::get('/searchReceiveDetail/expiry', 'SearchReceiveDetailByExpiry')->name('search.receive.details.expiry');
        Route::get('/searchReceiveDetail/product', 'SearchReceiveDetailByProduct')->name('search.receive.details.product');
        //pagination routes start
        Route::get('/receiveDetail/pagination', 'ReceiveDetailPagination');
        Route::get('/receiveDetail/supplierPagination', 'SearchReceiveDetailBySupplier');
        Route::get('/receiveDetail/invoicePagination', 'SearchReceiveDetailByInvoice');
        Route::get('/receiveDetail/batchPagination', 'SearchReceiveDetailByBatch');
        Route::get('/receiveDetail/cpPagination', 'SearchReceiveDetailByCp');
        Route::get('/receiveDetail/discountPagination', 'SearchReceiveDetailByDiscount');
        Route::get('/receiveDetail/expiryPagination', 'SearchReceiveDetailByExpiry');
        Route::get('/receiveDetail/productPagination', 'SearchReceiveDetailByProduct');
        //search list routs




        Route::put('/status','Status')->name('status');

    });

    
});

