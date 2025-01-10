<?php

namespace App\Http\Requests;

use Crypt;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class StoreSuratTugasRequest extends FormRequest
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
            'sppd_id' => 'required|unique:surat_tugas,sppd_id',
            'nomor_spd' => 'required',
            'nomor_st' => 'required',
            'kegiatan' => 'required|max:250',
            'dari' => 'required|max:250',
            'tujuan' => 'required|max:250',
            'lama_tugas' => 'required|numeric',
            'tanggal_st' => 'required',
            'tanggal_berangkat' => 'required',
            'tanggal_kembali' => 'required',
        ];
    }

    public function attributes()
    {
        return [
            'nomor_spd' => 'Nomor SPD',
            'nomor_st' => 'Nomor ST',
            'tanggal_st' => 'Tanggal ST',
            'lama_tugas' => 'Lama tugas',
            'tanggal_berangkat' => 'Tanggal berangkat',
        ];
    }

    public function prepareForValidation()
    {
        return $this->merge([
            'sppd_id' => Crypt::decrypt($this->input('sppd_id')),
        ]);
    }
}
