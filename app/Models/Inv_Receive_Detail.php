<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Inv_Receive_Detail extends Model
{
    use HasFactory;
    protected $guarded = [];
    public $timestamps = false;

    public function ProductName(){
        return $this->belongsTo(Inv_Product::class,'product_id','id');
    }

    public function UserName(){
        return $this->belongsTo(User_Info::class,'user_id','id');
    }

    public function SupplierName(){
        return $this->belongsTo(Inv_Supplier_Info::class,'supplier_id','id');
    }
}
