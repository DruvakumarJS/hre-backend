<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHistogramHistoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('histogram_histories', function (Blueprint $table) {
            $table->id();
            $table->string('histogram_id');
            $table->string('pcn');
            $table->string('user_id');
            $table->string('submission_date');
            $table->string('submission_time');
            $table->string('path')->nullable();
            $table->string('filename')->nullable();
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
        Schema::dropIfExists('histogram_histories');
    }
}
