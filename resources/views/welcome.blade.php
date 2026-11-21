<x-guest-layout split>
    <main class="welcome">
        <div class="welcome__inner">
            <header class="welcome__top">
                @include('layouts.partials.auth-identity')
            </header>

            <section class="welcome__hero" aria-labelledby="welcome-title">
                <p class="auth-brand__eyebrow">Sistem Informasi Layanan SPPD</p>
                <h1 class="welcome__title" id="welcome-title">
                    Perjalanan dinas tercatat rapi, dari surat tugas hingga laporan biaya.
                </h1>
                <p class="welcome__lead">
                    Layanan pengelolaan Surat Perintah Perjalanan Dinas di lingkungan
                    Dinas PUPR Kabupaten Aceh Barat.
                </p>

                <div class="welcome__actions">
                    <a href="{{ route('login') }}" class="welcome__cta">
                        Masuk ke {{ config('app.name') }}
                        <i class="bi bi-arrow-right" aria-hidden="true"></i>
                    </a>
                    <p class="welcome__note">
                        <i class="bi bi-shield-lock" aria-hidden="true"></i>
                        Khusus pegawai dengan akun terdaftar.
                    </p>
                </div>
            </section>

            <section class="welcome__features" aria-label="Fitur utama">
                @include('layouts.partials.auth-features')
            </section>

            <footer class="auth-brand__footer">&copy; {{ date('Y') }} Pemerintah Kabupaten Aceh Barat</footer>
        </div>
    </main>
</x-guest-layout>
