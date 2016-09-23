<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class RenameConvGradeToConventionalGrade extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('user_subject', function(Blueprint $table) {
            $table->renameColumn('conv_grade', 'conventional_grade');
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
            $table->renameColumn('conventional_grade', 'conv_grade');
        });
    }
}
