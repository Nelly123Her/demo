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
        Schema::create('punto_ventas', function (Blueprint $table) {
            $table->id();
            $table->string('numero');
            $table->string('codigo');
            $table->string('descripcion');
            $table->decimal('precio_venta', 10, 2);
            $table->integer('cantidad');
            $table->decimal('importe', 10, 2);
            $table->string('imagen_url')->nullable();
            $table->string('folio_venta')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('punto_ventas');
    }
};
