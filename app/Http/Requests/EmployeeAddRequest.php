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
            'profile_image'              => ['nullable'],
            'designation'                => ['required'],
            'email'                      => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'phone'                      => ['required', 'string'],
            'password'                   => ['required', 'confirmed', 'min:8', 'max:255'],
            'joining_date'               => 'nullable',
            'current_address'            => 'nullable',
            'permanent_address'          => 'nullable',
            'emergency_contact_name'     => 'nullable',
            'emergency_contact_no'       => 'nullable',
            'emergency_contact_relation' => 'nullable'
        ];
    }
}
