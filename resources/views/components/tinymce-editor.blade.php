@props([
    'label',
    'hint' => null,
    'preset' => 'content',
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
        <div class="flex items-center gap-2">
            @if ($preset !== 'caption')
                <span wire:ignore><button
                    type="button"
                    data-tinymce-source-toggle
                    aria-pressed="false"
                    title="Edit HTML mentah; format kode tersimpan persis seperti yang ditulis"
                    class="border border-gray-300 bg-white px-2.5 py-1 text-[11px] font-semibold uppercase tracking-wide text-gray-600 hover:border-[#376A64] hover:text-[#376A64] aria-pressed:border-[#376A64] aria-pressed:bg-[#eef6f4] aria-pressed:text-[#376A64]"
                >HTML</button></span>
            @endif
            <span class="bg-gray-100 px-2.5 py-1 text-[11px] font-medium uppercase tracking-wide text-gray-500">TinyMCE custom</span>
        </div>
    </div>

    <div
        data-tinymce-wrapper
        data-tinymce-picker-id="{{ $wireModel }}"
        data-tinymce-preset="{{ $preset }}"
        data-tinymce-reference-page-url="{{ route('cms.reference', ['picker' => 1, 'editor' => $wireModel]) }}"
        data-tinymce-visualization-options-url="{{ route('cms.data-visualizations.options') }}"
    >
        <div wire:ignore>
            <textarea data-tinymce-editor>{{ $value }}</textarea>
            @if ($preset !== 'caption')
                <textarea data-tinymce-source class="hidden min-h-[560px] w-full resize-y border-0 bg-gray-950 p-4 font-mono text-sm leading-6 text-emerald-300 outline-none" spellcheck="false" aria-label="Kode HTML {{ $label }}"></textarea>
            @endif
        </div>
        <textarea data-tinymce-input wire:model="{{ $wireModel }}" class="hidden" aria-hidden="true">{{ $value }}</textarea>
    </div>

    @error($wireModel)
        <p class="mt-1.5 text-xs font-medium text-red-600">{{ $message }}</p>
    @enderror
</div>
