<?php

namespace App\Http\Requests;

use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use App\Enums\StatusEnum;


class SalesPersonFormrequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
       
        return [
            'name' => ['required', 'string', 'max:255'],
            'fg_color' => ['required', 'max:255'],
            'bg_color' => ['required', 'max:255'],
            'status' => ['nullable'],
        ];
        
    }
}
