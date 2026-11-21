<x-guest-layout split title="Masuk">
    {{-- `status` dikirim setelah reset kata sandi berhasil. --}}
    <x-auth-shell title="Masuk ke akun Anda" subtitle="Gunakan email dan kata sandi yang terdaftar."
                  :status="session('status')">
        <form action="{{ route('login') }}" method="post">
            @csrf

            <x-auth-input name="email" type="email" label="Email" icon="bi-envelope" :value="old('email')"
                          placeholder="nama@contoh.com" autocomplete="username" required autofocus />

            <x-auth-input name="password" type="password" label="Kata sandi" icon="bi-lock"
                          placeholder="Masukkan kata sandi" autocomplete="current-password" required />

            <div class="auth-options">
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="remember" id="remember"
                           @checked(old('remember'))>
                    <label class="form-check-label" for="remember">Ingat saya</label>
                </div>
            </div>

            <x-auth-submit label="Masuk" />
        </form>

        <x-slot:footer>
            <i class="bi bi-info-circle" aria-hidden="true"></i>
            <span>Lupa kata sandi? Hubungi administrator untuk mengatur ulang kata sandi Anda.</span>
        </x-slot:footer>
    </x-auth-shell>
</x-guest-layout>
