<?php

namespace App\Http\Controllers\Backend;

use Carbon\Carbon;
use App\Models\Inv_Unit;
use App\Models\user_info;
use App\Models\Inv_Product;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Models\Inv_Supplier_Info;
use App\Http\Controllers\Controller;
use App\Models\Inv_Product_Category;
use App\Models\Inv_Manufacturer_info;
use App\Models\Inv_Product_Sub_Category;
use App\Models\Inv_Client_Info;
use App\Models\Inv_Location;
use App\Models\Inv_Store;

class InventoryController extends Controller
{
    /////////////////////////// --------------- Inventory Units Methods start ---------- //////////////////////////
    //Show Units
    public function ShowUnits(){
        $inv_unit = Inv_Unit::orderBy('added_at','desc')->paginate(5);
        return view('inventory.unit.units', compact('inv_unit'));
    }//End Method


    //Insert Unit
    public function InsertUnits(Request $request){
        $request->validate([
            "unitName" => 'required|unique:inv__units,unit_name'
        ]);

        Inv_Unit::insert([
            "unit_name" => $request->unitName,
        ]);
        return response()->json([
            'status'=>'success',
        ]);  
    }//End Method


    //Edit Unit
    public function EditUnits($id){
        $inv_unit = Inv_Unit::findOrFail($id);
        return response()->json([
            'inv_unit'=>$inv_unit,
        ]);
    }//End Method



    //Update Unit
    public function UpdateUnits(Request $request,$id){
        $inv_unit = Inv_Unit::findOrFail($id);

        $request->validate([
            "unitName" => ['required',Rule::unique('inv__units', 'unit_name')->ignore($inv_unit->id)],
            "status"=>'required|in:0,1'
        ]);

        $update = Inv_Unit::findOrFail($id)->update([
            "unit_name" => $request->unitName,
            "status" => $request->status,
            "updated_at" => now()
        ]);
        if($update){
            return response()->json([
                'status'=>'success'
            ]); 
        }
    }//End Method



    //Delete Units
    public function DeleteUnits($id){
        Inv_Unit::findOrFail($id)->delete();
        return response()->json([
            'status'=>'success'
        ]); 
    }//End Method


    public function UnitPagination(){
        $inv_unit = Inv_Unit::orderBy('added_at','desc')->paginate(5);
        return view('inventory.unit.unitPagination', compact('inv_unit'))->render();
    }//End Method



    public function SearchUnit(Request $request){
        $inv_unit = Inv_Unit::where('unit_name', 'like', '%'.$request->search.'%')
        ->orWhere('id', 'like','%'.$request->search.'%')
        ->orderBy('id','desc')
        ->paginate(5);
        
        if($inv_unit->count() >= 1){
            return response()->json([
                'status' => 'success',
                'pagination' => $inv_unit->links()->toHtml(),
                'data' => view('inventory.unit.unitPagination', compact('inv_unit'))->render(),
            ]);
        }
        else{
            return response()->json([
                'status'=>'null'
            ]); 
        }
        
    }//End Method

    /////////////////////////// --------------- Inventory Units Methods end ---------- //////////////////////////


    /////////////////////////// --------------- Inventory Suppliers Methods start---------- //////////////////////////

    public function ShowSuppliers(){
        $user_info = User_Info::get();
        $inv_supplier = Inv_Supplier_Info::orderBy('added_at','desc')->paginate(5);
        return view('inventory.supplier.suppliers', compact('inv_supplier','user_info'));
    }//End Method


    //Insert Supplier
    public function InsertSuppliers(Request $request){
        $request->validate([
            "supplierName" => 'required|unique:inv__supplier__infos,sup_name',
            "supplierEmail" => 'required|email|unique:inv__supplier__infos,sup_email',
            "supplierContact" => 'required|numeric|unique:inv__supplier__infos,sup_contact',
            "user" => 'required',
        ]);
        
        Inv_Supplier_info::insert([
            "sup_name" => $request->supplierName,
            "sup_email" => $request->supplierEmail,
            "sup_contact" => $request->supplierContact,
            "user_id" => $request->user,
        ]);

        return response()->json([
            'status'=>'success',
        ]); 
    }//End Method



