<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProjectBillEditRequest extends FormRequest {
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
            'date'            => 'nullable|date',
            'bill_status_id'  => 'nullable',
            'total'           => 'nullable|numeric',
            'asf'             => 'nullable|numeric',
            'vat'             => 'nullable|numeric',
            'file'            => 'nullable|file',
            'supporting_file' => 'nullable|file'
        ];
    }
}
