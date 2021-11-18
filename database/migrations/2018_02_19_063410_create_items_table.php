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

            $table->foreignId('item_id')->nullable()->constrained();
            $table->foreignId('item_category_id')->constrained();
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
        Schema::dropIfExists('items');
    }
}
