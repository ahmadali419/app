<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePackageCategoryTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('package_category', function (Blueprint $table) {
            $table->id('category_id');
            $table->unsignedBigInteger('package_id');
            $table->string('food_category');
            $table->string('food_name');
            $table->string('food_amount');
            $table->string('image');
            $table->foreign('package_id')->references('category_id')->on('users')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('package_category');
    }
}
