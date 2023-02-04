<?php

namespace App\Http\Requests\User;

use App\Http\Requests\FormRequest;

/**
 * Class StoreRequest
 */
class StoreRequest extends FormRequest
{

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            'name' => [
                'required',
                'string',
            ],
            'email' => [
                'required',
                'string',
                'email',
                'unique:users,email',
            ],
            'phone' => [
                'required',
                'string',
                'min:10',
                'max:26',
                'regex:/^([0-9\s\-\+\(\)]*)$/',
            ],
            'password' => [
                'required',
                'string',
            ],
        ];
    }

}
