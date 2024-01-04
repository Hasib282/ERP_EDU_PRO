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




    //////////////////////////// ------------------- 

    

}
