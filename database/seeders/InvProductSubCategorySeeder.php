<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Inv_Product_Sub_Category;
use Illuminate\Support\Facades\File;

class InvProductSubCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $json = File::get("database/json/inv_product_sub_category.json");
        $sub_category = collect(json_decode($json));

        $sub_category->each(function($sub){
            Inv_Product_Sub_Category::create([
                "sub_category_name"=>$sub->sub_category_name,
                'category_id'=>$sub->category_id
            ]);
        });
    }
}
