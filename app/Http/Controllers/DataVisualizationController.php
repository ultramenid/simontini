<?php

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

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
                // APP_URL, bukan host request: URL ini tersimpan di konten artikel.
                'embed_url' => rtrim(config('app.url'), '/').route('data-visualizations.embed', $item->id, false),
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

        $description = $this->describe($visualization, $chartData);

        return view('frontends.data-visualization', compact('visualization', 'chartData', 'embed', 'description'));
    }

    /** Meta description: the saved description, or a one-line summary of the data points. */
    private function describe(object $visualization, array $chartData): string
    {
        if (filled($visualization->description ?? null)) {
            return Str::limit(strip_tags($visualization->description), 160);
        }

        $unit = $chartData['columns'][1] ?? '';
        $points = collect($chartData['rows'] ?? [])
            ->filter(fn ($row) => is_array($row) && isset($row[0], $row[1]))
            ->map(fn ($row) => $row[0].' '.$row[1])
            ->join(', ');

        return Str::limit(trim($visualization->title.'. '.($points ? "{$unit}: {$points}." : '')), 160);
    }
}
