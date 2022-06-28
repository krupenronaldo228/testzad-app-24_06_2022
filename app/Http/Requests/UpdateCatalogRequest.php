<?php

namespace App\Http\Requests;

use App\Http\Components\CatalogCategory;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Enum;

class UpdateCatalogRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'id' => 'required|unique:catalogs',
            'name' => 'nullable|unique:catalogs|max:255',
            'description' => 'nullable|max:10000',
            'category' => ['nullable', new Enum(CatalogCategory::class)],
            'price' => 'nullable|float',
        ];
    }
}
