<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;

class UpdateUserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize()
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
        $public_id = $this->course;

        return [
            'name' => ['required', 'min:3', 'max:255', "unique:courses,name,{$public_id},public_id"],
            'description' => ['nullable', 'min:3', 'max:9999'],
        ];
    }
}
