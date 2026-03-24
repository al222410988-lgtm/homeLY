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
        Schema::create('reportes', function (Blueprint $table) {
    $table->id();
    $table->foreignId('usuario_id')->constrained('usuarios')->onDelete('cascade');

    $table->enum('categoria', [
        'areas_verdes',
        'calles',
        'fugas',
        'alumbrado'
    ]);

    $table->text('descripcion');

    $table->string('imagen_problema')->nullable();
    $table->string('imagen_solucion')->nullable();

    $table->decimal('latitud', 10, 7);
    $table->decimal('longitud', 10, 7);

    $table->enum('estado', ['pendiente', 'en_proceso', 'finalizado'])->default('pendiente');

    $table->text('mensaje_admin')->nullable();

    $table->timestamp('fecha_finalizacion')->nullable();

    $table->timestamps();
});
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reportes');
    }
};
