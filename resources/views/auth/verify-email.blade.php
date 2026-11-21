<x-guest-layout split title="Verifikasi email">
    {{-- Status 'verification-link-sent' berupa kode, bukan pesan, sehingga diterjemahkan di sini. --}}
    <x-auth-shell title="Verifikasi email Anda"
                  subtitle="Klik tautan verifikasi yang telah kami kirim ke email Anda sebelum mulai menggunakan aplikasi."
                  :status="session('status') == 'verification-link-sent'
                      ? 'Tautan verifikasi baru telah dikirim ke email yang Anda daftarkan.'
                      : null">
        <form method="POST" action="{{ route('verification.send') }}">
            @csrf
            <x-auth-submit label="Kirim ulang email verifikasi" icon="bi-send" />
        </form>

        <x-slot:footer>
            <i class="bi bi-box-arrow-left" aria-hidden="true"></i>
            <form method="POST" action="{{ route('logout') }}" class="d-inline">
                @csrf
                <span>Bukan akun Anda? <button type="submit" class="auth-link">Keluar</button></span>
            </form>
        </x-slot:footer>
    </x-auth-shell>
</x-guest-layout>
