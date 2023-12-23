<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User_Info;
use Illuminate\Support\Facades\File;

class UserInfoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $json = File::get("database/json/user_info.json");
        $users = collect(json_decode($json));

        $users->each(function($user){
            User_info::create([
                "name"=>$user->name,
                "email"=>$user->email,
                "contact"=>$user->contact,
                "gender"=>$user->gender,
                "address"=>$user->address,
                "password"=>$user->password,
                "category_id"=>$user->category_id
            ]);
        });
        


    }
}
