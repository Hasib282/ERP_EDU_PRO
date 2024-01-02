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

class InventoryController extends Controller
{
    /////////////////////////// --------------- Inventory Units Methods start ---------- //////////////////////////
    //Show Units
    public function ShowUnits(){
        $inv_unit = Inv_Unit::orderBy('added_at','desc')->paginate(5);
        return view('inventory.unit.units', compact('inv_unit'));
    }


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
    }


    //Edit Unit
    public function EditUnits($id){
        $inv_unit = Inv_Unit::findOrFail($id);
        return response()->json([
            'inv_unit'=>$inv_unit,
        ]);
    }



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
    }



    //Delete Units
    public function DeleteUnits($id){
        Inv_Unit::findOrFail($id)->delete();
        return response()->json([
            'status'=>'success'
        ]); 
    }


    public function UnitPagination(){
        $inv_unit = Inv_Unit::orderBy('added_at','desc')->paginate(5);
        return view('inventory.unit.unitPagination', compact('inv_unit'))->render();
    }



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
        
    }

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
            "supplierName" => 'required',
            "supplierEmail" => 'required',
            "supplierContact" => 'required',
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
    }



    //Edit Supplier
    public function EditSuppliers($id){
        $inv_supplier = Inv_Supplier_info::findOrFail($id);
        $user_info = User_Info::get();
        return response()->json([
            'inv_supplier'=>$inv_supplier,
            'user_info'=>$user_info,
        ]);
    }



    //Update Suppliers
    public function UpdateSuppliers(Request $request,$id){
        $inv_unit = Inv_Supplier_info::findOrFail($id);

        $request->validate([
            "supplierName" => 'required',
            "supplierEmail" => 'required',
            "supplierContact" => 'required',
            "user" => 'required',
            "status" => 'required'
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
    }



    //Delete Supplier
    public function DeleteSuppliers($id){
        Inv_Supplier_Info::findOrFail($id)->delete();
        return response()->json([
            'status'=>'success'
        ]); 
    }


    public function SupplierPagination(){
        $user_info = User_Info::get();
        $inv_supplier = Inv_Supplier_Info::orderBy('added_at','desc')->paginate(5);
        return view('inventory.supplier.supplierPagination', compact('inv_supplier','user_info'))->render();
    }


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
        
    }

    /////////////////////////// --------------- Inventory Suppliers Methods start---------- //////////////////////////



    /////////////////////////// --------------- Inventory Manufacturers Methods start---------- //////////////////////////

    public function ShowManufacturers(){
        $inv_manufacturer = Inv_Manufacturer_Info::get();
        return view('inventory.manufacturer.manufacturers', compact('inv_manufacturer'));
    }//End Method


    public function AddManufacturers(){
        $user_info = User_Info::get();
        return view('inventory.manufacturer.addManufacturers',compact('user_info'));
    }


    //Insert Manufacturer
    public function InsertManufacturers(Request $request){
        Inv_Manufacturer_info::insert([
            "manufacturer_name" => $request->manufacturerName,
            "manufacturer_email" => $request->manufacturerEmail,
            "manufacturer_contact" => $request->manufacturerContact,
            "user_id" => $request->user,
        ]);
        return redirect()->route('show.manufacturers');  
    }



    //Edit Manufacturer
    public function EditManufacturers($id){
        $inv_manufacturer = Inv_Manufacturer_info::findOrFail($id);
        $user_info = User_Info::get();
        return view('inventory.manufacturer.editManufacturers', compact('inv_manufacturer','user_info'));
    }



    //Update Manufacturer
    public function UpdateManufacturers(Request $request,$id){
        Inv_Manufacturer_info::findOrFail($id)->update([
            "manufacturer_name" => $request->manufacturerName,
            "manufacturer_email" => $request->manufacturerEmail,
            "manufacturer_contact" => $request->manufacturerContact,
            "user_id" => $request->user,
            "status" => $request->status,
            "updated_at" => now()
        ]);
        return redirect()->route('show.manufacturers');  
    }


    //Delete Manufacturers
    public function DeleteManufacturers($id){
        Inv_Manufacturer_Info::findOrFail($id)->delete();
        return redirect()->back();  
    }

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
         
    }



    //Edit Product Category
    public function EditProductCategory($id){
        $inv_product_category = Inv_Product_Category::findOrFail($id);
        return response()->json([
            'inv_product_category'=>$inv_product_category,
        ]);
    }


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
    }


    //Delete Product Category
    public function DeleteProductCategory($id){
        Inv_Product_Category::findOrFail($id)->delete();
        return response()->json([
            'status'=>'success'
        ]); 
    }


    //product Category Pagination
    public function ProductCategoryPagination(){
        $inv_product_category = Inv_Product_Category::orderBy('added_at','desc')->paginate(5);
        return view('inventory.product_category.productCategoryPagination', compact('inv_product_category'))->render();
    }


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
    }
    
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
         
    }




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
    }



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
    }



    //Delete Product Sub Category
    public function DeleteSubCategory($id){
        Inv_Product_Sub_Category::findOrFail($id)->delete();
        return response()->json([
            'status'=>'success'
        ]);
    }


    //product Category Pagination
    public function SubCategoryPagination(){
        $sub_category = Inv_Product_Sub_Category::orderBy('added_at','desc')->paginate(5);
        return view('inventory.product_category.sub_category.subCategoryPagination', compact('sub_category'))->render();
    }


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
    }
    
    /////////////////////////// --------------- Inventory Product Sub Categorys Methods end---------- //////////////////////////










    //////////////////////////// ------------------ Inventory Products Methods start --------------- //////////////////////////
    
    //show all Products
    public function ShowProducts(){
        $inv_product = Inv_Product::get();
        return view('inventory.product.products', compact('inv_product'));
    }


    //Add Products
    public function AddProducts(){
        $inv_product_category = Inv_Product_Category::get();
        $sub_category = Inv_Product_Sub_Category::get();
        $inv_manufacturer = Inv_Manufacturer_Info::get();
        $inv_unit = Inv_Unit::get();
        $user_info = User_Info::get();
        return view('inventory.product.addProducts',compact('inv_product_category','inv_manufacturer','inv_unit','user_info','sub_category'));
    }


    //Insert Product
    public function InsertProducts(Request $request){
        Inv_Product::insert([
            "product_name" => $request->productName,
            "category_id" => $request->category,
            "sub_category_id" => $request->subCategory,
            "manufacturer_id" => $request->manufacturer,
            "size" => $request->size,
            "unit" => $request->unit,
            "mrp" => $request->mrp,
            "user_id" => $request->user,
        ]);
        return redirect()->route('show.products');  
    }


    



    //Edit Product
    public function EditProducts($id){
        $inv_product_category = Inv_Product_Category::get();
        $sub_category = Inv_Product_Sub_Category::get();
        $inv_manufacturer = Inv_Manufacturer_Info::get();
        $inv_unit = Inv_Unit::get();
        $user_info = User_Info::get();
        $inv_product = Inv_Product::findOrFail($id);
        return view('inventory.product.editProducts', compact('inv_product','inv_product_category','inv_manufacturer','inv_unit','user_info','sub_category'));
    }//End Method



    //Update Product
    public function UpdateProducts(Request $request,$id){
        Inv_Product::findOrFail($id)->update([
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
        return redirect()->route('show.products');  
    }//End Method



    //Delete Product
    public function DeleteProducts($id){
        Inv_Product::findOrFail($id)->delete();
        return redirect()->back();  
    }


    /////////////////////////// --------------- Inventory Products Methods end ---------- //////////////////////////




    /////////////////////////// --------------- Inventory Units Methods start ---------- //////////////////////////
    /////////////////////////// --------------- Inventory Units Methods start ---------- //////////////////////////





    /////////////////////////// --------------- Inventory Units Methods start ---------- //////////////////////////
    /////////////////////////// --------------- Inventory Units Methods start ---------- //////////////////////////





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
    }

    /////////////////////////// --------------- Status Methods end ---------- //////////////////////////

    /////////////////////////// --------------- Pagination Method start ---------- //////////////////////////

    // public function Pagination(Request $request){

    // }

    /////////////////////////// --------------- Units Methods start ---------- //////////////////////////

}
