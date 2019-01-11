<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('items', function (Blueprint $table) {
            $table->increments('id');

            $table->string('title');
            $table->text('description');
            $table->string('thumbnail')->nullable();
            $table->enum('gender', ['both', 'male', 'female'])->default('both');
            $table->integer('minimum_age')->default(13);
            $table->string('display_title')->nullable();

            $table->integer('item_category_id')->unsigned();
            $table->integer('item_id')->unsigned()->nullable();
            $table->integer('created_by')->unsigned();
            $table->integer('updated_by')->unsigned()->nullable();

            $table->timestamps();
            $table->softDeletes();

            $table->foreign('item_id')->references('id')->on('items')
                ->onUpdate('restrict')->onDelete('restrict');
            $table->foreign('item_category_id')->references('id')->on('item_categories')
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
        Schema::dropIfExists('items');
    }
}
