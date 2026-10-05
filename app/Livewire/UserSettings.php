<?php

namespace App\Livewire;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Livewire\Component;
use Masmerise\Toaster\Toaster;

/**
 * Pengaturan akun milik user yang sedang login: profil, password, dan passkey (biometrik).
 * Pendaftaran passkey berjalan lewat JS (resources/js/passkeys.js) ke CmsPasskeyController.
 */
class UserSettings extends Component
{
    public string $name = '';

    public string $email = '';

    public string $current_password = '';

    public string $password = '';

    public string $password_confirmation = '';

    // Komponen hanya berlaku untuk user aktif yang sedang login (boot berjalan di setiap request Livewire).
    public function boot(): void
    {
        abort_unless($this->user(), 403);
    }

    public function mount(): void
    {
        $user = $this->user();
        $this->name = $user->name;
        $this->email = $user->email;
    }

    private function user(): ?User
    {
        return User::where('id', (int) session('id'))->where('status', 1)->first();
    }

    public function saveProfile(): void
    {
        $user = $this->user();

        $data = $this->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email:rfc', 'max:255', Rule::unique('users', 'email')->ignore($user->id)],
        ], ['email.unique' => 'Email ini sudah dipakai user lain.']);

        $user->update([
            'name' => trim($data['name']),
            'email' => mb_strtolower(trim($data['email'])),
        ]);

        Toaster::success('Profil berhasil diperbarui.');
    }

    public function savePassword(): void
    {
        $this->validate([
            'current_password' => ['required', 'string'],
            'password' => ['required', 'string', 'confirmed', UserManagement::passwordRule()->uncompromised()],
        ], [
            'password.confirmed' => 'Konfirmasi password tidak cocok.',
            'password.uncompromised' => 'Password ini pernah bocor di internet. Gunakan password lain.',
        ]);

        $user = $this->user();

        if (! Hash::check($this->current_password, $user->password)) {
            $this->addError('current_password', 'Password saat ini salah.');

            return;
        }

        // Cast 'hashed' pada model User meng-hash password secara otomatis.
        $user->update(['password' => $this->password]);

        $this->reset(['current_password', 'password', 'password_confirmation']);
        Toaster::success('Password berhasil diganti.');
    }

    public function deletePasskey(int $id): void
    {
        $this->user()->passkeys()->whereKey($id)->delete();

        Toaster::success('Passkey dihapus.');
    }

    public function render()
    {
        return view('livewire.user-settings', [
            'passkeys' => $this->user()->passkeys()->latest()->get(),
        ]);
    }
}
