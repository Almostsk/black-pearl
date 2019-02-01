<?php

namespace App\Http\Requests\Auth;

use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
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
            //'name'         => 'required|max:255',
            //'surname'      => 'required|max:255',
            //'city_id'      => 'required|numeric|min:1',
            //'mobile_phone' => 'required|max:255',
            //'about_me'     => 'sometimes|required',
            //'avatar'       => 'sometimes|required',
        ];
    }
}
