<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class UpdateAkomodasiRequest extends FormRequest
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
            'name_hotel' => 'nullable|string|max:250',
            'check_in' => 'nullable',
            'check_out' => 'nullable',
            'nomor_invoice' => 'nullable|string|max:250',
            'nomor_kamar' => 'nullable|string|max:100',
            'lama_inap' => 'nullable|numeric',
            'nama_kwitansi' => 'nullable|string|max:250',
            'harga' => 'nullable',
            'harga_diskon' => 'nullable',
            'bbm' => 'required',
            'dari' => 'required',
            'ke' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'name_hotel' => 'Nama hotel',
        ];
    }

    public function prepareForValidation()
    {
        return $this->merge([
            'harga' => $this->input('harga') ? str_replace('.', '', $this->input('harga')) : null,
            'harga_diskon' => $this->input('harga_diskon') ? str_replace('.', '', $this->input('harga_diskon')) : null,
            'bbm' => str_replace('.', '', $this->input('bbm')),
        ]);
    }
}
