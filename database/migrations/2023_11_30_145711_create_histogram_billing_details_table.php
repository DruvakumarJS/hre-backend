<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHistogramBillingDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('histogram_billing_details', function (Blueprint $table) {
            $table->id();
            $table->string('billing_name');
            $table->string('brand')->nullable();
            $table->string('gst');
            $table->string('project_name');
            $table->string('location');
            $table->string('area');
            $table->string('city');
            $table->string('state');
            $table->string('pincode');
            $table->string('target_start_date');
            $table->string('target_end_date');
            $table->string('approved_holidays_no');
            $table->string('holiday_dates')->nullable();
            $table->string('actual_start_date');
            $table->string('actual_end_date');
            $table->string('hold_days_no');
            $table->string('hold_dates')->nullable();
            $table->string('po_date')->nullable();
            $table->string('po_number')->nullable();
            $table->string('is_dlp_applicable');
            $table->string('dlp_days')->nullable();
            $table->string('dlp_end_date')->nullable();
            $table->string('user_id');
            $table->string('pcn')->nullable();
            $table->string('form_verified_by')->nullable();
            $table->string('pcn_alloted_by')->nullable();
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
        Schema::dropIfExists('histogram_billing_details');
    }
}
