<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class StoreTotalPergiRequest extends FormRequest
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
            'sppd_id' => 'required|unique:total_pergi,sppd_id',
            'asal' => 'required',
            'tujuan' => 'required',
            'tgl_penerbangan' => 'required',
            'maskapai' => 'required',
            'booking_reference' => 'required',
            'no_eticket' => 'required',
            'no_penerbangan' => 'required',
            'total_harga' => 'required',
        ];
    }

    public function prepareForValidation()
    {
        return $this->merge([
            'total_harga' => str_replace('.', '', $this->input('total_harga')),
        ]);
    }
}
