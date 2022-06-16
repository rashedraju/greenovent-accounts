<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProjectBillAddRequest extends FormRequest {
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
            'date'            => 'required|string',
            'bill_status_id'  => 'required',
            'total'           => 'required|numeric',
            'asf'             => 'required|numeric',
            'vat'             => 'required|numeric',
            'file'            => 'nullable|file',
            'supporting_file' => 'nullable|file'
        ];
    }
}
