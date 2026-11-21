<?php

use App\Models\ApiToken;
use App\Models\User;
use Spatie\Permission\Models\Role;

beforeEach(function () {
    Role::create(['name' => 'admin', 'guard_name' => 'web']);
    Role::create(['name' => 'user', 'guard_name' => 'web']);

    // Halaman surat tugas membutuhkan token SIMPEG; tanpa baris ini view gagal render.
    ApiToken::create(['app_name' => 'Sijadin', 'token' => 'test-token']);
});

function userWithRole(?string $role = null): User
{
    $user = User::factory()->create();

    if ($role) {
        $user->assignRole($role);
    }

    return $user;
}

dataset('admin only routes', ['/user', '/pegawai', '/jenis', '/surat-tugas', '/surat-tugas/riwayat', '/api-token']);

test('guests are redirected to login from protected routes', function (string $uri) {
    $this->get($uri)->assertRedirect('/login');
})->with('admin only routes')->with([['/sppd'], ['/export-sppd/1'], ['/dashboard']]);

test('admin can access admin only routes', function (string $uri) {
    $this->actingAs(userWithRole('admin'))->get($uri)->assertOk();
})->with('admin only routes');

test('karyawan cannot access admin only routes', function (string $uri) {
    $this->actingAs(userWithRole('user'))->get($uri)->assertForbidden();
})->with('admin only routes');

test('admin and karyawan can access sppd', function (string $role) {
    $this->actingAs(userWithRole($role))->get('/sppd')->assertOk();
})->with(['admin', 'user']);

test('users without a role cannot access sppd', function () {
    $this->actingAs(userWithRole())->get('/sppd')->assertForbidden();
});

test('any authenticated user can open the dashboard', function (?string $role) {
    $this->actingAs(userWithRole($role))->get('/dashboard')->assertOk();
})->with(['admin', 'user', null]);
