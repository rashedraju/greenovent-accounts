<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class VendorCostRequest extends FormRequest {
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
        return $this->vendorCost ? $this->vendorEditRules() : $this->vendorAddRules();
    }

    private function vendorEditRules() {
        return [
            'total' => 'nullable|numeric',
            'due'   => 'nullable|numeric',
            'file'  => 'nullable|file',
            'note'  => 'nullable|string'
        ];
    }

    private function vendorAddRules() {
        return [
            'total' => 'required|numeric',
            'due'   => 'nullable|numeric',
            'file'  => 'nullable|file',
            'note'  => 'nullable|string'
        ];
    }
}
