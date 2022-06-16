<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class CreditAddRequest extends FormRequest {
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
            'user_id'             => ['required', Rule::exists( 'users', 'id' )],
            'category_id'         => ['required', Rule::exists( 'credit_categories', 'id' )],
            'project_id'          => 'nullable',
            'loan_lender_id'      => 'nullable',
            'investor_id'         => 'nullable',
            'transaction_type_id' => ['required', Rule::exists( 'transaction_types', 'id' )],
            'amount'              => 'required|string',
            'note'                => 'nullable',
            'date'                => 'required|date|date_format:Y-m-d'
        ];
    }

    public function messages() {
        return [
            'category_id.required'         => 'Category is not selected',
            'user_id.required'             => 'Billing person is not selected',
            'project_id.required'          => 'Project name is not selected',
            'transaction_type_id.required' => 'Transaction type is not selected'
        ];
    }
}
