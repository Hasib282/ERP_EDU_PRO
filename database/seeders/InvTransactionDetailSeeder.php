<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Inv_Transaction_Details_Temp;
use Illuminate\Support\Facades\File;

class InvTransactionDetailSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $json = File::get("database/json/inv_transaction_details_temp.json");
        $transitions = collect(json_decode($json));

        $transitions->each(function($transition){
            Inv_Transaction_Details_Temp::create([
                "tran_type"=>$transition->tran_type,
                "tran_id"=>$transition->tran_id,
                "supplier_id"=>$transition->supplier_id,
                "client_id"=>$transition->client_id,
                "sl"=>$transition->sl,
                "product_id"=>$transition->product_id,
                "receive_qty"=>$transition->receive_qty,
                "issue_qty"=>$transition->issue_qty,
                "balance_qty"=>$transition->balance_qty,
                "cp"=>$transition->cp,
                "mrp"=>$transition->mrp,
                "tot_cp"=>$transition->tot_cp,
                "tot_mrp"=>$transition->tot_mrp,
                "discount"=>$transition->discount,
                "profit"=>$transition->profit,
                "receive_id"=>$transition->receive_id,
                "user_id"=>$transition->user_id
            ]);
        });
    }
}
