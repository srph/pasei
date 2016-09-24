<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateTeacherRequest extends FormRequest
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
        $id = $this->route('teacher')->id;

        return [
            'first_name'    => 'required|name',
            'middle_name'   => 'required|name',
            'last_name'     => 'required|name',
            'email'         => 'required|email|unique:users,email,' . $id
        ];
    }
}
