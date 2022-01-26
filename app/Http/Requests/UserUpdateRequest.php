<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserUpdateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return auth()->user()->can('user-update');
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
            'email' => 'string|nullable|email',
            'gender' => 'integer',
            'dob' => 'date_format:d-m-Y|nullable',
            'blood_group' => 'integer|nullable',
            'address' => 'required|string',
            'phone' => 'required|string|size:11',
            'photo' => 'mimes:png,jpg,jpeg|max:2048|nullable',

            'joining_date' => 'date_format:d-m-Y|nullable',
            'employment_type' => 'integer|required'
        ];
    }
}