    //Edit Supplier
    public function EditSuppliers($id){
        $inv_supplier = Inv_Supplier_info::findOrFail($id);
        $user_info = User_Info::get();
        return response()->json([
            'inv_supplier'=>$inv_supplier,
            'user_info'=>$user_info,
        ]);
    }//End Method



    //Update Suppliers
    public function UpdateSuppliers(Request $request,$id){
        $inv_suplier = Inv_Supplier_info::findOrFail($id);

        $request->validate([
            "supplierName" => 'required',
            "supplierEmail" => 'required',
            "supplierContact" => 'required',
            "user" => 'required',
            "status" => 'required'
        ]);

        $request->validate([
            "supplierName" => ['required',Rule::unique('inv__supplier__infos', 'sup_name')->ignore($inv_suplier->id)],
            "supplierEmail" => ['required','email',Rule::unique('inv__supplier__infos', 'sup_email')->ignore($inv_suplier->id)],
            "supplierContact" => ['required','numeric',Rule::unique('inv__supplier__infos', 'sup_email')->ignore($inv_suplier->id)],
            "user" => 'required',
            'status' => 'required'
        ]);

        $update = Inv_Supplier_info::findOrFail($id)->update([
            "sup_name" => $request->supplierName,
            "sup_email" => $request->supplierEmail,
            "sup_contact" => $request->supplierContact,
            "user_id" => $request->user,
            "status" => $request->status,
            "updated_at" => now()
        ]);
        if($update){
            return response()->json([
                'status'=>'success'
            ]); 
        }
    }//End Method



    //Delete Supplier
    public function DeleteSuppliers($id){
        Inv_Supplier_Info::findOrFail($id)->delete();
        return response()->json([
            'status'=>'success'
        ]); 
    }//End Method


    public function SupplierPagination(){
        $user_info = User_Info::get();
        $inv_supplier = Inv_Supplier_Info::orderBy('added_at','desc')->paginate(5);
        return view('inventory.supplier.supplierPagination', compact('inv_supplier','user_info'))->render();
    }//End Method


    public function SearchSupplier(Request $request){
        $user_info = User_Info::get();
        $inv_supplier = Inv_Supplier_Info::where('id', 'like', '%'.$request->search.'%')
        ->orWhere('sup_name', 'like','%'.$request->search.'%')
        ->orWhere('sup_email', 'like','%'.$request->search.'%')
        ->orWhere('sup_contact', 'like','%'.$request->search.'%')
        ->orderBy('id','desc')
        ->paginate(5);
        
        if($inv_supplier->count() >= 1){
            return response()->json([
                'status' => 'success',
                'pagination' => $inv_supplier->links()->toHtml(),
                'data' => view('inventory.supplier.supplierPagination', compact('inv_supplier','user_info'))->render(),
            ]);
        }
        else{
            return response()->json([
                'status'=>'null'
            ]); 
        }
        
    }//End Method

    /////////////////////////// --------------- Inventory Suppliers Methods start---------- //////////////////////////



    /////////////////////////// --------------- Inventory Manufacturers Methods start---------- //////////////////////////

    public function ShowManufacturers(){
        $user_info = User_Info::get();
        $inv_manufacturer = Inv_Manufacturer_Info::orderBy('added_at','desc')->paginate(5);
        return view('inventory.manufacturer.manufacturers', compact('inv_manufacturer','user_info'));
    }//End Method



