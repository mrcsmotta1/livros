<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use App\Models\Assunto;

class AssuntoStoreRequest extends FormRequest
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
        $assuntoParam = $this->route('assunto');
        $assuntoId    = $assuntoParam instanceof Assunto ? $assuntoParam->codAs : $assuntoParam;

        return [
            'descricao' => [
                'required',
                'string',
                'min:2',
                'max:20',
                'regex:/^[A-Za-zÀ-ÿ0-9\s\'-]+$/', // permite apenas letras, números, espaços e alguns caracteres especiais
                function ($attribute, $value, $fail) {
                    if (trim($value) === '') {
                        $fail('O nome não pode conter apenas espaços em branco.');
                    }
                },
                Rule::unique('assunto', 'descricao')->when($assuntoId, function ($rule) use ($assuntoId) {
                    return $rule->ignore($assuntoId, 'codAs');
                }),
            ],
        ];
    }

    public function messages(): array
    {
        return [
            'descricao.required' => 'O campo descrição é obrigatório.',
            'descricao.max' => 'A descrição não pode ter mais que 20 caracteres.',
            'descricao.unique' => 'Essa descrição já existe.',
        ];
    }
}
