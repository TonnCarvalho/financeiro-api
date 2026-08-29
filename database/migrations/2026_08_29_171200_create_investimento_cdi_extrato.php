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
            $table->decimal('valor_bruto', 8, 2);
            $table->decimal('valor_liquido', 8, 2);
            $table->decimal('ganhos_perdas', 8, 2);
            $table->decimal('ir_iof', 8, 2);
            $table->enum('tipo', ['rendimento', 'guardado', 'resgate']);
            $table->timestamps();
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
