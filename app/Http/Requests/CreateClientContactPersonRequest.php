<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateClientContactPersonRequest extends FormRequest {
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
            'client_contact_persons_input'               => 'required|array',
            'client_contact_persons_input.*.name'        => "required|string",
            'client_contact_persons_input.*.designation' => "string",
            'client_contact_persons_input.*.dpartment'   => "string",
            'client_contact_persons_input.*.email'       => "string",
            'client_contact_persons_input.*.phone'       => "string"
        ];
    }
}
