<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePettycashSummariesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pettycash_summaries', function (Blueprint $table) {
            $table->id();
            $table->string('user_id');
            $table->string('finance_id');
            $table->string('pettycash_id');
            $table->string('amount');
            $table->string('comment');
            $table->string('type');
            $table->string('balance');
            $table->string('transaction_date');
            $table->string('mode')->nullable();
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
        Schema::dropIfExists('pettycash_summaries');
    }
}
