<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class EmployeeEditRequest extends FormRequest {
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
            'name'                       => ['sometimes', 'string', 'max:255'],
            'designation_id'             => ['sometimes', Rule::exists( 'user_designations', 'id' )],
            'email'                      => ['sometimes', 'string', 'email', 'max:255', Rule::unique( 'users', 'email' )->ignore( $this->route( 'user' ) )],
            'phone'                      => ['sometimes', 'string'],
            'password'                   => ['sometimes', 'confirmed', 'min:8', 'max:255'],
            'joining_date'               => 'sometimes|string',
            'current_address'            => 'sometimes|string',
            'permanent_address'          => 'sometimes|string',
            'emergency_contact_name'     => 'sometimes|string',
            'emergency_contact_no'       => 'sometimes|string',
            'emergency_contact_relation' => 'sometimes|string'
        ];
    }

    protected function prepareForValidation() {
        if ( $this->password === null ) {
            $this->request->remove( 'password' );
        }
    }
}
