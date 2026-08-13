<?php

namespace App\Http\Controllers;

use App\Jobs\SendDeforestationSubscriptionConfirmationEmail;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use Illuminate\View\View;
use Throwable;

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

    public function unsubscribe(string $locale, string $token): View
    {
        $subscription = DB::table('deforestation_story_subscriptions')
            ->where('unsubscribe_token', $token)
            ->first(['id']);

        abort_unless($subscription, 404);

        DB::table('deforestation_story_subscriptions')
            ->where('id', $subscription->id)
            ->update([
                'status' => 'inactive',
                'updated_at' => now(),
            ]);

        return view('frontends.deforestation-story-unsubscribed', [
            'locale' => $locale,
        ]);
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
            $subscriptionId = (int) $existing->id;
            DB::table('deforestation_story_subscriptions')->where('id', $subscriptionId)->update([
                'name' => trim($validated['name']),
                'locale' => $locale,
                'status' => 'active',
                'updated_at' => now(),
            ]);
        } else {
            $subscriptionId = DB::table('deforestation_story_subscriptions')->insertGetId([
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

        try {
            SendDeforestationSubscriptionConfirmationEmail::dispatchAfterResponse($subscriptionId);
        } catch (Throwable $exception) {
            Log::warning('Email konfirmasi langganan Deforestory gagal dijadwalkan.', [
                'subscription_id' => $subscriptionId,
                'error' => $exception->getMessage(),
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
