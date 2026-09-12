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
        Schema::create('investimento_cdi_extrato', function (Blueprint $table) {
            $table->id();

            $table->foreignId('id_investimento')
                ->constrained('investimento_cdi')
                ->cascadeOnDelete();

            $table->enum('tipo_operacao', ['rendimento', 'guardado', 'resgatado']);
            $table->decimal('valor_operacao', 15, 2)->nullable();

            $table->decimal('valor_bruto', 15, 2)->nullable();
            $table->decimal('valor_liquido', 15, 2)->nullable();

            $table->decimal('renda_bruta', 15, 2)->nullable();
            $table->decimal('renda_liquida', 15, 2)->nullable();

            $table->date('data_operacao');
            $table->timestamps();

            $table->index(['id_investimento', 'tipo_operacao']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('investimento_extrato');
    }
};
