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
        Schema::table('livro_assunto', function (Blueprint $table) {
            $table->unsignedInteger('ordem')->after('assunto_codAs')->default(1);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('livro_assunto', function (Blueprint $table) {
            $table->dropColumn('ordem');
        });
    }
};
