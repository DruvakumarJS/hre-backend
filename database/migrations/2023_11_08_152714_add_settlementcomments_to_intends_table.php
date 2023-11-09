<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddSettlementcommentsToIntendsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('intends', function (Blueprint $table) {
            $table->string('settlement_triggerd')->nullable();
            $table->string('trigger_comments')->nullable();
            $table->string('commenter_id')->nullable();
            $table->string('indent_settled')->nullable();
            $table->string('settled_comments')->nullable();
            $table->string('settler_id')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('intends', function (Blueprint $table) {
            //
        });
    }
}
