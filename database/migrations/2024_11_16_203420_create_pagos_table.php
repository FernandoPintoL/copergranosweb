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
        Schema::create('pagos', function (Blueprint $table) {
            $table->id();
            $table->double('precio_total')->nullable()->default(0);
            $table->string('moneda')->nullable();
            $table->string('estado')->nullable();
            $table->string('descripcion')->nullable();
            $table->unsignedBigInteger('metodo_pago_id');
            $table->timestamps();
            $table->foreign('metodo_pago_id')->references('id')->on('metodo_pagos')->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pagos');
    }
};
