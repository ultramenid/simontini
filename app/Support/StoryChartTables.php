<?php

namespace App\Support;

use Illuminate\Support\Facades\DB;

final class StoryChartTables
{
    private const CHART_FIGURE = '#<figure\b[^>]*\bstory-data-visualization\b[^>]*>.*?</figure>#is';

    private const EMBED_ID = '#/embed/data-visualizations/(\d+)#';

    /**
     * Charts are drawn on a canvas inside an iframe, so their numbers are invisible to
     * crawlers and screen readers. Append each chart's data as a visually hidden table.
     */
    public static function append(string $html): string
    {
        if (! preg_match_all(self::EMBED_ID, $html, $matches)) {
            return $html;
        }

        $charts = DB::table('data_visualizations')
            ->whereIn('id', array_unique($matches[1]))
            ->where('is_active', true)
            ->get(['id', 'title', 'chart_data'])
            ->keyBy('id');

        return preg_replace_callback(self::CHART_FIGURE, function (array $figure) use ($charts) {
            $chart = preg_match(self::EMBED_ID, $figure[0], $id) ? $charts->get((int) $id[1]) : null;
            $chartData = $chart ? json_decode($chart->chart_data ?? '', true) : null;

            if (! is_array($chartData) || empty($chartData['rows'])) {
                return $figure[0];
            }

            return $figure[0].view('partials.story-chart-data', [
                'title' => $chart->title,
                'chartData' => $chartData,
            ])->render();
        }, $html) ?? $html;
    }
}
