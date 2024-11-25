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
        Schema::create('productos', function (Blueprint $table) {
            $table->id();
            $table->string('codigo')->nullable();
            $table->string('nombre')->nullable();
            $table->string('descripcion')->nullable();
            $table->double('precio')->nullable()->default(0);
            $table->unsignedBigInteger('categoria_id')->unsigned();
            $table->unsignedBigInteger('medida_id')->unsigned();
            $table->unsignedBigInteger('proveedor_id')->unsigned();
            $table->timestamps();
            $table->foreign('categoria_id')->references('id')->on('categorias')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('medida_id')->references('id')->on('medidas')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('proveedor_id')->references('persona_id')->on('proveedores')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('productos');
    }
};
