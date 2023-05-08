<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class KelasPayungRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'kelas' => 'required|unique:App\Models\KelasPayung,kelas,' . $this->id
        ];
    }
}
