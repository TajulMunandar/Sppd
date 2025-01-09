<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SuratTugasRequest extends FormRequest
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
            'nomor_st' => 'required',
            'nomor_spd' => 'required',
            'kegiatan' => 'required',
            'dari' => 'required',
            'tujuan' => 'required',
            'lama_tugas' => 'required',
            'tanggal_st' => 'required',
            'tanggal_berangkat' => 'required',
            'tanggal_kembali' => 'required',
        ];
    }

    public function attributes(): array
    {
        return [
            'tanggal_st' => 'Tanggal ST',
        ];
    }
}
