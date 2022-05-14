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
            'profile_image'              => ['sometimes|image'],
            'designation'                => ['required'],
            'email'                      => [
                'required',
                'email',
                Rule::unique( 'users' )->ignore( $this->user->id, 'id' )
            ],
            'phone'                      => ['required', 'string'],
            'password'                   => ['sometimes', 'confirmed', 'min:8', 'max:255'],
            'joining_date'               => 'sometimes',
            'current_address'            => 'sometimes',
            'permanent_address'          => 'sometimes',
            'emergency_contact_name'     => 'sometimes',
            'emergency_contact_no'       => 'sometimes',
            'emergency_contact_relation' => 'sometimes'
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
