<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PrizeGenerateRequest extends FormRequest
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
            'count' => 'required|integer',
            'card_number' => 'nullable|integer',
            'exp_month' => 'nullable|integer',
            'exp_year' => 'nullable|integer',
            'cvc' => 'nullable|integer',
            'physycal_id' => 'nullable|integer',
            'address' => 'nullable|string|max:2048'
        ];
    }
}
