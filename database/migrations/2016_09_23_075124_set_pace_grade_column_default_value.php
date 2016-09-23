<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class SetPaceGradeColumnDefaultValue extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('user_subject', function(BluePrint $table) {
            $table->float('pace_grade')->nullable()->change();
            $table->float('conventional_grade')->nullable(false)->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('user_subject', function(BluePrint $table) {
            $table->float('pace_grade')->nullable(false)->change();
            $table->float('conventional_grade')->nullable()->change();
        });
    }
}
