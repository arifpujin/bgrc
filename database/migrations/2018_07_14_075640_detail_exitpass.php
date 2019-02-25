<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class DetailExitpass extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('detail_exitpass', function (Blueprint $table) {
            $table->increments('id', 3);
            $table->string('name', 100);
            $table->string('depart',50);
            $table->longText('purpose', 500);
            $table->datetime('hod_approv')->nullable();
            $table->string('name_police_out', 100);
            $table->date('date_out');
            $table->time('time_out');
            $table->string('name_police_in', 100);
            $table->date('date_in');
            $table->time('time_in');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('detail_exitpass');
    }
}
