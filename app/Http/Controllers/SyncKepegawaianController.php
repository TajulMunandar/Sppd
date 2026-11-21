<?php

namespace App\Http\Controllers;

use App\Models\Golongan;
use App\Models\Kepegawaian;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class SyncKepegawaianController extends Controller
{
    private const FIELDS = [
        'nama', 'gelar_depan', 'gelar_belakang', 'tempat_lahir', 'tanggal_lahir', 'nip_lama', 'nip_baru',
        'universitas', 'jurusan', 'tingkat_ijazah', 'tahun_lulus', 'golongan_id', 'tmt_cpns',
        'tmt_pangkat_terakhir', 'jabatan', 'masa_kerja_tahun', 'masa_kerja_bulan', 'unit_kerja',
        'instansi_induk', 'alamat', 'telp', 'rencana_naik_pangkat', 'rencana_naik_gaji',
    ];

    private const REQUIRED_TEXT_FIELDS = ['tempat_lahir', 'jurusan', 'jabatan', 'unit_kerja', 'instansi_induk', 'alamat', 'telp'];

    private const ITEM_RULES = [
        'id' => ['required', 'integer', 'min:1'],
        'nama' => ['required', 'string', 'max:255'],
        'tanggal_lahir' => ['required', 'date'],
        'nip_baru' => ['nullable', 'string', 'max:100'],
        'tingkat_ijazah' => ['nullable', 'string', 'max:100'],
        'tahun_lulus' => ['nullable', 'integer', 'between:1901,2155'],
        'tmt_cpns' => ['nullable', 'date'],
        'tmt_pangkat_terakhir' => ['nullable', 'date'],
        'rencana_naik_pangkat' => ['nullable', 'date'],
        'rencana_naik_gaji' => ['nullable', 'date'],
        'masa_kerja_tahun' => ['nullable', 'integer'],
        'masa_kerja_bulan' => ['nullable', 'integer'],
    ];

    public function sync(Request $request): JsonResponse
    {
        $data = $request->json()->all();

        if ($data === [] || ! array_is_list($data)) {
            return response()->json(['message' => 'Payload harus berupa daftar pegawai dan tidak boleh kosong.'], 422);
        }

        $golonganIds = Golongan::pluck('id')->flip();
        $created = 0;
        $updated = 0;
        $skipped = [];

        DB::transaction(function () use ($data, $golonganIds, &$created, &$updated, &$skipped) {
            foreach ($data as $index => $item) {
                if (! is_array($item)) {
                    $skipped[] = ['index' => $index, 'id' => null, 'errors' => ['Data bukan objek pegawai.']];

                    continue;
                }

                $validator = Validator::make($item, self::ITEM_RULES);
                if ($validator->fails()) {
                    $skipped[] = ['index' => $index, 'id' => $item['id'] ?? null, 'errors' => $validator->errors()->all()];

                    continue;
                }

                $attributes = $this->attributesFrom($item, $golonganIds);
                $pegawai = $this->findExisting((int) $item['id'], $attributes['nip_baru']);

                $pegawai->fill($attributes + ['id_lama' => (int) $item['id']])->save();
                $pegawai->wasRecentlyCreated ? $created++ : $updated++;
            }
        });

        return response()->json([
            'message' => 'Data berhasil disinkronisasi',
            'created' => $created,
            'updated' => $updated,
            'skipped' => $skipped,
        ]);
    }

    private function findExisting(int $idLama, ?string $nipBaru): Kepegawaian
    {
        $pegawai = Kepegawaian::where('id_lama', $idLama)->first();

        if (! $pegawai && $nipBaru !== null) {
            $pegawai = Kepegawaian::whereNull('id_lama')->where('nip_baru', $nipBaru)->first();
        }

        return $pegawai ?? new Kepegawaian;
    }

    private function attributesFrom(array $item, $golonganIds): array
    {
        $attributes = [];
        foreach (self::FIELDS as $field) {
            $value = $item[$field] ?? null;
            $attributes[$field] = is_string($value) && trim($value) === '' ? null : $value;
        }

        foreach (self::REQUIRED_TEXT_FIELDS as $field) {
            $attributes[$field] ??= '';
        }

        if ($attributes['golongan_id'] !== null && ! $golonganIds->has($attributes['golongan_id'])) {
            $attributes['golongan_id'] = null;
        }

        return $attributes;
    }
}
