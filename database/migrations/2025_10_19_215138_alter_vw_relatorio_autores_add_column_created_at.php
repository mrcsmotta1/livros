<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration {
    public function up(): void
    {
        if (DB::getDriverName() === 'sqlite') {
            // SQLite não suporta CREATE OR REPLACE VIEW nem STRING_AGG.
            DB::statement('DROP VIEW IF EXISTS vw_relatorio_autores');
            DB::statement(<<<SQL
            CREATE VIEW vw_relatorio_autores AS
            SELECT
                a."codAu" AS id_autor,
                a.nome AS autor,
                l.codl AS id_livro,
                l.titulo AS titulo_livro,
                l.editora AS editora,
                l.ano_publicacao AS ano_publicacao,
                l.edicao AS edicao,
                l.valor AS valor,
                group_concat(DISTINCT s.descricao, ', ') AS assuntos_relacionados,
                l.created_at AS data_criacao_livro,
                l.created_at
            FROM autor a
            JOIN livro_autor la
                ON la."autor_codAu" = a."codAu"
            JOIN livro l
                ON l.codl = la.livro_codl
            LEFT JOIN livro_assunto ls
                ON ls.livro_codl = l.codl
            LEFT JOIN assunto s
                ON s."codAs" = ls."assunto_codAs"
            GROUP BY
                a."codAu", a.nome, l.codl, l.titulo, l.editora, l.ano_publicacao, l.edicao, l.valor
            ;
            SQL);
        } else {
            DB::statement(<<<SQL
            CREATE OR REPLACE VIEW vw_relatorio_autores AS
            SELECT
                a."codAu" AS id_autor,
                a.nome AS autor,
                l.codl AS id_livro,
                l.titulo AS titulo_livro,
                l.editora AS editora,
                l.ano_publicacao AS ano_publicacao,
                l.edicao AS edicao,
                l.valor AS valor,
                STRING_AGG(DISTINCT s.descricao, ', ' ORDER BY s.descricao) AS assuntos_relacionados,
                l.created_at AS data_criacao_livro,
                l.created_at
            FROM autor a
            JOIN livro_autor la
                ON la."autor_codAu" = a."codAu"
            JOIN livro l
                ON l.codl = la.livro_codl
            LEFT JOIN livro_assunto ls
                ON ls.livro_codl = l.codl
            LEFT JOIN assunto s
                ON s."codAs" = ls."assunto_codAs"
            GROUP BY
                a."codAu", a.nome, l.codl, l.titulo, l.editora, l.ano_publicacao, l.edicao, l.valor
            ORDER BY
                a.nome, l.titulo;
            SQL);
        }
    }

    public function down(): void
    {
        DB::statement('DROP VIEW IF EXISTS vw_relatorio_autores');
    }
};
