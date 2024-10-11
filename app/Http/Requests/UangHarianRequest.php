<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UangHarianRequest extends FormRequest
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
            'sppd_id' => 'required',
            'harian' => 'required',
            'konsumsi' => 'required',
            'transportasi' => 'required',
            'representasi' => 'required',
        ];
    }

    public function attributes()
    {
        return [
            'sppd_id' => 'Sppd',
        ];
    }

    public function prepareForValidation()
    {
        $this->merge([
            'harian' => str_replace('.', '', $this->harian),
            'representasi' => str_replace('.', '', $this->representasi),
        ]);
    }
}
