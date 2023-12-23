<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Inv_Manufacturer_Info;
use Illuminate\Support\Facades\File;

class InvManufacturerInfoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $json = File::get("database/json/inv_manufacturer_info.json");
        $users = collect(json_decode($json));

        $users->each(function($user){
            Inv_Manufacturer_Info::create([
                "manufacturer_name"=>$user->manufacturer_name,
                "manufacturer_email"=>$user->manufacturer_email,
                "manufacturer_contact"=>$user->manufacturer_contact,
                "user_id"=>$user->user_id,
            ]);
        });
    }
}
