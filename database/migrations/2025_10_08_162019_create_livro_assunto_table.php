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
        Schema::create('livro_assunto', function (Blueprint $table) {
            $table->id();

            // Relação com livro (FK -> livro.codl)
            $table->foreignId('livro_codl')
                ->constrained('livros', 'codl')
                ->cascadeOnDelete();

            // Relação com assunto (FK -> assunto.codAs)
            $table->foreignId('assunto_codAs')
                ->constrained('assunto', 'codAs')
                ->cascadeOnDelete();

            $table->unique(['livro_codl', 'assunto_codAs']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('livro_assuntos');
    }
};
