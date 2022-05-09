<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AddRequisitionRequest extends FormRequest {
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
            'user_id'                          => 'required|exists:users,id',
            'checked_by'                       => 'required|exists:users,id',
            'requisition_items'                => 'required|array',
            'requisition_items.*.purpose'      => "required",
            'requisition_items.*.rate'         => "required",
            'requisition_items.*.total_amount' => "required"
        ];
    }
}
