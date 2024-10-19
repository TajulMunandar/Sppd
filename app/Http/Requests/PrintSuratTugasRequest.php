<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PrintSuratTugasRequest extends FormRequest
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
            'pegawai' => ['required'],
            'tujuan' => ['required', 'string', 'max:200'],
            'bulan' => ['required', 'string', 'max:10'],
            'tahun' => ['required', 'numeric', 'digits:4'],
            'nd' => ['nullable']
        ];
    }

    public function attributes()
    {
        return [
            'nd' => 'Notadinas'
        ];
    }
}
