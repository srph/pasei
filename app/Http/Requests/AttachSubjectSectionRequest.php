<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AttachSubjectSectionRequest extends FormRequest
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
        $subject = $this->get('subject_id');
        
        return [
            'subject_id' => 'required|exists:subjects,id|unique:resources,subject_id,' . $subject . ',id,class_id,' . $id,
            'user_id'    => 'required|exists:users,id|unique:resources,user_id,' . $user . ',id,class_id,' . $id
        ];
    }
}
