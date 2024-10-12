<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TiketPergiRequest extends FormRequest
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
            'asal' => 'required',
            'tujuan' => 'required',
            'tgl_penerbangan' => 'required',
            'maskapai' => 'required',
            'booking_reference' => 'required',
            'no_eticket' => 'required',
            'no_penerbangan' => 'required',
            'total_harga' => 'required|numeric',
            'dokumen' => ['nullable', 'file', 'mimes:pdf', 'max:10240']
        ];
    }

    public function attributes()
    {
        return [
            'sppd_id' => 'SPPD',
            'tgl_penerbangan' => 'Tgl. Penerbangan',
            'maskapai' => 'Maskapai penerbangan',
            'booking_reference' => 'Booking Reference',
            'no_eticket' => 'No. E-Ticket',
            'no_penerbangan' => 'No. Penerbangan',
            'total_harga' => 'Total Harga',
            'dokumen' => 'Bukti tiket'
        ];
    }

    public function prepareForValidation()
    {
        return $this->merge([
            'total_harga' => str_replace('.', '', $this->input('total_harga')),
        ]);
    }
}
