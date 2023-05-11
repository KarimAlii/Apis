<?php

namespace App\Http\Requests\Companies\Profile;

use Illuminate\Foundation\Http\FormRequest;

class UpdateProfileRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            "company_name" => "required|min:2|max:255",
            "company_industry" => "nullable|array",
            "company_address" => "required|min:2|max:255",
            "company_lat" => "required",
            "company_lng" => "required",
            "company_size" => "nullable|in:micro,small,mini,large",
            "user_name" => "required|min:2|max:255",
            "user_phone" => "required|min:11|max:11,unique:users,phone," . $this->user()->id,
            "user_email" => "required|email|unique:users,email," .  $this->user()->id,
            "password" => "required|confirmed|min:8",
            "image" => "nullable|mimes:png,jpg,jpeg|max:2048"
        ];
    }
}
