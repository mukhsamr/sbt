<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PlpTahfidzRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'plp' => 'required|unique:App\Models\PlpTahfidz,plp,' . $this->id
        ];
    }
}
