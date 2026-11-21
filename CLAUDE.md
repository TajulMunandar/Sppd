# CLAUDE.md

This file provides guidance to Claude Code (claude.ai/code) when working with code in this repository.

## Ringkasan

Aplikasi SPPD (Surat Perintah Perjalanan Dinas) untuk Dinas PUPR Pemkab Aceh Barat. Laravel 10 (PHP ^8.1), MySQL, Blade server-rendered. Bahasa domain, nama tabel, pesan flash, dan komentar memakai Bahasa Indonesia — pertahankan konvensi ini.

## Perintah

```bash
composer install && npm install
cp .env.example .env && php artisan key:generate
php artisan migrate --seed        # seeder: role, user, golongan, jenis tugas, pegawai, dll.
php artisan serve                 # server dev
npm run dev / npm run build       # Vite (hanya untuk halaman Breeze/Tailwind)
php artisan storage:link          # PDF upload disimpan di disk `public`

./vendor/bin/pest                          # semua test (Pest 2)
./vendor/bin/pest tests/Feature/ProfileTest.php
./vendor/bin/pest --filter="nama test"
./vendor/bin/pint                          # formatter (Laravel Pint)
```

Test: bawaan Breeze (auth/profile) + `tests/Feature/RoleAccessTest.php` (hak akses per role). **Peringatan:** semua Feature test memakai `RefreshDatabase` terhadap MySQL lokal `sijadin` yang dikunci di `phpunit.xml` (`force="true"`, host `127.0.0.1`) — isi database itu dihapus setiap test dijalankan. Username/password tetap dari `.env`. Jangan ubah `DB_DATABASE`/`DB_HOST` di `phpunit.xml` ke database yang datanya perlu dipertahankan.

## Arsitektur

### UI
Dua stack frontend hidup berdampingan:
- **Panel admin** (`resources/views/layouts/app.blade.php`, `admin/**`): template Bootstrap 5 (Sneat-style) dari `public/vendor`, `public/js`, `public/libs`, plus jQuery DataTables via CDN. Halaman memakai `<x-app-layout>` (`App\View\Components\AppLayout` → `layouts.app`), yang hanya merender `$slot` tanpa named slot seperti `header`. Script/style halaman disisipkan lewat `@push('script')` / `@push('css')`. Menu di `layouts/partials/sidebar.blade.php`, navbar di `layouts/partials/navbar.blade.php`. `@extends` hanya dipakai halaman error (`errors::minimal`).
- **Halaman tamu** (`<x-guest-layout>` → `layouts/guest.blade.php`: login, welcome, register, reset password): tema Dash UI (`public/css/theme.css`, Bootstrap 5.1.3, primer `#192655`, font Inter) + Bootstrap Icons lokal (`public/libs/bootstrap-icons`). Atribut `<x-guest-layout split>` membuat halaman mengatur tata letaknya sendiri; tanpa atribut itu konten dibungkus kolom tengah. Semua halaman `auth/*` dibangun dari komponen `<x-auth-shell>` (kerangka dua kolom + alert), `<x-auth-input>` (field dengan ikon, error, toggle kata sandi), dan `<x-auth-submit>`; gaya di `public/css/auth.css` (kelas `auth-*`), perilaku di `public/js/auth.js`. Komponen Breeze bawaan (`x-text-input`, `x-primary-button`, dll.) berbasis Tailwind dan tidak bergaya di halaman ini.
- Tailwind/Vite/Alpine (sisa scaffolding Breeze) terpasang tetapi tidak dimuat oleh layout mana pun.

Helper global di `app/Helpers/helper.php` (di-autoload via composer `files`): `routeActive`/`groupActive` (menu aktif), `uploadDokumen`/`uploadSuratTugas` (simpan PDF ber-nama UUID ke disk `public`), `romawi` (bulan → angka Romawi untuk nomor surat), `terbilang` (angka → teks rupiah).

### Alur SPPD (wizard multi-langkah)
`Sppd` adalah induk; tiap SPPD punya satu `SuratTugas`, `UangHarian`, `Akomodasi`, `TotalPergi`, `TotalPulang` (FK `sppd_id`) dan banyak pegawai via pivot `sppd_pegawai`. Pembuatan berjalan berantai lewat redirect `store()`:

`sppd.store` → `surat.index` → `uang.index` → `akomodasi.index` → `pergi.index` → `pulang.index` → kembali ke `sppd.index`

ID SPPD dan `jenis_tugas_id` dioper antar langkah sebagai query string, sebagian di-`Crypt::encrypt` — saat mengubah satu langkah, cek langkah sebelum/sesudahnya agar format parameter (terenkripsi atau tidak) tetap konsisten. Setiap modul juga punya route `{modul}.detail` / `{modul}.detailStore` untuk melihat/menambah data per SPPD. Perhitungan biaya (mis. `total_harian = harian × lama_tugas`) dilakukan di controller berdasarkan `SuratTugas`. Export Excel (maatwebsite/excel) ada di `app/Exports` dengan view di `resources/views/export`.

### Surat Tugas mandiri & integrasi SIMPEG
Terpisah dari wizard SPPD:
- `CreateSuratTugasController` (`surat-tugas.*`) mengambil data pegawai real-time dari API SIMPEG eksternal (`simpeg.pupr-acehbaratkab.com`) dengan Guzzle, memakai bearer token dari tabel `api_token` (`ApiToken` dengan `app_name = 'Sijadin'`, dikelola di menu API Token). Hasil cetak disimpan sebagai snapshot di `riwayat_surat_tugas` (kolom `pegawai` berisi JSON), lalu ditampilkan di `RiwayatSuratTugasController` (Yajra DataTables server-side, respons `ajax()`).
- `POST /api/sync-kepegawaian` (tanpa auth) menerima push data pegawai dari SIMPEG dan meng-upsert tabel `kepegawaian` berdasarkan `id_lama`, menghapus yang tidak ada di payload.

### Model pegawai
`Pegawai` dan `Kepegawaian` sama-sama memetakan tabel `kepegawaian` (`Pegawai` dipakai wizard SPPD, `Kepegawaian` untuk sinkronisasi). Keduanya punya accessor `nama_lengkap` (gelar depan + nama + gelar belakang).

### Otorisasi
spatie/laravel-permission dengan role `admin` dan `user` (Karyawan) — lihat `RoleSeeder`. `routes/web.php` dibagi tiga grup: `auth` saja (dashboard, profil), `auth` + `role:admin` (user, pegawai, jenis tugas, surat tugas mandiri & riwayat, API token, reset password), dan `auth` + `role:admin|user` (seluruh modul SPPD beserta langkah rincian, dokumen ST, dan export). Akun tanpa role akan mendapat 403 di luar grup pertama. Saat menambah route, letakkan di grup yang sesuai dan samakan dengan `@role` di sidebar/dashboard. Pendaftaran mandiri (`/register`) dinonaktifkan; akun dibuat admin. `POST /api/sync-kepegawaian` masih tanpa autentikasi.

## Aturan tambahan

`.claude/rules/` berisi aturan yang dimuat otomatis, jadi isinya tidak diulang di sini: `comment.md` (standar komentar, berlaku global), lalu `blade-architecture.md` (berlaku untuk `resources/views/**`) dan `ui-ux-design.md` (berlaku untuk `resources/views/**`, `public/js/**`, `public/css/**`; perubahan UI wajib dievaluasi dengan lima hukum UX dan mengikuti tema Bootstrap/Sneat yang sudah ada).

## Catatan README
README berisi catatan validasi yang masih terbuka: data `SppdController` perlu disesuaikan, dan method `showDetail` belum punya halaman di beberapa modul.
