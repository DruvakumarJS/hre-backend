<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHistogramClientDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('histogram_client_details', function (Blueprint $table) {
            $table->id();
            $table->integer('histogram_billing_id');
            $table->string('client_name')->nullable();
            $table->string('client_designation')->nullable();
            $table->string('client_organisation')->nullable();
            $table->string('client_contact')->nullable();
            $table->string('client_email')->nullable();
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
        Schema::dropIfExists('histogram_client_details');
    }
}
