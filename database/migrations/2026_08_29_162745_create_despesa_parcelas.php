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
        Schema::create('despesa_parcelas', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_despesa')
                ->constrained('despesas')
                ->cascadeOnUpdate()
                ->cascadeOnDelete();
            $table->foreignId('id_cartao')
                ->constrained('cartoes')
                ->cascadeOnUpdate()
                ->cascadeOnDelete();
            $table->integer('numero_parcela');
            $table->decimal('valor', 8, 2);
            $table->boolean('paga')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('despesa_parcelas');
    }
};
