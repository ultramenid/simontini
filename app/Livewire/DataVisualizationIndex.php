<?php

namespace App\Livewire;

use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Livewire\WithPagination;

class DataVisualizationIndex extends Component
{
    use WithPagination;

    public function delete(int $id): void
    {
        DB::table('data_visualizations')->where('id', $id)->delete();

        $this->resetPage();
        session()->flash('success', 'Data & grafik berhasil dihapus.');
    }

    public function toggleStatus(int $id): void
    {
        $item = DB::table('data_visualizations')->find($id);

        if ($item === null) {
            return;
        }

        DB::table('data_visualizations')
            ->where('id', $id)
            ->update([
                'is_active' => ! (bool) $item->is_active,
                'updated_at' => now(),
            ]);
    }

    public function render()
    {
        $items = DB::table('data_visualizations')
            ->orderByDesc('id')
            ->paginate(12);

        return view('livewire.data-visualization-index', compact('items'));
    }
}
