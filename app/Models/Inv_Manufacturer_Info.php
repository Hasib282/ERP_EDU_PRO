<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Inv_Manufacturer_Info extends Model
{
    use HasFactory;
    protected $guarded = [];
    public $timestamps = false;


    public function UserName(){
        return $this->belongsTo(User_Info::class,'user_id','id');
    }
}
