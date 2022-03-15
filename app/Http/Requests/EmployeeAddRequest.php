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
            'profile_image'              => ['required'],
            'designation'                => ['required'],
            'email'                      => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'phone'                      => ['required', 'string'],
            'password'                   => ['required', 'confirmed', 'min:8', 'max:255'],
            'joining_date'               => 'required|string',
            'current_address'            => 'required|string',
            'permanent_address'          => 'required|string',
            'emergency_contact_name'     => 'required|string',
            'emergency_contact_no'       => 'required|string',
            'emergency_contact_relation' => 'required|string'
        ];
    }
}
