<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCentersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('centers', function (Blueprint $table) {
            $table->increments('id');

            $table->string('name');
            $table->text('description');
            $table->string('thumbnail');
            $table->string('phone');
            $table->text('address')->nullable();
            $table->string('email')->nullable();
            $table->string('website')->nullable();

            $table->foreignId('ward_id')->constrained();
            $table->foreignId('user_id')->constrained();

            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('centers');
    }
}
