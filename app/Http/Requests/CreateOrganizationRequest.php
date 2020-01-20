<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class CreateOrganizationRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return (Auth::check() && isset(Auth::user()->email_verified_at));
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' =>['required','string', 'max:255'],
            'address'=>'required|string|min:1',
            'city'=>'required|string|min:1',
            'state'=>['required', 'string','min:2'],
            'country'=>['required', Rule::in(['USA','Canada'])],
            'timezone'=>['required', 'string','min:1'],
        ];
    }
}