    //Insert Manufacturer
    public function InsertManufacturers(Request $request){
        $request->validate([
            "manufacturerName" => 'required|unique:inv__manufacturer__infos,manufacturer_name',
            "manufacturerEmail" => 'required|email|unique:inv__manufacturer__infos,manufacturer_email',
            "manufacturerContact" => 'required|numeric|unique:inv__manufacturer__infos,manufacturer_contact',
            "user" => 'required',
        ]);

        $inv_manufacturer = Inv_Manufacturer_info::insert([
            "manufacturer_name" => $request->manufacturerName,
            "manufacturer_email" => $request->manufacturerEmail,
            "manufacturer_contact" => $request->manufacturerContact,
            "user_id" => $request->user,
        ]);
        
        if($inv_manufacturer){
            return response()->json([
                'status'=>'success',
            ]); 
        } 
    }//End Method



    //Edit Manufacturer
    public function EditManufacturers($id){
        $inv_manufacturer = Inv_Manufacturer_info::findOrFail($id);
        $user_info = User_Info::get();
        return response()->json([
            'inv_manufacturer'=>$inv_manufacturer,
            'user_info'=>$user_info,
        ]);
    }//End Method




    //Update Manufacturer
    public function UpdateManufacturers(Request $request,$id){
        $inv_manufacturer = Inv_Manufacturer_info::findOrFail($id);

        $request->validate([
            "manufacturerName" => ['required',Rule::unique('inv__manufacturer__infos', 'manufacturer_name')->ignore($inv_manufacturer->id)],
            "manufacturerEmail" => ['required','email',Rule::unique('inv__manufacturer__infos', 'manufacturer_email')->ignore($inv_manufacturer->id)],
            "manufacturerContact" => ['required','numeric',Rule::unique('inv__manufacturer__infos', 'manufacturer_email')->ignore($inv_manufacturer->id)],
            "user" => 'required',
            'status' => 'required'
        ]);


        $update = Inv_Manufacturer_info::findOrFail($id)->update([
            "manufacturer_name" => $request->manufacturerName,
            "manufacturer_email" => $request->manufacturerEmail,
            "manufacturer_contact" => $request->manufacturerContact,
            "user_id" => $request->user,
            "status" => $request->status,
            "updated_at" => now()
        ]);
        if($update){
            return response()->json([
                'status'=>'success'
            ]); 
        } 
    }//End Method




    //Delete Manufacturers
    public function DeleteManufacturers($id){
        Inv_Manufacturer_Info::findOrFail($id)->delete();
        return response()->json([
            'status'=>'success'
        ]); 
    }//End Method



    //Manufacturer Pagination
    public function ManufacturerPagination(){
        $user_info = User_Info::get();
        $inv_manufacturer = Inv_Manufacturer_Info::orderBy('added_at','desc')->paginate(5);
        return view('inventory.manufacturer.manufacturerPagination', compact('inv_manufacturer','user_info'))->render();
    }//End Method



    //Manufacturer Search
    public function SearchManufacturer(Request $request){
        $inv_manufacturer = Inv_Manufacturer_Info::where('manufacturer_name', 'like', '%'.$request->search.'%')
        ->orWhere('id', 'like','%'.$request->search.'%')
        ->orderBy('id','desc')
        ->paginate(5);
        
        if($inv_manufacturer->count() >= 1){
            return response()->json([
                'status' => 'success',
                'pagination' => $inv_manufacturer->links()->toHtml(),
                'data' => view('inventory.manufacturer.manufacturerPagination', compact('inv_manufacturer'))->render(),
            ]);
        }
        else{
            return response()->json([
                'status'=>'null'
            ]); 
        }
    }//End Method

    /////////////////////////// --------------- Inventory Manufacturers Methods end---------- //////////////////////////








    /////////////////////////// --------------- Inventory Product Categorys Methods start---------- //////////////////////////
    
    public function ShowProductCategory(){
        $inv_product_category = Inv_Product_Category::orderBy('added_at','desc')->paginate(5);;
        return view('inventory.product_category.productCategory', compact('inv_product_category'));
    }//End Method


