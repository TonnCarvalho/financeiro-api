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
        Schema::create('grupo_despesa_usuarios', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_usuario')
                ->constrained('usuarios')
                ->cascadeOnDelete();
            $table->foreignId('id_grupo_despesa')
                ->constrained('grupo_despesas')
                ->cascadeOnDelete();
            $table->enum('permissao_usuario', ['admin', 'membro'])
                ->default('membro');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('grupo_despesa_usuarios');
    }
};
