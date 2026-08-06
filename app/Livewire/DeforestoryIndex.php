<?php

namespace App\Livewire;

use App\Services\DeforestationStoryNotificationDispatcher;
use App\Services\DeforestationStoryWebhookDispatcher;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\WithPagination;

class DeforestoryIndex extends Component
{
    use WithPagination;

    public function toggleStatus(
        int $id,
        DeforestationStoryNotificationDispatcher $notifications,
        DeforestationStoryWebhookDispatcher $webhooks,
    ): void
    {
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

        if ($item?->image_id) {
            Storage::disk('public')->delete($item->image_id);
        }

        if ($item?->image_en) {
            Storage::disk('public')->delete($item->image_en);
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
