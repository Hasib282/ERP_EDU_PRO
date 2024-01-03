<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Inv_Client_info;
use Illuminate\Support\Facades\File;

class InvClientInfoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $json = File::get("database/json/inv_client_infos.json");
        $clients = collect(json_decode($json));

        $clients->each(function($client){
            Inv_Client_Info::create([
                "client_name"=>$client->client_name,
                "contact"=>$client->contact,
                "user_id"=>$client->user_id,
            ]);
        });
    }
}
