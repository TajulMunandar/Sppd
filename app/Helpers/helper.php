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
