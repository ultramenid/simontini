<?php

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;

class DataVisualizationController extends Controller
{
    public function options(): JsonResponse
    {
        $items = DB::table('data_visualizations')
            ->where('is_active', true)
            ->orderByDesc('updated_at')
            ->get(['id', 'title', 'chart_type'])
            ->map(fn ($item) => [
                'id' => $item->id,
                'title' => $item->title,
                'chart_type' => $item->chart_type,
                'embed_url' => route('data-visualizations.embed', $item->id),
            ]);

        return response()->json(['data' => $items]);
    }

    public function show(int $id)
    {
        return $this->renderVisualization($id, false);
    }

    public function embed(int $id)
    {
        return $this->renderVisualization($id, true);
    }

    private function renderVisualization(int $id, bool $embed)
    {
        $visualization = DB::table('data_visualizations')
            ->where('id', $id)
            ->where('is_active', true)
            ->first();

        abort_if($visualization === null, 404);

        $chartData = json_decode($visualization->chart_data ?? '', true);
        abort_unless(is_array($chartData), 404);

        return view('frontends.data-visualization', compact('visualization', 'chartData', 'embed'));
    }
}
