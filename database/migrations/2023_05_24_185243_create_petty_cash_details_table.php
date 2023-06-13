<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePettyCashDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('petty_cash_details', function (Blueprint $table) {
            $table->id();
            $table->string('pettycash_id');
            $table->string('billing_no');
            $table->string('bill_date');
            $table->string('spent_amount');
            $table->string('purpose');
            $table->string('pcn')->nullable();
            $table->string('comments')->nullable();
            $table->string('filename');
            $table->string('isapproved')->default('0');
            $table->string('remarks')->nullable();
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
        Schema::dropIfExists('petty_cash_details');
    }
}
