<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AutorStoreRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    protected function prepareForValidation()
    {
        if ($this->has('nome')) {
            $this->merge([
                'nome' => ucwords(strtolower(trim($this->input('nome')))),
            ]);
        }
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        $autorId = $this->route('autore');

        $uniqueRule = 'unique:autor,nome';

        if ($autorId) {
            $uniqueRule .= ',' . $autorId . ',codAu';
        }

        return [
            'nome' => [
                'required',
                'string',
                'max:40',
                'regex:/^[A-Za-zÀ-ÿ0-9\s\'-]+$/', // permite apenas letras, números, espaços e alguns caracteres especiais
                function ($attribute, $value, $fail) {
                    if (trim($value) === '') {
                        $fail('O nome não pode conter apenas espaços em branco.');
                    }
                },
                $uniqueRule,
            ],
        ];
    }

    public function messages(): array
    {
        return [
            'nome.required' => 'O nome do autor é obrigatório.',
            'nome.string'   => 'O nome deve ser um texto válido.',
            'nome.max'      => 'O nome pode ter no máximo 40 caracteres.',
            'nome.regex'    => 'O nome deve conter apenas letras, números, espaços, apóstrofos ou hífens (sem símbolos).',
            'nome.unique'   => 'Já existe um autor cadastrado com este nome.',
        ];
    }
}
