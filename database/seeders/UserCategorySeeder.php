<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User_Category;
use Illuminate\Support\Facades\File;

class UserCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $json = File::get("database/json/user_category.json");
        $users = collect(json_decode($json));

        $users->each(function($user){
            User_Category::create([
                "category_name"=>$user->category_name
            ]);
        });
    }
}
