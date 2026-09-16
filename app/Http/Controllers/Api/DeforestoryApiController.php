<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Services\DeforestationStoryNotificationDispatcher;
use App\Services\DeforestationStoryWebhookDispatcher;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use Symfony\Component\HttpFoundation\Response;

class DeforestoryApiController extends Controller
{
    public function __construct(
        private DeforestationStoryNotificationDispatcher $notifications,
        private DeforestationStoryWebhookDispatcher $webhooks,
    ) {}

    public function index(Request $request): JsonResponse
    {
        $perPage = min(max($request->integer('per_page', 10), 1), 100);

        $items = DB::table('deforestory')
            ->select([
                'id',
                'external_id',
                'image_id',
                'image_en',
                'title_id',
                'title_en',
                'category',
                'category_id',
                'category_en',
                'region',
                'region_id',
                'region_en',
                'meta_font_size',
                'slug',
                'desrkirpsi_id',
                'desrkirpsi_en',
                'date',
                'content_id',
                'content_en',
                'status',
            ])
            ->where('status', 'publish')
            ->orderByDesc('date')
            ->orderByDesc('id')
            ->paginate($perPage);

        return response()->json($items);
    }

    public function store(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'title_id' => ['required', 'string', 'max:255'],
            'title_en' => ['required', 'string', 'max:255'],
            'category' => ['nullable', 'string', 'max:100'],
            'category_id' => ['nullable', 'string', 'max:100'],
            'category_en' => ['nullable', 'string', 'max:100'],
            'region' => ['nullable', 'string', 'max:100'],
            'region_id' => ['nullable', 'string', 'max:100'],
            'region_en' => ['nullable', 'string', 'max:100'],
            'meta_font_size' => ['nullable', 'integer', 'min:10', 'max:28'],
            'desrkirpsi_id' => ['required', 'string'],
            'desrkirpsi_en' => ['required', 'string'],
            'date' => ['required', 'date'],
            'content_id' => ['required', 'string'],
            'content_en' => ['required', 'string'],
            'status' => ['required', Rule::in(['publish', 'draft'])],
        ]);
        $validated['category'] = blank($validated['category'] ?? null)
            ? null
            : trim($validated['category']);
        $validated['category_id'] = blank($validated['category_id'] ?? null)
            ? $validated['category']
            : trim($validated['category_id']);
        $validated['category_en'] = blank($validated['category_en'] ?? null)
            ? $validated['category']
            : trim($validated['category_en']);
        $validated['category'] = $validated['category_id'];
        $validated['region'] = blank($validated['region'] ?? null)
            ? null
            : trim($validated['region']);
        $validated['region_id'] = blank($validated['region_id'] ?? null)
            ? $validated['region']
            : trim($validated['region_id']);
        $validated['region_en'] = blank($validated['region_en'] ?? null)
            ? $validated['region']
            : trim($validated['region_en']);
        $validated['region'] = $validated['region_id'];
        $validated['meta_font_size'] = $validated['meta_font_size'] ?? 14;

        $id = DB::table('deforestory')->insertGetId([
            ...$validated,
            'uuid' => (string) Str::uuid(),
            'slug' => $this->uniqueSlug($validated['title_id']),
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        $item = DB::table('deforestory')->find($id);
        $queuedNotifications = $validated['status'] === 'publish'
            ? $this->notifications->queueNewStory($id)
            : 0;

        if ($validated['status'] === 'publish') {
            $this->webhooks->dispatch($id, 'created');
        }

        return response()->json([
            'message' => 'Data Deforestory berhasil dibuat.',
            'queued_notifications' => $queuedNotifications,
            'data' => $item,
        ], Response::HTTP_CREATED);
    }

    public function sync(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'external_id' => ['required', 'string', 'max:255'],
            'title_id' => ['required', 'string', 'max:255'],
            'title_en' => ['required', 'string', 'max:255'],
            'category' => ['sometimes', 'nullable', 'string', 'max:100'],
            'category_id' => ['sometimes', 'nullable', 'string', 'max:100'],
            'category_en' => ['sometimes', 'nullable', 'string', 'max:100'],
            'region' => ['sometimes', 'nullable', 'string', 'max:100'],
            'region_id' => ['sometimes', 'nullable', 'string', 'max:100'],
            'region_en' => ['sometimes', 'nullable', 'string', 'max:100'],
            'meta_font_size' => ['sometimes', 'nullable', 'integer', 'min:10', 'max:28'],
            'desrkirpsi_id' => ['required', 'string'],
            'desrkirpsi_en' => ['required', 'string'],
            'date' => ['required', 'date'],
            'content_id' => ['required', 'string'],
            'content_en' => ['required', 'string'],
            'status' => ['required', Rule::in(['publish', 'draft'])],
        ]);
        if (array_key_exists('category', $validated)) {
            $validated['category'] = blank($validated['category'])
                ? null
                : trim($validated['category']);
        }
        if (array_key_exists('category_id', $validated)) {
            $validated['category_id'] = blank($validated['category_id'])
                ? null
                : trim($validated['category_id']);
        }
        if (array_key_exists('category_en', $validated)) {
            $validated['category_en'] = blank($validated['category_en'])
                ? null
                : trim($validated['category_en']);
        }

        if (! array_key_exists('category_id', $validated) && array_key_exists('category', $validated)) {
            $validated['category_id'] = $validated['category'];
        }

        if (! array_key_exists('category_en', $validated) && array_key_exists('category', $validated)) {
            $validated['category_en'] = $validated['category'];
        }

        if (array_key_exists('category_id', $validated)) {
            $validated['category'] = $validated['category_id'];
        }
        if (array_key_exists('region', $validated)) {
            $validated['region'] = blank($validated['region'])
                ? null
                : trim($validated['region']);
        }
        if (array_key_exists('region_id', $validated)) {
            $validated['region_id'] = blank($validated['region_id'])
                ? null
                : trim($validated['region_id']);
        }
        if (array_key_exists('region_en', $validated)) {
            $validated['region_en'] = blank($validated['region_en'])
                ? null
                : trim($validated['region_en']);
        }

        if (! array_key_exists('region_id', $validated) && array_key_exists('region', $validated)) {
            $validated['region_id'] = $validated['region'];
        }

        if (! array_key_exists('region_en', $validated) && array_key_exists('region', $validated)) {
            $validated['region_en'] = $validated['region'];
        }

        if (array_key_exists('region_id', $validated)) {
            $validated['region'] = $validated['region_id'];
        }
        if (array_key_exists('meta_font_size', $validated) && $validated['meta_font_size'] === null) {
            $validated['meta_font_size'] = 14;
        }

        $existing = DB::table('deforestory')
            ->where('external_id', $validated['external_id'])
            ->first();
        $exists = $existing !== null;

        $values = [
            'title_id' => $validated['title_id'],
            'title_en' => $validated['title_en'],
            'desrkirpsi_id' => $validated['desrkirpsi_id'],
            'desrkirpsi_en' => $validated['desrkirpsi_en'],
            'date' => $validated['date'],
            'content_id' => $validated['content_id'],
            'content_en' => $validated['content_en'],
            'status' => $validated['status'],
            'slug' => $this->uniqueSlug(
                $validated['title_id'],
                DB::table('deforestory')->where('external_id', $validated['external_id'])->value('id'),
            ),
            'updated_at' => now(),
        ];

        if (array_key_exists('category', $validated)) {
            $values['category'] = $validated['category'];
        }
        if (array_key_exists('category_id', $validated)) {
            $values['category_id'] = $validated['category_id'];
        }
        if (array_key_exists('category_en', $validated)) {
            $values['category_en'] = $validated['category_en'];
        }
        if (array_key_exists('region', $validated)) {
            $values['region'] = $validated['region'];
        }
        if (array_key_exists('region_id', $validated)) {
            $values['region_id'] = $validated['region_id'];
        }
        if (array_key_exists('region_en', $validated)) {
            $values['region_en'] = $validated['region_en'];
        }
        if (array_key_exists('meta_font_size', $validated)) {
            $values['meta_font_size'] = $validated['meta_font_size'];
        }

        if (! $exists) {
            $values['uuid'] = (string) Str::uuid();
            $values['created_at'] = now();
        } elseif (blank($existing->uuid)) {
            $values['uuid'] = (string) Str::uuid();
        }

        DB::table('deforestory')->updateOrInsert(
            ['external_id' => $validated['external_id']],
            $values,
        );

        $item = DB::table('deforestory')
            ->where('external_id', $validated['external_id'])
            ->first();
        $becamePublished = $item->status === 'publish'
            && ($existing === null || $existing->status !== 'publish');
        $queuedNotifications = $becamePublished
            ? $this->notifications->queueNewStory((int) $item->id)
            : 0;

        if ($item->status === 'publish') {
            $this->webhooks->dispatch(
                (int) $item->id,
                $existing?->status === 'publish' ? 'updated' : 'created',
            );
        } elseif ($existing?->status === 'publish') {
            $this->webhooks->dispatch((int) $item->id, 'unpublished');
        }

        return response()->json([
            'message' => $exists
                ? 'Data Deforestory berhasil diperbarui.'
                : 'Data Deforestory berhasil dibuat.',
            'action' => $exists ? 'updated' : 'created',
            'queued_notifications' => $queuedNotifications,
            'data' => $item,
        ], $exists ? Response::HTTP_OK : Response::HTTP_CREATED);
    }

    private function uniqueSlug(string $title, ?int $ignoreId = null): string
    {
        $baseSlug = Str::slug($title) ?: 'deforestation-story';
        $slug = $baseSlug;
        $suffix = 2;

        while (DB::table('deforestory')
            ->where('slug', $slug)
            ->when($ignoreId, fn ($query) => $query->where('id', '!=', $ignoreId))
            ->exists()) {
            $slug = $baseSlug.'-'.$suffix;
            $suffix++;
        }

        return $slug;
    }
}
