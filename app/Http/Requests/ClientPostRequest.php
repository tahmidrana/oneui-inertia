<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ClientPostRequest extends FormRequest
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
            'name' => 'required|string',
            'client_code' => 'required|string|unique:clients|max:30',
            'client_type_id' => 'required|integer',
            'gender' => 'required|integer',
            'dob' => 'required|date_format:d-m-Y|nullable',
            'blood_group' => 'integer|nullable',
            'address' => 'required|string',
            'post_code' => 'required|string',
            'phone' => 'required|string|size:11',
            'email' => 'required|string|email',
            // 'photo' => 'mimes:png,jpg,jpeg|max:2048|nullable',
            'district_id' => 'required|integer',

            'emergency_contact.name' => 'required|string',
            'emergency_contact.relation' => 'required|string',
            'emergency_contact.phone' => 'required|string|size:11',
            'emergency_contact.email' => 'required|string|email',

            'referral_source_type' => 'required|integer',

            'referral.name' => 'required_if:referral_source_type,==,1',
            'referral.relation' => 'string|nullable',
            'referral.phone' => 'required_if:referral_source_type,1',
            'referral.email' => 'email|nullable',

            'corporate_id' => 'required_if:referral_source_type,==,2',
            'referral.relation_with_company' => 'required_if:referral_source_type,==,2',
            'referral.emp_id' => 'string|nullable',
            'referral.designation' => 'string|nullable',
            'referral.official_phone' => 'string|nullable',
            'referral.official_email' => 'string|nullable',

            'preferred_days' => 'array',
            'preferred_timeslots' => 'array',
            'pref_language' => 'integer|required',
            'payment_methods' => 'array',
            'pref_meeting_place' => 'integer|required',
            'pref_price_range' => 'integer|required',
            'preferred_clinicians' => 'array',
        ];
    }

    public function messages()
    {
        return [
            'referral.name.required_if' => 'Referral name field is required',
            'referral.phone.required_if' => 'Referral phone field is required',
            'corporate_id.required_if' => 'Company field is required',
            'referral.relation_with_company.required_if' => 'Relation with company field is required',
        ];
    }
}
