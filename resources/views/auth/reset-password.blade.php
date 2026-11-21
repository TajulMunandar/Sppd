<x-guest-layout split title="Atur ulang kata sandi">
    <x-auth-shell title="Buat kata sandi baru" subtitle="Kata sandi baru akan langsung berlaku untuk akun Anda.">
        <form method="POST" action="{{ route('password.store') }}">
            @csrf
            <input type="hidden" name="token" value="{{ $request->route('token') }}">

            <x-auth-input name="email" type="email" label="Email" icon="bi-envelope"
                          :value="old('email', $request->email)" autocomplete="username" required autofocus />

            <x-auth-input name="password" type="password" label="Kata sandi baru" icon="bi-lock"
                          placeholder="Minimal 8 karakter" autocomplete="new-password" required />

            <x-auth-input name="password_confirmation" type="password" label="Ulangi kata sandi baru"
                          icon="bi-shield-check" placeholder="Ketik ulang kata sandi baru"
                          autocomplete="new-password" required />

            <x-auth-submit label="Simpan kata sandi" icon="bi-check2" class="mt-2" />
        </form>

        <x-slot:footer>
            <i class="bi bi-arrow-left" aria-hidden="true"></i>
            <span><a href="{{ route('login') }}" class="auth-link">Kembali ke halaman masuk</a></span>
        </x-slot:footer>
    </x-auth-shell>
</x-guest-layout>
