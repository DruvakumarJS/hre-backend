<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateIndentListsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('indent_lists', function (Blueprint $table) {
            $table->id();
            $table->string('indent_id');
            $table->string('material_id');
            $table->string('decription');
            $table->string('quantity');
            $table->string('recieved');
            $table->string('pending');
            $table->string('status');
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
        Schema::dropIfExists('indent_lists');
    }
}
