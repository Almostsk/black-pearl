<?php

namespace App\Http\Requests\Admin;

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
            'name'     => 'sometimes|required|max:190',
            'surname'  => 'sometimes|required|max:190',
            'status'   => 'sometimes|required|integer|min:1',
            'about_me' => 'sometimes|max:190'
        ];
    }
}
