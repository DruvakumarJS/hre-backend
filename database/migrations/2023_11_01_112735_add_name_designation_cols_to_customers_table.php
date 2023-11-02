<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddNameDesignationColsToCustomersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('customers', function (Blueprint $table) {
            $table->string('full_name')->nullable();
            $table->string('designation')->nullable();
            $table->string('full_name1')->nullable();
            $table->string('designation1')->nullable();
            $table->string('full_name2')->nullable();
            $table->string('designation2')->nullable();
            $table->string('full_name3')->nullable();
            $table->string('designation3')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('customers', function (Blueprint $table) {
            //
        });
    }
}
