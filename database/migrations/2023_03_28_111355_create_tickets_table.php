<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTicketsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tickets', function (Blueprint $table) {
            $table->id();
            $table->string('ticket_no');
            $table->string('pcn');
            $table->string('category');
            $table->string('issue')->nullable();
            $table->string('assigner')->nullable();
            $table->string('assigned_to')->nullable();
            $table->string('creator');
            $table->string('status');
            $table->string('reopened')->default('0');
            $table->string('priority')->nullable();
            $table->string('tat')->nullable();
            $table->string('comments')->nullable();
            $table->string('filename')->nullable();
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
        Schema::dropIfExists('tickets');
    }
}