    //Insert Products
    public function InsertProductCategory(Request $request){
        $request->validate([
            "categoryName" => 'required|unique:inv__product__categories,product_category_name'
        ]);

        $inv_product_category = Inv_Product_Category::insert([
            "product_category_name" => $request->categoryName,
        ]);
        if($inv_product_category){
            return response()->json([
                'status'=>'success',
            ]); 
        }
         
    }//End Method



    //Edit Product Category
    public function EditProductCategory($id){
        $inv_product_category = Inv_Product_Category::findOrFail($id);
        return response()->json([
            'inv_product_category'=>$inv_product_category,
        ]);
    }//End Method


    //Update Product Category
    public function UpdateProductCategory(Request $request,$id){
        $inv_product_category = Inv_Product_Category::findOrFail($id);

        $request->validate([
            "categoryName" => ['required',Rule::unique('inv__product__categories', 'product_category_name')->ignore($inv_product_category->id)],
            "status"=>'required|in:0,1'
        ]);

        $update = Inv_Product_Category::findOrFail($id)->update([
            "product_category_name" => $request->categoryName,
            "status" => $request->status,
            "updated_at" => now()
        ]);
        if($update){
            return response()->json([
                'status'=>'success'
            ]); 
        }
    }//End Method


    //Delete Product Category
    public function DeleteProductCategory($id){
        Inv_Product_Category::findOrFail($id)->delete();
        return response()->json([
            'status'=>'success'
        ]); 
    }//End Method


    //product Category Pagination
    public function ProductCategoryPagination(){
        $inv_product_category = Inv_Product_Category::orderBy('added_at','desc')->paginate(5);
        return view('inventory.product_category.productCategoryPagination', compact('inv_product_category'))->render();
    }//End Method


    //product category Search
    public function SearchProductCategory(Request $request){
        $inv_product_category = Inv_Product_Category::where('product_category_name', 'like', '%'.$request->search.'%')
        ->orWhere('id', 'like','%'.$request->search.'%')
        ->orderBy('id','desc')
        ->paginate(5);
        
        if($inv_product_category->count() >= 1){
            return response()->json([
                'status' => 'success',
                'pagination' => $inv_product_category->links()->toHtml(),
                'data' => view('inventory.product_category.productCategoryPagination', compact('inv_product_category'))->render(),
            ]);
        }
        else{
            return response()->json([
                'status'=>'null'
            ]); 
        }
    }//End Method
    
    /////////////////////////// --------------- Inventory Product Categorys Methods end---------- //////////////////////////











    /////////////////////////// --------------- Inventory Product Sub Categorys Methods start---------- //////////////////////////
    
    
    //Show Product Sub Categories
    public function ShowSubCategory(){
        $inv_product_category = Inv_Product_Category::get();
        $sub_category = Inv_Product_Sub_Category::orderBy('added_at','desc')->paginate(5);;
        return view('inventory.product_category.sub_category.subcategory', compact('sub_category','inv_product_category'));
    }//End Method


    //Insert Product Sub Category
    public function InsertSubCategory(Request $request){
        $request->validate([
            "subCategory" => 'required|unique:inv__product__sub__categories,sub_category_name',
            "category" => 'required'
        ]);

        $sub_category = Inv_Product_Sub_Category::insert([
            "sub_category_name" => $request->subCategory,
            "category_id" => $request->category,
        ]);
        if($sub_category){
            return response()->json([
                'status'=>'success',
            ]); 
        }
         
    }//End Method




    // public function GetSubcategory(Request $request)
    // {
    //     $categoryId = $request->input('category_id');
    //     $subcategories = Subcategory::select('id', 'sub_category_name')
    //     ->where('category_id', $categoryId)
    //     ->get();
    //     // dd($sub_category);
    //     return response()->json($subcategories);
    // }


    
    //Edit Product Sub Category
    public function EditSubCategory($id){
        $sub_category = Inv_Product_Sub_Category::findOrFail($id);
        $inv_product_category = Inv_Product_Category::get();
        return response()->json([
            'inv_product_category'=>$inv_product_category,
            'sub_category'=>$sub_category
        ]);
    }//End Method



