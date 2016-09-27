<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class UpdateAuthRequest extends FormRequest
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
        if ( Auth::user()->user_type_id === 3 ) {
            return [
                'email'     => 'required|email',
                'first_name'    => 'required|name',
                'middle_name'   => 'required|name',
                'last_name'     => 'required|name',
                'password'  => 'min:6|confirmed'
            ];
        }

        return [
            'email'     => 'required|email',
            'password'  => 'min:6|confirmed'
        ];
    }
}
