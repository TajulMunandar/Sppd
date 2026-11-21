<a href="{{ url('/') }}" class="auth-brand__identity" aria-label="{{ config('app.name') }} — halaman awal"
   @if (request()->is('/')) aria-current="page" @endif>
    <span class="auth-brand__logo">
        <img src="{{ asset('images/acehbarat.png') }}" alt="" width="34" height="38">
    </span>
    <span>
        <span class="auth-brand__name">{{ config('app.name') }}</span>
        <span class="auth-brand__org">Dinas PUPR Kabupaten Aceh Barat</span>
    </span>
</a>