    //Update Product Sub Category
    public function UpdateSubCategory(Request $request,$id){
        $sub_category = Inv_Product_Sub_Category::findOrFail($id);

        $request->validate([
            "subCategory" => ['required',Rule::unique('inv__product__sub__categories', 'sub_category_name')->ignore($sub_category->id)],
            "category"=>'required',
            "status"=>'required|in:0,1',
        ]);

        $update = Inv_Product_Sub_Category::findOrFail($id)->update([
            "sub_category_name" => $request->subCategory,
            "category_id" => $request->category,
            "status" => $request->status,
            "updated_at" => now()
        ]);
        if($update){
            return response()->json([
                'status'=>'success'
            ]); 
        }
    }//End Method



    //Delete Product Sub Category
    public function DeleteSubCategory($id){
        Inv_Product_Sub_Category::findOrFail($id)->delete();
        return response()->json([
            'status'=>'success'
        ]);
    }//End Method


    //product Category Pagination
    public function SubCategoryPagination(){
        $sub_category = Inv_Product_Sub_Category::orderBy('added_at','desc')->paginate(5);
        return view('inventory.product_category.sub_category.subCategoryPagination', compact('sub_category'))->render();
    }//End Method


    //product category Search
    public function SearchSubCategory(Request $request){
        $sub_category = Inv_Product_Sub_Category::where('sub_category_name', 'like', '%'.$request->search.'%')
        ->orWhere('category_id', 'like','%'.$request->search.'%')
        ->orWhere('id', 'like','%'.$request->search.'%')
        ->orderBy('id','desc')
        ->paginate(5);
        
        if($sub_category->count() >= 1){
            return response()->json([
                'status' => 'success',
                'pagination' => $sub_category->links()->toHtml(),
                'data' => view('inventory.product_category.sub_category.subCategoryPagination', compact('sub_category'))->render(),
            ]);
        }
        else{
            return response()->json([
                'status'=>'null'
            ]); 
        }
    }//End Method
    
    /////////////////////////// --------------- Inventory Product Sub Categorys Methods end---------- //////////////////////////










    //////////////////////////// ------------------ Inventory Products Methods start --------------- //////////////////////////
    
    //show all Products
    public function ShowProducts(){
        $inv_product_category = Inv_Product_Category::get();
        $sub_category = Inv_Product_Sub_Category::get();
        $inv_manufacturer = Inv_Manufacturer_Info::get();
        $inv_unit = Inv_Unit::get();
        $user_info = User_Info::get();
        $inv_product = Inv_Product::orderBy('added_at','desc')->paginate(5);
        return view('inventory.product.products', compact('inv_product','inv_product_category','inv_manufacturer','inv_unit','user_info','sub_category'));
    }//End Method



    //Insert Product
    public function InsertProducts(Request $request){
        $request->validate([
            "productName" => 'required|unique:inv__product__sub__categories,sub_category_name',
            "category" => 'required',
            "subCategory" => 'required',
            "manufacturer" => 'required',
            "size" => 'required',
            "unit" => 'required',
            "mrp" => 'required',
            "user" => 'required',
        ]);

        $inv_product = Inv_Product::insert([
            "product_name" => $request->productName,
            "category_id" => $request->category,
            "sub_category_id" => $request->subCategory,
            "manufacturer_id" => $request->manufacturer,
            "size" => $request->size,
            "unit" => $request->unit,
            "mrp" => $request->mrp,
            "user_id" => $request->user,
        ]);
        if($inv_product){
            return response()->json([
                'status'=>'success',
            ]); 
        }  
    }//End Method


    



