<?php

namespace App\Livewire;

use App\Services\CommentHtmlSanitizer;
use App\Services\PasopatiReportClient;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Livewire\Attributes\On;
use Livewire\Component;

class DeforestationStoryInteractions extends Component
{
    public int $storyId;

    public string $storyUuid;

    public string $locale;

    public bool $isPreview = false;

    public array $updateItems = [];

    public function mount(int $storyId, string $storyUuid, string $locale, bool $isPreview = false): void
    {
        abort_unless(in_array($locale, ['id', 'en'], true), 404);

        $this->storyId = $storyId;
        $this->storyUuid = $storyUuid;
        $this->locale = $locale;
        $this->isPreview = $isPreview;

        $updates = app(PasopatiReportClient::class)->forStory(
            $this->storyUuid,
            $this->locale,
            $this->isPreview,
        ) ?? $this->localUpdates();

        $this->updateItems = $updates
            ->map(fn (object $update): array => (array) $update)
            ->values()
            ->all();
    }

    #[On('comment-created')]
    public function refreshComments(?int $commentId = null): void
    {
        // Receiving the event is enough: Livewire renders the latest comments again.
    }

    public function render()
    {
        $comments = DB::table('story_comments')
            ->where('story_id', $this->storyId)
            ->where('status', 'approved')
            ->orderByDesc('created_at')
            ->orderByDesc('id')
            ->get(['id', 'story_id', 'parent_id', 'user_name', 'user_avatar', 'comment', 'created_at'])
            ->map(function (object $comment) {
                $comment->safe_comment = app(CommentHtmlSanitizer::class)->sanitize($comment->comment);

                return $comment;
            });

        return view('livewire.deforestation-story-interactions', [
            'updates' => collect($this->updateItems)->map(fn (array $update): object => (object) $update),
            'comments' => $comments,
            'commentsAvailable' => true,
            'story' => (object) ['id' => $this->storyId],
        ]);
    }

    private function localUpdates(): Collection
    {
        $query = DB::table('deforestation_story_updates')
            ->where('deforestory_id', $this->storyId)
            ->orderByDesc('published_at')
            ->orderByDesc('id');

        if (! $this->isPreview) {
            $query->where('status', 'on');
        }

        return $query->get()->map(function (object $update) {
            $update->localized_title = $this->locale === 'en' ? $update->title_en : $update->title_id;
            $update->localized_description = $this->locale === 'en'
                ? $update->description_en
                : $update->description_id;

            return $update;
        });
    }
}
