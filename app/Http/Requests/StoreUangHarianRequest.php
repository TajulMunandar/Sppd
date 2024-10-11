<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class StoreUangHarianRequest extends FormRequest
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
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'sppd_id' => 'required',
            'harian' => 'required',
            'konsumsi' => 'required',
            'transportasi' => 'required',
            'representasi' => 'required',
        ];
    }

    public function prepareForValidation()
    {
        return $this->merge([
            'harian' => str_replace('.', '', $this->harian),
            'transportasi' => str_replace('.', '', $this->transportasi),
        ]);
    }
}
