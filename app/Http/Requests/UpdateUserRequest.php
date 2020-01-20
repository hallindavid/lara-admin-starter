<?php

namespace App\Http\Requests;


use App\Rules\StrongPassword;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Http\FormRequest;

class UpdateUserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return (Auth::check() && Auth::user()->is_admin);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'first_name' => ['required', 'string', 'max:255'],
            'last_name' => ['required', 'string', 'max:255'],
            'state'=>['nullable','string', 'max:255'],
            'country' =>['nullable','string', 'max:255'],
            'timezone'=>['nullable','string','max:255'],
            'is_admin'=>['boolean','nullable']
        ];
    }
}
