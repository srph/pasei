<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AttachStudentSectionRequest extends FormRequest
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
        $id = $this->route('class')->id;
        $user = $this->get('user_id');
        
        return [
            'user_id' => 'required|exists:users,id|unique:class_user,user_id,' . $user . ',id,class_id,' . $id
        ];
    }
}
