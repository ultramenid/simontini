<?php

namespace App\Livewire;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Password;
use Livewire\Component;

class UserManagement extends Component
{
    public ?int $editingId = null;

    public bool $formOpen = false;

    public string $name = '';

    public string $email = '';

    public int $roleId = 0;

    public bool $active = true;

    public string $password = '';

    public string $password_confirmation = '';

    // Pertahanan berlapis: selain middleware rute/persistent, komponen ini hanya
    // boleh berjalan untuk admin aktif (boot berjalan di setiap request Livewire).
    public function boot(): void
    {
        $isActiveAdmin = DB::table('users')
            ->where('id', (int) session('id'))
            ->where('status', 1)
            ->where('role_id', (int) config('cms.role_ids.admin'))
            ->exists();

        abort_unless($isActiveAdmin, 403);
    }

    public function mount(): void
    {
        $this->roleId = (int) config('cms.role_ids.admin');
    }

    public static function passwordRule(): Password
    {
        return Password::min(12)->max(128)->letters()->mixedCase()->numbers()->symbols();
    }

    protected function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email:rfc', 'max:255', Rule::unique('users', 'email')->ignore($this->editingId)],
            'roleId' => ['required', 'integer', Rule::in(array_values(config('cms.role_ids')))],
            'active' => ['boolean'],
            // Password wajib saat membuat user; saat edit kosong berarti tidak diubah.
            'password' => [$this->editingId ? 'nullable' : 'required', 'string', 'confirmed', self::passwordRule()],
        ];
    }

    protected function messages(): array
    {
        return [
            'email.unique' => 'Email ini sudah dipakai user lain.',
            'password.confirmed' => 'Konfirmasi password tidak cocok.',
            'password.uncompromised' => 'Password ini pernah bocor di internet. Gunakan password lain.',
        ];
    }

    public function updated(string $property): void
    {
        // Password dicek langsung di browser (checklist Alpine); server memvalidasi ulang saat simpan.
        if (! in_array($property, ['password', 'password_confirmation'], true)) {
            $this->validateOnly($property);
        }
    }

    public function create(): void
    {
        $this->resetForm();
        $this->formOpen = true;
    }

    public function edit(int $id): void
    {
        $user = DB::table('users')->select(['id', 'name', 'email', 'role_id', 'status'])->find($id);

        if ($user === null) {
            return;
        }

        $this->resetForm();
        $this->editingId = $user->id;
        $this->name = $user->name;
        $this->email = $user->email;
        $this->roleId = (int) $user->role_id;
        $this->active = (int) $user->status === 1;
        $this->formOpen = true;
    }

    public function cancel(): void
    {
        $this->resetForm();
    }

    public function save(): void
    {
        $rules = $this->rules();
        // Cek kebocoran (Have I Been Pwned) hanya saat simpan, bukan tiap ketikan.
        $rules['password'][] = self::passwordRule()->uncompromised();
        $data = $this->validate($rules);

        $isSelf = $this->editingId === (int) session('id');
        $adminRoleId = (int) config('cms.role_ids.admin');

        if ($isSelf && ($data['roleId'] !== $adminRoleId || ! $data['active'])) {
            $this->addError('roleId', 'Anda tidak bisa menurunkan role atau menonaktifkan akun sendiri.');

            return;
        }

        $values = [
            'name' => trim($data['name']),
            'email' => mb_strtolower(trim($data['email'])),
            'role_id' => $data['roleId'],
            'status' => $data['active'] ? 1 : 0,
            'updated_at' => now(),
        ];

        if ($data['password'] !== null && $data['password'] !== '') {
            $values['password'] = Hash::make($data['password']);
        }

        if ($this->editingId) {
            DB::table('users')->where('id', $this->editingId)->update($values);
            session()->flash('success', 'User berhasil diperbarui.');
        } else {
            DB::table('users')->insert($values + ['created_at' => now()]);
            session()->flash('success', 'User berhasil ditambahkan.');
        }

        $this->resetForm();
    }

    private function resetForm(): void
    {
        $this->reset(['editingId', 'formOpen', 'name', 'email', 'active', 'password', 'password_confirmation']);
        $this->roleId = (int) config('cms.role_ids.admin');
        $this->resetValidation();
    }

    public function render()
    {
        return view('livewire.user-management', [
            'users' => DB::table('users')
                ->select(['id', 'name', 'email', 'role_id', 'status', 'created_at'])
                ->orderBy('name')
                ->get(),
            'roles' => array_flip(config('cms.role_ids')),
        ]);
    }
}
