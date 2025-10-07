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
        Schema::create('livros', function (Blueprint $table) {
            $table->increments('codl');
            $table->string('titulo', 40);
            $table->string('editora', 40)->nullable();
            $table->integer('edicao')->nullable();
            $table->string('ano_publicacao', 4)->nullable();
            $table->decimal('valor', 10, 2)->nullable();
            $table->timestamps();

            $table->index('titulo');
            $table->index('editora');
            $table->index('edicao');
            $table->index('ano_publicacao');
            $table->index('valor');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('livros');
    }
};
