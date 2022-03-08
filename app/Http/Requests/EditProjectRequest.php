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
            'po_number'           => ['sometimes', Rule::unique('projects', 'po_number')],
            'po_value'            => ['sometimes', 'integer'],
            'start_date'          => 'sometimes|date',
            'closing_date'        => 'sometimes|date',
            'advance_paid'        => 'sometimes',
            'status_id'           => 'sometimes'
        ];
    }
}
