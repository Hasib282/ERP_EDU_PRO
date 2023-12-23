<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Inv_Product_Sub_Category extends Model
{
    use HasFactory;
    protected $guarded = [];
    public $timestamps = false;

    public function CategoryName(){
        return $this->belongsTo(Inv_Product_Category::class,'category_id','id');
    }
}
