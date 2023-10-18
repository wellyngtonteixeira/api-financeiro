<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreUpdateItem extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array
    {
        $rules = [
            'name' => ['required'],
            'value' => ['required'],
        ];

        if ($this->method() === 'PUT' || $this->method() === 'PATCH') {
            $rules['subject'] = [
                'required', // 'nullable',
                // "unique:supports,subject,{$this->id},id",
                Rule::unique('items')->ignore($this->item ?? $this->id),
            ];
        }

        return $rules;
    }
}
