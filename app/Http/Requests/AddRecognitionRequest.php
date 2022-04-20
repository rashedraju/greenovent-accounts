<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AddRecognitionRequest extends FormRequest {
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
            'recognition_items'                => 'required|array',
            'recognition_items.*.purpose'      => "required",
            'recognition_items.*.rate'         => "required",
            'recognition_items.*.total_amount' => "required"
        ];
    }
}
