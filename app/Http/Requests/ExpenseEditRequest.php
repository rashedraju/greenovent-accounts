<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ExpenseEditRequest extends FormRequest {
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
            'head'                => 'required|string',
            'user_id'             => ['required', Rule::exists( 'users', 'id' )],
            'project_id'          => ['required', Rule::exists( 'users', 'id' )],
            'description'         => 'nullable',
            'expense_type_id'     => ['required', Rule::exists( 'expense_types', 'id' )],
            'transaction_type_id' => ['required', Rule::exists( 'transaction_types', 'id' )],
            'amount'              => 'required|string',
            'note'                => 'nullable',
            'date'                => 'required|date'
        ];
    }

    public function messages() {
        return [
            'user_id.required'             => 'Billing person is not selected',
            'project_id.required'          => 'Project name is not selected',
            'expense_type_id.required'     => 'Expense type is not selected',
            'transaction_type_id.required' => 'Transaction type is not selected'
        ];
    }
}
