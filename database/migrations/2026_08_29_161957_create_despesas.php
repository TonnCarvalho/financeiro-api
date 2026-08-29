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
        Schema::create('despesas', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->foreignId('id_usuario')
                ->constrained('usuarios')
                ->cascadeOnDelete();
            $table->foreignId('id_cartao')
                ->constrained('cartoes')
                ->cascadeOnUpdate()
                ->cascadeOnDelete();
            $table->string('nome', 50)->index();
            $table->decimal('valor', 8, 2);
            $table->date('data');
            $table->boolean('parcelado')->default(false);
            $table->boolean('paga')->default(false);
            $table->string('descricao', 255);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('despesas');
    }
};
