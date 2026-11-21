<x-guest-layout split>
    @push('css')
        <link rel="stylesheet" href="{{ asset('css/auth.css') }}">
    @endpush

    <main class="auth">
        <aside class="auth-brand" aria-label="Tentang aplikasi">
            <div class="auth-brand__inner">
                @include('layouts.partials.auth-identity')

                <div class="auth-brand__body">
                    <p class="auth-brand__eyebrow">Sistem Informasi Layanan SPPD</p>
                    <h1 class="auth-brand__title">Perjalanan dinas tercatat rapi, dari surat tugas hingga laporan biaya.</h1>

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
                    <h2 class="auth-panel__title">Masuk ke akun Anda</h2>
                    <p class="auth-panel__subtitle">Gunakan email dan kata sandi yang terdaftar.</p>
                </header>

                @if (session()->has('success'))
                    <div class="auth-alert auth-alert--success" role="status">
                        <i class="bi bi-check-circle-fill" aria-hidden="true"></i>
                        <span>{{ session('success') }}</span>
                    </div>
                @elseif (session()->has('failed'))
                    <div class="auth-alert auth-alert--danger" role="alert">
                        <i class="bi bi-exclamation-octagon-fill" aria-hidden="true"></i>
                        <span>{{ session('failed') }}</span>
                    </div>
                @endif

                <form action="{{ route('login') }}" method="post" id="login-form">
                    @csrf

                    <div class="auth-field">
                        <label for="email" class="auth-label">Email</label>
                        <div class="auth-input @error('email') is-invalid @enderror">
                            <i class="bi bi-envelope" aria-hidden="true"></i>
                            <input type="email" name="email" id="email" value="{{ old('email') }}"
                                   placeholder="nama@contoh.com" autocomplete="username" required autofocus
                                   @error('email') aria-invalid="true" aria-describedby="email-error" @enderror>
                        </div>
                        @error('email')
                            <p class="auth-error" id="email-error">
                                <i class="bi bi-exclamation-circle" aria-hidden="true"></i>{{ $message }}
                            </p>
                        @enderror
                    </div>

                    <div class="auth-field">
                        <label for="password" class="auth-label">Kata sandi</label>
                        <div class="auth-input @error('password') is-invalid @enderror">
                            <i class="bi bi-lock" aria-hidden="true"></i>
                            <input type="password" name="password" id="password" placeholder="Masukkan kata sandi"
                                   autocomplete="current-password" required
                                   aria-describedby="capslock-hint @error('password') password-error @enderror"
                                   @error('password') aria-invalid="true" @enderror>
                            <button type="button" class="auth-input__toggle" id="toggle-password"
                                    aria-label="Tampilkan kata sandi" aria-controls="password" aria-pressed="false">
                                <i class="bi bi-eye" aria-hidden="true"></i>
                            </button>
                        </div>
                        <p class="auth-hint" id="capslock-hint" hidden>
                            <i class="bi bi-capslock-fill" aria-hidden="true"></i>Caps Lock aktif
                        </p>
                        @error('password')
                            <p class="auth-error" id="password-error">
                                <i class="bi bi-exclamation-circle" aria-hidden="true"></i>{{ $message }}
                            </p>
                        @enderror
                    </div>

                    <div class="auth-options">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="remember" id="remember"
                                   @checked(old('remember'))>
                            <label class="form-check-label" for="remember">Ingat saya</label>
                        </div>
                    </div>

                    <button type="submit" class="auth-submit" id="login-submit">
                        <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true" hidden></span>
                        <span class="auth-submit__label">Masuk</span>
                        <i class="bi bi-arrow-right" aria-hidden="true"></i>
                    </button>
                </form>

                <p class="auth-help">
                    <i class="bi bi-info-circle" aria-hidden="true"></i>
                    Lupa kata sandi? Hubungi administrator untuk mengatur ulang kata sandi Anda.
                </p>
            </div>
        </section>
    </main>

    @push('script')
        <script>
            (function () {
                const password = document.getElementById('password');
                const toggle = document.getElementById('toggle-password');
                const capsHint = document.getElementById('capslock-hint');
                const form = document.getElementById('login-form');
                const submit = document.getElementById('login-submit');

                toggle.addEventListener('click', function () {
                    const show = password.type === 'password';
                    password.type = show ? 'text' : 'password';
                    toggle.setAttribute('aria-pressed', String(show));
                    toggle.setAttribute('aria-label', show ? 'Sembunyikan kata sandi' : 'Tampilkan kata sandi');
                    toggle.querySelector('i').className = show ? 'bi bi-eye-slash' : 'bi bi-eye';
                    password.focus();
                });

                ['keydown', 'keyup'].forEach(function (type) {
                    password.addEventListener(type, function (event) {
                        if (typeof event.getModifierState === 'function') {
                            capsHint.hidden = !event.getModifierState('CapsLock');
                        }
                    });
                });
                password.addEventListener('blur', function () {
                    capsHint.hidden = true;
                });

                function setLoading(loading) {
                    submit.disabled = loading;
                    submit.setAttribute('aria-busy', String(loading));
                    submit.querySelector('.spinner-border').hidden = !loading;
                    submit.querySelector('.bi-arrow-right').hidden = loading;
                    submit.querySelector('.auth-submit__label').textContent = loading ? 'Memproses…' : 'Masuk';
                }

                // Event submit hanya terpicu setelah validasi native (required/email) lolos.
                form.addEventListener('submit', function () {
                    setLoading(true);
                });

                document.querySelectorAll('.auth-input input').forEach(function (input) {
                    input.addEventListener('input', function () {
                        input.closest('.auth-input').classList.remove('is-invalid');
                    });
                });

                // Halaman yang dipulihkan dari bfcache (tombol Back) tidak boleh tertahan dalam status memproses.
                window.addEventListener('pageshow', function () {
                    setLoading(false);
                });
            })();
        </script>
    @endpush
</x-guest-layout>
