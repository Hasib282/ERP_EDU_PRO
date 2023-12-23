<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class User_Info extends Model
{
    use HasFactory;
    protected $guarded = [];
    public $timestamps = false;

    public function CategoryName(){
        return $this->belongsTo(User_Category::class,'category_id','id');
    }
}
