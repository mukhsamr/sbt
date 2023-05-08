<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class KelasPondokRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'kelas' => 'required|unique:App\Models\KelasPondok,kelas,' . $this->id
        ];
    }
}
