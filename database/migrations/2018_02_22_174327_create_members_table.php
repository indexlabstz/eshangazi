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
            $table->integer('born_year')->unsigned()->nullable();
            $table->enum('gender', ['male', 'female'])->nullable();

            $table->foreignId('platform_id')->nullable()->constrained();
            $table->foreignId('district_id')->nullable()->constrained();

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
        Schema::dropIfExists('members');
    }
}
