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
        Schema::create('acoes', function (Blueprint $table) {
            $table->id();
            $table->string('titulo');
            $table->text('descricao')->nullable();
            $table->foreignId('categoria_id')->nullable()->constrained('categorias')->onDelete('set null');
            $table->string('localizacao')->nullable();
            $table->date('data')->nullable();
            $table->decimal('meta', 10, 2)->nullable();
            $table->integer('progresso')->default(0);
            $table->enum('urgencia', ['baixa', 'media', 'alta', 'critica'])->default('media');
            $table->string('email_contato')->nullable();
            $table->string('telefone_contato')->nullable();
            $table->enum('status', ['ativa', 'pausada', 'encerrada'])->default('ativa');
            $table->foreignId('organizador_id')->constrained('users')->onDelete('cascade');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('acoes');
    }
};
