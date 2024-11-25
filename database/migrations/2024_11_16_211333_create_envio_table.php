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
        Schema::create('envios', function (Blueprint $table) {
            $table->id();
            $table->string('direccion_destino')->nullable();
            $table->string('ciudad_destino')->nullable();
            $table->string('pais_destino')->nullable();
            $table->date('fecha_entrega')->default(now());
            $table->string('descripcion_entrega')->nullable();
            $table->string('estado_envio')->nullable()->default('pendiente');
            $table->unsignedBigInteger('metodo_envio_id')->nullable();
            $table->unsignedBigInteger('compra_id')->nullable();
            $table->timestamps();
            $table->foreign('metodo_envio_id')->references('id')->on('metodo_envio')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('compra_id')->references('id')->on('compras')->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('envios');
    }
};
