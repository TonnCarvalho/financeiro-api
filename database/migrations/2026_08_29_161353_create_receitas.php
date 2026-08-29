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
        Schema::create('receitas', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_usuario')
                ->constrained('usuarios')
                ->cascadeOnDelete();
            $table->foreignId('id_banco')
                ->constrained('bancos')
                ->cascadeOnUpdate()
                ->cascadeOnDelete();
            $table->decimal('valor', 8, 4)->nullable();
            $table->date('data');
            $table->boolean('recorrente')->default(false);
            $table->string('descricao', 255)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('receitas');
    }
};
