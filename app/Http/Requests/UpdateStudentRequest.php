<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateStudentRequest extends FormRequest
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
        $id = $this->route('student')->id;

        return [
            'first_name'    => 'required',
            'middle_name'   => 'required',
            'last_name'     => 'required',
            'email'         => 'required|email|unique:users,email,' . $id
        ];
    }
}
