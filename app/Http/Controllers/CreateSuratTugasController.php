<?php

namespace App\Http\Controllers;

use App\Http\Requests\PrintSuratTugasRequest;
use App\Models\ApiToken;
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
                        'Authorization' => 'Bearer '.$token->token,
                        'Accept' => 'application/json',
                    ],
                ]
            );
            $pegawais = json_decode($response->getBody()->getContents(), true);
            $data = [
                'tujuan' => $request->tujuan,
                'perihal' => $request->perihal,
                'lama_kegiatan' => $request->lama_kegiatan,
                'bulan' => $request->bulan,
                'tahun' => $request->tahun,
                'nd' => $request->nd,
                'pelaksana' => $request->pelaksana,
                'nip' => $request->nip,
                'golongan' => $request->golongan,
                'nomor_nd' => $request->nomor_nd,
                'tgl_berangkat' => $request->tgl_berangkat,
                'tgl_pulang' => $request->tgl_pulang,
                'tgl_surat' => $request->tgl_surat,
                'tanggal_nd' => Carbon::parse($request->tanggal_nd)->translatedFormat('d F Y'),
            ];

            // dd($pegawais);

            return view('admin.surat_tugas.print.index', compact('title', 'data', 'pegawais'));
        } catch (Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
}
