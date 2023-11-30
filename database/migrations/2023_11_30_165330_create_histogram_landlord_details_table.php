<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHistogramLandlordDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('histogram_landlord_details', function (Blueprint $table) {
            $table->id();
            $table->integer('histogram_billing_id');
            $table->string('land_name')->nullable();
            $table->string('land_designation')->nullable();
            $table->string('land_organisation')->nullable();
            $table->string('land_contact')->nullable();
            $table->string('land_email')->nullable();
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
        Schema::dropIfExists('histogram_landlord_details');
    }
}
