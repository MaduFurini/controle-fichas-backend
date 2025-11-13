<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreUpdateCommunityRequest extends FormRequest
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
        $isUpdate = in_array($this->method(), ['PUT', 'PATCH']);

        $rules = [
            'uuid' => ['prohibited', 'uuid'],
            'parish_id' => [
                $isUpdate ? 'nullable' : 'required',
                'integer',
                Rule::exists('communities', 'id')->where('status', 1),
            ],
            'name' => [$isUpdate ? 'nullable' : 'required', 'string', 'max:255'],
            'type' => [$isUpdate ? 'nullable' : 'required', 'string', Rule::in(['parish', 'community'])],
            'street' => [$isUpdate ? 'nullable' : 'required', 'string', 'max:255'],
            'city' => [$isUpdate ? 'nullable' : 'required', 'string', 'max:255'],
            'state' => [$isUpdate ? 'nullable' : 'required', 'string', 'max:2'],
            'number' => ['nullable', 'integer'],
            'zip_code' => [$isUpdate ? 'nullable' : 'required', 'string', 'max:20'],
            'email_responsible' => [$isUpdate ? 'nullable' : 'required', 'string', 'email', 'max:255'],
            'phone' => [$isUpdate ? 'nullable' : 'required', 'string'],
            'image' => ['nullable'],
            'status' => [$isUpdate ? 'nullable' : 'required', 'boolean'],
        ];

        if ($isUpdate) {
            foreach ($rules as $field => &$ruleSet) {
                array_unshift($ruleSet, 'sometimes');
            }
        }

        return $rules;
    }

    public function messages(): array
    {
        return [
            'parish_id.integer' => 'O campo paróquia deve ser um número inteiro.',
            'parish_id.exists' => 'A paróquia selecionada é inválida ou está inativa.',

            'name.required' => 'O campo nome é obrigatório.',
            'name.string' => 'O campo nome deve ser um texto.',
            'name.max' => 'O campo nome pode ter no máximo 255 caracteres.',

            'type.required' => 'O campo tipo é obrigatório.',
            'type.string' => 'O campo tipo deve ser um texto.',
            'type.in' => 'O campo tipo deve ser "parish" ou "community".',

            'street.required' => 'O campo rua é obrigatório.',
            'street.string' => 'O campo rua deve ser um texto.',
            'street.max' => 'O campo rua pode ter no máximo 255 caracteres.',

            'city.required' => 'O campo cidade é obrigatório.',
            'city.string' => 'O campo cidade deve ser um texto.',
            'city.max' => 'O campo cidade pode ter no máximo 255 caracteres.',

            'state.required' => 'O campo estado é obrigatório.',
            'state.string' => 'O campo estado deve ser um texto.',
            'state.max' => 'O campo estado deve conter no máximo 2 caracteres (ex: SP).',

            'number.integer' => 'O campo número deve ser um valor numérico.',

            'zip_code.required' => 'O campo CEP é obrigatório.',
            'zip_code.string' => 'O campo CEP deve ser um texto.',
            'zip_code.max' => 'O campo CEP pode ter no máximo 20 caracteres.',

            'email_responsible.required' => 'O campo e-mail do responsável é obrigatório.',
            'email_responsible.string' => 'O e-mail do responsável deve ser um texto.',
            'email_responsible.email' => 'O e-mail do responsável deve ser válido.',
            'email_responsible.max' => 'O e-mail do responsável pode ter no máximo 255 caracteres.',

            'phone.required' => 'O campo telefone é obrigatório.',
            'phone.string' => 'O campo telefone deve ser um texto.',

            'image.nullable' => 'O campo imagem é opcional.',

            'status.required' => 'O campo status é obrigatório.',
            'status.boolean' => 'O campo status deve ser verdadeiro (1) ou falso (0).',
        ];
    }
}
