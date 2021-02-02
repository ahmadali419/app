<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PackageCategory extends Model
{
    //
    protected $table='package_category';
    protected $fillable=['package_id','food_category','food_name','food_amount','
    image'];
}
