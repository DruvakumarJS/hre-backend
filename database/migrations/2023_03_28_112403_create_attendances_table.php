<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAttendancesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('attendances', function (Blueprint $table) {
            $table->id();
            $table->string('date');
            $table->string('user_id');
            $table->string('login_time');
            $table->string('login_lat')->nullable();
            $table->string('login_long')->nullable();
            $table->string('login_location')->nullable();
            $table->string('logout_time')->nullable();
            $table->string('logout_lat')->nullable();
            $table->string('logout_long')->nullable();
            $table->string('logout_location')->nullable();
            $table->string('overtime')->default('No');
            $table->string('total_hours')->default('0');
            $table->string('proof')->nullable();
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
        Schema::dropIfExists('attendances');
    }
}
