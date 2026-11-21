@props([
    'name',
    'label',
    'icon',
    'type' => 'text',
    'id' => null,
    'value' => null,
])

@php
    $id = $id ?? $name;
    $isPassword = $type === 'password';
    $error = $errors->first($name);
    $describedBy = trim(($isPassword ? "{$id}-capslock " : '') . ($error ? "{$id}-error" : ''));
@endphp

<div class="auth-field">
    <label for="{{ $id }}" class="auth-label">{{ $label }}</label>
    <div @class(['auth-input', 'is-invalid' => $error])>
        <i class="bi {{ $icon }}" aria-hidden="true"></i>
        <input type="{{ $type }}" name="{{ $name }}" id="{{ $id }}"
               @unless ($isPassword) value="{{ $value }}" @endunless
               @if ($describedBy) aria-describedby="{{ $describedBy }}" @endif
               @if ($error) aria-invalid="true" @endif
               @if ($isPassword) data-capslock="{{ $id }}-capslock" @endif
               {{ $attributes }}>
        @if ($isPassword)
            <button type="button" class="auth-input__toggle" data-password-toggle="{{ $id }}"
                    aria-label="Tampilkan kata sandi" aria-controls="{{ $id }}" aria-pressed="false">
                <i class="bi bi-eye" aria-hidden="true"></i>
            </button>
        @endif
    </div>
    @if ($isPassword)
        <p class="auth-hint" id="{{ $id }}-capslock" hidden>
            <i class="bi bi-capslock-fill" aria-hidden="true"></i>Caps Lock aktif
        </p>
    @endif
    @if ($error)
        <p class="auth-error" id="{{ $id }}-error">
            <i class="bi bi-exclamation-circle" aria-hidden="true"></i>{{ $error }}
        </p>
    @endif
</div>
