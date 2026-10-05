@php
    $input = 'w-full border border-gray-300 px-3 py-2.5 text-sm focus:border-[#376A64] focus:outline-none focus:ring-1 focus:ring-[#376A64]';
    $label = 'mb-1.5 block text-xs font-bold uppercase tracking-wide text-gray-600';
    $primary = 'bg-simontini px-4 py-2.5 text-xs font-bold uppercase tracking-wide text-white hover:opacity-90 disabled:opacity-50';
@endphp

<div class="space-y-8">
    <div>
        <h1 class="text-2xl font-bold text-gray-900">Pengaturan akun</h1>
        <p class="mt-1 text-sm text-gray-500">Kelola profil, password, dan login biometrik untuk akun Anda.</p>
    </div>

    {{-- Profil --}}
    <form wire:submit="saveProfile" class="border border-gray-300 bg-white" novalidate>
        <div class="border-b border-gray-300 px-5 py-4">
            <h2 class="text-sm font-bold text-gray-900">Profil</h2>
        </div>
        <div class="grid gap-5 p-5 md:grid-cols-2">
            <div>
                <label for="settings-name" class="{{ $label }}">Nama</label>
                <input id="settings-name" type="text" wire:model="name" autocomplete="name" class="{{ $input }}">
                @error('name') <p class="mt-1 text-xs text-red-600">{{ $message }}</p> @enderror
            </div>
            <div>
                <label for="settings-email" class="{{ $label }}">Email</label>
                <input id="settings-email" type="email" wire:model="email" autocomplete="email" class="{{ $input }}">
                @error('email') <p class="mt-1 text-xs text-red-600">{{ $message }}</p> @enderror
            </div>
        </div>
        <div class="flex justify-end border-t border-gray-300 bg-gray-50 px-5 py-4">
            <button type="submit" wire:loading.attr="disabled" wire:target="saveProfile" class="{{ $primary }}">Simpan profil</button>
        </div>
    </form>

    {{-- Password --}}
    <form wire:submit="savePassword" class="border border-gray-300 bg-white" novalidate>
        <div class="border-b border-gray-300 px-5 py-4">
            <h2 class="text-sm font-bold text-gray-900">Ganti password</h2>
        </div>
        <div class="grid gap-5 p-5 md:grid-cols-3">
            <div>
                <label for="settings-current-password" class="{{ $label }}">Password saat ini</label>
                <input id="settings-current-password" type="password" wire:model="current_password" autocomplete="current-password" class="{{ $input }}">
                @error('current_password') <p class="mt-1 text-xs text-red-600">{{ $message }}</p> @enderror
            </div>
            <div>
                <label for="settings-password" class="{{ $label }}">Password baru</label>
                <input id="settings-password" type="password" wire:model="password" autocomplete="new-password" class="{{ $input }}">
                @error('password') <p class="mt-1 text-xs text-red-600">{{ $message }}</p> @enderror
            </div>
            <div>
                <label for="settings-password-confirmation" class="{{ $label }}">Ulangi password baru</label>
                <input id="settings-password-confirmation" type="password" wire:model="password_confirmation" autocomplete="new-password" class="{{ $input }}">
            </div>
        </div>
        <p class="px-5 pb-4 text-xs text-gray-500">Minimal 8 karakter dengan huruf besar, huruf kecil, angka, dan simbol.</p>
        <div class="flex justify-end border-t border-gray-300 bg-gray-50 px-5 py-4">
            <button type="submit" wire:loading.attr="disabled" wire:target="savePassword" class="{{ $primary }}">Ganti password</button>
        </div>
    </form>

    {{-- Passkey / biometrik --}}
    <section class="border border-gray-300 bg-white">
        <div class="border-b border-gray-300 px-5 py-4">
            <h2 class="text-sm font-bold text-gray-900">Login biometrik (passkey)</h2>
            <p class="mt-1 text-xs text-gray-500">Masuk dengan sidik jari, Face ID, Touch ID, atau Windows Hello tanpa mengetik password. Data biometrik tidak pernah dikirim ke server.</p>
        </div>

        @if ($passkeys->isEmpty())
            <p class="px-5 py-4 text-sm text-gray-500">Belum ada passkey terdaftar.</p>
        @else
            <ul class="divide-y divide-gray-200">
                @foreach ($passkeys as $passkey)
                    <li wire:key="passkey-{{ $passkey->id }}" class="flex items-center justify-between gap-4 px-5 py-3">
                        <div>
                            <p class="text-sm font-semibold text-gray-800">{{ $passkey->name }}</p>
                            <p class="text-xs text-gray-500">
                                {{ $passkey->authenticator ? $passkey->authenticator.' · ' : '' }}Ditambahkan {{ $passkey->created_at->translatedFormat('d M Y') }}
                                · {{ $passkey->last_used_at ? 'Terakhir dipakai '.$passkey->last_used_at->diffForHumans() : 'Belum pernah dipakai' }}
                            </p>
                        </div>
                        <button type="button" wire:click="deletePasskey({{ $passkey->id }})" wire:confirm="Hapus passkey &quot;{{ $passkey->name }}&quot;?" class="text-xs font-semibold text-red-600 hover:underline">Hapus</button>
                    </li>
                @endforeach
            </ul>
        @endif

        <form data-passkey-register wire:ignore class="border-t border-gray-300 bg-gray-50 p-5" novalidate>
            <p data-passkey-unsupported hidden class="mb-3 text-xs text-red-600">Browser ini tidak mendukung passkey.</p>
            <div class="grid gap-5 md:grid-cols-[1fr_1fr_auto] md:items-end">
                <div>
                    <label for="passkey-name" class="{{ $label }}">Nama perangkat</label>
                    <input id="passkey-name" name="name" type="text" required maxlength="255" placeholder="mis. MacBook kantor" class="{{ $input }}">
                </div>
                <div>
                    <label for="passkey-password" class="{{ $label }}">Konfirmasi password</label>
                    <input id="passkey-password" name="password" type="password" required autocomplete="current-password" class="{{ $input }}">
                </div>
                <button type="submit" class="{{ $primary }}">+ Tambah passkey</button>
            </div>
            <p data-passkey-message class="mt-3 text-xs" aria-live="polite"></p>
        </form>
    </section>
</div>
