<?php

namespace App\Http\Controllers;

use App\Http\Requests\PrintSuratTugasRequest;
use App\Models\ApiToken;
use App\Models\RiwayatSuratTugas;
use Exception;
use GuzzleHttp\Client;
use Illuminate\Support\Carbon;

class CreateSuratTugasController extends Controller
{
    public function index()
    {
        $title = 'Surat Tugas';
        $token = ApiToken::where('app_name', 'Sijadin')->first();

        return view('admin.surat_tugas.create.index', compact('title', 'token'));
    }

    public function print(PrintSuratTugasRequest $request)
    {
        $title = 'Surat Tugas';
        $request->validated();
        $pegawaiIds = $request->pegawai;

        $token = ApiToken::where('app_name', 'Sijadin')->first();
        try {
            $client = new Client;
            $response = $client->request(
                'POST',
                'https://simpeg.pupr-acehbaratkab.com/api/data-pegawai/show',
                [
                    'json' => ['ids' => $pegawaiIds],
                    'headers' => [
                        'Authorization' => 'Bearer ' . $token->token,
                        'Accept' => 'application/json',
                    ],
                ]
            );
            $pegawais = json_decode($response->getBody()->getContents(), true);

            foreach ($pegawais as $pegawai) {
                $dataPegawai[] = [
                    'nama' => $pegawai['nama_lengkap'],
                    'nip' => $pegawai['nip_baru'] ?? null,
                    'pangkat' => $pegawai['pangkats'] ? $pegawai['pangkats'][0]['golongan']['nama'] . ' (' . $pegawai['pangkats'][0]['golongan']['kode'] . ')' : '-',
                    'jabatan' => $pegawai['latest_jabatan'] ? $pegawai['latest_jabatan']['nama_jabatan'] : '-',
                    'kode' => $pegawai['pangkats'][0]['golongan']['kode']
                ];
            }
            usort($dataPegawai, function ($a, $b) {
                return $b['kode'] <=> $a['kode'];
            });
            // hapus kata kunci kode agar tidak disimpan ke database
            foreach ($dataPegawai as &$pegawai) {
                unset($pegawai['kode']);
            }
            unset($pegawai);

            // simpan riwayat surat tugas
            RiwayatSuratTugas::create([
                'jenis' => $request->jenis,
                'pegawai' => json_encode($dataPegawai),
                'perihal' => $request->perihal,
                'tujuan' => $request->tujuan,
                'tanggal_berangkat' => $request->tgl_berangkat,
                'tanggal_kembali' => $request->tgl_pulang,
                'bulan' => $request->bulan,
                'tahun' => $request->tahun,
                'tanggal_surat' => $request->tgl_surat,
                'pelaksana_nd' => $request->pelaksana,
                'nip' => $request->nip,
                'nomor_nd' => $request->nomor_nd,
                'pangkat' => $request->golongan,
                'jabatan' => $request->jabatan,
                'tanggal_nd' => $request->tanggal_nd,
            ]);

            $data = [
                'jenis' => $request->jenis,
                'tujuan' => $request->tujuan,
                'perihal' => $request->perihal,
                'lama_kegiatan' => $request->lama_kegiatan,
                'bulan' => $request->bulan,
                'tahun' => $request->tahun,
                'nd' => $request->nd,
                'pelaksana' => $request->pelaksana,
                'nip' => $request->nip,
                'golongan' => $request->golongan,
                'jabatan' => $request->jabatan,
                'nomor_nd' => $request->nomor_nd,
                'tgl_berangkat' => $request->tgl_berangkat,
                'tgl_pulang' => $request->tgl_pulang,
                'tgl_surat' => $request->tgl_surat,
                'tanggal_nd' => Carbon::parse($request->tanggal_nd)->translatedFormat('d F Y'),
            ];

            return view('admin.surat_tugas.print.index', compact('title', 'data', 'pegawais'));
        } catch (Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
}
