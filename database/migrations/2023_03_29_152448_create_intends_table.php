<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateIntendsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('intends', function (Blueprint $table) {
            $table->id();
            $table->string('indent_no');
            $table->string('pcn');
            $table->string('user_id');
            $table->string('quantity');
            $table->string('recieved');
            $table->string('pending');
            $table->string('status');
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
        Schema::dropIfExists('intends');
    }
}
