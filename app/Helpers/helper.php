<?php

use Illuminate\Support\Str;

if (!function_exists('groupActive')) {
    function groupActive($route)
    {
        return call_user_func_array('Route::is', (array) $route) ? 'active' : '';
    }
}
if (!function_exists('routeActive')) {
    function routeActive($route)
    {
        return request()->routeIs($route) ? 'active' : '';
    }
}


if (!function_exists('uploadSuratTugas')) {
    function uploadSuratTugas($file)
    {
        $filename = Str::uuid() . '.pdf';
        $path = $file->storeAs('upload/surat_tugas', $filename, 'public');
        return $path;
    }
}

if (!function_exists(function: 'uploadDokumen')) {
    function uploadDokumen($file, $path)
    {
        $filename = Str::uuid() . '.pdf';
        $path = $file->storeAs($path, $filename, 'public');
        return $path;
    }
}

if (!function_exists('romawi')) {
    function romawi($number)
    {
        $romawi = [1 => 'I', 'II', 'III', 'IV', 'V', 'VI', 'VII', 'VIII', 'IX', 'X', 'XI', 'XII'];
        return $romawi[$number];
    }
}

if (!function_exists(function: 'hitung')) {
    function hitung($angka)
    {
        $angka = abs($angka);
        $huruf = ['', 'satu', 'dua', 'tiga', 'empat', 'lima', 'enam', 'tujuh', 'delapan', 'sembilan', 'sepuluh', 'sebelas'];
        $temp = '';

        if ($angka < 12) {
            $temp = ' ' . $huruf[$angka];
        } elseif ($angka < 20) {
            $temp = hitung($angka - 10) . ' belas';
        } elseif ($angka < 100) {
            $temp = hitung($angka / 10) . ' puluh ' . hitung($angka % 10);
        } elseif ($angka < 200) {
            $temp = ' seratus ' . hitung($angka - 100);
        } elseif ($angka < 1000) {
            $temp = hitung($angka / 100) . ' ratus ' . hitung($angka % 100);
        } elseif ($angka < 2000) {
            $temp = ' seribu ' . hitung($angka - 1000);
        } elseif ($angka < 1000000) {
            $temp = hitung($angka / 1000) . ' ribu ' . hitung($angka % 1000);
        } elseif ($angka < 1000000000) {
            $temp = hitung($angka / 1000000) . ' juta ' . hitung($angka % 1000000);
        } elseif ($angka < 1000000000000) {
            $temp = hitung($angka / 1000000000) . ' miliar ' . hitung(fmod($angka, 1000000000));
        } else {
            $temp = hitung($angka / 1000000000000) . ' triliun ' . hitung(fmod($angka, 1000000000000));
        }

        return trim($temp);
    }
}

if (!function_exists('terbilang')) {
    function terbilang($angka)
    {
        if ($angka < 0) {
            return 'minus ' . hitung(abs($angka)) . ' rupiah';
        } else {
            return hitung($angka) . ' rupiah';
        }
    }
}
