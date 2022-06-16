<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class AddProjectRequest extends FormRequest {
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
            'name'                => 'required|string',
            'business_manager_id' => ['required', Rule::exists( 'users', 'id' )],
            'client_id'           => ['required', Rule::exists( 'clients', 'id' )],
            'type_id'             => ['required', Rule::exists( 'project_types', 'id' )],
            'po_number'           => ['sometimes'],
            'po_value'            => ['required', 'integer'],
            'bill_type'           => ['required', Rule::exists( 'bill_statuses', 'id' )],
            'start_date'          => ['required', 'date'],
            'closing_date'        => ['required', 'date'],
            'status_id'           => ['sometimes'],
            'bp'                  => 'sometimes',
            'advance_paid'        => 'sometimes'
        ];
    }
}
