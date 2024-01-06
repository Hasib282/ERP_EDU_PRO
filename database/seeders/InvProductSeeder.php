<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Inv_Product;
use Illuminate\Support\Facades\File;

class InvProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $json = File::get("database/json/inv_product.json");
        $users = collect(json_decode($json));

        $users->each(function($user){
            Inv_Product::create([
                "product_name"=>$user->product_name,
                "category_id"=>$user->category_id,
                "sub_category_id"=>$user->sub_category_id,
                "manufacturer_id"=>$user->manufacturer_id,
                "size"=>$user->size,
                "unit"=>$user->unit,
                "mrp"=>$user->mrp,
                "expiry_date"=>$user->expiry_date,
                "user_id"=>$user->user_id,
            ]);
        });
    }
}
