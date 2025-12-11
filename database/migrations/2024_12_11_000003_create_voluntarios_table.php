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
        Schema::create('voluntarios', function (Blueprint $table) {
            $table->id();
            $table->foreignId('acao_id')->constrained('acoes')->onDelete('cascade');
            $table->string('nome');
            $table->string('email');
            $table->string('telefone')->nullable();
            $table->enum('tipo_participacao', ['voluntario', 'doador', 'ambos'])->default('voluntario');
            $table->text('mensagem')->nullable();
            $table->enum('status', ['pendente', 'confirmado', 'cancelado'])->default('pendente');
            $table->timestamp('confirmado_em')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('voluntarios');
    }
};
