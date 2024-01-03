<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Inv_Store extends Model
{
    use HasFactory;
    protected $guarded = [];
    public $timestamps = false;

    public function Location(){
        return $this->belongsTo(Inv_Location::class,'location_id','id');
    }
}
