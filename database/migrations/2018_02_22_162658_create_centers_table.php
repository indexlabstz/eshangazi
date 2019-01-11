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

            $table->integer('ward_id')->unsigned();
            $table->integer('partner_id')->unsigned();
            $table->integer('created_by')->unsigned();
            $table->integer('updated_by')->unsigned()->nullable();

            $table->timestamps();
            $table->softDeletes();

            $table->foreign('ward_id')->references('id')->on('wards')
                ->onUpdate('restrict')->onDelete('restrict');
            $table->foreign('partner_id')->references('id')->on('partners')
                ->onUpdate('restrict')->onDelete('restrict');
            $table->foreign('created_by')->references('id')->on('users')
                ->onUpdate('restrict')->onDelete('restrict');
            $table->foreign('updated_by')->references('id')->on('users')
                ->onUpdate('restrict')->onDelete('restrict');
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
