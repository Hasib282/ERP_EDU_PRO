<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Inv_Supplier_Info;
use Illuminate\Support\Facades\File;

class InvSupplierInfoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $json = File::get("database/json/inv_supplier_info.json");
        $users = collect(json_decode($json));

        $users->each(function($user){
            Inv_Supplier_Info::create([
                "sup_name"=>$user->sup_name,
                "sup_email"=>$user->sup_email,
                "sup_contact"=>$user->sup_contact,
                "user_id"=>$user->user_id,
            ]);
        });
    }
}
