<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Inv_Transaction_Details_Temp extends Model
{
    use HasFactory;
    protected $guarded = [];
    public $timestamps = false;

    public function Store(){
        return $this->belongsTo(Inv_Store::class,'store_id','id');
    }

    public function Location(){
        return $this->belongsTo(Inv_Location::class,'location_id','id');
    }

    public function Supplier(){
        return $this->belongsTo(Inv_Supplier_Info::class,'supplier_id','id');
    }


    public function Product(){
        return $this->belongsTo(Inv_Product::class,'product_id','id');
    }

    public function User(){
        return $this->belongsTo(User_Info::class,'user_id','id');
    }
}
