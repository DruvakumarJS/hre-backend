<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePettycashesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pettycashes', function (Blueprint $table) {
            $table->id();
            $table->string('user_id');
            $table->string('total');
            $table->string('comments')->nullable();
            $table->string('spend');
            $table->string('remaining');
            $table->string('finance_id');
            $table->string('mode');
            $table->string('reference_number')->nullable();
           
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
        Schema::dropIfExists('pettycashes');
    }
}
