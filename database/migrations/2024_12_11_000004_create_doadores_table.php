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
        Schema::create('doadores', function (Blueprint $table) {
            $table->id();
            $table->foreignId('acao_id')->constrained('acoes')->onDelete('cascade');
            $table->string('nome');
            $table->string('email');
            $table->string('telefone')->nullable();
            $table->enum('tipo_doacao', ['dinheiro', 'alimentos', 'roupas', 'outros'])->default('dinheiro');
            $table->decimal('valor_estimado', 10, 2)->nullable();
            $table->text('descricao_doacao')->nullable();
            $table->enum('status', ['pendente', 'confirmada', 'recusada'])->default('pendente');
            $table->timestamp('data_doacao')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('doadores');
    }
};
