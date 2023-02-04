<?php

namespace App\Http\Requests\User;

use App\Http\Requests\FormRequest;
use App\Models\User;
use Illuminate\Validation\Rule;

/**
 * Class UpdateRequest
 */
class UpdateRequest extends FormRequest
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
                'string',
            ],
            'email' => [
                'string',
                'email',
            ],
            'phone' => [
                'string',
                'max:26',
            ],
            'password' => [
                'string',
            ],
        ];
    }

}