    //Edit Product
    public function EditProducts($id){
        $inv_product_category = Inv_Product_Category::get();
        $sub_category = Inv_Product_Sub_Category::get();
        $inv_manufacturer = Inv_Manufacturer_Info::get();
        $inv_unit = Inv_Unit::get();
        $user_info = User_Info::get();
        $inv_product = Inv_Product::findOrFail($id);
        return response()->json([
            'inv_product_category'=>$inv_product_category,
            'sub_category'=>$sub_category,
            'inv_manufacturer'=>$inv_manufacturer,
            'inv_unit'=>$inv_unit,
            'user_info'=>$user_info,
            'inv_product'=>$inv_product,
        ]);
    }//End Method



    //Update Product
    public function UpdateProducts(Request $request,$id){
        $inv_product = Inv_Product::findOrFail($id);

        $request->validate([
            "productName" => ['required',Rule::unique('inv__products', 'product_name')->ignore($inv_product->id)],
            "category" => 'required',
            "subCategory" => 'required',
            "manufacturer" => 'required',
            "size" => 'required',
            "unit" => 'required',
            "mrp" => 'required',
            "user" => 'required',
        ]);

        $update = Inv_Product::findOrFail($id)->update([
            "product_name" => $request->productName,
            "category_id" => $request->category,
            "sub_category_id" => $request->subCategory,
            "manufacturer_id" => $request->manufacturer,
            "size" => $request->size,
            "unit" => $request->unit,
            "mrp" => $request->mrp,
            "user_id" => $request->user,
            "status" => $request->status,
            "updated_at" => now()
        ]);
        if($update){
            return response()->json([
                'status'=>'success'
            ]); 
        }
    }//End Method


    //Delete Product
    public function DeleteProducts($id){
        Inv_Product::findOrFail($id)->delete();
        return response()->json([
            'status'=>'success'
        ]);
    }//End Method


    //product Pagination
    public function ProductPagination(){
        $inv_product = Inv_Product::orderBy('added_at','desc')->paginate(5);
        return view('inventory.product.productPagination', compact('inv_product'))->render();
    }//End Method


    //product Search
    public function SearchProduct(Request $request){
        $inv_product = Inv_Product::where('product_name', 'like', '%'.$request->search.'%')
        ->orWhere('category_id', 'like','%'.$request->search.'%')
        ->orWhere('id', 'like','%'.$request->search.'%')
        ->orderBy('id','desc')
        ->paginate(5);
        
        if($inv_product->count() >= 1){
            return response()->json([
                'status' => 'success',
                'pagination' => $inv_product->links()->toHtml(),
                'data' => view('inventory.product.productPagination', compact('inv_product'))->render(),
            ]);
        }
        else{
            return response()->json([
                'status'=>'null'
            ]); 
        }
    }//End Method


    /////////////////////////// --------------- Inventory Products Methods end ---------- //////////////////////////



    /////////////////////////// --------------- Inventory Client Methods start---------- //////////////////////////

    public function ShowClients(){
        $user_info = User_Info::get();
        $inv_client = Inv_Client_Info::orderBy('added_at','desc')->paginate(5);
        return view('inventory.client.clients', compact('inv_client','user_info'));
    }//End Method



    //Insert Manufacturer
    public function InsertClients(Request $request){
        $request->validate([
            "clientName" => 'required',
            "contact" => 'required|numeric|unique:inv__client__infos,contact',
            "user" => 'required',
        ]);

        $inv_client = Inv_Client_Info::insert([
            "client_name" => $request->clientName,
            "contact" => $request->contact,
            "user_id" => $request->user,
        ]);
        
        if($inv_client){
            return response()->json([
                'status'=>'success',
            ]); 
        } 
    }//End Method



    // //Edit Manufacturer
    // public function EditManufacturers($id){
    //     $inv_manufacturer = Inv_Manufacturer_info::findOrFail($id);
    //     $user_info = User_Info::get();
    //     return response()->json([
    //         'inv_manufacturer'=>$inv_manufacturer,
    //         'user_info'=>$user_info,
    //     ]);
    // }//End Method




