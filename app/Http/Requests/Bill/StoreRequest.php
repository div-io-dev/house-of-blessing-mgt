<?php

namespace App\Http\Requests\Bill;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreRequest extends FormRequest
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
            'type' => 'required',
            'amount' => 'required',
            'for' => 'required',
            'student_number' => [Rule::requiredIf(fn()=>$this->for == 'student'), 'exists:students,student_number'],
            'selected_classes' => [Rule::requiredIf(fn()=>$this->for == 'class'), 'array', 'min:1'],
        ];
    }
}
