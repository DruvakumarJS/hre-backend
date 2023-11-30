<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHistogramArchitectDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('histogram_architect_details', function (Blueprint $table) {
            $table->id();
            $table->integer('histogram_billing_id');
            $table->string('arc_name')->nullable();
            $table->string('arc_designation')->nullable();
            $table->string('arc_organisation')->nullable();
            $table->string('arc_contact')->nullable();
            $table->string('arc_email')->nullable();
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
        Schema::dropIfExists('histogram_architect_details');
    }
}
