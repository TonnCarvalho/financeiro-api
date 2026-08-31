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
        Schema::create('cartoes', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_usuario')
                ->constrained('usuarios')
                ->cascadeOnUpdate()
                ->cascadeOnDelete();
            $table->foreignId('id_banco')
                ->constrained('bancos')
                ->cascadeOnUpdate()
                ->cascadeOnDelete();
            $table->integer('numero')->index();
            $table->decimal('limite', 10, 2);
            $table->string('banceira')->nullable();
            $table->boolean('cartao_principal')->nullable();
            $table->integer('dia_fechamento');
            $table->integer('dia_vencimento');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cartoes');
    }
};
