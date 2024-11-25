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
        Schema::create('compras', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('cliente_id');
            $table->unsignedBigInteger('administrativo_id');
            $table->unsignedBigInteger('pago_id');
            $table->double('precio_total')->default(0);
            $table->string('estado')->default('creada');
            $table->timestamps();
            $table->foreign('cliente_id')->references('persona_id')->on('clientes')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('administrativo_id')->references('persona_id')->on('administrativos')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('pago_id')->references('id')->on('pagos')->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('compras');
    }
};
