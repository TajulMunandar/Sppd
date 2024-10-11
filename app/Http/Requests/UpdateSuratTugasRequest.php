<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class UpdateSuratTugasRequest extends FormRequest
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
            'nomor_st' => 'required',
            'nomor_spd' => 'required',
            'kegiatan' => 'required',
            'dari' => 'required',
            'tujuan' => 'required',
            'lama_tugas' => 'required',
            'tanggal_st' => 'required',
            'tanggal_berangkat' => 'required',
            'tanggal_kembali' => 'required',
            'dokumen' => ['nullable', 'sometimes', 'file', 'mimes:pdf', 'max:10240']
        ];
    }
}
