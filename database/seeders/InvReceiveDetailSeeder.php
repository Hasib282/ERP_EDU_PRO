<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Inv_Receive_Detail;
use Illuminate\Support\Facades\File;

class InvReceiveDetailSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $json = File::get("database/json/inv_receive_details.json");
        $receive_details = collect(json_decode($json));

        $receive_details->each(function($receive_detail){
            Inv_Receive_Detail::create([
                "supplier_id"=>$receive_detail->supplier_id,
                'invoice_no'=>$receive_detail->invoice_no,
                'product_id'=>$receive_detail->product_id,
                'batch_no'=>$receive_detail->batch_no,
                'cp'=>$receive_detail->cp,
                'discount'=>$receive_detail->discount,
                'expiry_date'=>$receive_detail->expiry_date,
                'quantity'=>$receive_detail->quantity,
                'mrp'=>$receive_detail->mrp,
                'user_id'=>$receive_detail->user_id,
            ]);
        });
    }
}
