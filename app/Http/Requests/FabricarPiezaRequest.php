<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class FabricarPiezaRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'peso_real' => ['required', 'numeric', 'min:0.01', 'max:999999.999'],
        ];
    }
}
