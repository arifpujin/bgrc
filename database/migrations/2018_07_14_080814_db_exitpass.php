<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class DbExitpass extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('db_exitpass', function (Blueprint $table) {
            $table->string('db_id_kegiatan', 3);
            $table->string('db_name_user', 100);
            $table->string('db_depart',50);
            $table->longText('db_purpose', 500);
            $table->datetime('db_hod_approv')->nullable();
            $table->string('db_name_police_out', 100);
            $table->date('db_date_out');
            $table->time('db_time_out');
            $table->string('db_name_police_in', 100);
            $table->date('db_date_in');
            $table->time('db_time_in');
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
        Schema::drop('db_exitpass');
    }
}
