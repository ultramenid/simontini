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

        $validated = $request->validate([
            'name' => ['required', 'string', 'min:2', 'max:100'],
            'email' => ['required', 'email:rfc', 'max:255'],
        ]);

        DB::table('deforestation_story_subscriptions')->updateOrInsert(
            [
                'deforestory_id' => $story->id,
                'email' => Str::lower(trim($validated['email'])),
            ],
            [
                'name' => trim($validated['name']),
                'locale' => $locale,
                'status' => 'active',
                'unsubscribe_token' => hash('sha256', Str::uuid()->toString()),
                'updated_at' => now(),
                'created_at' => now(),
            ],
        );

        $message = $locale === 'en'
            ? 'Subscription activated. You will receive this story’s latest updates.'
            : 'Langganan aktif. Anda akan menerima pembaruan terbaru story ini.';

        if ($request->expectsJson()) {
            return response()->json(['message' => $message], 201);
        }

        return back()->with('subscription_success', $message);
    }
}
