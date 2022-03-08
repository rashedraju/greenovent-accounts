<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class EditProjectRequest extends FormRequest {
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
            'name'                => 'string',
            'business_manager_id' => [Rule::exists( 'users', 'id' )],
            'client_id'           => [Rule::exists( 'clients', 'id' )],
            'type_id'             => [Rule::exists( 'project_types', 'id' )],
            'po_number'           => ['sometimes'],
            'po_value'            => ['sometimes'],
            'start_date'          => 'sometimes',
            'closing_date'        => 'sometimes',
            'external'            => 'sometimes',
            'internal'            => 'sometimes',
            'advance_paid'        => 'sometimes',
            'status_id'           => 'sometimes'
        ];
    }
}
