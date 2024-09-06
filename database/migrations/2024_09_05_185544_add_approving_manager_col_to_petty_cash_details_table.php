<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddApprovingManagerColToPettyCashDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('petty_cash_details', function (Blueprint $table) {
            $table->string('approving_manager')->nullable();
            $table->string('manager_approval')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('petty_cash_details', function (Blueprint $table) {
            //
        });
    }
}
