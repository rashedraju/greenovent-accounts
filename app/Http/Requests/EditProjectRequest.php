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
            'po_number'           => ['required', Rule::unique( 'projects', 'po_number' )->ignore( $this->route( 'project' ) )],
            'po_value'            => ['required', 'integer'],
            'bill_type'           => ['required', Rule::exists( 'bill_statuses', 'id' )],
            'start_date'          => 'required|date',
            'closing_date'        => 'required|date',
            'advance_paid'        => 'sometimes',
            'status_id'           => 'sometimes'
        ];
    }
}
