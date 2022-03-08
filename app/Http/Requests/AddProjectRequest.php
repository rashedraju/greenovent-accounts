<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class AddProjectRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required|string',
            'business_manager_id' => ['required', Rule::exists('users', 'id')],
            'client_id' => ['required', Rule::exists('clients', 'id')],
            'type_id' => ['required', Rule::exists('project_types', 'id')],
            'po_number' => ['required'],
            'po_value' => ['required'],
            'start_date' => ['required'],
            'closing_date' => ['required'],
            'external' => ['sometimes'],
            'internal' => ['sometimes'],
            'advance_paid' => ['sometimes'],
            'status_id' => ['sometimes'],
        ];
    }
}
