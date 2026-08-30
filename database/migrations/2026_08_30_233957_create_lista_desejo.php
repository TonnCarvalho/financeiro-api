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
        Schema::create('lista_desejo', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_usuario')
                ->constrained('usuarios')
                ->cascadeOnDelete();
            $table->foreignId('id_grupo_desejo')
                ->constrained('grupo_desejo')
                ->cascadeOnDelete();
            $table->string('nome', 100)->index();
            $table->tinyText('imagem')->nullable();
            $table->decimal('valor', 8, 2)->default(0);
            $table->tinyText('link')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('lista_desejo');
    }
};
