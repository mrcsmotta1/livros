<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Validator;
use Illuminate\Support\Carbon;

class LivroStoreRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        $anoAtual = Carbon::now()->year;

        return [
            'titulo'          => ['required', 'string', 'min:2', 'max:100'],
            'editora'         => ['required', 'string', 'min:2', 'max:100'],
            'edicao'          => ['required', 'integer', 'min:1', 'max:2147483647'],
            'ano_publicacao'  => ['required', 'integer', 'min:1500', "max:{$anoAtual}"],
            'valor'           => ['required', 'numeric', 'gt:0', 'lt:100000000'],
            'autores'         => ['required', 'array', 'min:1'],
            'autores.*'       => ['integer', 'exists:autor,"codAu"'],
            'assuntos'        => ['required', 'array', 'min:1'],
            'assuntos.*'      => ['integer', 'exists:assunto,"codAs"'],
        ];
    }

    public function messages(): array
    {
        return [
            'titulo.required' => 'O campo título é obrigatório.',
            'titulo.max' => 'O título não pode ter mais de 100 caracteres.',

            'editora.required' => 'O campo editora é obrigatório.',
            'editora.max' => 'A editora não pode ter mais de 100 caracteres.',

            'edicao.integer' => 'A edição deve ser um número inteiro.',
            'edicao.min' => 'A edição deve ser no mínimo 1.',
            'edicao.max' => 'A edição deve ser no máximo 2147483647.',

            'ano_publicacao.integer' => 'O ano de publicação deve ser numérico.',
            'ano_publicacao.min' => 'O ano de publicação não pode ser anterior a 1500.',
            'ano_publicacao.max' => 'O ano de publicação não pode ser maior que o ano atual.',

            'valor.required' => 'O campo valor é obrigatório.',
            'valor.numeric' => 'O valor deve ser numérico (ex: 10.50).',
            'valor.gt' => 'O valor deve ser maior que zero.',
            'valor.lt' => 'O valor deve ser menor que 100.000.000,00.',

            'autores.required' => 'É necessário selecionar pelo menos um autor.',
            'autores.array' => 'O campo de autores deve ser uma lista.',
            'autores.min' => 'Selecione pelo menos um autor.',
            'autores.*.exists' => 'Algum dos autores selecionados não existe.',

            'assuntos.required' => 'É necessário selecionar pelo menos um assunto.',
            'assuntos.array' => 'O campo de assuntos deve ser uma lista.',
            'assuntos.min' => 'Selecione pelo menos um assunto.',
            'assuntos.*.exists' => 'Algum dos assuntos selecionados não existe.',
        ];
    }

    /**
     * Limpa e prepara dados antes da validação
     */
    protected function prepareForValidation()
    {
        if ($this->has('valor')) {
            $valor = str_replace(['R$', ' ', '.'], '', $this->valor);
            $valor = str_replace(',', '.', $valor);
            $this->merge(['valor' => $valor]);
        }
    }

    /**
     * Regras adicionais customizadas
     */
    public function withValidator(Validator $validator)
    {
        $validator->after(function ($validator) {
            $anoAtual = now()->year;
            $ano = $this->input('ano_publicacao');

            if ($ano && $ano > $anoAtual) {
                $validator->errors()->add('ano_publicacao', 'O ano de publicação não pode ser maior que o ano atual.');
            }
        });
    }
}
