<x-guest-layout split title="Lupa kata sandi">
    <x-auth-shell title="Lupa kata sandi?"
                  subtitle="Masukkan email akun Anda. Kami akan mengirimkan tautan untuk membuat kata sandi baru."
                  :status="session('status')">
        <form method="POST" action="{{ route('password.email') }}">
            @csrf

            <x-auth-input name="email" type="email" label="Email" icon="bi-envelope" :value="old('email')"
                          placeholder="nama@contoh.com" autocomplete="username" required autofocus />

            <x-auth-submit label="Kirim tautan reset" icon="bi-send" class="mt-2" />
        </form>

        <x-slot:footer>
            <i class="bi bi-arrow-left" aria-hidden="true"></i>
            <span>Sudah ingat kata sandi? <a href="{{ route('login') }}" class="auth-link">Kembali ke halaman masuk</a></span>
        </x-slot:footer>
    </x-auth-shell>
</x-guest-layout>
