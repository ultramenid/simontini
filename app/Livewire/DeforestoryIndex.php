<?php

namespace App\Livewire;

use App\Services\DeforestationStoryNotificationDispatcher;
use App\Services\DeforestationStoryWebhookDispatcher;
use Illuminate\Contracts\Encryption\DecryptException;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\WithPagination;

class DeforestoryIndex extends Component
{
    use WithPagination;

    public string $globalPreviewPassword = '';

    public string $globalPreviewPassword_confirmation = '';

    public bool $hasGlobalPreviewPassword = false;

    public ?string $revealedGlobalPreviewPassword = null;

    public function mount(): void
    {
        $this->hasGlobalPreviewPassword = filled(
            DB::table('deforestory_preview_settings')->where('id', 1)->value('password_hash'),
        );
    }

    public function saveGlobalPreviewPassword(): void
    {
        $validated = $this->validate([
            'globalPreviewPassword' => ['required', 'string', 'min:6', 'max:100', 'confirmed'],
            'globalPreviewPassword_confirmation' => ['required', 'string', 'max:100'],
        ], [], [
            'globalPreviewPassword' => 'password global',
        ]);

        DB::table('deforestory_preview_settings')->updateOrInsert(
            ['id' => 1],
            [
                'password_hash' => Hash::make($validated['globalPreviewPassword']),
                'password_encrypted' => Crypt::encryptString($validated['globalPreviewPassword']),
                'updated_at' => now(),
            ],
        );

        $this->reset('globalPreviewPassword', 'globalPreviewPassword_confirmation');
        $this->revealedGlobalPreviewPassword = null;
        $this->hasGlobalPreviewPassword = true;
        session()->flash('success', 'Password global preview berhasil disimpan.');
    }

    public function revealGlobalPreviewPassword(): void
    {
        $encryptedPassword = DB::table('deforestory_preview_settings')
            ->where('id', 1)
            ->value('password_encrypted');

        if (! filled($encryptedPassword)) {
            $this->addError('globalPreviewPassword', 'Atur ulang password satu kali agar password dapat ditampilkan.');

            return;
        }

        try {
            $this->revealedGlobalPreviewPassword = Crypt::decryptString($encryptedPassword);
        } catch (DecryptException) {
            $this->addError('globalPreviewPassword', 'Password tidak dapat dibuka. Silakan atur ulang password.');
        }
    }

    public function hideGlobalPreviewPassword(): void
    {
        $this->revealedGlobalPreviewPassword = null;
    }

    public function toggleStatus(
        int $id,
        DeforestationStoryNotificationDispatcher $notifications,
        DeforestationStoryWebhookDispatcher $webhooks,
    ): void {
        $item = DB::table('deforestory')->select(['id', 'status'])->find($id);

        if ($item === null) {
            return;
        }

        $status = $item->status === 'publish' ? 'draft' : 'publish';

        DB::table('deforestory')
            ->where('id', $id)
            ->update([
                'status' => $status,
                'updated_at' => now(),
            ]);

        if ($status === 'publish') {
            $notifications->queueNewStory($id);
            $webhooks->dispatch($id, 'created');
        } else {
            $webhooks->dispatch($id, 'unpublished');
        }

        session()->flash('success', $status === 'publish'
            ? 'Data berhasil dipublikasikan.'
            : 'Data berhasil dijadikan draft.');
    }

    public function delete(int $id): void
    {
        $item = DB::table('deforestory')
            ->select(['image_id', 'image_en'])
            ->find($id);

        DB::table('deforestory')->where('id', $id)->delete();

        foreach (array_unique(array_filter([$item?->image_id, $item?->image_en])) as $media) {
            Storage::disk('public')->delete($media);
        }

        $this->resetPage();
        session()->flash('success', 'Data Deforestory berhasil dihapus.');
    }

    public function render()
    {
        $items = DB::table('deforestory')
            ->orderByDesc('date')
            ->orderByDesc('id')
            ->paginate(10);

        return view('livewire.deforestory-index', compact('items'));
    }
}
