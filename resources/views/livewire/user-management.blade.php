<div>
    <div class="mb-7 flex flex-col justify-between gap-5 sm:flex-row sm:items-end">
        <div>
            <h1 class="text-2xl font-bold text-gray-900">User CMS</h1>
            <p class="mt-1 text-sm text-gray-500">Kelola akun yang bisa masuk ke CMS Simontini.</p>
        </div>
        @unless ($formOpen)
            <button type="button" wire:click="create" class="bg-simontini px-4 py-2.5 text-xs font-bold uppercase tracking-wide text-white hover:opacity-90">+ Tambah user</button>
        @endunless
    </div>

    @if (session('success'))
        <div class="mb-6 border-l-4 border-green-600 bg-green-50 px-4 py-3 text-sm font-semibold text-green-800">{{ session('success') }}</div>
    @endif

    @if ($formOpen)
        <form wire:submit="save" class="mb-8 border border-gray-300 bg-white" novalidate>
            <div class="border-b border-gray-300 px-5 py-4">
                <h2 class="text-sm font-bold text-gray-900">{{ $editingId ? 'Edit user' : 'Tambah user' }}</h2>
            </div>

            <div class="grid gap-5 p-5 md:grid-cols-2">
                <div>
                    <label for="user-name" class="mb-1.5 block text-xs font-bold uppercase tracking-wide text-gray-600">Nama</label>
                    <input id="user-name" type="text" wire:model.blur="name" autocomplete="name" class="w-full border border-gray-300 px-3 py-2.5 text-sm focus:border-[#376A64] focus:outline-none focus:ring-1 focus:ring-[#376A64]">
                    @error('name') <p class="mt-1 text-xs text-red-600">{{ $message }}</p> @enderror
                </div>

                <div>
                    <label for="user-email" class="mb-1.5 block text-xs font-bold uppercase tracking-wide text-gray-600">Email</label>
                    <input id="user-email" type="email" wire:model.blur="email" autocomplete="email" class="w-full border border-gray-300 px-3 py-2.5 text-sm focus:border-[#376A64] focus:outline-none focus:ring-1 focus:ring-[#376A64]">
                    @error('email') <p class="mt-1 text-xs text-red-600">{{ $message }}</p> @enderror
                </div>

                <div>
                    <label for="user-role" class="mb-1.5 block text-xs font-bold uppercase tracking-wide text-gray-600">Role</label>
                    <select id="user-role" wire:model.live="roleId" class="w-full border border-gray-300 px-3 py-2.5 text-sm capitalize focus:border-[#376A64] focus:outline-none focus:ring-1 focus:ring-[#376A64]">
                        @foreach ($roles as $id => $label)
                            <option value="{{ $id }}">{{ $label }}</option>
                        @endforeach
                    </select>
                    @error('roleId') <p class="mt-1 text-xs text-red-600">{{ $message }}</p> @enderror
                </div>

                <div class="flex items-end">
                    <label class="flex items-center gap-2 text-sm text-gray-700">
                        <input type="checkbox" wire:model.live="active" class="h-4 w-4 accent-[#376A64]">
                        Akun aktif (bisa login)
                    </label>
                </div>
            </div>

            <div class="border-t border-gray-200 p-5"
                 x-data="{
                     show: false,
                     get pw() { return $wire.password ?? '' },
                     get checks() {
                         const pw = this.pw;
                         return [
                             ['Minimal 8 karakter', pw.length >= 8],
                             ['Huruf kecil (a-z)', /\p{Ll}/u.test(pw)],
                             ['Huruf besar (A-Z)', /\p{Lu}/u.test(pw)],
                             ['Angka (0-9)', /\p{N}/u.test(pw)],
                             ['Simbol (!@#$…)', /[\p{Z}\p{S}\p{P}]/u.test(pw)],
                         ];
                     },
                     get score() { return this.checks.filter(c => c[1]).length },
                     get matches() { return this.pw !== '' && this.pw === ($wire.password_confirmation ?? '') },
                 }">
                <p class="mb-4 text-xs text-gray-500">
                    {{ $editingId ? 'Kosongkan jika password tidak diubah.' : 'Password wajib diisi untuk user baru.' }}
                    Password juga dicek terhadap database kebocoran saat disimpan.
                </p>

                <div class="grid gap-5 md:grid-cols-2">
                    <div>
                        <label for="user-password" class="mb-1.5 block text-xs font-bold uppercase tracking-wide text-gray-600">Password {{ $editingId ? 'baru' : '' }}</label>
                        <div class="relative">
                            <input id="user-password" :type="show ? 'text' : 'password'" wire:model="password" autocomplete="new-password" class="w-full border border-gray-300 py-2.5 pl-3 pr-16 text-sm focus:border-[#376A64] focus:outline-none focus:ring-1 focus:ring-[#376A64]">
                            <button type="button" @click="show = !show" class="absolute inset-y-0 right-0 px-3 text-xs font-semibold text-gray-500 hover:text-gray-900" x-text="show ? 'Sembunyi' : 'Lihat'" :aria-pressed="show"></button>
                        </div>
                        @error('password') <p class="mt-1 text-xs text-red-600">{{ $message }}</p> @enderror

                        <div class="mt-3 flex gap-1" aria-hidden="true" x-show="pw !== ''">
                            <template x-for="i in 5">
                                <span class="h-1 flex-1 transition-colors"
                                      :class="i <= score ? (score === 5 ? 'bg-green-600' : score >= 3 ? 'bg-amber-500' : 'bg-red-500') : 'bg-gray-200'"></span>
                            </template>
                        </div>
                    </div>

                    <div>
                        <label for="user-password-confirmation" class="mb-1.5 block text-xs font-bold uppercase tracking-wide text-gray-600">Ulangi password</label>
                        <input id="user-password-confirmation" :type="show ? 'text' : 'password'" wire:model="password_confirmation" autocomplete="new-password" class="w-full border border-gray-300 px-3 py-2.5 text-sm focus:border-[#376A64] focus:outline-none focus:ring-1 focus:ring-[#376A64]">
                    </div>
                </div>

                <ul class="mt-4 grid gap-1.5 text-xs sm:grid-cols-3" x-show="pw !== ''" aria-live="polite">
                    <template x-for="[label, ok] in checks" :key="label">
                        <li class="flex items-center gap-1.5" :class="ok ? 'text-green-700' : 'text-gray-500'">
                            <span x-text="ok ? '✓' : '○'" class="w-3"></span><span x-text="label"></span>
                        </li>
                    </template>
                    <li class="flex items-center gap-1.5" :class="matches ? 'text-green-700' : 'text-gray-500'">
                        <span x-text="matches ? '✓' : '○'" class="w-3"></span><span>Konfirmasi cocok</span>
                    </li>
                </ul>
            </div>

            <div class="flex justify-end gap-2 border-t border-gray-300 bg-gray-50 px-5 py-4">
                <button type="button" wire:click="cancel" class="border border-gray-300 bg-white px-4 py-2.5 text-xs font-bold uppercase tracking-wide text-gray-700 hover:border-gray-400">Batal</button>
                <button type="submit" wire:loading.attr="disabled" wire:target="save" class="bg-simontini px-4 py-2.5 text-xs font-bold uppercase tracking-wide text-white hover:opacity-90 disabled:opacity-50">
                    <span wire:loading.remove wire:target="save">Simpan</span>
                    <span wire:loading wire:target="save">Menyimpan…</span>
                </button>
            </div>
        </form>
    @endif

    <div class="overflow-x-auto border border-gray-300 bg-white">
        <table class="w-full min-w-[640px] text-left text-sm">
            <thead class="border-b border-gray-300 bg-gray-50 text-[11px] font-bold uppercase tracking-wide text-gray-500">
                <tr>
                    <th class="px-5 py-3">Nama</th>
                    <th class="px-5 py-3">Email</th>
                    <th class="px-5 py-3">Role</th>
                    <th class="px-5 py-3">Status</th>
                    <th class="px-5 py-3"><span class="sr-only">Aksi</span></th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-200">
                @foreach ($users as $user)
                    <tr wire:key="user-{{ $user->id }}" class="{{ $editingId === $user->id ? 'bg-gray-50' : '' }}">
                        <td class="px-5 py-3 font-semibold text-gray-800">
                            {{ $user->name }}
                            @if ($user->id === (int) session('id'))
                                <span class="ml-1 text-[10px] font-bold uppercase text-simontini">Anda</span>
                            @endif
                        </td>
                        <td class="px-5 py-3 text-gray-600">{{ $user->email }}</td>
                        <td class="px-5 py-3 capitalize text-gray-600">{{ $roles[$user->role_id] ?? 'role '.$user->role_id }}</td>
                        <td class="px-5 py-3">
                            <span class="px-2 py-1 text-[10px] font-bold uppercase {{ (int) $user->status === 1 ? 'bg-green-50 text-green-700' : 'bg-gray-100 text-gray-500' }}">
                                {{ (int) $user->status === 1 ? 'Aktif' : 'Nonaktif' }}
                            </span>
                        </td>
                        <td class="px-5 py-3 text-right">
                            <button type="button" wire:click="edit({{ $user->id }})" class="text-xs font-semibold text-simontini hover:underline">Edit</button>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
