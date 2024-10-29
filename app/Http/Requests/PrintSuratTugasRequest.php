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
            'perihal' => ['required', 'string', 'max:250'],
            'tujuan' => ['required', 'string', 'max:200'],
            'lama_kegiatan' => ['required', 'numeric'],
            'tgl_berangkat' => ['required'],
            'tgl_pulang' => 'nullable',
            'tgl_surat' => ['required'],
            'bulan' => ['required', 'string', 'max:10'],
            'tahun' => ['required', 'numeric', 'digits:4'],
            'nd' => ['nullable'],
            'pelaksana' => ['nullable', 'required_if:nd,1', 'string', 'max:200'],
            'nip' => ['nullable', 'required_if:nd,1', 'string', 'max:200'],
            'golongan' => ['nullable', 'required_if:nd,1', 'string', 'max:200'],
            'nomor_nd' => ['nullable', 'required_if:nd,1', 'string', 'max:200'],
            'tanggal_nd' => ['nullable', 'required_if:nd,1'],
        ];
    }

    public function attributes()
    {
        return [
            'lama_kegiatan' => 'Lama kegiatan',
            'nd' => 'Notadinas',
            'nomor_nd' => 'Nomor nota dinas',
            'tanggal_nd' => 'Tanggal nota dinas',
        ];
    }

    public function messages()
    {
        return [
            'nomor_nd.required_if' => ':Attribute wajib diisi jika dinotadinaskan',
            'tanggal_nd.required_if' => ':Attribute wajib diisi jika dinotadinaskan',
        ];
    }
}
