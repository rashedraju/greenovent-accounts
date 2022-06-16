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
            'name'                       => ['required', 'string', 'max:255'],
            'profile_image'              => ['nullable|image'],
            'designation'                => ['required'],
            'email'                      => [
                'required',
                'email',
                Rule::unique( 'users' )->ignore( $this->user->id, 'id' )
            ],
            'phone'                      => ['required', 'string'],
            'password'                   => ['nullable', 'confirmed', 'min:8', 'max:255'],
            'joining_date'               => 'nullable',
            'current_address'            => 'nullable',
            'permanent_address'          => 'nullable',
            'emergency_contact_name'     => 'nullable',
            'emergency_contact_no'       => 'nullable',
            'emergency_contact_relation' => 'nullable'
        ];
    }

    protected function prepareForValidation() {
        if ( $this->password === null ) {
            $this->request->remove( 'password' );
        }

        if ( $this->profile_image === null ) {
            $this->request->remove( 'profile_image' );
        }
    }
}
