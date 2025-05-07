<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreBookRequest extends FormRequest
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
        return [
            'title' => 'required|string|max:255',
            'isbn' => 'nullable|string|max:13|unique:books,isbn',
            'author_id' => 'required|exists:authors,id',
        ];
    }

    public function messages(): array
    {
        return [
            'title.required' => 'The book title is mandatory.',
            'isbn.unique' => 'This ISBN is already registered.',
            'author_id.exists' => 'The author must exist in the database.',
        ];
    }

}
