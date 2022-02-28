<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class EmployeeAddRequest extends FormRequest {
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
            'name'                       => ['required', 'string', 'max:255'],
            'designation_id'             => ['required', Rule::exists( 'user_designations', 'id' )],
            'email'                      => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'phone'                      => ['required'],
            'password'                   => ['required', 'confirmed', 'min:8', 'max:255'],
            'joining_date'               => 'string',
            'current_address'            => 'string',
            'permanent_address'          => 'string',
            'emergency_contact_name'     => 'string',
            'emergency_contact_no'       => 'string',
            'emergency_contact_relation' => 'string'
        ];
    }
}
