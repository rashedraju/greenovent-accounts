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
            'date'            => 'required|string',
            'bill_no'         => 'required|string',
            'subject'         => 'required|string',
            'bill_status_id'  => 'required',
            'total'           => 'required',
            'asf'             => 'sometimes|integer',
            'vat'             => 'sometimes|integer',
            'file'            => 'sometimes|file',
            'supporting_file' => 'sometimes|file'
        ];
    }
}
