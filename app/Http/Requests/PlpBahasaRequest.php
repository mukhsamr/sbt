<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PlpBahasaRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'plp' => 'required|unique:App\Models\PlpIt,plp,' . $this->id
        ];
    }
}
