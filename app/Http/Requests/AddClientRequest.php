<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class AddClientRequest extends FormRequest {
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize() {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules() {
        return [
            'company_name'                               => 'required|string',
            'office_address'                             => 'required|string',
            'business_manager_id'                        => ['required', Rule::exists( 'users', 'id' )],
            'client_contact_persons_input'               => 'required|array',
            'client_contact_persons_input.*.name'        => 'required|string',
            'client_contact_persons_input.*.designation' => 'sometimes',
            'client_contact_persons_input.*.department'   => 'sometimes',
            'client_contact_persons_input.*.email'       => 'sometimes',
            'client_contact_persons_input.*.phone'       => 'sometimes'
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array
     */
    public function messages() {
        return [
            'client_contact_persons_input.*.name.required' => 'Contact person name is required'
        ];
    }
}
