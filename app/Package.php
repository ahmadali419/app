<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\PackageCategory;

class Package extends Model
{
    //
    protected $table='packages';
    protected $fillable=['package_name','package_validity','meals','package_amount','package_description','image'];

    public function categories(){
        return $this->hasMany(PackageCategory::class,"package_id","package_id");
    }
}
