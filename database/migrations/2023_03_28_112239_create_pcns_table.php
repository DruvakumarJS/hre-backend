<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePcnsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pcns', function (Blueprint $table) {
            $table->id();
            $table->string('pcn')->unique();
            $table->string('customer_id');
            $table->string('client_name');
            $table->string('brand');
            $table->string('work');
            $table->string('area');
            $table->string('city');
            $table->string('state');
            $table->string('proposed_start_date')->nullable();
            $table->string('proposed_end_date')->nullable();
            $table->string('approve_holidays')->nullable();
            $table->string('targeted_days')->nullable();
            $table->string('actual_start_date')->nullable();
            $table->string('actual_completed_date')->nullable();
            $table->string('hold_days')->nullable();
            $table->string('days_acheived')->nullable();
            $table->string('status');
            $table->string('assigned_to')->nullable();
            $table->string('owner')->nullable();

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
        Schema::dropIfExists('pcns');
    }
}
