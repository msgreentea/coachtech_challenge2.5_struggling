<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ChallengeRequest extends FormRequest
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
            'familyname' => 'required',
            'lastname' => 'required',
            'gender' => 'required',
            'email' => 'required | email',
            'postcode' => 'required | min:8',
            'address' => 'required',
            'opinion' => 'required | max:120'
        ];
    }
}