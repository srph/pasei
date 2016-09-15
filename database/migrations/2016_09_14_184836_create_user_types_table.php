<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserTypesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_types', function(Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->timestamps();
        });

        DB::table('user_types')->insert([
            'id'        => 1,
            'name'      => 'student'
        ]);

        DB::table('user_types')->insert([
            'id'        => 2,
            'name'      => 'teacher'
        ]);

        DB::table('user_types')->insert([
            'id'        => 3,
            'name'      => 'staff'
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('user_types');
    }
}
