<?php

namespace App\Http\Requests\Mafia;

use App\Enums\MafiaTargetType;
use App\Rules\Mafia\TargetIdIsValid;
use App\Rules\Mafia\TargetTypeIsUnlocked;
use Illuminate\Foundation\Http\FormRequest;

class CreateContractRequest extends FormRequest
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
            "targetType" => ["required", "string",
                "in:".implode(",",array_column(MafiaTargetType::cases(), 'value')),
                new TargetTypeIsUnlocked()],
            "targetId" => ["required", "integer", new TargetIdIsValid()]
        ];
    }
}
