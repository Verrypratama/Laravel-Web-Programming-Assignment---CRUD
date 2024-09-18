<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('verry_pratamas', function (Blueprint $table) {
            $table->Increments('id');
            $table->string('nama');
            $table->integer('harga');
            $table->string('namadaerah');
            $table->string('foto')->nullable;
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('verry_pratamas');
    }
};
