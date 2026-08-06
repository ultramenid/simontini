<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CmsSubscriberController extends Controller
{
    public function index(Request $request): View
    {
        $requestedScope = $request->string('scope')->toString();
        $selectedScope = 'all';

        if ($requestedScope === 'global') {
            $selectedScope = 'global';
        } elseif (ctype_digit($requestedScope)
            && DB::table('deforestory')->where('id', (int) $requestedScope)->exists()) {
            $selectedScope = (int) $requestedScope;
        }

        $subscribersQuery = DB::table('deforestation_story_subscriptions as subscriptions')
            ->leftJoin('deforestory as stories', 'stories.id', '=', 'subscriptions.deforestory_id')
            ->select([
                'subscriptions.*',
                'stories.title_id as story_title_id',
                'stories.title_en as story_title_en',
            ]);

        if ($selectedScope === 'global') {
            $subscribersQuery->whereNull('subscriptions.deforestory_id');
        } elseif (is_int($selectedScope)) {
            $subscribersQuery->where('subscriptions.deforestory_id', $selectedScope);
        }

        $subscribers = $subscribersQuery
            ->orderByRaw("CASE subscriptions.status WHEN 'active' THEN 0 ELSE 1 END")
            ->orderByDesc('subscriptions.created_at')
            ->get();

        $stories = DB::table('deforestory as stories')
            ->leftJoin('deforestation_story_subscriptions as subscriptions', 'subscriptions.deforestory_id', '=', 'stories.id')
            ->select([
                'stories.id',
                'stories.title_id',
                'stories.title_en',
            ])
            ->selectRaw('COUNT(subscriptions.id) as subscribers_count')
            ->groupBy('stories.id', 'stories.title_id', 'stories.title_en')
            ->orderBy('stories.title_id')
            ->get();

        return view('backends.subscribers', [
            'title' => 'Subscriber - Simontini',
            'nav' => 'subscribers',
            'subscribers' => $subscribers,
            'stories' => $stories,
            'selectedScope' => $selectedScope,
            'totalSubscribers' => (int) DB::table('deforestation_story_subscriptions')->count(),
            'globalSubscribers' => (int) DB::table('deforestation_story_subscriptions')->whereNull('deforestory_id')->count(),
        ]);
    }
}
