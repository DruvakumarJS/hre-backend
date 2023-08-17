<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('password_resets', function (Blueprint $table) {
            $table->string('email')->primary();
            $table->string('token');
            $table->timestamp('created_at')->nullable();
        });
        // CREATE TABLE `password_resets` (
        //     `email` varchar(255) not null,
        //     `token` varchar(255) not null,
        //     `created_at` timestamp null,
        //     PRIMARY KEY (`email`)
        // ) default character set utf8mb4 collate 'utf8mb4_unicode_ci';
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('password_resets');
    }
};
