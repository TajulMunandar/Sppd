<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * Melindungi endpoint sinkronisasi kepegawaian yang dipanggil sistem eksternal (SIMPEG).
 * Pemanggil wajib mengirim header `Authorization: Bearer <SIMPEG_SYNC_TOKEN>`.
 */
class VerifySyncToken
{
    public function handle(Request $request, Closure $next): Response
    {
        $expected = (string) config('services.simpeg_sync.token');

        // Gagal tertutup: tanpa token terkonfigurasi, endpoint tidak boleh bisa dipakai siapa pun.
        if ($expected === '') {
            return response()->json(['message' => 'Sinkronisasi belum dikonfigurasi.'], Response::HTTP_SERVICE_UNAVAILABLE);
        }

        $provided = (string) $request->bearerToken();

        if ($provided === '' || ! hash_equals($expected, $provided)) {
            return response()->json(['message' => 'Token tidak valid.'], Response::HTTP_UNAUTHORIZED);
        }

        return $next($request);
    }
}
