<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Inv_Store;
use Illuminate\Support\Facades\File;

class InvStoreSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $json = File::get("database/json/inv_store.json");
        $stores = collect(json_decode($json));

        $stores->each(function($store){
            Inv_Store::create([
                "store_name"=>$store->store_name,
                "location_id"=>$store->location_id,
            ]);
        });
    }
}
