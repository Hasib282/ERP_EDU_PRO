<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Inv_Transaction_Main_Temp;
use Illuminate\Support\Facades\File;

class InvTransactionMainSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $json = File::get("database/json/inv_transaction_main_temp.json");
        $transitions = collect(json_decode($json));

        $transitions->each(function($transition){
            Inv_Transaction_Main_Temp::create([
                "tran_type"=>$transition->tran_type,
                "tran_id"=>$transition->tran_id,
                "supplier_id"=>$transition->supplier_id,
                "client_id"=>$transition->client_id,
                "invoice_no"=>$transition->invoice_no,
                "invoice_amount"=>$transition->invoice_amount,
                "discount"=>$transition->discount,
                "net_amount"=>$transition->net_amount,
                "user_id"=>$transition->user_id
            ]);
        });
    }
}
