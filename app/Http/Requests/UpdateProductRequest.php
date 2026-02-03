<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateProductRequest extends FormRequest
{
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
        $currentId = $this->route('product')->id;

        return [
            'name' => ['nullable',Rule::unique('products')->ignore($currentId),'string'],
            'price' => 'nullable|numeric|min:0.01',
            'description' => 'nullable|string',
            'category_id' => 'nullable|exists:categories,id',
        ];
    }
}
