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
        Schema::create('notas_de_venta', function (Blueprint $table) {
            $table->id();
            $table->string('folio');
            $table->dateTime('fecha_hora');
            $table->string('cliente');
            $table->string('servicio');
            $table->decimal('total', 10, 2);
            $table->decimal('pagado', 10, 2);
            $table->boolean('apertura')->default(false);
            $table->boolean('factura')->default(false);
            $table->string('estado');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('notas_de_venta');
    }
};

