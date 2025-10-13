<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Validator;
use Carbon\Carbon;

class RelatorioAutorRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    protected function prepareForValidation()
    {
        if ($this->has('valor')) {
            $valorLimpo = str_replace(['R$', ' ', '.', ','], ['', '', '', '.'], $this->valor);
            $this->merge([
                'valor' => is_numeric($valorLimpo) ? (float) $valorLimpo : null,
            ]);
        }
    }

    public function rules(): array
    {
            $anoAtual = Carbon::now()->year;

        return [
            'autor'           => [
                'nullable',
                'string',
                'max:40',
                'regex:/^[A-Za-zÀ-ÖØ-öø-ÿ0-9\s\'\-\.\,]+$/u',
                function ($attribute, $value, $fail) {
                    // Verifica se o valor é composto só por caracteres não permitidos
                    if (!preg_match('/[A-Za-zÀ-ÖØ-öø-ÿ0-9]/u', $value)) {
                        $fail('O nome do autor deve conter letras ou números válidos.');
                    }
                },
            ],
            'editora'         => ['nullable', 'string', 'max:40'],
            'titulo_livro'    => ['nullable', 'string', 'max:40'],

            'operador_valor'  => ['nullable', 'in:=,>=,<='],
            'operador_ano'    => ['nullable', 'in:=,>=,<='],
            'operador_edicao' => ['nullable', 'in:=,>=,<='],

            'valor'           => ['nullable', 'numeric', 'gt:0', 'lt:100000000'],
            'ano_publicacao'  => ['nullable', 'integer', 'digits:4', 'min:1500', "max: {$anoAtual}"],
            'edicao'          => ['nullable', 'integer', 'min:1', 'max:2147483647'],


            'data_inicio'     => ['nullable', 'date', 'before_or_equal:today'],
            'data_fim'        => ['nullable', 'date', 'before_or_equal:today'],
        ];
    }

    public function withValidator(Validator $validator)
    {
        $validator->after(function ($validator) {
            $inicio = $this->input('data_inicio');
            $fim    = $this->input('data_fim');

            if ($inicio && $fim) {
                $inicioData = Carbon::parse($inicio);
                $fimData    = Carbon::parse($fim);

                // Se a data inicial for maior que a final
                if ($inicioData->gt($fimData)) {
                    $validator->errors()->add('data_inicio', 'A data inicial não pode ser maior que a data final.');
                }

                // Se a data final for menor que a inicial
                if ($fimData->lt($inicioData)) {
                    $validator->errors()->add('data_fim', 'A data final não pode ser menor que a data inicial.');
                }
            }
        });
    }

    public function messages(): array
    {
        return [
            // Textos
            'autor.max'                    => 'O nome do autor pode ter no máximo 40 caracteres.',
            'nome.regex'                   => 'O nome deve conter apenas letras, números, espaços, apóstrofos ou hífens (sem símbolos).',
            'editora.max'                  => 'A editora pode ter no máximo 40 caracteres.',
            'titulo_livro.max'             => 'O título do livro pode ter no máximo 40 caracteres.',
            'assunto.max'                  => 'O assunto pode ter no máximo 40 caracteres.',

            // Operadores
            'operador_valor.in'            => 'Operador de valor inválido.',
            'operador_ano.in'              => 'Operador de ano inválido.',
            'operador_edicao.in'           => 'Operador de edição inválido.',

            // Numéricos
            'valor.numeric'                => 'O valor deve ser numérico (ex: 10.50).',
            'valor.gt'                     => 'O valor deve ser maior que zero.',
            'valor.lt'                     => 'O valor não pode ultrapassar 100 milhões.',
            'ano_publicacao.digits'        => 'O ano de publicação deve conter 4 dígitos.',
            'ano_publicacao.max'           => 'O ano de publicação não pode ser maior que o ano atual.',
            'edicao.integer'               => 'A edição deve ser um número inteiro.',
            'edicao.min'                   => 'A edição deve ser maior ou igual a 1.',
            'edicao.max'                   => 'A edição deve ser no máximo 2147483647.',

            // Datas
            'data_inicio.date'             => 'A data inicial deve ser uma data válida.',
            'data_fim.date'                => 'A data final deve ser uma data válida.',
            'data_inicio.before_or_equal'  => 'A data inicial não pode ser uma data futura.',
            'data_fim.before_or_equal'     => 'A data final não pode ser uma data futura.',
        ];
    }
}
