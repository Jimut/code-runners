<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddXpAndTestCase extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('problems', function (Blueprint $table) {
            $table->string('input');
            $table->string('output');
        });

        Schema::table('users', function (Blueprint $table) {
            $table->integer('xp');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('problems', function (Blueprint $table) {
            $table->dropColumn('input');
            $table->dropColumn('output');
        });

        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('xp');
        });
    }
}
