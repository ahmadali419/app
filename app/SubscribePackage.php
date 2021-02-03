<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SubscribePackage extends Model
{
    //
    protected $table='subscription_request';
    protected $fillable=['product_id','user_id'];


}
