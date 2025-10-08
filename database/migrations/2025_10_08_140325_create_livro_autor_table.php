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
        Schema::create('livro_autor', function (Blueprint $table) {
            $table->id();

            // Relação com livro (FK -> livro.codl)
            $table->foreignId('livro_codl')
                ->constrained('livros', 'codl')
                ->cascadeOnDelete();

            // Relação com autor (FK -> autor.codau)
            $table->foreignId('autor_codAu')
                ->constrained('autor', 'codAu')
                ->cascadeOnDelete();

            $table->unique(['livro_codl', 'autor_codAu']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('livro_autor');
    }
};
