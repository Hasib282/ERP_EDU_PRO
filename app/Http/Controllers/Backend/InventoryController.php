<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\user_info;
use App\Models\Inv_Unit;
use App\Models\Inv_Supplier_Info;
use App\Models\Inv_Manufacturer_info;
use App\Models\Inv_Product_Category;
use App\Models\Inv_Product_Sub_Category;
use App\Models\Inv_Product;
use Carbon\Carbon;

class InventoryController extends Controller
{
    /////////////////////////// --------------- Inventory Units Methods start ---------- //////////////////////////
    public function ShowUnits(){
        $inv_unit = Inv_Unit::get();
        return view('inventory.unit.units', compact('inv_unit'));
    }//End Method


    public function AddUnits(){
        return view('inventory.unit.addUnits');
    }

    //Delete Units
    public function DeleteUnits($id){
        Inv_Unit::findOrFail($id)->delete();
        return redirect()->back();  
    }

    /////////////////////////// --------------- Inventory Units Methods end ---------- //////////////////////////


    /////////////////////////// --------------- Inventory Suppliers Methods start---------- //////////////////////////

    public function ShowSuppliers(){
        $inv_supplier = Inv_Supplier_Info::get();
        return view('inventory.supplier.suppliers', compact('inv_supplier'));
    }//End Method

    public function AddSuppliers(){
        return view('inventory.supplier.addSuppliers');
    }

    //Delete Supplier
    public function DeleteSuppliers($id){
        Inv_Supplier_Info::findOrFail($id)->delete();
        return redirect()->back();  
    }

    /////////////////////////// --------------- Inventory Suppliers Methods start---------- //////////////////////////



    /////////////////////////// --------------- Inventory Manufacturers Methods start---------- //////////////////////////

    public function ShowManufacturers(){
        $inv_manufacturer = Inv_Manufacturer_Info::get();
        return view('inventory.manufacturer.manufacturers', compact('inv_manufacturer'));
    }//End Method


    public function AddManufacturers(){
        return view('inventory.manufacturer.addManufacturers');
    }

    //Delete Manufacturers
    public function DeleteManufacturers($id){
        Inv_Manufacturer_Info::findOrFail($id)->delete();
        return redirect()->back();  
    }

    /////////////////////////// --------------- Inventory Manufacturers Methods end---------- //////////////////////////








    /////////////////////////// --------------- Inventory Product Categorys Methods start---------- //////////////////////////
    
    public function ShowProductCategory(){
        $inv_product_category = Inv_Product_Category::get();
        return view('inventory.product_category.productCategory', compact('inv_product_category',));
    }//End Method


    public function AddProductCategory(){
        return view('inventory.product_category.addProductCategory');
    }

    //Insert Products
    public function InsertProductCategory(Request $request){
        Inv_Product_Category::insert([
            "product_category_name"=>$request->categoryName,
        ]);
        return redirect()->route('show.productCatagory');
    }



    //Edit Product Category
    public function EditProductCategory($id){
        $inv_product_category = Inv_Product_Category::findOrFail($id);
        return view('inventory.product_category/editProductCategory', compact('inv_product_category'));
    }


    //Update Product Category
    public function UpdateProductCategory(Request $request,$id){
        Inv_Product_Category::findOrFail($id)->update([
            "product_category_name"=>$request->categoryName,
            "updated_at" => now()
        ]);
        return redirect()->route('show.productCatagory');  
    }


    //Delete Product Category
    public function DeleteProductCategory($id){
        Inv_Product_Category::findOrFail($id)->delete();
        return redirect()->back();  
    }
    
    /////////////////////////// --------------- Inventory Product Categorys Methods end---------- //////////////////////////











    /////////////////////////// --------------- Inventory Product Sub Categorys Methods start---------- //////////////////////////
    
    
    //Show Product Sub Categories
    public function ShowSubCategory(){
        $sub_category = Inv_Product_Sub_Category::get();
        return view('inventory.product_category.sub_category.subcategory', compact('sub_category',));
    }

   

    //Add Product Sub Category
    public function AddSubCategory(){
        $inv_product_category = Inv_Product_Category::get();
        return view('inventory.product_category.sub_category.addSubCategory',compact('inv_product_category'));
    }


    public function GetSubcategory(Request $req)
    {
        dd($req->category_id);
        $subcategories = Subcategory::where('category_id', $category)->pluck('sub_category_name','id');
        return response()->json($subcategories);
    }


    //Insert Product Sub Category
    public function InsertSubCategory(Request $request){
        
        Inv_Product_Sub_Category::insert([
            "sub_category_name"=>$request->subCategory,
            "category_id"=>$request->category
        ]);
        return redirect()->route('show.subCatagory');
    }




    //Edit Product Sub Category
    public function EditSubCategory($id){
        $inv_sub_category = Inv_Product_Sub_Category::findOrFail($id);
        $inv_product_category = Inv_Product_Category::get();
        return view('inventory.product_category.sub_category.editSubCategory', compact('inv_sub_category','inv_product_category'));
    }



    //Update Product Sub Category
    public function UpdateSubCategory(Request $request,$id){
        $inv_product_category = Inv_Product_Category::findOrFail($id);
        Inv_Product_Sub_Category::findOrFail($id)->update([
            "sub_category_name"=>$request->subCategory,
            "category_id"=>$request->category,
            "updated_at" => now()
        ]);
        return redirect()->route('show.subCatagory');  
    }



    //Delete Product Sub Category
    public function DeleteSubCategory($id){
        Inv_Product_Sub_Category::findOrFail($id)->delete();
        return redirect()->back();  
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
            "product_name"=>$request->productName,
            "category_id"=>$request->category,
            "sub_category_id"=>$request->subCategory,
            "manufacturer_id"=>$request->manufacturer,
            "size"=>$request->size,
            "unit"=>$request->unit,
            "quantity"=>$request->quantity,
            "mrp"=>$request->mrp,
            "user_id"=>$request->user,
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
            "product_name"=>$request->productName,
            "category_id"=>$request->category,
            "sub_category_id"=>$request->subCategory,
            "manufacturer_id"=>$request->manufacturer,
            "size"=>$request->size,
            "unit"=>$request->unit,
            "quantity"=>$request->quantity,
            "mrp"=>$request->mrp,
            "user_id"=>$request->user,
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

}
