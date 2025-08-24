<?php

namespace App\Http\Requests\City;

use App\Models\Company;
use Illuminate\Foundation\Http\FormRequest;

class GetCityCompaniesRequest extends FormRequest
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
        return [
            "page" => ["integer", "min:1"],
            "per_page" => ["integer", "min:1"],
            "name" => ["filled", "string"],
            "type" => ["string", "in:".implode(",", Company::COMPANY_TYPE)],
            "level" => ["integer", "min:1", "max:".Company::MAX_LEVEL]
        ];
    }
}
