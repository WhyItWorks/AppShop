<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('categories', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('description')->nullable();
            $table->string('image')->nullable();

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
        Schema::dropIfExists('categories');
    }

    // public function up()
    // {
    //     Schema::table('categories', function (Blueprint $table) {
    //       $table->string('image')->nullable;
    //     });
    // }

    
    // public function down()
    // {
    //     Schema::dropColumn('categories', function (Blueprint $table) {
    //         $table->string('image');
    //       });
    // }
}
