<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PhoneBookRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'name' => 'required',
            'phone_number' => 'required',
            'relationship' => 'required',
            'country' => 'required',
            'email' => 'required',
            'job',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:1048',
        ];
    }
}
