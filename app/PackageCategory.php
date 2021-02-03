<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Category;

class PackageCategory extends Model
{
    //
    protected $table='package_category';
    protected $fillable=['package_id','food_category','food_name','food_amount','
    image'];
}
