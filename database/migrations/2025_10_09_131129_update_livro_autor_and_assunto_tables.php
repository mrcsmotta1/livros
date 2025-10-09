<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('livro_autor', function (Blueprint $table) {
            if (Schema::hasColumn('livro_autor', 'ordem')) {
                $table->dropColumn('ordem');
            }
            if (!Schema::hasColumn('livro_autor', 'created_at')) {
                $table->timestamps();
            }
        });

        Schema::table('livro_assunto', function (Blueprint $table) {
            if (Schema::hasColumn('livro_assunto', 'ordem')) {
                $table->dropColumn('ordem');
            }

            if (!Schema::hasColumn('livro_assunto', 'created_at')) {
                $table->timestamps();
            }
        });
    }

    public function down(): void
    {
        Schema::table('livro_autor', function (Blueprint $table) {
            $table->dropTimestamps();
            $table->integer('ordem')->nullable();
        });

        Schema::table('livro_assunto', function (Blueprint $table) {
            $table->dropTimestamps();
            $table->integer('ordem')->nullable();
        });
    }
};
