/*
 * Perilaku bersama halaman autentikasi: toggle kata sandi, peringatan Caps Lock,
 * dan status memproses pada tombol submit.
 */
(function () {
    document.querySelectorAll('[data-password-toggle]').forEach(function (toggle) {
        var input = document.getElementById(toggle.dataset.passwordToggle);
        if (!input) return;

        toggle.addEventListener('click', function () {
            var show = input.type === 'password';
            input.type = show ? 'text' : 'password';
            toggle.setAttribute('aria-pressed', String(show));
            toggle.setAttribute('aria-label', show ? 'Sembunyikan kata sandi' : 'Tampilkan kata sandi');
            toggle.querySelector('i').className = show ? 'bi bi-eye-slash' : 'bi bi-eye';
            input.focus();
        });
    });

    document.querySelectorAll('[data-capslock]').forEach(function (input) {
        var hint = document.getElementById(input.dataset.capslock);
        if (!hint) return;

        ['keydown', 'keyup'].forEach(function (type) {
            input.addEventListener(type, function (event) {
                if (typeof event.getModifierState === 'function') {
                    hint.hidden = !event.getModifierState('CapsLock');
                }
            });
        });
        input.addEventListener('blur', function () {
            hint.hidden = true;
        });
    });

    document.querySelectorAll('.auth-input input').forEach(function (input) {
        input.addEventListener('input', function () {
            input.closest('.auth-input').classList.remove('is-invalid');
        });
    });

    function setLoading(button, loading) {
        button.disabled = loading;
        button.setAttribute('aria-busy', String(loading));
        button.querySelector('.spinner-border').hidden = !loading;
        var icon = button.querySelector('[data-auth-submit-icon]');
        if (icon) icon.hidden = loading;
        button.querySelector('.auth-submit__label').textContent = loading ? 'Memproses…' : button.dataset.label;
    }

    // Event submit hanya terpicu setelah validasi native (required/email) lolos.
    document.querySelectorAll('form').forEach(function (form) {
        var button = form.querySelector('[data-auth-submit]');
        if (!button) return;
        form.addEventListener('submit', function () {
            setLoading(button, true);
        });
    });

    // Halaman yang dipulihkan dari bfcache (tombol Back) tidak boleh tertahan dalam status memproses.
    window.addEventListener('pageshow', function () {
        document.querySelectorAll('[data-auth-submit]').forEach(function (button) {
            setLoading(button, false);
        });
    });
})();
