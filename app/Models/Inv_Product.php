<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Inv_Product extends Model
{
    use HasFactory;
    protected $guarded = [];
    public $timestamps = false;

    public function CategoryName(){
        return $this->belongsTo(Inv_Product_Category::class,'category_id','id');
    }

    public function ManufacturerName(){
        return $this->belongsTo(Inv_Manufacturer_Info::class,'manufacturer_id','id');
    }

    public function UnitName(){
        return $this->belongsTo(Inv_Unit::class,'unit','id');
    }

    public function UserName(){
        return $this->belongsTo(User_Info::class,'user_id','id');
    }

    public function SubCategory(){
        return $this->belongsTo(Inv_Product_Sub_Category::class,'sub_category_id','id');
    }
}
