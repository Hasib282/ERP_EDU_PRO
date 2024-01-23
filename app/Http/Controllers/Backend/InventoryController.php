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
use App\Models\Inv_Receive_Detail;
use App\Models\Inv_Transaction_Details_Temp;

class InventoryController extends Controller
{
    /////////////////////////// --------------- Inventory Units Methods start ---------- //////////////////////////
    //Show Units
    public function ShowUnits(){
        $inv_unit = Inv_Unit::orderBy('added_at','desc')->paginate(15);
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



    //Get Unit by Name
    public function GetUnitByName(Request $request){
        if($request->unit != ""){
            $inv_unit = Inv_unit::where('unit_name', 'like', '%'.$request->unit.'%')
            ->orderBy('unit_name','asc')
            ->take(10)
            ->get();

            if($inv_unit->count() > 0){
                $list = "";
                foreach($inv_unit as $unit) {
                    $list .= '<li class="list-group-item list-group-item-primary" data-id="'.$unit->id.'">'.$unit->unit_name.'</li>';
                }
            }
            else{
                $list = '<li class="list-group-item list-group-item-primary">No Data Found</li>';
            }
            return $list;
        }else{
            return "";
        } 
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



    //Delete Unit
    public function DeleteUnits($id){
        Inv_Unit::findOrFail($id)->delete();
        return response()->json([
            'status'=>'success'
        ]); 
    }//End Method



    //Unit Pagination
    public function UnitPagination(){
        $inv_unit = Inv_Unit::orderBy('added_at','desc')->paginate(15);
        return response()->json([
            'status' => 'success',
            'data' => view('inventory.unit.unitPagination', compact('inv_unit'))->render(),
        ]);
    }//End Method



    //Unit Search
    public function SearchUnits(Request $request){
        $inv_unit = Inv_Unit::where('unit_name', 'like', '%'.$request->search.'%')
        ->orWhere('id', 'like','%'.$request->search.'%')
        ->orderBy('unit_name','asc')
        ->paginate(15);
        
        if($inv_unit->count() >= 1){
            return response()->json([
                'status' => 'success',
                // 'pagination' => $inv_unit->links()->toHtml(),
                'data' => view('inventory.unit.searchUnit', compact('inv_unit'))->render(),
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
    //Show Suppliers
    public function ShowSuppliers(){
        $user_info = User_Info::get();
        $inv_supplier = Inv_Supplier_Info::orderBy('added_at','desc')->paginate(15);
        return view('inventory.supplier.suppliers', compact('inv_supplier','user_info'));
    }//End Method



    //Get Suppliers by Name
    public function GetSupplierByName(Request $request){
        if($request->supplier != ""){
            $inv_supplier = Inv_Supplier_Info::where('sup_name', 'like', '%'.$request->supplier.'%')
                ->orderBy('sup_name','asc')
                ->take(10)
                ->get();
    
            if($inv_supplier->count() > 0){
                $list = "";
                foreach($inv_supplier as $supplier) {
                    $list .= '<li class="list-group-item list-group-item-primary" data-id="'.$supplier->id.'">'.$supplier->sup_name.'</li>';
                }
            }
            else{
                $list = '<li class="list-group-item list-group-item-primary">No Data Found</li>';
            }
            return $list;
        }else{
            return "";
        } 
    }//End Method



    //Insert Supplier
    public function InsertSuppliers(Request $request){
        $request->validate([
            "supplierName" => 'required|unique:inv__supplier__infos,sup_name',
            "supplierEmail" => 'required|email',
            "supplierContact" => 'required|numeric',
            "supplierAddress" => 'required',
            "user" => 'required',
        ]);
        
        Inv_Supplier_info::insert([
            "sup_name" => $request->supplierName,
            "sup_email" => $request->supplierEmail,
            "sup_contact" => $request->supplierContact,
            "sup_address" => $request->supplierAddress,
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



    //Update Supplier
    public function UpdateSuppliers(Request $request,$id){
        $inv_suplier = Inv_Supplier_info::findOrFail($id);

        $request->validate([
            "supplierName" => ['required',Rule::unique('inv__supplier__infos', 'sup_name')->ignore($inv_suplier->id)],
            "supplierEmail" => 'required|email',
            "supplierContact" => 'required|numeric',
            "supplierAddress" => 'required',
            "user" => 'required',
            'status' => 'required'
        ]);

        $update = Inv_Supplier_info::findOrFail($id)->update([
            "sup_name" => $request->supplierName,
            "sup_email" => $request->supplierEmail,
            "sup_contact" => $request->supplierContact,
            "sup_address" => $request->supplierAddress,
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



    //Supplier Pagination
    public function SupplierPagination(){
        $user_info = User_Info::get();
        $inv_supplier = Inv_Supplier_Info::orderBy('added_at','desc')->paginate(15);
        return response()->json([
            'status' => 'success',
            'data' => view('inventory.supplier.supplierPagination', compact('inv_supplier','user_info'))->render(),
        ]);
    }//End Method



    //Search Suppplier by Name
    public function SearchSuppliers(Request $request){
        $user_info = User_Info::get();
        $inv_supplier = Inv_Supplier_Info::where('sup_name', 'like','%'.$request->search.'%')
        ->orderBy('sup_name','asc')
        ->paginate(15);

        $paginationHtml = $inv_supplier->links()->toHtml();
        
        if($inv_supplier->count() >= 1){
            return response()->json([
                'status' => 'success',
                'user_info' => $user_info,
                'data' => view('inventory.supplier.searchSupplier', compact('inv_supplier','user_info'))->render(),
                'paginate' => $paginationHtml
            ]);
        }
        else{
            return response()->json([
                'status'=>'null'
            ]); 
        }
        
    }//End Method



    //Search Suppplier by Email
    public function SearchSupplierByEmail(Request $request){
        $user_info = User_Info::get();
        $inv_supplier = Inv_Supplier_Info::where('sup_email', 'like','%'.$request->search.'%')
        ->orderBy('sup_email','asc')
        ->paginate(15);

        $paginationHtml = $inv_supplier->links()->toHtml();
        
        if($inv_supplier->count() >= 1){
            return response()->json([
                'status' => 'success',
                'user_info' => $user_info,
                'data' => view('inventory.supplier.searchSupplier', compact('inv_supplier','user_info'))->render(),
                'paginate' => $paginationHtml
            ]);
        }
        else{
            return response()->json([
                'status'=>'null'
            ]); 
        }
        
    }//End Method



    //Search Suppplier by Contact
    public function SearchSupplierByContact(Request $request){
        $user_info = User_Info::get();
        $inv_supplier = Inv_Supplier_Info::where('sup_contact', 'like','%'.$request->search.'%')
        ->orderBy('sup_contact','asc')
        ->paginate(15);

        $paginationHtml = $inv_supplier->links()->toHtml();
        
        if($inv_supplier->count() >= 1){
            return response()->json([
                'status' => 'success',
                'user_info' => $user_info,
                'data' => view('inventory.supplier.searchSupplier', compact('inv_supplier','user_info'))->render(),
                'paginate' => $paginationHtml
            ]);
        }
        else{
            return response()->json([
                'status'=>'null'
            ]); 
        }
        
    }//End Method



    //Search Suppplier by Address
    public function SearchSupplierByAddress(Request $request){
        $user_info = User_Info::get();
        $inv_supplier = Inv_Supplier_Info::where('sup_address', 'like', '%'.$request->search.'%')
        ->orderBy('sup_address','asc')
        ->paginate(15);

        $paginationHtml = $inv_supplier->links()->toHtml();
        
        if($inv_supplier->count() >= 1){
            return response()->json([
                'status' => 'success',
                'user_info' => $user_info,
                'data' => view('inventory.supplier.searchSupplier', compact('inv_supplier','user_info'))->render(),
                'paginate' => $paginationHtml
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
    //Show Manufacturers
    public function ShowManufacturers(){
        $user_info = User_Info::get();
        $inv_manufacturer = Inv_Manufacturer_Info::orderBy('added_at','desc')->paginate(15);
        return view('inventory.manufacturer.manufacturers', compact('inv_manufacturer','user_info'));
    }//End Method



    //Get Manufacturers by Name
    public function GetManufacturerByName(Request $request){
        if($request->manufacturer != ""){
            $inv_manufacturer = Inv_Manufacturer_Info::where('manufacturer_name', 'like', '%'.$request->manufacturer.'%')
                ->orderBy('manufacturer_name','asc')
                ->take(10)
                ->get();
    
            if($inv_manufacturer->count() > 0){
                $list = "";
                foreach($inv_manufacturer as $manufacturer) {
                    $list .= '<li class="list-group-item list-group-item-primary" data-id="'.$manufacturer->id.'">'.$manufacturer->manufacturer_name.'</li>';
                }
            }
            else{
                $list = '<li class="list-group-item list-group-item-primary">No Data Found</li>';
            }
            return $list;
        }else{
            return "";
        } 
    }//End Method



    //Insert Manufacturer
    public function InsertManufacturers(Request $request){
        $request->validate([
            "manufacturerName" => 'required|unique:inv__manufacturer__infos,manufacturer_name',
            "manufacturerEmail" => 'required|email',
            "manufacturerContact" => 'required|numeric',
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
            "manufacturerEmail" => 'required|email',
            "manufacturerContact" => 'required|numeric',
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
        $inv_manufacturer = Inv_Manufacturer_Info::orderBy('added_at','desc')->paginate(15);
        return response()->json([
            'status' => 'success',
            'data' => view('inventory.manufacturer.manufacturerPagination', compact('inv_manufacturer','user_info'))->render(),
        ]);
    }//End Method



    //Search Manufacturer by Name
    public function SearchManufacturer(Request $request){
        $inv_manufacturer = Inv_Manufacturer_Info::where('manufacturer_name', 'like', '%'.$request->search.'%')
        ->orderBy('manufacturer_name','asc')
        ->paginate(15);

        $paginationHtml = $inv_manufacturer->links()->toHtml();
        
        if($inv_manufacturer->count() >= 1){
            return response()->json([
                'status' => 'success',
                'data' => view('inventory.manufacturer.searchManufacturer', compact('inv_manufacturer'))->render(),
                'paginate' => $paginationHtml
            ]);
        }
        else{
            return response()->json([
                'status'=>'null'
            ]); 
        }
    }//End Method



    //Search Manufacturer by Email
    public function SearchManufacturerByEmail(Request $request){
        $inv_manufacturer = Inv_Manufacturer_Info::where('manufacturer_email', 'like', '%'.$request->search.'%')
        ->orderBy('manufacturer_email','asc')
        ->paginate(15);

        $paginationHtml = $inv_manufacturer->links()->toHtml();
        
        if($inv_manufacturer->count() >= 1){
            return response()->json([
                'status' => 'success',
                'data' => view('inventory.manufacturer.searchManufacturer', compact('inv_manufacturer'))->render(),
                'paginate' => $paginationHtml
            ]);
        }
        else{
            return response()->json([
                'status'=>'null'
            ]); 
        }
    }//End Method



    //Search Manufacturer by Contact
    public function SearchManufacturerByContact(Request $request){
        $inv_manufacturer = Inv_Manufacturer_Info::where('manufacturer_contact', 'like', '%'.$request->search.'%')
        ->orderBy('manufacturer_contact','asc')
        ->paginate(15);

        $paginationHtml = $inv_manufacturer->links()->toHtml();
        
        if($inv_manufacturer->count() >= 1){
            return response()->json([
                'status' => 'success',
                'data' => view('inventory.manufacturer.searchManufacturer', compact('inv_manufacturer'))->render(),
                'paginate' => $paginationHtml
            ]);
        }
        else{
            return response()->json([
                'status'=>'null'
            ]); 
        }
    }//End Method

    /////////////////////////// --------------- Inventory Manufacturers Methods end---------- //////////////////////////




    /////////////////////////// --------------- Inventory Product Category Methods start---------- //////////////////////////
    //Show Product Categories
    public function ShowProductCategory(){
        $inv_product_category = Inv_Product_Category::orderBy('added_at','desc')->paginate(15);;
        return view('inventory.product_category.productCategory', compact('inv_product_category'));
    }//End Method



    //Get Product Category by Name
    public function GetCategoryByName(Request $request){
        if($request->category != ""){
            $inv_product_category = Inv_Product_Category::where('product_category_name', 'like', '%'.$request->category.'%')
            ->orderBy('product_category_name','asc')
            ->take(10)
            ->get();

            if($inv_product_category->count() > 0){
                $list = "";
                foreach($inv_product_category as $category) {
                    $list .= '<li data-id="'.$category->id.'">'.$category->product_category_name.'</li>';
                }
            }
            else{
                $list = '<li>No Data Found</li>';
            }
            return $list;
        }else{
            return "";
        } 
    }//End Method



    //Insert Product Category
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



    //Product Category Pagination
    public function ProductCategoryPagination(){
        $inv_product_category = Inv_Product_Category::orderBy('added_at','desc')->paginate(15);
        return response()->json([
            'status' => 'success',
            'data' => view('inventory.product_category.productCategoryPagination', compact('inv_product_category'))->render(),
        ]);
    }//End Method



    // Search Product Category
    public function SearchProductCategory(Request $request){
        $inv_product_category = Inv_Product_Category::where('product_category_name', 'like', '%'.$request->search.'%')
        ->orWhere('id', 'like','%'.$request->search.'%')
        ->orderBy('product_category_name','asc')
        ->paginate(15);
        
        if($inv_product_category->count() >= 1){
            return response()->json([
                'status' => 'success',
                // 'pagination' => $inv_product_category->links()->toHtml(),
                'data' => view('inventory.product_category.searchProductCategory', compact('inv_product_category'))->render(),
            ]);
        }
        else{
            return response()->json([
                'status'=>'null'
            ]); 
        }
    }//End Method
    
    /////////////////////////// --------------- Inventory Product Category Methods end---------- //////////////////////////




    /////////////////////////// --------------- Inventory Product Sub Category Methods start---------- //////////////////////////
    //Show Product Sub Categories
    public function ShowSubCategory(){
        $sub_category = Inv_Product_Sub_Category::orderBy('added_at','desc')->paginate(15);;
        return view('inventory.product_category.sub_category.subcategory', compact('sub_category'));
    }//End Method



    //Get Product Sub Category by Category Id
    public function GetSubCategoryByCategory(Request $request){
        if($request->category != ""){
            $sub_category = Inv_Product_Sub_Category::where('category_id','=', $request->category)
            ->where('sub_category_name', 'like', '%'.$request->subCategory.'%')
            ->orderBy('sub_category_name','asc')
            ->take(10)
            ->get();

            if($sub_category->count() > 0){
                $list = "";
                foreach($sub_category as $sub) {
                    $list .= '<li data-id="'.$sub->id.'">'.$sub->sub_category_name.'</li>';
                }
            }
            else{
                $list = '<li>No Data Found</li>';
            }
            return $list;
        }else{
            return "";
        } 
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


    
    //Edit Product Sub Category
    public function EditSubCategory($id){
        $sub_category = Inv_Product_Sub_Category::with('CategoryName')->findOrFail($id);
        return response()->json([
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



    //Product Sub Category Pagination
    public function SubCategoryPagination(){
        $sub_category = Inv_Product_Sub_Category::orderBy('added_at','desc')->paginate(15);
        return response()->json([
            'status' => 'success',
            'data' => view('inventory.product_category.sub_category.subCategoryPagination', compact('sub_category'))->render(),
        ]);
    }//End Method



    //Search Product Sub Category by Name
    public function SearchSubCategory(Request $request){
        $sub_category = Inv_Product_Sub_Category::where('sub_category_name', 'like', '%'.$request->search.'%')
        ->orderBy('sub_category_name','asc')
        ->paginate(15);

        $paginationHtml = $sub_category->links()->toHtml();

        if($sub_category->count() >= 1){
            return response()->json([
                'status' => 'success',
                'data' => view('inventory.product_category.sub_category.searchSubCategory', compact('sub_category'))->render(),
                'paginate' =>$paginationHtml
            ]);
        }
        else{
            return response()->json([
                'status'=>'null'
            ]); 
        }
    }//End Method


    //Search Product Sub Category by Category Name
    public function SearchSubCategoryByCategoryName(Request $request){
        $sub_category = Inv_Product_Sub_Category::with('CategoryName:id,product_category_name')
        ->whereHas('CategoryName', function ($query) use ($request) {
            $query->where('product_category_name', 'like', '%' . $request->search . '%');
            $query->orderBy('product_category_name','asc');
        })
        ->paginate(15);

                

        $paginationHtml = $sub_category->links()->toHtml();

        if($sub_category->count() >= 1){
            return response()->json([
                'status'=>'success',
                'data' => view('inventory.product_category.sub_category.searchSubCategory', compact('sub_category'))->render(),
                'paginate' =>$paginationHtml
            ]);
        }
        else{
            return response()->json([
                'status'=>'null',
            ]);
        }
         
    }//End Method
    
    /////////////////////////// --------------- Inventory Product Sub Categorys Methods end---------- //////////////////////////




    //////////////////////////// ------------------ Inventory Products Methods start --------------- //////////////////////////
    //Show All Products
    public function ShowProducts(){
        $user_info = User_Info::get();
        $inv_product = Inv_Product::orderBy('added_at','desc')->paginate(15);
        return view('inventory.product.products', compact('inv_product','user_info'));
    }//End Method



    //Get Product by Name
    public function GetProductByName(Request $request){
        if($request->name != ""){
            $inv_product = Inv_Product::where('product_name', 'like', '%'.$request->name.'%')
            ->orderBy('product_name','asc')
            ->take(10)
            ->get();

            if($inv_product->count() > 0){
                $list = "";
                foreach($inv_product as $product) {
                    $list .= '<li class="list-group-item list-group-item-primary" data-id="'.$product->id. '" data-mrp="'.$product->mrp.'">'.$product->product_name.'</li>';
                }
            }
            else{
                $list = '<li class="list-group-item list-group-item-primary">No Data Found</li>';
            }
            return $list;
        }else{
            return "";
        } 
    }//End Method
    


    //Insert Product
    public function InsertProducts(Request $request){
        $request->validate([
            "productName" => 'required|unique:inv__products,product_name',
            "category" => 'required|numeric',
            "subCategory" => 'required|numeric',
            "manufacturer" => 'required|numeric',
            "size" => 'required|numeric',
            "unit" => 'required|numeric',
            "mrp" => 'required|numeric',
            "user" => 'required|numeric',
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
        $user_info = User_Info::get();
        $inv_product = Inv_Product::with(
            'CategoryName:id,product_category_name',
            'ManufacturerName:id,manufacturer_name',
            'UnitName:id,unit_name',
            'UserName:id,name',
            'SubCategory:id,sub_category_name'
        )
        ->findOrFail($id);

        return response()->json([
            'inv_product' =>$inv_product,
            'user_info' => $user_info
        ]);
    }//End Method



    //Update Product
    public function UpdateProducts(Request $request,$id){
        $inv_product = Inv_Product::findOrFail($id);

        $request->validate([
            "productName" => ['required',Rule::unique('inv__products', 'product_name')->ignore($inv_product->id)],
            "category" => 'required|numeric',
            "subCategory" => 'required|numeric',
            "manufacturer" => 'required|numeric',
            "size" => 'required|numeric',
            "unit" => 'required|numeric',
            "mrp" => 'required|numeric',
            "user" => 'required|numeric',
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



    //Product Pagination
    public function ProductPagination(){
        $inv_product = Inv_Product::orderBy('added_at','desc')->paginate(15);
        return response()->json([
            'status' => 'success',
            'data' => view('inventory.product.productPagination', compact('inv_product'))->render(),
        ]);
    }//End Method



    //Search Product By Name
    public function SearchProduct(Request $request){
        $inv_product = Inv_Product::where('product_name', 'like', '%'.$request->search.'%')
        ->orWhere('id', 'like','%'.$request->search.'%')
        ->orderBy('product_name','asc')
        ->paginate(15);
        
        if($inv_product->count() >= 1){
            return response()->json([
                'status' => 'success',
                'data' => view('inventory.product.searchProduct', compact('inv_product'))->render(),
            ]);
        }
        else{
            return response()->json([
                'status'=>'null'
            ]); 
        }
    }//End Method



    //Search Product By Category
    public function SearchProductByCategory(Request $request){
        $inv_product = Inv_Product::with('CategoryName:id,product_category_name')
        ->whereHas('CategoryName', function ($query) use ($request) {
            $query->where('product_category_name', 'like', '%' . $request->search . '%');
            $query->orderBy('product_category_name','asc');
        })
        ->paginate(15);
        
        
        if($inv_product->count() >= 1){
            return response()->json([
                'status' => 'success',
                'data' => view('inventory.product.searchProduct', compact('inv_product'))->render(),
            ]);
        }
        else{
            return response()->json([
                'status'=>'null'
            ]); 
        }
    }//End Method



    //Search Product By Sub Category
    public function SearchProductBySubCategory(Request $request){
        $inv_product = Inv_Product::with('SubCategory:id,sub_category_name')
        ->whereHas('SubCategory', function ($query) use ($request) {
            $query->where('sub_category_name', 'like', '%' . $request->search . '%');
            $query->orderBy('sub_category_name','asc');
        })
        ->paginate(15);

        
        if($inv_product->count() >= 1){
            return response()->json([
                'status' => 'success',
                'data' => view('inventory.product.searchProduct', compact('inv_product'))->render(),
            ]);
        }
        else{
            return response()->json([
                'status'=>'null'
            ]); 
        }
    }//End Method



    //Search Product By Manufacturer
    public function SearchProductByManufacturer(Request $request){
        $inv_product = Inv_Product::with('ManufacturerName:id,manufacturer_name')
        ->whereHas('ManufacturerName', function ($query) use ($request) {
            $query->where('manufacturer_name', 'like', '%' . $request->search . '%');
            $query->orderBy('manufacturer_name','asc');
        })
        ->paginate(15);

        
        
        if($inv_product->count() >= 1){
            return response()->json([
                'status' => 'success',
                'data' => view('inventory.product.searchProduct', compact('inv_product'))->render(),
            ]);
        }
        else{
            return response()->json([
                'status'=>'null'
            ]); 
        }
    }//End Method



    //Search Product By Mrp
    public function SearchProductByMrp(Request $request){
        $inv_product = Inv_Product::where('mrp', 'like', '%'.$request->search.'%')
        ->orderBy('mrp','asc')
        ->paginate(15);
        
        if($inv_product->count() >= 1){
            return response()->json([
                'status' => 'success',
                'data' => view('inventory.product.searchProduct', compact('inv_product'))->render(),
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
    //Show Clients
    public function ShowClients(){
        $user_info = User_Info::get();
        $inv_client = Inv_Client_Info::orderBy('added_at','desc')->paginate(15);
        return view('inventory.client.clients', compact('inv_client','user_info'));
    }//End Method



    //Insert Client
    public function InsertClients(Request $request){
        $request->validate([
            "clientName" => 'required',
            "contact" => 'required|numeric|unique:inv__client__infos,client_contact',
            "email" => 'required|email',
            "address" => 'required',
            "user" => 'required',
        ]);

        $inv_client = Inv_Client_Info::insert([
            "client_name" => $request->clientName,
            "client_contact" => $request->contact,
            "client_email" => $request->email,
            "client_address" => $request->address,
            "user_id" => $request->user,
        ]);
        
        if($inv_client){
            return response()->json([
                'status'=>'success',
            ]); 
        } 
    }//End Method



    //Edit Client
    public function EditClients($id){
        $user_info = User_Info::get();
        $inv_client = Inv_Client_Info::findOrFail($id);
        return response()->json([
            'inv_client'=>$inv_client,
            'user_info'=>$user_info,
        ]);
    }//End Method



    //Update Client
    public function UpdateClients(Request $request,$id){
        $inv_client = Inv_Client_Info::findOrFail($id);

        $request->validate([
            "clientName" => 'required',
            "contact" => ['required','numeric',Rule::unique('inv__client__infos', 'client_contact')->ignore($inv_client->id)],
            "email" => 'required|email',
            "address" => 'required',
            "user" => 'required',
            "status" => 'required'
        ]);


        $update = Inv_Client_Info::findOrFail($id)->update([
            "client_name" => $request->clientName,
            "client_contact" => $request->contact,
            "client_email" => $request->email,
            "client_address" => $request->address,
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
        $inv_client = Inv_Client_Info::orderBy('added_at','desc')->paginate(15);
        return response()->json([
            'status' => 'success',
            'data' => view('inventory.client.clientPagination', compact('user_info','inv_client'))->render(),
        ]);
    }//End Method



    //Search Client by Name
    public function SearchClients(Request $request){
        $inv_client = Inv_Client_Info::where('client_name', 'like', '%'.$request->search.'%')
        ->orWhere('id', 'like','%'.$request->search.'%')
        ->orderBy('client_name','asc')
        ->paginate(15);

        $paginationHtml = $inv_client->links()->toHtml();
        
        if($inv_client->count() >= 1){
            return response()->json([
                'status' => 'success',
                'data' => view('inventory.client.searchClient', compact('inv_client'))->render(),
                'paginate' =>$paginationHtml
            ]);
        }
        else{
            return response()->json([
                'status'=>'null'
            ]); 
        }
    }//End Method



    //Search Client by Email
    public function SearchClientByEmail(Request $request){
        $inv_client = Inv_Client_Info::where('client_email', 'like', '%'.$request->search.'%')
        ->orderBy('client_email','asc')
        ->paginate(15);

        $paginationHtml = $inv_client->links()->toHtml();
        
        if($inv_client->count() >= 1){
            return response()->json([
                'status' => 'success',
                'data' => view('inventory.client.searchClient', compact('inv_client'))->render(),
                'paginate' =>$paginationHtml
            ]);
        }
        else{
            return response()->json([
                'status'=>'null'
            ]); 
        }
    }//End Method



    //Search Client by Contact
    public function SearchClientByContact(Request $request){
        $inv_client = Inv_Client_Info::where('client_contact', 'like', '%'.$request->search.'%')
        ->orderBy('client_contact','asc')
        ->paginate(15);

        $paginationHtml = $inv_client->links()->toHtml();
        
        if($inv_client->count() >= 1){
            return response()->json([
                'status' => 'success',
                'data' => view('inventory.client.searchClient', compact('inv_client'))->render(),
                'paginate' =>$paginationHtml
            ]);
        }
        else{
            return response()->json([
                'status'=>'null'
            ]); 
        }
    }//End Method



    //Search Client by Address
    public function SearchClientByAddress(Request $request){
        $inv_client = Inv_Client_Info::where('client_address', 'like', '%'.$request->search.'%')
        ->orderBy('client_address','asc')
        ->paginate(15);

        $paginationHtml = $inv_client->links()->toHtml();
        
        if($inv_client->count() >= 1){
            return response()->json([
                'status' => 'success',
                'data' => view('inventory.client.searchClient', compact('inv_client'))->render(),
                'paginate' =>$paginationHtml
            ]);
        }
        else{
            return response()->json([
                'status'=>'null'
            ]); 
        }
    }//End Method

    /////////////////////////// --------------- Inventory Client Methods end---------- //////////////////////////




    /////////////////////////// --------------- Inventory Location Methods start---------- //////////////////////////
    //Show Location
    public function ShowLocations(){
        $inv_location = Inv_Location::orderBy('added_at','desc')->paginate(15);
        return view('inventory.location.locations', compact('inv_location'));
    }//End Method



    //Get Location by Division
    public function GetLocationByDivision(Request $request){
        if($request->location != ""){
            $inv_location = Inv_Location::where('division', 'like', '%'.$request->location.'%')
            ->orderBy('division','asc')
            ->take(10)
            ->get();

            if($inv_location->count() > 0){
                $list = "";
                foreach($inv_location as $location) {
                    $list .= '<li data-id="'.$location->id.'">'.$location->division.'</li>';
                }
            }
            else{
                $list = '<li>No Data Found</li>';
            }
            return $list;
        }else{
            return "";
        } 
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
            "district" => $request->district,
            "city" => $request->city,
            "area" => $request->area,
            "road_no" => $request->road,
        ]);
        
        if($inv_location){
            return response()->json([
                'status'=>'success',
            ]); 
        } 
    }//End Method



    //Edit Location
    public function EditLocations($id){
        $inv_location = Inv_Location::findOrFail($id);
        return response()->json([
            'inv_location'=>$inv_location,
        ]);
    }//End Method



    //Update Location
    public function UpdateLocations(Request $request,$id){
        $request->validate([
            "division" => 'required',
            "district" => 'required',
            "city" => 'required',
            "area" => 'required',
            "status" => 'required'
        ]);


        $update = Inv_Location::findOrFail($id)->update([
            "division" => $request->division,
            "district" => $request->district,
            "city" => $request->city,
            "area" => $request->area,
            "road_no" => $request->road,
            "status" => $request->status,
            "updated_at" => now()
        ]);
        if($update){
            return response()->json([
                'status'=>'success'
            ]); 
        } 
    }//End Method



    //Delete Location
    public function DeleteLocations($id){
        Inv_Location::findOrFail($id)->delete();
        return response()->json([
            'status'=>'success'
        ]); 
    }//End Method



    //Location Pagination
    public function LocationPagination(){
        $inv_location = Inv_Location::orderBy('added_at','desc')->paginate(15);
        return response()->json([
            'status' => 'success',
            'data' => view('inventory.location.locationPagination', compact('inv_location'))->render(),
        ]);
    }//End Method



    //Search Location by Division
    public function SearchLocations(Request $request){
        $inv_location = Inv_Location::where('division', 'like', '%'.$request->search.'%')
        ->orWhere('id', 'like','%'.$request->search.'%')
        ->orderBy('division','asc')
        ->paginate(15);
        
        $paginationHtml = $inv_location->links()->toHtml();

        if($inv_location->count() >= 1){
            return response()->json([
                'status' => 'success',
                'data' => view('inventory.location.searchLocation', compact('inv_location'))->render(),
                'paginate' =>$paginationHtml
            ]);
        }
        else{
            return response()->json([
                'status'=>'null'
            ]); 
        }
    }//End Method



    //Search Location by District
    public function SearchLocationByDistrict(Request $request){
        $inv_location = Inv_Location::where('district', 'like', '%'.$request->search.'%')
        ->orderBy('district','asc')
        ->paginate(15);

        $paginationHtml = $inv_location->links()->toHtml();
        
        if($inv_location->count() >= 1){
            return response()->json([
                'status' => 'success',
                'data' => view('inventory.location.searchLocation', compact('inv_location'))->render(),
                'paginate' =>$paginationHtml
            ]);
        }
        else{
            return response()->json([
                'status'=>'null'
            ]); 
        }
    }//End Method



    //Search Location by City
    public function SearchLocationByCity(Request $request){
        $inv_location = Inv_Location::where('city', 'like', '%'.$request->search.'%')
        ->orderBy('city','asc')
        ->paginate(15);

        $paginationHtml = $inv_location->links()->toHtml();
        
        if($inv_location->count() >= 1){
            return response()->json([
                'status' => 'success',
                'data' => view('inventory.location.searchLocation', compact('inv_location'))->render(),
                'paginate' =>$paginationHtml
            ]);
        }
        else{
            return response()->json([
                'status'=>'null'
            ]); 
        }
    }//End Method



    //Search Location by Area
    public function SearchLocationByArea(Request $request){
        $inv_location = Inv_Location::where('area', 'like', '%'.$request->search.'%')
        ->orderBy('area','asc')
        ->paginate(15);

        $paginationHtml = $inv_location->links()->toHtml();
        
        if($inv_location->count() >= 1){
            return response()->json([
                'status' => 'success',
                'data' => view('inventory.location.searchLocation', compact('inv_location'))->render(),
                'paginate' =>$paginationHtml
            ]);
        }
        else{
            return response()->json([
                'status'=>'null'
            ]); 
        }
    }//End Method



    //Search Location by Roadno
    public function SearchLocationByRoadno(Request $request){
        $inv_location = Inv_Location::where('road_no', 'like', '%'.$request->search.'%')
        ->orderBy('road_no','asc')
        ->paginate(15);

        $paginationHtml = $inv_location->links()->toHtml();
        
        if($inv_location->count() >= 1){
            return response()->json([
                'status' => 'success',
                'data' => view('inventory.location.searchLocation', compact('inv_location'))->render(),
                'paginate' =>$paginationHtml
            ]);
        }
        else{
            return response()->json([
                'status'=>'null'
            ]); 
        }
    }//End Method

    /////////////////////////// --------------- Inventory Location Methods end ---------- //////////////////////////





    /////////////////////////// --------------- Inventory Store Methods start ---------- //////////////////////////
    //Show Store
    public function ShowStores(){
        $inv_store = Inv_Store::orderBy('added_at','desc')->paginate(15);
        return view('inventory.store.stores', compact('inv_store'));
    }//End Method



    //Insert Store
    public function InsertStores(Request $request){
        $request->validate([
            "storeName" => 'required|unique:inv__stores,store_name',
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



    //Edit Stores
    public function EditStores($id){
        $inv_store = Inv_Store::with('Location:id,division')->findOrFail($id);
        return response()->json([
            'inv_store'=>$inv_store,
        ]);
    }//End Method



    //Update Stores
    public function UpdateStores(Request $request,$id){
        $inv_store = Inv_Store::findOrFail($id);

        $request->validate([
            "storeName" => ['required',Rule::unique('inv__stores', 'store_name')->ignore($inv_store->id)],
            "locations" => 'required|numeric',
            "status" => 'required'
        ]);


        $update = Inv_Store::findOrFail($id)->update([
            "store_name" => $request->storeName,
            "location_id" => $request->locations,
            "status" => $request->status,
            "updated_at" => now()
        ]);
        if($update){
            return response()->json([
                'status'=>'success'
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
        $inv_store = Inv_Store::orderBy('added_at','desc')->paginate(15);
        return response()->json([
            'status' => 'success',
            'data' => view('inventory.store.storePagination', compact('inv_store'))->render(),
        ]);
    }//End Method



    //Search Store by Name
    public function SearchStores(Request $request){
        $inv_store = Inv_Store::where('store_name', 'like', '%'.$request->search.'%')
        ->orWhere('id', 'like','%'.$request->search.'%')
        ->orderBy('store_name','asc')
        ->paginate(15);

        $paginationHtml = $inv_store->links()->toHtml();
        
        if($inv_store->count() >= 1){
            return response()->json([
                'status' => 'success',
                'data' => view('inventory.store.searchStore', compact('inv_store'))->render(),
                'paginate' =>$paginationHtml
            ]);
        }
        else{
            return response()->json([
                'status'=>'null'
            ]); 
        }
    }//End Method



    //Search Store by Location
    public function SearchStoreByLocation(Request $request){
        $inv_store = Inv_Store::with('Location:id,division')
        ->whereHas('Location', function ($query) use ($request) {
            $query->where('division', 'like', '%' . $request->search . '%');
            $query->orderBy('division','asc');
        })
        ->paginate(15);

        $paginationHtml = $inv_store->links()->toHtml();
        
        if($inv_store->count() >= 1){
            return response()->json([
                'status' => 'success',
                'data' => view('inventory.store.searchStore', compact('inv_store'))->render(),
                'paginate' =>$paginationHtml
            ]);
        }
        else{
            return response()->json([
                'status'=>'null'
            ]); 
        }
    }//End Method
    
    /////////////////////////// --------------- Inventory Store Methods end ---------- //////////////////////////





    /////////////////////////// --------------- Inventory Receive Details Methods start ---------- //////////////////////////
    //Show Receive Details
    public function ShowReceiveDetails(){
        $user_info = User_Info::get();
        $inv_receive_details = Inv_Receive_Detail::orderBy('receive_date','desc')->paginate(15);
        return view('inventory.receive_detail.receiveDetails', compact('user_info','inv_receive_details'));
    }//End Method



    //Insert Receive Details
    public function InsertReceiveDetails(Request $request){
        $request->validate([
            "supplier" => 'required|numeric',
            'invoice' => 'required|numeric|unique:inv__receive__details,invoice_no',
            'product' => 'required|numeric',
            'batch' => 'required|numeric',
            'cp' => 'required|numeric',
            'discount' => 'required|numeric',
            'expiry' => 'required|date',
            'quantity' => 'required|numeric',
            'mrp' => 'required|numeric',
            'user' => 'required|numeric',
        ]);

        $inv_receive_details = Inv_Receive_Detail::insert([
            'supplier_id' => $request->supplier,
            'invoice_no' => $request->invoice,
            'product_id' => $request->product,
            'batch_no' => $request->batch,
            'cp' => $request->cp,
            'discount' => $request->discount,
            'expiry_date' => $request->expiry,
            'quantity' => $request->quantity,
            'mrp' => $request->mrp,
            'user_id' => $request->user,
        ]);
        
        if($inv_receive_details){
            return response()->json([
                'status'=>'success',
            ]); 
        } 
    }//End Method



    //Edit Receive Details
    public function EditReceiveDetails($id){
        $user_info = User_Info::get();
        $inv_receive_details = Inv_Receive_Detail::with('ProductName:id,product_name','UserName:id,name','SupplierName:id,sup_name')->findOrFail($id);
        return response()->json([
            'user_info'=>$user_info,
            'inv_receive_details'=>$inv_receive_details,
        ]);
    }//End Method



    //Update Receive Details
    public function UpdateReceiveDetails(Request $request,$id){
        $inv_receive_details = Inv_Receive_Detail::findOrFail($id);

        $request->validate([
            "supplier" => 'required|numeric',
            'invoice' => ['required','numeric',Rule::unique('inv__receive__details', 'invoice_no')->ignore($inv_receive_details->id)],
            'product' => 'required|numeric',
            'batch' => 'required|numeric',
            'cp' => 'required|numeric',
            'discount' => 'required|numeric',
            'expiry' => 'required|date',
            'quantity' => 'required|numeric',
            'mrp' => 'required|numeric',
            'user' => 'required|numeric',
            "status" => 'required'
        ]);


        $update = Inv_Receive_Detail::findOrFail($id)->update([
            'supplier_id' => $request->supplier,
            'invoice_no' => $request->invoice,
            'product_id' => $request->product,
            'batch_no' => $request->batch,
            'cp' => $request->cp,
            'discount' => $request->discount,
            'expiry_date' => $request->expiry,
            'quantity' => $request->quantity,
            'mrp' => $request->mrp,
            'user_id' => $request->user,
            "status" => $request->status,
            "updated_at" => now()
        ]);



        
        if($update){
            return response()->json([
                'status'=>'success'
            ]); 
        } 
    }//End Method



    //Delete Receive Details
    public function DeleteReceiveDetails($id){
        Inv_Receive_Detail::findOrFail($id)->delete();
        return response()->json([
            'status'=>'success'
        ]); 
    }//End Method



    //Receive Details Pagination
    public function ReceiveDetailPagination(){  
        $inv_receive_details = Inv_Receive_Detail::orderBy('receive_date','desc')->paginate(15);
        return response()->json([
            'status' => 'success',
            'data' => view('inventory.receive_detail.receiveDetailPagination', compact('inv_receive_details'))->render(),
        ]);
    }//End Method



    // Search Receive Details By Supplier
    public function SearchReceiveDetailBySupplier(Request $request){
        $inv_receive_details = Inv_Receive_Detail::with('SupplierName:id,sup_name')
        ->whereHas('SupplierName', function ($query) use ($request) {
            $query->where('sup_name', 'like', '%' . $request->search . '%');
            $query->orderBy('sup_name','asc');
        })
        ->paginate(15);


        if($inv_receive_details->count() >= 1){
            return response()->json([
                'status' => 'success',
                'data' => view('inventory.receive_detail.searchReceiveDetail', compact('inv_receive_details'))->render(),
            ]);
        }
        else{
            return response()->json([
                'status'=>'null'
            ]); 
        }
    }//End Method



    // Search Receive Details By Invoice No
    public function SearchReceiveDetailByInvoice(Request $request){
        $inv_receive_details = Inv_Receive_Detail::where('invoice_no', 'like', '%' . $request->search . '%')
        ->orderBy('invoice_no','asc')
        ->paginate(15);

        if($inv_receive_details->count() >= 1){
            return response()->json([
                'status' => 'success',
                'data' => view('inventory.receive_detail.searchReceiveDetail', compact('inv_receive_details'))->render(),
            ]);
        }
        else{
            return response()->json([
                'status'=>'null'
            ]); 
        }
    }//End Method



    // Search Receive Details By Batch No
    public function SearchReceiveDetailByBatch(Request $request){
        $inv_receive_details = Inv_Receive_Detail::where('batch_no', 'like', '%' . $request->search . '%')
        ->orderBy('batch_no','asc')
        ->paginate(15);

        if($inv_receive_details->count() >= 1){
            return response()->json([
                'status' => 'success',
                'data' => view('inventory.receive_detail.searchReceiveDetail', compact('inv_receive_details'))->render(),
            ]);
        }
        else{
            return response()->json([
                'status'=>'null'
            ]); 
        }
    }//End Method



    // Search Receive Details By Cp
    public function SearchReceiveDetailByCp(Request $request){
        $inv_receive_details = Inv_Receive_Detail::where('cp', 'like', '%' . $request->search . '%')
        ->orderBy('cp','asc')
        ->paginate(15);

        if($inv_receive_details->count() >= 1){
            return response()->json([
                'status' => 'success',
                'data' => view('inventory.receive_detail.searchReceiveDetail', compact('inv_receive_details'))->render(),
            ]);
        }
        else{
            return response()->json([
                'status'=>'null'
            ]); 
        }
    }//End Method



    // Search Receive Details By Discount
    public function SearchReceiveDetailByDiscount(Request $request){
        $inv_receive_details = Inv_Receive_Detail::where('discount', 'like', '%' . $request->search . '%')
        ->orderBy('discount','asc')
        ->paginate(15);

        if($inv_receive_details->count() >= 1){
            return response()->json([
                'status' => 'success',
                'data' => view('inventory.receive_detail.searchReceiveDetail', compact('inv_receive_details'))->render(),
            ]);
        }
        else{
            return response()->json([
                'status'=>'null'
            ]); 
        }
    }//End Method



    // Search Receive Details By Expiry Date
    public function SearchReceiveDetailByExpiry(Request $request){
        $inv_receive_details = Inv_Receive_Detail::where('expiry_date', 'like', '%' . $request->search . '%')
        ->orderBy('expiry_date','asc')
        ->paginate(15);

        if($inv_receive_details->count() >= 1){
            return response()->json([
                'status' => 'success',
                'data' => view('inventory.receive_detail.searchReceiveDetail', compact('inv_receive_details'))->render(),
            ]);
        }
        else{
            return response()->json([
                'status'=>'null'
            ]); 
        }
    }//End Method



    // Search Receive Details By Product
    public function SearchReceiveDetailByProduct(Request $request){
        $inv_receive_details = Inv_Receive_Detail::with('ProductName:id,product_name')
        ->whereHas('ProductName', function ($query) use ($request) {
            $query->where('product_name', 'like', '%' . $request->search . '%');
            $query->orderBy('product_name','asc');
        })
        ->paginate(15);


        if($inv_receive_details->count() >= 1){
            return response()->json([
                'status' => 'success',
                'data' => view('inventory.receive_detail.searchReceiveDetail', compact('inv_receive_details'))->render(),
            ]);
        }
        else{
            return response()->json([
                'status'=>'null'
            ]); 
        }
    }//End Method

    /////////////////////////// --------------- Inventory Receive Details Methods end ---------- //////////////////////////



    /////////////////////////// --------------- Inventory Transaction Details Methods start ---------- //////////////////////////
    //Show Temporary Transaction Details
    public function ShowTransactionDetailTemp(){
        $user_info = User_Info::get();
        $inv_transaction_temp = Inv_Transaction_Details_Temp::orderBy('tran_date','desc')->paginate(15);
        return view('inventory.transaction.details_temp.tempTransactionDetails', compact('user_info','inv_transaction_temp'));
    }//End Method



    // //Insert Receive Details
    // public function InsertReceiveDetails(Request $request){
    //     $request->validate([
    //         "supplier" => 'required|numeric',
    //         'invoice' => 'required|numeric|unique:inv__receive__details,invoice_no',
    //         'product' => 'required|numeric',
    //         'batch' => 'required|numeric',
    //         'cp' => 'required|numeric',
    //         'discount' => 'required|numeric',
    //         'expiry' => 'required|date',
    //         'quantity' => 'required|numeric',
    //         'mrp' => 'required|numeric',
    //         'user' => 'required|numeric',
    //     ]);

    //     $inv_receive_details = Inv_Receive_Detail::insert([
    //         'supplier_id' => $request->supplier,
    //         'invoice_no' => $request->invoice,
    //         'product_id' => $request->product,
    //         'batch_no' => $request->batch,
    //         'cp' => $request->cp,
    //         'discount' => $request->discount,
    //         'expiry_date' => $request->expiry,
    //         'quantity' => $request->quantity,
    //         'mrp' => $request->mrp,
    //         'user_id' => $request->user,
    //     ]);
        
    //     if($inv_receive_details){
    //         return response()->json([
    //             'status'=>'success',
    //         ]); 
    //     } 
    // }//End Method



    // //Edit Receive Details
    // public function EditReceiveDetails($id){
    //     $user_info = User_Info::get();
    //     $inv_receive_details = Inv_Receive_Detail::with('ProductName:id,product_name','UserName:id,name','SupplierName:id,sup_name')->findOrFail($id);
    //     return response()->json([
    //         'user_info'=>$user_info,
    //         'inv_receive_details'=>$inv_receive_details,
    //     ]);
    // }//End Method



    // //Update Receive Details
    // public function UpdateReceiveDetails(Request $request,$id){
    //     $inv_receive_details = Inv_Receive_Detail::findOrFail($id);

    //     $request->validate([
    //         "supplier" => 'required|numeric',
    //         'invoice' => ['required','numeric',Rule::unique('inv__receive__details', 'invoice_no')->ignore($inv_receive_details->id)],
    //         'product' => 'required|numeric',
    //         'batch' => 'required|numeric',
    //         'cp' => 'required|numeric',
    //         'discount' => 'required|numeric',
    //         'expiry' => 'required|date',
    //         'quantity' => 'required|numeric',
    //         'mrp' => 'required|numeric',
    //         'user' => 'required|numeric',
    //         "status" => 'required'
    //     ]);


    //     $update = Inv_Receive_Detail::findOrFail($id)->update([
    //         'supplier_id' => $request->supplier,
    //         'invoice_no' => $request->invoice,
    //         'product_id' => $request->product,
    //         'batch_no' => $request->batch,
    //         'cp' => $request->cp,
    //         'discount' => $request->discount,
    //         'expiry_date' => $request->expiry,
    //         'quantity' => $request->quantity,
    //         'mrp' => $request->mrp,
    //         'user_id' => $request->user,
    //         "status" => $request->status,
    //         "updated_at" => now()
    //     ]);



        
    //     if($update){
    //         return response()->json([
    //             'status'=>'success'
    //         ]); 
    //     } 
    // }//End Method



    // //Delete Receive Details
    // public function DeleteReceiveDetails($id){
    //     Inv_Receive_Detail::findOrFail($id)->delete();
    //     return response()->json([
    //         'status'=>'success'
    //     ]); 
    // }//End Method



    //Receive Details Pagination
    // public function ReceiveDetailPagination(){  
    //     $inv_receive_details = Inv_Receive_Detail::orderBy('receive_date','desc')->paginate(15);
    //     return response()->json([
    //         'status' => 'success',
    //         'data' => view('inventory.receive_detail.receiveDetailPagination', compact('inv_receive_details'))->render(),
    //     ]);
    // }//End Method

    /////////////////////////// --------------- Inventory Transaction Details Methods end ---------- //////////////////////////
    


    /////////////////////////// --------------- Inventory Transaction Details Methods start ---------- //////////////////////////
    //Show Temporary Transaction Main details
    public function ShowTransactionMainTemp(){
        $user_info = User_Info::get();
        $inv_transaction_main_temp = Inv_Transaction_Details_Temp::orderBy('tran_date','desc')->paginate(15);
        return view('inventory.transaction.main_temp.tempTransactionMain', compact('user_info','inv_transaction_main_temp'));
    }//End Method

    /////////////////////////// --------------- Inventory Units Methods start ---------- //////////////////////////
    /////////////////////////// --------------- Inventory Units Methods start ---------- //////////////////////////



    /////////////////////////// --------------- Status Methods start ---------- //////////////////////////
    //Update Status Dynamically
    public function Status(Request $req){
        $model = "App\\Models\\" . $req->table_name;
        if($req->status==0){
            $model::findOrFail($req->id)->update(['status'=>1]);
            return response()->json([
                'status'=>'success',
            ]);
        }
        else{
            $model::findOrFail($req->id)->update(['status'=>0]);
            return response()->json([
                'status'=>'success',
            ]);
        }  
    }//End Method

    /////////////////////////// --------------- Status Methods end ---------- //////////////////////////


}
