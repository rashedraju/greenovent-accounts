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
            'total' => 'required|integer',
            'file'  => 'sometimes|file',
            'note'  => 'sometimes'
        ];
    }

    private function internalAddRules() {
        return [
            'total' => 'required|integer',
            'file'  => 'required|file',
            'note'  => 'sometimes'
        ];
    }
}
