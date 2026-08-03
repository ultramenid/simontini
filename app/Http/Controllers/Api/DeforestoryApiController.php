<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use Symfony\Component\HttpFoundation\Response;

class DeforestoryApiController extends Controller
{
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
            'desrkirpsi_id' => ['required', 'string'],
            'desrkirpsi_en' => ['required', 'string'],
            'date' => ['required', 'date'],
            'content_id' => ['required', 'string'],
            'content_en' => ['required', 'string'],
            'status' => ['required', Rule::in(['publish', 'draft'])],
        ]);

        $id = DB::table('deforestory')->insertGetId([
            ...$validated,
            'slug' => $this->uniqueSlug($validated['title_id']),
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        $item = DB::table('deforestory')->find($id);

        return response()->json([
            'message' => 'Data Deforestory berhasil dibuat.',
            'data' => $item,
        ], Response::HTTP_CREATED);
    }

    public function sync(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'external_id' => ['required', 'string', 'max:255'],
            'title_id' => ['required', 'string', 'max:255'],
            'title_en' => ['required', 'string', 'max:255'],
            'desrkirpsi_id' => ['required', 'string'],
            'desrkirpsi_en' => ['required', 'string'],
            'date' => ['required', 'date'],
            'content_id' => ['required', 'string'],
            'content_en' => ['required', 'string'],
            'status' => ['required', Rule::in(['publish', 'draft'])],
        ]);

        $exists = DB::table('deforestory')
            ->where('external_id', $validated['external_id'])
            ->exists();

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

        if (! $exists) {
            $values['created_at'] = now();
        }

        DB::table('deforestory')->updateOrInsert(
            ['external_id' => $validated['external_id']],
            $values,
        );

        $item = DB::table('deforestory')
            ->where('external_id', $validated['external_id'])
            ->first();

        return response()->json([
            'message' => $exists
                ? 'Data Deforestory berhasil diperbarui.'
                : 'Data Deforestory berhasil dibuat.',
            'action' => $exists ? 'updated' : 'created',
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
