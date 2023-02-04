<?php

namespace App\Http\Requests\User;

use App\Http\Requests\FormRequest;
use Illuminate\Validation\Rule;

/**
 * Class IndexRequest
 * @package App\Http\Requests\User
 */
class IndexRequest extends FormRequest
{
    public const PER_PAGES = [10, 20, 50];

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            'per_page' => [
                'sometimes',
                Rule::in(self::PER_PAGES)
            ],
        ];
    }
}
