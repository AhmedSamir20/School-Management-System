<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class FeesRequest extends FormRequest
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
     * Get the Fees rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'title_ar' => 'required',
            'title_en' => 'required',
            'amount' => 'required|numeric',
            'Grade_id' => 'required|integer',
            'Classroom_id' => 'required|integer|unique:fees,Classroom_id,'.$this->id,
            'year' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'title_ar.required' => trans('Fees.required_name_ar'),
            'title_en.required' => trans('Fees.required_name_en'),
            'amount.required' => trans('Fees.required_amount'),
            'amount.numeric' => trans('Fees.numeric_amount'),
            'Grade_id.required' => trans('Fees.required_Grade'),
            'Classroom_id.required' => trans('Fees.required_Classroom'),
            'year.required' => trans('Fees.required_year'),
        ];
    }
}
