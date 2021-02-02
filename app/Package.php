<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Package extends Model
{
    //
    protected $table='subscription_request';
    protected $fillable=['user_id','product_id','status'];
}
