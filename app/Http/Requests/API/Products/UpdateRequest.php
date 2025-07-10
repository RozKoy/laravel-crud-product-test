<?php

namespace App\Http\Requests\API\Products;

use App\Models\Product;
use App\Traits\APIBadRequestHandler;
use Illuminate\Foundation\Http\FormRequest;

class UpdateRequest extends FormRequest
{
    use APIBadRequestHandler;

    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:' . Product::ATTRIBUTE_LIMIT['name']['max']],

            'description' => ['nullable', 'string', 'max:' . Product::ATTRIBUTE_LIMIT['description']['max']],
            'phot' => ['nullable', 'file', 'image', 'max:' . Product::PHOTO_MAX_SIZE],
        ];
    }
}
