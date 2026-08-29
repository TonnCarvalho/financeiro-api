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
        Schema::create('grupo_despesas', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_grupo')
                ->constrained('grupos')
                ->cascadeOnDelete();
            $table->foreignId('id_despesa')
                ->constrained('despesas')
                ->cascadeOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('grupo_despesas');
    }
};
