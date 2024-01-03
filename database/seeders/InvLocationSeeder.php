<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Inv_Location;
use Illuminate\Support\Facades\File;

class InvLocationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $json = File::get("database/json/inv_location.json");
        $locations = collect(json_decode($json));

        $locations->each(function($location){
            Inv_Location::create([
                "division"=>$location->division,
                "district_name"=>$location->district_name,
                "city_name"=>$location->city_name,
                "area"=>$location->area,
                "road_no"=>$location->road_no
            ]);
        });
    }
}
