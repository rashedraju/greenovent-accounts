<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class EditClientRequest extends FormRequest {
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
            'company_name'                               => 'string',
            'office_address'                             => 'string',
            'business_manager_id'                        => [Rule::exists( 'users', 'id' )],
            'client_contact_persons_input'               => 'sometimes|array',
            'client_contact_persons_input.*.name'        => 'sometimes|string',
            'client_contact_persons_input.*.designation' => 'sometimes|string',
            'client_contact_persons_input.*.dpartment'   => 'sometimes|string',
            'client_contact_persons_input.*.email'       => 'sometimes|string',
            'client_contact_persons_input.*.phone'       => 'sometimes|string'
        ];
    }
}
