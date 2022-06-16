<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EditCostRequest extends FormRequest {
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
            'total' => 'nullable|numeric',
            'asf'   => 'nullable|numeric',
            'vat'   => 'nullable|numeric',
            'file'  => 'nullable|file',
            'note'  => 'nullable|string'
        ];
    }
}