    // //Update Manufacturer
    // public function UpdateManufacturers(Request $request,$id){
    //     $inv_manufacturer = Inv_Manufacturer_info::findOrFail($id);

    //     $request->validate([
    //         "manufacturerName" => ['required',Rule::unique('inv__manufacturer__infos', 'manufacturer_name')->ignore($inv_manufacturer->id)],
    //         "manufacturerEmail" => ['required','email',Rule::unique('inv__manufacturer__infos', 'manufacturer_email')->ignore($inv_manufacturer->id)],
    //         "manufacturerContact" => ['required','numeric',Rule::unique('inv__manufacturer__infos', 'manufacturer_email')->ignore($inv_manufacturer->id)],
    //         "user" => 'required',
    //         'status' => 'required'
    //     ]);


    //     $update = Inv_Manufacturer_info::findOrFail($id)->update([
    //         "manufacturer_name" => $request->manufacturerName,
    //         "manufacturer_email" => $request->manufacturerEmail,
    //         "manufacturer_contact" => $request->manufacturerContact,
    //         "user_id" => $request->user,
    //         "status" => $request->status,
    //         "updated_at" => now()
    //     ]);
    //     if($update){
    //         return response()->json([
    //             'status'=>'success'
    //         ]); 
    //     } 
    // }//End Method




    //Delete Clients
    public function DeleteClients($id){
        Inv_Client_Info::findOrFail($id)->delete();
        return response()->json([
            'status'=>'success'
        ]); 
    }//End Method



    //Client Pagination
    public function ClientPagination(){
        $user_info = User_Info::get();
        $inv_client = Inv_Client_Info::orderBy('added_at','desc')->paginate(5);
        return view('inventory.client.clientPagination', compact('user_info','inv_client'))->render();
    }//End Method



    //Client Search
    public function SearchClients(Request $request){
        $inv_client = Inv_Client_Info::where('client_name', 'like', '%'.$request->search.'%')
        ->orWhere('id', 'like','%'.$request->search.'%')
        ->orderBy('id','desc')
        ->paginate(5);
        
        if($inv_client->count() >= 1){
            return response()->json([
                'status' => 'success',
                'pagination' => $inv_client->links()->toHtml(),
                'data' => view('inventory.client.clientPagination', compact('inv_client'))->render(),
            ]);
        }
        else{
            return response()->json([
                'status'=>'null'
            ]); 
        }
    }//End Method

    /////////////////////////// --------------- Inventory Client Methods end---------- //////////////////////////



    /////////////////////////// --------------- Inventory Client Methods start---------- //////////////////////////

    //Show Location
    public function ShowLocations(){
        $inv_location = Inv_Location::orderBy('added_at','desc')->paginate(5);
        return view('inventory.location.locations', compact('inv_location'));
    }//End Method



    //Insert Location
    public function InsertLocations(Request $request){
        $request->validate([
            "division" => 'required',
            "district" => 'required',
            "city" => 'required',
            "area" => 'required',
        ]);

        $inv_location = Inv_Location::insert([
            "division" => $request->division,
            "district_name" => $request->district,
            "city_name" => $request->city,
            "area" => $request->area,
            "road_no" => $request->road,
        ]);
        
        if($inv_location){
            return response()->json([
                'status'=>'success',
            ]); 
        } 
    }//End Method





    //Delete Locations
    public function DeleteLocations($id){
        Inv_Location::findOrFail($id)->delete();
        return response()->json([
            'status'=>'success'
        ]); 
    }//End Method



    //Location Pagination
    public function LocationPagination(){
        $inv_location = Inv_Location::orderBy('added_at','desc')->paginate(5);
        return view('inventory.location.locationPagination', compact('inv_location'))->render();
    }//End Method



