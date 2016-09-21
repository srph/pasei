<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddGradesColumnToUserSubjectTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('user_subject', function(Blueprint $table) {
            $table->float('pace_grade');
            $table->float('conv_grade')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('user_subject', function(Blueprint $table) {
            $table->dropColumn('pace_grade');
            $table->dropColumn('conv_grade');
        });
    }
}
