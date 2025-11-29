<?php

namespace App\Http\Requests\Casino;

use App\Rules\Casino\MaxValueValidator;
use Illuminate\Foundation\Http\FormRequest;

class UpdateTicketPriceRequest extends FormRequest
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
            "ticketPrice" => ["filled", "integer", "min:1", new MaxValueValidator("maxTicketPrice")],
            "VIPTicketPrice" => ["filled", "integer", "min:1", new MaxValueValidator("maxVIPTicketPrice")],
        ];
    }
}
