<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateGradeRequest extends FormRequest
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
        if ( $this->route('subject')->is_conventional ) {
            return [
                'pace_grade' => 'required|numeric|min:50|max:100',
                'conventional_grade' => 'required|numeric|min:50|max:100',
            ];            
        }

        return ['conventional_grade' => 'required|numeric|min:50|max:100'];
    }
}
