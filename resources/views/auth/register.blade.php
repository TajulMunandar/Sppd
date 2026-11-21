<x-guest-layout split title="Daftar">
    <x-auth-shell title="Buat akun baru" subtitle="Lengkapi data berikut untuk mendaftar.">
        <form method="POST" action="{{ route('register') }}">
            @csrf

            <x-auth-input name="name" label="Nama lengkap" icon="bi-person" :value="old('name')"
                          placeholder="Nama sesuai data kepegawaian" autocomplete="name" required autofocus />

            <x-auth-input name="email" type="email" label="Email" icon="bi-envelope" :value="old('email')"
                          placeholder="nama@contoh.com" autocomplete="username" required />

            <x-auth-input name="password" type="password" label="Kata sandi" icon="bi-lock"
                          placeholder="Minimal 8 karakter" autocomplete="new-password" required />

            <x-auth-input name="password_confirmation" type="password" label="Ulangi kata sandi"
                          icon="bi-shield-check" placeholder="Ketik ulang kata sandi"
                          autocomplete="new-password" required />

            <x-auth-submit label="Daftar" class="mt-2" />
        </form>

        <x-slot:footer>
            <i class="bi bi-box-arrow-in-right" aria-hidden="true"></i>
            <span>Sudah punya akun? <a href="{{ route('login') }}" class="auth-link">Masuk</a></span>
        </x-slot:footer>
    </x-auth-shell>
</x-guest-layout>