    //Location Search
    public function SearchLocations(Request $request){
        $inv_location = Inv_Location::where('district_name', 'like', '%'.$request->search.'%')
        ->orWhere('division', 'like','%'.$request->search.'%')
        ->orWhere('city_name', 'like','%'.$request->search.'%')
        ->orWhere('id', 'like','%'.$request->search.'%')
        ->orderBy('id','desc')
        ->paginate(5);
        
        if($inv_location->count() >= 1){
            return response()->json([
                'status' => 'success',
                'pagination' => $inv_location->links()->toHtml(),
                'data' => view('inventory.location.locationPagination', compact('inv_location'))->render(),
            ]);
        }
        else{
            return response()->json([
                'status'=>'null'
            ]); 
        }
    }//End Method


    /////////////////////////// --------------- Inventory Client Methods end ---------- //////////////////////////





    /////////////////////////// --------------- Inventory Store Methods start ---------- //////////////////////////
    
    //Show Store
    public function ShowStores(){
        $inv_location = Inv_Location::get();
        $inv_store = Inv_Store::orderBy('added_at','desc')->paginate(5);
        return view('inventory.store.stores', compact('inv_store','inv_location'));
    }//End Method



    //Insert Store
    public function InsertStores(Request $request){
        $request->validate([
            "storeName" => 'required',
            "locations" => 'required|numeric',
        ]);

        $inv_store = Inv_Store::insert([
            "store_name" => $request->storeName,
            "location_id" => $request->locations,
        ]);
        
        if($inv_store){
            return response()->json([
                'status'=>'success',
            ]); 
        } 
    }//End Method


    //Delete Stores
    public function DeleteStores($id){
        Inv_Store::findOrFail($id)->delete();
        return response()->json([
            'status'=>'success'
        ]); 
    }//End Method


    //Store Pagination
    public function StorePagination(){
        $inv_location = Inv_Location::get();
        $inv_store = Inv_Store::orderBy('added_at','desc')->paginate(5);
        return view('inventory.store.storePagination', compact('inv_location','inv_store'))->render();
    }//End Method


    //Location Search
    public function SearchStores(Request $request){
        $inv_store = Inv_Store::where('store_name', 'like', '%'.$request->search.'%')
        ->orWhere('location_id', 'like','%'.$request->search.'%')
        ->orWhere('id', 'like','%'.$request->search.'%')
        ->orderBy('id','desc')
        ->paginate(5);
        
        if($inv_store->count() >= 1){
            return response()->json([
                'status' => 'success',
                'pagination' => $inv_store->links()->toHtml(),
                'data' => view('inventory.store.storePagination', compact('inv_store'))->render(),
            ]);
        }
        else{
            return response()->json([
                'status'=>'null'
            ]); 
        }
    }//End Method
    
    /////////////////////////// --------------- Inventory Store Methods end ---------- //////////////////////////





    /////////////////////////// --------------- Inventory Units Methods start ---------- //////////////////////////
    /////////////////////////// --------------- Inventory Units Methods start ---------- //////////////////////////




    /////////////////////////// --------------- Inventory Units Methods start ---------- //////////////////////////
    /////////////////////////// --------------- Inventory Units Methods start ---------- //////////////////////////



    /////////////////////////// --------------- Status Methods start ---------- //////////////////////////
    public function Status($table_name,$id,$status)
    {
        $model = "App\\Models\\" . $table_name;
        if($status==0){
            $model::findOrFail($id)->update(['status'=>1]);
            return redirect()->back();
        }
        else{
            $model::findOrFail($id)->update(['status'=>0]);
            return redirect()->back();
        }  
    }//End Method

    /////////////////////////// --------------- Status Methods end ---------- //////////////////////////

    /////////////////////////// --------------- Pagination Method start ---------- //////////////////////////

    // public function Pagination(Request $request){

    // }

    /////////////////////////// --------------- Units Methods start ---------- //////////////////////////

}
