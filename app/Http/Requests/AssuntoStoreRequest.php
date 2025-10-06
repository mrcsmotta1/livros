<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

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
        return [
            'descricao' => 'required|string|min:3|max:20|unique:assuntos,descricao',
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
