<x-guest-layout split title="Konfirmasi kata sandi">
    <x-auth-shell title="Konfirmasi kata sandi"
                  subtitle="Area ini bersifat sensitif. Masukkan kata sandi Anda untuk melanjutkan.">
        <form method="POST" action="{{ route('password.confirm') }}">
            @csrf

            <x-auth-input name="password" type="password" label="Kata sandi" icon="bi-lock"
                          placeholder="Masukkan kata sandi" autocomplete="current-password" required autofocus />

            <x-auth-submit label="Konfirmasi" icon="bi-shield-check" class="mt-2" />
        </form>
    </x-auth-shell>
</x-guest-layout>
