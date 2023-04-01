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
        $user = $this->user();

        return $user != null && $user->tokenCan('create', 'update', 'delete');
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
            'job' => 'required',
            'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:1048',
        ];
    }
}
