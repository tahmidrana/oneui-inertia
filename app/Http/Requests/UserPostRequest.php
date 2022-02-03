<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserPostRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return auth()->user()->can('user-create');
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required|string',
            'userid' => 'required|string|unique:users|max:30',
            'email' => 'string|nullable|email',
            'gender' => 'integer',
            'dob' => 'date_format:d-m-Y|nullable',
            'address' => 'required|string',
            'phone' => 'required|string|size:11',
            'photo' => 'mimes:png,jpg,jpeg|max:2048|nullable',

            'joining_date' => 'date_format:d-m-Y|nullable',
            'user_type_id' => 'integer|required',
            'other_roles_id' => 'array',
            'employment_type' => 'integer|required'
        ];
    }
}
