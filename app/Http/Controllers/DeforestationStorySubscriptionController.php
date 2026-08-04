<?php

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class DeforestationStorySubscriptionController extends Controller
{
    public function store(Request $request, string $locale, int $id): JsonResponse|RedirectResponse
    {
        $story = DB::table('deforestory')
            ->where('id', $id)
            ->where('status', 'publish')
            ->first();

        abort_unless($story, 404);

        return $this->saveSubscription($request, $locale, (int) $story->id);
    }

    public function storeAll(Request $request, string $locale): JsonResponse|RedirectResponse
    {
        return $this->saveSubscription($request, $locale, null);
    }

    private function saveSubscription(Request $request, string $locale, ?int $storyId): JsonResponse|RedirectResponse
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'min:2', 'max:100'],
            'email' => ['required', 'email:rfc', 'max:255'],
        ]);

        $email = Str::lower(trim($validated['email']));
        $query = DB::table('deforestation_story_subscriptions')->where('email', $email);
        $storyId === null ? $query->whereNull('deforestory_id') : $query->where('deforestory_id', $storyId);
        $existing = $query->first();

        if ($existing) {
            DB::table('deforestation_story_subscriptions')->where('id', $existing->id)->update([
                'name' => trim($validated['name']),
                'locale' => $locale,
                'status' => 'active',
                'updated_at' => now(),
            ]);
        } else {
            DB::table('deforestation_story_subscriptions')->insert([
                'deforestory_id' => $storyId,
                'name' => trim($validated['name']),
                'email' => $email,
                'locale' => $locale,
                'status' => 'active',
                'unsubscribe_token' => hash('sha256', Str::uuid()->toString()),
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }

        $message = match ([$locale, $storyId === null]) {
            ['en', true] => 'Subscription activated. You will receive updates from every Deforestory.',
            ['en', false] => 'Subscription activated. You will receive this story’s latest updates.',
            ['id', true] => 'Langganan aktif. Anda akan menerima pembaruan dari semua Deforestory.',
            default => 'Langganan aktif. Anda akan menerima pembaruan terbaru story ini.',
        };

        if ($request->expectsJson()) {
            return response()->json(['message' => $message], $existing ? 200 : 201);
        }

        return back()->with('subscription_success', $message);
    }
}
