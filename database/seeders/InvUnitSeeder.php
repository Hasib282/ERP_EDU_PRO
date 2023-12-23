<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Inv_Unit;
use Illuminate\Support\Facades\File;

class InvUnitSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $json = File::get("database/json/inv_units.json");
        $users = collect(json_decode($json));

        $users->each(function($user){
            Inv_Unit::create([
                "unit_name"=>$user->unit_name,
                "user_id"=>$user->user_id
            ]);
        });
    }
}
