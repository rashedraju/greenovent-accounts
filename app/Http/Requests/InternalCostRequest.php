<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class InternalCostRequest extends FormRequest {
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
        return $this->internalCost ? $this->internalEditRules() : $this->internalAddRules();
    }

    private function internalEditRules() {
        return [
            'total' => 'nullable|numeric',
            'ait' => 'nullable|numeric',
            'file'  => 'nullable|file',
            'note'  => 'nullable|string'
        ];
    }

    private function internalAddRules() {
        return [
            'total' => 'required|numeric',
            'ait' => 'required|numeric',
            'file'  => 'nullable|file',
            'note'  => 'nullable|string'
        ];
    }
}
