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
        Schema::create('cliente', function (Blueprint $table) {
            $table->id();
            $table->string('nombre_cliente');
            $table->string('telefono_cliente');
            $table->string('correo_cliente');
            $table->enum('tipo_documento', ['CC', 'TI', 'CE', 'PP']);
            $table->string('numero_documento')->unique();
            $table->string('direccion');
            $table->string('ciudad');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cliente');
    }
};
