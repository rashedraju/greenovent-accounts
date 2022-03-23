<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class WithdrawalAddRequest extends FormRequest {
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
            'user_id'     => ['required', Rule::exists( 'users', 'id' )],
            'bank_name'   => 'required|string',
            'slip_number' => 'required|string',
            'amount'      => 'required|string',
            'note'        => 'sometimes',
            'date'        => 'required|date|date_format:Y-m-d'
        ];
    }

    public function messages() {
        return [
            'user_id.required'     => 'Withdrawal person is not selected',
            'bank_name.required'   => 'Bank name is required',
            'slip_number.required' => 'Slip number is required',
            'amount.required'      => 'Amount is required'
        ];
    }
}
