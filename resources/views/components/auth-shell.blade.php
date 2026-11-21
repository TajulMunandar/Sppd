@props([
    'title',
    'subtitle' => null,
    'status' => null,
])

<main class="auth">
    <aside class="auth-brand" aria-label="Tentang aplikasi">
        <div class="auth-brand__inner">
            @include('layouts.partials.auth-identity')

            <div class="auth-brand__body">
                <p class="auth-brand__eyebrow">Sistem Informasi Layanan SPPD</p>
                <p class="auth-brand__title">Perjalanan dinas tercatat rapi, dari surat tugas hingga laporan biaya.</p>

                @include('layouts.partials.auth-features')
            </div>

            <p class="auth-brand__footer">&copy; {{ date('Y') }} Pemerintah Kabupaten Aceh Barat</p>
        </div>
    </aside>

    <section class="auth-panel">
        <div class="auth-panel__inner">
            <a href="{{ url('/') }}" class="auth-mobile-brand" aria-label="{{ config('app.name') }} — halaman awal">
                <img src="{{ asset('images/acehbarat.png') }}" alt="" width="30" height="34">
                <span>
                    <span class="auth-mobile-brand__name">{{ config('app.name') }}</span>
                    <span class="auth-mobile-brand__org">Dinas PUPR Kabupaten Aceh Barat</span>
                </span>
            </a>

            <header class="auth-panel__header">
                <h1 class="auth-panel__title">{{ $title }}</h1>
                @if ($subtitle)
                    <p class="auth-panel__subtitle">{{ $subtitle }}</p>
                @endif
            </header>

            @if ($status || session()->has('success'))
                <div class="auth-alert auth-alert--success" role="status">
                    <i class="bi bi-check-circle-fill" aria-hidden="true"></i>
                    <span>{{ $status ?: session('success') }}</span>
                </div>
            @elseif (session()->has('failed'))
                <div class="auth-alert auth-alert--danger" role="alert">
                    <i class="bi bi-exclamation-octagon-fill" aria-hidden="true"></i>
                    <span>{{ session('failed') }}</span>
                </div>
            @endif

            {{ $slot }}

            @isset($footer)
                <div class="auth-help">
                    {{ $footer }}
                </div>
            @endisset
        </div>
    </section>
</main>

@push('script')
    <script src="{{ asset('js/auth.js') }}"></script>
@endpush
