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
            'total' => 'sometimes|integer',
            'asf'   => 'sometimes|integer',
            'vat'   => 'sometimes|integer',
            'file'  => 'sometimes|file',
            'note'  => 'sometimes|string'
        ];
    }
}
