@props([
    'label',
    'icon' => 'bi-arrow-right',
])

<button type="submit" {{ $attributes->class('auth-submit') }} data-auth-submit data-label="{{ $label }}">
    <span class="spinner-border spinner-border-sm" aria-hidden="true" hidden></span>
    <span class="auth-submit__label">{{ $label }}</span>
    <i class="bi {{ $icon }}" data-auth-submit-icon aria-hidden="true"></i>
</button>
