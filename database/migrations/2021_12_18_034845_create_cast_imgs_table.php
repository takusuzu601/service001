<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCastImgsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cast_imgs', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('cast_id')->nullable();
            $table->foreign('cast_id')->references('id')->on('casts')->onDelete('cascade');
            $table->string('img_path');
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
        Schema::dropIfExists('cast_imgs');
    }
}
