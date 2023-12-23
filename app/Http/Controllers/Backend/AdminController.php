<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Inv_Unit;
use Carbon\Carbon;

class AdminController extends Controller
{
    public function AdminDashboard(){

        return view('admin.admin_master_dashboard');

    }//End Method





    // /////////////// ---------------- show metheod for inventory starts here -------------- ////////////

    // public function Products(){

    //     $products = DB::table('products')->get();
    //     return view('admin.inventory.show.products', compact('products'));

    // }//End Method


    // public function Units(){

    //     $inv_unit = DB::table('inv_units')->get();
    //     return view('admin.inventory.show.units', compact('inv_unit'));

    // }//End Method


    // public function Suppliers(){

    //     $suppliers = DB::table('suppliers')->get();
    //     return view('admin.inventory.show.suppliers', compact('suppliers'));

    // }//End Method

    // public function Manufacturers(){

    //     $suppliers = DB::table('manufacturers')->get();
    //     return view('admin.inventory.show.manufacturers', compact('manufacturers'));

    // }//End Method

    // public function Clients(){

    //     return view('admin.inventory.show.clients');

    // }//End Method


    // /////////////// ---------------- show metheod for inventory end here -------------- ////////////



    // /////////////// ---------------- add metheod for inventory starts here -------------- ////////////
    
    // public function AddProducts(){

    //     return view('admin.inventory.add.addProducts');

    // }//End Method

    

    // public function AddUnits(){

    //     return view('admin.inventory.add.addUnits');

    // }//End Method

    // public function AddSuppliers(){

    //     return view('admin.inventory.add.addSuppliers');

    // }//End Method

    // public function AddManufacturers(){

    //     return view('admin.inventory.add.addManufacturers');

    // }//End Method

    // public function AddClients(){

    //     return view('admin.inventory.add.addClients');

    // }//End Method
    
    
    // /////////////// ---------------- add metheod for inventory end here -------------- ////////////

    

    // /////////////// ---------------- edit metheod for inventory starts here -------------- ////////////
    
    // public function EditProducts(){

    //     return view('admin.inventory.edit.editProducts');

    // }//End Method

    // public function EditUnits(){

    //     return view('admin.inventory.edit.editUnits');

    // }//End Method

    // public function EditUnit($id){

    //     $inv_unit = DB::table('inv_units')->findOrFail($id);
    //     return view("unit.edit_unit",compact("inv_unit"));

    // }//End Method

    // public function UpdateUnit(Request $request){

    //     $unitid = $request->id;

    //     DB::table('inv_units')->findOrFail($unitid)->update([
    //         'unit_name' => $request->unitName,
    //         'status' => $request->unitstatus,
    //         'updated_at' => Carbon::now(),
    //     ]);

    //      $notification = array(
    //         'message' => 'Unit Update Successfully',
    //         'alert-type' => 'success'
    //     );

    //     return redirect()->route('unit')->with($notification);  

    // }//End Method

    // public function EditSuppliers(){

    //     return view('admin.inventory.edit.editSuppliers');

    // }//End Method

    // public function EditManufacturers(){

    //     return view('admin.inventory.edit.editManufacturers');

    // }//End Method

    // public function EditClients(){

    //     return view('admin.inventory.edit.editClients');

    // }//End Method

    // /////////////// ---------------- edit metheod for inventory ends here -------------- ////////////

    // /////////////// ---------------- delete metheod for inventory starts here -------------- ////////////

    // public function DeleteUnits($id){

    //     DB::table('inv_units')->findOr($id)->delete();
    //     $notification = array(
    //         'message' => 'Unit Delete Successfully',
    //         'alert-type' => 'success'
    //     );
    //     return redirect()->back()->with($notification);  
    // }//End Method


    // /////////////// ---------------- delete metheod for inventory ends here -------------- ////////////

    // /////////////// ------------------------ Status Method ------------------------ //////////////////
    // //////////////////////////////// -------Status Method------ ///////////////////////////////
    // public function Status($id)
    // {
    //     $status = DB::table('inv_units')->findOrFail($id);
    //     if($status->status==1){
    //         $status->status=2;
    //     }
    //     else{
    //         $status->status=1;
    //     }
    //     $status->update();
    //     return redirect()->back();
    // }




    //////////////////////////// ------------------- 

    

}
