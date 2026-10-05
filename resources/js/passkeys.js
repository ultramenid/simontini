// Passkey (WebAuthn) untuk login biometrik CMS dan pendaftaran passkey di halaman Pengaturan.
// Server: App\Http\Controllers\CmsPasskeyController.

const toBuffer = (value) => {
    const base64 = value.replace(/-/g, '+').replace(/_/g, '/');
    const padded = base64.padEnd(Math.ceil(base64.length / 4) * 4, '=');
    return Uint8Array.from(atob(padded), (c) => c.charCodeAt(0)).buffer;
};

const toBase64Url = (buffer) => btoa(String.fromCharCode(...new Uint8Array(buffer)))
    .replace(/\+/g, '-').replace(/\//g, '_').replace(/=+$/, '');

const withIds = (list = []) => list.map((item) => ({ ...item, id: toBuffer(item.id) }));

const serializeCredential = (credential) => {
    const { response } = credential;
    const json = { clientDataJSON: toBase64Url(response.clientDataJSON) };

    if (response.attestationObject) {
        json.attestationObject = toBase64Url(response.attestationObject);
        json.transports = response.getTransports?.() ?? [];
    } else {
        json.authenticatorData = toBase64Url(response.authenticatorData);
        json.signature = toBase64Url(response.signature);
        if (response.userHandle) json.userHandle = toBase64Url(response.userHandle);
    }

    return { id: credential.id, rawId: toBase64Url(credential.rawId), type: credential.type, response: json };
};

const request = async (method, url, body) => {
    const response = await fetch(url, {
        method,
        credentials: 'same-origin',
        headers: {
            Accept: 'application/json',
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.content ?? '',
        },
        body: body ? JSON.stringify(body) : undefined,
    });
    const data = await response.json().catch(() => ({}));

    if (!response.ok) {
        const firstError = Object.values(data.errors ?? {})[0]?.[0];
        if (response.status === 429) throw new Error('Terlalu banyak percobaan. Tunggu sebentar lalu coba lagi.');
        throw new Error(firstError ?? data.message ?? 'Terjadi kesalahan. Coba lagi.');
    }

    return data;
};

const describeError = (error) => {
    if (error.name === 'NotAllowedError') return 'Dibatalkan atau waktu habis.';
    if (error.name === 'InvalidStateError') return 'Passkey untuk perangkat ini sudah terdaftar.';
    if (error.name === 'SecurityError') return 'Passkey membutuhkan HTTPS atau localhost (bukan alamat IP).';
    return error.message;
};

const supported = () => typeof window.PublicKeyCredential === 'function';

async function loginWithPasskey(button) {
    const message = button.parentElement.querySelector('[data-passkey-message]');
    message.textContent = '';
    button.disabled = true;

    try {
        const { options } = await request('GET', '/cms/passkeys/login/options');
        const credential = await navigator.credentials.get({
            publicKey: { ...options, challenge: toBuffer(options.challenge), allowCredentials: withIds(options.allowCredentials) },
        });
        const { redirect } = await request('POST', '/cms/passkeys/login', { credential: serializeCredential(credential) });
        window.location.href = redirect;
    } catch (error) {
        message.textContent = describeError(error);
        button.disabled = false;
    }
}

async function registerPasskey(form) {
    const message = form.querySelector('[data-passkey-message]');
    const button = form.querySelector('[type="submit"]');
    const name = form.elements.name.value.trim();
    const password = form.elements.password.value;

    const show = (text, ok = false) => {
        message.textContent = text;
        message.className = `mt-3 text-xs ${ok ? 'text-green-700' : 'text-red-600'}`;
    };

    if (!name || !password) return show('Isi nama perangkat dan password.');

    button.disabled = true;
    show('');

    try {
        const { options } = await request('POST', '/cms/settings/passkeys/options', { password });
        const credential = await navigator.credentials.create({
            publicKey: {
                ...options,
                challenge: toBuffer(options.challenge),
                user: { ...options.user, id: toBuffer(options.user.id) },
                excludeCredentials: withIds(options.excludeCredentials),
            },
        });
        await request('POST', '/cms/settings/passkeys', { name, credential: serializeCredential(credential) });

        form.reset();
        show('Passkey berhasil ditambahkan.', true);
        const component = form.closest('[wire\\:id]');
        if (component) window.Livewire?.find(component.getAttribute('wire:id'))?.$refresh();
    } catch (error) {
        show(describeError(error));
    } finally {
        button.disabled = false;
    }
}

document.addEventListener('click', (event) => {
    const button = event.target.closest('[data-passkey-login]');
    if (button) loginWithPasskey(button);
});

document.addEventListener('submit', (event) => {
    const form = event.target.closest('[data-passkey-register]');
    if (!form) return;
    event.preventDefault();
    registerPasskey(form);
});

const revealPasskeyUi = () => {
    if (supported()) {
        document.querySelectorAll('[data-passkey-login-wrap]').forEach((el) => { el.hidden = false; });
    } else {
        document.querySelectorAll('[data-passkey-unsupported]').forEach((el) => { el.hidden = false; });
    }
};

if (document.readyState === 'loading') {
    document.addEventListener('DOMContentLoaded', revealPasskeyUi);
} else {
    revealPasskeyUi();
}
document.addEventListener('livewire:navigated', revealPasskeyUi);
