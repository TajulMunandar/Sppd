<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TiketPulangRequest extends FormRequest
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
            'asal' => 'required',
            'tujuan' => 'required',
            'tgl_penerbangan' => 'nullable',
            'maskapai' => 'nullable',
            'booking_reference' => 'nullable',
            'no_eticket' => 'nullable',
            'no_penerbangan' => 'nullable',
            'total_harga' => 'required',
            'dokumen' => ['nullable', 'file', 'mimes:pdf', 'max:10240']
        ];
    }

    public function attributes()
    {
        return [
            'asal' => 'Asal',
            'tujuan' => 'Tujuan',
            'tgl_penerbangan' => 'Tgl. Penerbangan',
            'maskapai' => 'Maskapai',
            'booking_reference' => 'Booking Reference',
            'no_eticket' => 'No. E-Ticket',
            'no_penerbangan' => 'No. Penerbangan',
            'total_harga' => 'Total Harga',
            'dokumen' => 'Bukti tiket',
        ];
    }

    public function prepareForValidation()
    {
        return $this->merge([
            'total_harga' => str_replace('.', '', $this->input('total_harga'))
        ]);
    }
}
