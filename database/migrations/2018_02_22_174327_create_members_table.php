<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMembersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('members', function (Blueprint $table) {
            $table->increments('id');

            $table->string('user_platform_id')->unique();
            $table->string('name');
            $table->text('avatar')->nullable();
            $table->boolean('subscribe')->default(true);
            $table->integer('born_year');
            $table->enum('gender', ['male', 'female'])->nullable();
            
            $table->integer('platform_id')->unsigned()->nullable();
            $table->integer('district_id')->unsigned()->nullable();

            $table->timestamps();
            $table->softDeletes();

            $table->foreign('platform_id')->references('id')->on('platforms')
                ->onUpdate('restrict')->onDelete('restrict');
            $table->foreign('district_id')->references('id')->on('districts')
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
        Schema::dropIfExists('members');
    }
}
