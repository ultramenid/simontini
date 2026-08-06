@props([
    'label',
    'hint' => null,
    'value' => '',
])

@php
    $wireModel = $attributes->wire('model')->value();
@endphp

<div>
    <div class="mb-2 flex items-end justify-between gap-4">
        <div>
            <label class="block text-sm font-semibold text-gray-800">{{ $label }}</label>
            @if ($hint)
                <p class="mt-0.5 text-xs text-gray-500">{{ $hint }}</p>
            @endif
        </div>
        <span class="bg-gray-100 px-2.5 py-1 text-[11px] font-medium uppercase tracking-wide text-gray-500">TinyMCE custom</span>
    </div>

    <div data-tinymce-wrapper>
        <div wire:ignore>
            <textarea data-tinymce-editor>{{ $value }}</textarea>
        </div>
        <textarea data-tinymce-input wire:model="{{ $wireModel }}" class="hidden" aria-hidden="true">{{ $value }}</textarea>
    </div>

    @error($wireModel)
        <p class="mt-1.5 text-xs font-medium text-red-600">{{ $message }}</p>
    @enderror
</div>
