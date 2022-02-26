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
            'first_name'     => ['sometimes', 'string', 'max:255'],
            'last_name'      => ['sometimes', 'string', 'max:255'],
            'email'          => ['sometimes', 'string', 'email', 'max:255', Rule::unique( 'users', 'email' )->ignore( $this->route( 'user' ) )],
            'phone'          => ['sometimes'],
            'designation_id' => ['sometimes', Rule::exists( 'user_designations', 'id' )],
            'status_id'      => ['sometimes', Rule::exists( 'user_statuses', 'id' )],
            'password'       => ['sometimes', 'confirmed', 'min:8', 'max:255']
        ];
    }

    protected function prepareForValidation() {
        if ( $this->password === null ) {
            $this->request->remove( 'password' );
        }
    }
}
