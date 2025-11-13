<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreUpdateUserRequest extends FormRequest
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
            'recovery_code' => ['prohibited'],
            'community_id' => [
                $isUpdate ? 'nullable' : 'required',
                'integer',
                Rule::exists('communities', 'id')->where('status', 1),
            ],
            'name' => [$isUpdate ? 'nullable' : 'required', 'string', 'max:255'],
            'code' => [$isUpdate ? 'nullable' : 'required', 'string', 'max:20'],
            'email' => [$isUpdate ? 'nullable' : 'required', 'string', 'email', 'max:255',     Rule::unique('users', 'email')->ignore($this->route('id'))],
            'password' => [$isUpdate ? 'nullable' : 'required', 'string', 'max:255'],
            'access_type' => [$isUpdate ? 'nullable' : 'required', 'string', Rule::in(['general_admin', 'parish_admin', 'parish_community', 'operator', 'unknown'])],
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
            'community_id.required' => 'O campo comunidade é obrigatório.',
            'community_id.integer' => 'O campo comunidade deve ser um número inteiro.',
            'community_id.exists' => 'A comunidade informada é inválida ou está inativa.',

            'name.required' => 'O campo nome é obrigatório.',
            'name.string' => 'O campo nome deve ser um texto.',
            'name.max' => 'O campo nome pode ter no máximo 255 caracteres.',

            'code.required' => 'O campo código é obrigatório.',
            'code.string' => 'O campo código deve ser um texto.',
            'code.max' => 'O campo código pode ter no máximo 20 caracteres.',

            'email.required' => 'O campo e-mail é obrigatório.',
            'email.string' => 'O campo e-mail deve ser um texto.',
            'email.email' => 'O campo e-mail deve ser válido.',
            'email.max' => 'O campo e-mail pode ter no máximo 255 caracteres.',
            'email.unique' => 'Este e-mail já está sendo utilizado.',

            'password.required' => 'O campo senha é obrigatório.',
            'password.string' => 'O campo senha deve ser um texto.',
            'password.min' => 'A senha deve conter no mínimo 6 caracteres.',

            'access_type.required' => 'O tipo de acesso é obrigatório.',
            'access_type.string' => 'O tipo de acesso deve ser um texto.',
            'access_type.in' => 'O tipo de acesso deve ser um dos seguintes: general_admin, parish_admin, parish_community, operator ou unknown.',

            'status.required' => 'O campo status é obrigatório.',
            'status.boolean' => 'O campo status deve ser verdadeiro (1) ou falso (0).',
        ];
    }
}
