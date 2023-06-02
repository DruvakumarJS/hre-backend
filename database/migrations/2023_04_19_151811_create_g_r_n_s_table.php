<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGRNSTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('g_r_n_s', function (Blueprint $table) {
            $table->id();
            $table->string('grn');
            $table->string('user_id');
            $table->string('indent_list_id');
            $table->string('indent_no');
            $table->string('pcn');
            $table->string('dispatched');
            $table->string('approved')->nullable();
            $table->string('damaged')->nullable();
            $table->string('comment')->nullable();
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
        Schema::dropIfExists('g_r_n_s');
    }
}
