<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVendorDepartmentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vendor_departments', function (Blueprint $table) {
            $table->id();
            $table->integer('vid_id');
            $table->string('vid');
            $table->string('billing_name');
            $table->string('vendor_type');
            $table->string('gst');
            $table->string('pan');
            $table->string('tin');
            $table->string('building');
            $table->string('area');
            $table->string('location')->nullable();
            $table->string('city');
            $table->string('state');
            $table->string('pincode');
            $table->string('owner');
            $table->string('mobile');
            $table->string('email');

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
        Schema::dropIfExists('vendor_departments');
    }
}
