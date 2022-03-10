<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EditVendorCostRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'project_id'  => 'sometimes',
            'title'       => 'sometimes|string',
            'name'       => 'sometimes|string',
            'advance'    => 'sometimes|integer',
            'due'        => 'sometimes|integer',
            'created_at'  => 'sometimes|date',
        ];
    }
}
