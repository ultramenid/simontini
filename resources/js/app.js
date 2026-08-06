import './bootstrap';
import '../../vendor/masmerise/livewire-toaster/resources/js';
import { Editor, Node } from '@tiptap/core';
import StarterKit from '@tiptap/starter-kit';
import CodeBlockLowlight from '@tiptap/extension-code-block-lowlight';
import Image from '@tiptap/extension-image';
import Placeholder from '@tiptap/extension-placeholder';
import { TableKit } from '@tiptap/extension-table';
import TextAlign from '@tiptap/extension-text-align';
import { TextStyleKit } from '@tiptap/extension-text-style';
import { common, createLowlight } from 'lowlight';
import tinymce from 'tinymce/tinymce';
import 'tinymce/icons/default';
import 'tinymce/themes/silver';
import 'tinymce/models/dom';
import 'tinymce/plugins/advlist';
import 'tinymce/plugins/anchor';
import 'tinymce/plugins/autolink';
import 'tinymce/plugins/charmap';
import 'tinymce/plugins/code';
import 'tinymce/plugins/codesample';
import 'tinymce/plugins/fullscreen';
import 'tinymce/plugins/image';
import 'tinymce/plugins/link';
import 'tinymce/plugins/lists';
import 'tinymce/plugins/media';
import 'tinymce/plugins/preview';
import 'tinymce/plugins/searchreplace';
import 'tinymce/plugins/table';
import 'tinymce/plugins/visualblocks';
import 'tinymce/plugins/wordcount';
import 'tinymce/skins/ui/oxide/skin.min.css';

const lowlight = createLowlight(common);
let submittedCommentPositionApplied = false;

const StoryFigcaption = Node.create({
    name: 'storyFigcaption',
    content: 'inline*',
    defining: true,
    parseHTML: () => [{ tag: 'figcaption' }],
    renderHTML: () => ['figcaption', { class: 'story-content-caption' }, 0],
});

const StoryFigure = Node.create({
    name: 'storyFigure',
    group: 'block',
    content: 'image storyFigcaption?',
    defining: true,
    parseHTML: () => [{ tag: 'figure' }],
    renderHTML: () => ['figure', { class: 'story-content-figure' }, 0],
});

const initializeTinyMceEditors = () => {
    document.querySelectorAll('[data-tinymce-wrapper]').forEach((wrapper) => {
        if (wrapper.dataset.tinymceInitialized === 'true') return;

        const editorElement = wrapper.querySelector('[data-tinymce-editor]');
        const input = wrapper.querySelector('[data-tinymce-input]');
        if (!editorElement || !input) return;

        const referenceStorageKey = `simontini-tiptap-selection:${wrapper.dataset.tinymcePickerId}`;
        let lastReferenceSelection = 0;

        wrapper.dataset.tinymceInitialized = 'true';

        tinymce.init({
            target: editorElement,
            license_key: 'gpl',
            skin: false,
            content_css: false,
            height: 560,
            min_height: 360,
            resize: true,
            menubar: 'file edit view insert format tools table help',
            plugins: 'advlist anchor autolink charmap code codesample fullscreen image link lists media preview searchreplace table visualblocks wordcount',
            toolbar: 'undo redo | blocks fontsize | addImage addVideo addBorderMerah addSlider | bold italic underline strikethrough forecolor backcolor | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image media table | code codesample removeformat | fullscreen preview',
            toolbar_sticky: true,
            promotion: false,
            branding: false,
            statusbar: true,
            elementpath: false,
            valid_elements: '*[*]',
            extended_valid_elements: 'iframe[src|width|height|frameborder|allowfullscreen|style|class|loading|referrerpolicy]',
            verify_html: false,
            entity_encoding: 'raw',
            sandbox_iframes: false,
            font_size_formats: '8pt 10pt 12pt 14pt 16pt 18pt 24pt 30pt 36pt 48pt',
            content_style: 'body { font-family: Arial, sans-serif; font-size: 16px; line-height: 1.7; padding: 16px; } img, video, iframe { max-width: 100%; }',
            setup(editor) {
                const insertReferenceImage = (payload) => {
                    if (
                        payload?.type !== 'simontini-reference-selected'
                        || payload.editor !== wrapper.dataset.tinymcePickerId
                        || !payload.image?.url
                        || (payload.selectedAt && payload.selectedAt <= lastReferenceSelection)
                    ) return false;

                    lastReferenceSelection = payload.selectedAt || Date.now();
                    editor.insertContent(
                        `<figure class="media-caption"><img src="${editor.dom.encode(payload.image.url)}" alt="${editor.dom.encode(payload.image.alt_text || payload.image.title || '')}" title="${editor.dom.encode(payload.image.title || '')}" width="100%"><figcaption class="media-caption-text">${editor.dom.encode(payload.image.alt_text || payload.image.title || '')}</figcaption></figure>`,
                    );

                    try {
                        window.localStorage.removeItem(referenceStorageKey);
                    } catch (error) {
                        // The image is already inserted.
                    }

                    return true;
                };

                const consumeStoredReference = () => {
                    try {
                        const stored = window.localStorage.getItem(referenceStorageKey);
                        if (stored) insertReferenceImage(JSON.parse(stored));
                    } catch (error) {
                        // Ignore unavailable storage or invalid data.
                    }
                };

                editor.ui.registry.addButton('addImage', {
                    text: '+ Image',
                    tooltip: 'Pilih gambar dari Reference',
                    onAction: () => {
                        try {
                            window.localStorage.removeItem(referenceStorageKey);
                        } catch (error) {
                            // Opening the picker does not require browser storage.
                        }

                        const referenceWindow = window.open(
                            wrapper.dataset.tinymceReferencePageUrl,
                            'simontiniReferencePicker',
                            'width=1200,height=850,scrollbars=yes,resizable=yes',
                        );

                        if (!referenceWindow) {
                            window.alert('Jendela Reference diblokir browser. Izinkan pop-up untuk situs ini lalu coba lagi.');
                        }
                    },
                });
                editor.ui.registry.addButton('addVideo', {
                    text: '+ Video',
                    onAction: () => editor.insertContent("<figure class='media-caption'><video controls width='100%'><source src='' type='video/mp4'></video><figcaption class='media-caption-text'>Tulis caption video</figcaption></figure>"),
                });
                editor.ui.registry.addButton('addBorderMerah', {
                    text: '+ Border',
                    onAction: () => editor.insertContent("<div style='border:1px solid red;padding:20px;'>Konten</div>"),
                });
                editor.ui.registry.addButton('addSlider', {
                    text: '+ Slider',
                    onAction: () => editor.insertContent("<div class='tmce-slider' data-index='0'><div class='tmce-slides'><figure class='active'><img src='https://placehold.co/800x450' width='100%' alt=''><figcaption>Caption gambar pertama</figcaption></figure><figure><img src='https://placehold.co/800x450' width='100%' alt=''><figcaption>Caption gambar kedua</figcaption></figure></div><div class='tmce-controls'><button class='prev' type='button'>Prev</button><button class='next' type='button'>Next</button></div></div>"),
                });

                editor.on('init', () => {
                    editor.setContent(input.value || editorElement.value || '');
                    wrapper.tinyMceEditor = editor;
                });
                editor.on('change input undo redo blur', () => {
                    input.value = editor.getContent();
                    input.dispatchEvent(new Event('input', { bubbles: true }));
                    input.dispatchEvent(new Event('change', { bubbles: true }));
                });

                window.addEventListener('message', (event) => {
                    if (event.origin === window.location.origin) insertReferenceImage(event.data);
                });
                window.addEventListener('storage', (event) => {
                    if (event.key !== referenceStorageKey || !event.newValue) return;

                    try {
                        insertReferenceImage(JSON.parse(event.newValue));
                    } catch (error) {
                        // Ignore malformed storage events.
                    }
                });
                window.addEventListener('focus', () => window.setTimeout(consumeStoredReference, 150));
            },
        }).catch(() => {
            wrapper.dataset.tinymceInitialized = 'false';
        });
    });
};

const syncContentEditorsFromInputs = () => {
    document.querySelectorAll('[data-tiptap-wrapper]').forEach((wrapper) => {
        const input = wrapper.querySelector('[data-tiptap-input]');
        const editor = wrapper.tiptapEditor;
        if (!input || !editor) return;

        const current = editor.isEmpty ? '' : editor.getHTML();
        if (current !== input.value) editor.commands.setContent(input.value || '', { emitUpdate: false });
    });

    document.querySelectorAll('[data-tinymce-wrapper]').forEach((wrapper) => {
        const input = wrapper.querySelector('[data-tinymce-input]');
        const editor = wrapper.tinyMceEditor;
        if (!input || !editor) return;

        if (editor.getContent() !== input.value) editor.setContent(input.value || '');
    });
};

window.tinymce = tinymce;

const keepSubmittedCommentInView = () => {
    if (submittedCommentPositionApplied) return;

    const url = new URL(window.location.href);
    if (url.searchParams.get('comment') !== 'sent' && window.location.hash !== '#comments') return;

    const comments = document.getElementById('comments');
    if (!comments) return;

    const scrollToComments = () => {
        const top = comments.getBoundingClientRect().top + window.scrollY - 96;
        window.scrollTo({ top: Math.max(0, top), behavior: 'auto' });
        submittedCommentPositionApplied = true;
        document.getElementById('comment-position-guard')?.remove();
    };

    if ('scrollRestoration' in window.history) window.history.scrollRestoration = 'manual';
    window.requestAnimationFrame(scrollToComments);
};

if (document.readyState === 'loading') {
    document.addEventListener('DOMContentLoaded', keepSubmittedCommentInView);
} else {
    keepSubmittedCommentInView();
}

window.addEventListener('load', keepSubmittedCommentInView);
window.addEventListener('pageshow', keepSubmittedCommentInView);

document.addEventListener('click', (event) => {
    const button = event.target.closest('[data-tiptap-reference-select]');
    if (!button) return;

    event.preventDefault();
    const payload = {
        type: 'simontini-reference-selected',
        editor: button.dataset.editorKey,
        image: {
            url: button.dataset.imageUrl,
            title: button.dataset.imageTitle,
            alt_text: button.dataset.imageAlt,
        },
        selectedAt: Date.now(),
    };

    try {
        window.localStorage.setItem(`simontini-tiptap-selection:${payload.editor}`, JSON.stringify(payload));
    } catch (error) {
        // postMessage below remains available when browser storage is restricted.
    }

    if (window.opener && !window.opener.closed) {
        window.opener.postMessage(payload, window.location.origin);
    }

    window.setTimeout(() => window.close(), 100);
});

document.addEventListener('submit', async (event) => {
    const form = event.target.closest('[data-comment-ajax-form]');
    if (!form) return;

    event.preventDefault();

    const submitButton = form.querySelector('[type="submit"]');
    const feedback = document.querySelector('[data-comment-feedback]');
    const parentId = form.querySelector('[name="parent_id"]')?.value || null;

    if (submitButton?.disabled) return;
    if (submitButton) submitButton.disabled = true;

    try {
        const response = await fetch(form.action, {
            method: 'POST',
            body: new FormData(form),
            credentials: 'same-origin',
            headers: {
                Accept: 'application/json',
                'X-Requested-With': 'XMLHttpRequest',
            },
        });
        const payload = await response.json().catch(() => ({}));

        if (!response.ok) {
            const validationMessage = Object.values(payload.errors || {}).flat()[0];
            throw new Error(validationMessage || payload.message || 'Komentar belum dapat dikirim.');
        }

        const editorWrapper = form.querySelector('[data-tiptap-wrapper]');
        editorWrapper?.tiptapEditor?.commands.clearContent();

        if (feedback) {
            feedback.textContent = payload.message;
            feedback.className = 'mt-6 border-l-4 border-[#376A64] bg-[#e5efed] px-5 py-4 text-sm font-semibold text-[#244b47]';
        }

        if (parentId) {
            form.closest('[data-comment-reply-panel]')?.classList.add('hidden');
            window.dispatchEvent(new CustomEvent('reply-turnstile-expired', {
                detail: { id: Number(parentId) },
            }));
            window.setTimeout(updateCommentThreadLines, 50);
        } else {
            window.dispatchEvent(new CustomEvent('comment-submitted'));
        }

        const turnstileWidget = form.querySelector('.cf-turnstile');
        if (window.turnstile && turnstileWidget) {
            try {
                window.turnstile.reset(turnstileWidget);
            } catch (error) {
                // A fresh challenge will be rendered on the next interaction.
            }
        }
    } catch (error) {
        if (feedback) {
            feedback.textContent = error instanceof Error ? error.message : 'Komentar belum dapat dikirim.';
            feedback.className = 'mt-6 border-l-4 border-[#bc4a3c] bg-red-50 px-5 py-4 text-sm font-semibold text-red-800';
        }
    } finally {
        if (submitButton) submitButton.disabled = false;
    }
});

document.addEventListener('submit', async (event) => {
    const form = event.target.closest('[data-story-subscribe-form]');
    if (!form) return;

    event.preventDefault();

    const submitButton = form.querySelector('[type="submit"]');
    const feedback = form.querySelector('[data-story-subscribe-feedback]');
    if (submitButton?.disabled) return;
    if (submitButton) submitButton.disabled = true;

    try {
        const subscribedEmail = form.querySelector('[name="email"]')?.value || '';
        const response = await fetch(form.action, {
            method: 'POST',
            body: new FormData(form),
            credentials: 'same-origin',
            headers: {
                Accept: 'application/json',
                'X-Requested-With': 'XMLHttpRequest',
            },
        });
        const payload = await response.json().catch(() => ({}));

        if (!response.ok) {
            const validationMessage = Object.values(payload.errors || {}).flat()[0];
            throw new Error(validationMessage || payload.message || 'Langganan belum dapat disimpan.');
        }

        form.reset();
        if (feedback) {
            feedback.textContent = payload.message;
            feedback.className = 'mt-3 text-center text-xs font-semibold text-[#376A64]';
        }

        form.dispatchEvent(new CustomEvent('story-subscription-succeeded', {
            bubbles: true,
            detail: {
                email: subscribedEmail,
                message: payload.message,
            },
        }));
    } catch (error) {
        if (feedback) {
            feedback.textContent = error instanceof Error ? error.message : 'Langganan belum dapat disimpan.';
            feedback.className = 'mt-3 text-center text-xs font-semibold text-[#bc4a3c]';
        }
    } finally {
        if (submitButton) submitButton.disabled = false;
    }
});

const updateCommentThreadLines = () => {
    window.requestAnimationFrame(() => {
        document.querySelectorAll('[data-comment-thread-item]').forEach((item) => {
            const rail = item.querySelector(':scope > [data-comment-parent-rail]');
            const children = item.querySelector(':scope > [data-comment-thread-children]');
            const parentAvatar = item.querySelector(':scope > div > [data-comment-thread-avatar]');

            if (!rail || !children || !parentAvatar || children.offsetParent === null) return;

            const directChildren = Array.from(children.children)
                .filter((child) => child.matches('[data-comment-thread-item]'));
            const lastChild = directChildren.at(-1);
            if (!lastChild) return;

            const itemRect = item.getBoundingClientRect();
            const parentRect = parentAvatar.getBoundingClientRect();
            const lastChildRect = lastChild.getBoundingClientRect();
            const startY = parentRect.bottom - itemRect.top;
            const endY = lastChildRect.top - itemRect.top - 32;
            const centerX = parentRect.left + (parentRect.width / 2) - itemRect.left;

            rail.style.top = `${startY}px`;
            rail.style.left = `${centerX}px`;
            rail.style.height = `${Math.max(0, endY - startY)}px`;
        });
    });
};

document.addEventListener('click', (event) => {
    if (event.target.closest('[data-comment-replies-toggle]')) {
        window.setTimeout(updateCommentThreadLines, 250);
    }
});

window.addEventListener('resize', updateCommentThreadLines);

if (document.readyState === 'loading') {
    document.addEventListener('DOMContentLoaded', updateCommentThreadLines);
} else {
    updateCommentThreadLines();
}

document.addEventListener('livewire:navigated', updateCommentThreadLines);

const ContentImage = Image.extend({
    addAttributes() {
        return {
            ...this.parent?.(),
            width: {
                default: '100%',
                parseHTML: (element) => element.style.width || '100%',
                renderHTML: (attributes) => ({
                    style: `width: ${attributes.width}; max-width: 100%; height: ${attributes.height};`,
                }),
            },
            height: {
                default: 'auto',
                parseHTML: (element) => element.style.height || 'auto',
                renderHTML: () => ({}),
            },
        };
    },
});

const executeTiptapCommand = (editor, command, value = null) => {
    const chain = editor.chain().focus();

    switch (command) {
        case 'bold': chain.toggleBold().run(); break;
        case 'italic': chain.toggleItalic().run(); break;
        case 'underline': chain.toggleUnderline().run(); break;
        case 'strike': chain.toggleStrike().run(); break;
        case 'code': chain.toggleCode().run(); break;
        case 'codeBlock': chain.toggleCodeBlock().run(); break;
        case 'paragraph': chain.setParagraph().run(); break;
        case 'heading': chain.toggleHeading({ level: Number(value) }).run(); break;
        case 'bulletList': chain.toggleBulletList().run(); break;
        case 'orderedList': chain.toggleOrderedList().run(); break;
        case 'blockquote': chain.toggleBlockquote().run(); break;
        case 'horizontalRule': chain.setHorizontalRule().run(); break;
        case 'textAlign': chain.setTextAlign(value).run(); break;
        case 'fontSize':
            value ? chain.setFontSize(value).run() : chain.unsetFontSize().run();
            break;
        case 'lineHeight':
            value ? chain.setLineHeight(value).run() : chain.unsetLineHeight().run();
            break;
        case 'color': chain.setColor(value).run(); break;
        case 'backgroundColor': chain.setBackgroundColor(value).run(); break;
        case 'clearFormatting': chain.unsetAllMarks().clearNodes().run(); break;
        case 'link': {
            const currentUrl = editor.getAttributes('link').href || '';
            const url = window.prompt('Masukkan URL tautan:', currentUrl);

            if (url === null) break;
            if (url === '') chain.extendMarkRange('link').unsetLink().run();
            else chain.extendMarkRange('link').setLink({ href: url }).run();
            break;
        }
        case 'unlink': chain.extendMarkRange('link').unsetLink().run(); break;
        case 'insertTable': chain.insertTable({ rows: 3, cols: 3, withHeaderRow: true }).run(); break;
        case 'addRowBefore': chain.addRowBefore().run(); break;
        case 'addRowAfter': chain.addRowAfter().run(); break;
        case 'deleteRow': chain.deleteRow().run(); break;
        case 'addColumnBefore': chain.addColumnBefore().run(); break;
        case 'addColumnAfter': chain.addColumnAfter().run(); break;
        case 'deleteColumn': chain.deleteColumn().run(); break;
        case 'toggleHeaderRow': chain.toggleHeaderRow().run(); break;
        case 'toggleHeaderColumn': chain.toggleHeaderColumn().run(); break;
        case 'toggleHeaderCell': chain.toggleHeaderCell().run(); break;
        case 'mergeCells': chain.mergeCells().run(); break;
        case 'splitCell': chain.splitCell().run(); break;
        case 'deleteTable': chain.deleteTable().run(); break;
        case 'undo': chain.undo().run(); break;
        case 'redo': chain.redo().run(); break;
    }
};

const updateTiptapToolbar = (wrapper, editor) => {
    wrapper.querySelectorAll('[data-tiptap-active]').forEach((button) => {
        const name = button.dataset.tiptapActive;
        const value = button.dataset.tiptapValue;
        let active;

        if (name === 'heading') {
            active = editor.isActive('heading', { level: Number(value) });
        } else if (name === 'textAlign') {
            active = editor.isActive({ textAlign: value });
        } else {
            active = editor.isActive(name);
        }

        button.classList.toggle('tiptap-button-active', active);
    });

    const textStyle = editor.getAttributes('textStyle');
    const fontSize = wrapper.querySelector('[data-tiptap-select="fontSize"]');
    const lineHeight = wrapper.querySelector('[data-tiptap-select="lineHeight"]');

    if (fontSize) fontSize.value = textStyle.fontSize || '';
    if (lineHeight) lineHeight.value = textStyle.lineHeight || '';

    wrapper.querySelectorAll('[data-tiptap-table-tools]').forEach((element) => {
        element.classList.toggle('hidden', !editor.isActive('table'));
    });

    wrapper.querySelectorAll('[data-tiptap-selected-image-tools]').forEach((element) => {
        const active = editor.isActive('image');
        element.classList.toggle('hidden', !active);
        element.classList.toggle('flex', active);
    });

    const imageAttributes = editor.getAttributes('image');
    const selectedWidthInput = wrapper.querySelector('[data-tiptap-selected-image-width]');
    const selectedHeightInput = wrapper.querySelector('[data-tiptap-selected-image-height]');
    const selectedWidthUnit = wrapper.querySelector('[data-tiptap-selected-image-width-unit]');
    const selectedHeightUnit = wrapper.querySelector('[data-tiptap-selected-image-height-unit]');

    if (selectedWidthInput && typeof imageAttributes.width === 'string') {
        if (imageAttributes.width.endsWith('%')) {
            selectedWidthInput.value = Number.parseFloat(imageAttributes.width) || 100;
            if (selectedWidthUnit) selectedWidthUnit.value = '%';
        } else if (imageAttributes.width.endsWith('px')) {
            selectedWidthInput.value = Number.parseFloat(imageAttributes.width) || 600;
            if (selectedWidthUnit) selectedWidthUnit.value = 'px';
        } else {
            selectedWidthInput.value = 100;
            if (selectedWidthUnit) selectedWidthUnit.value = '%';
        }
    }
    if (selectedHeightInput) {
        if (typeof imageAttributes.height === 'string' && imageAttributes.height.endsWith('%')) {
            selectedHeightInput.value = Number.parseFloat(imageAttributes.height) || '';
            if (selectedHeightUnit) selectedHeightUnit.value = '%';
        } else if (typeof imageAttributes.height === 'string' && imageAttributes.height.endsWith('px')) {
            selectedHeightInput.value = Number.parseFloat(imageAttributes.height) || '';
            if (selectedHeightUnit) selectedHeightUnit.value = 'px';
        } else {
            selectedHeightInput.value = '';
        }
    }
};

const initializeTiptapEditors = () => {
    document.querySelectorAll('[data-tiptap-wrapper]').forEach((wrapper) => {
        if (wrapper.dataset.tiptapInitialized === 'true') return;

        const editorElement = wrapper.querySelector('[data-tiptap-content]');
        const input = wrapper.querySelector('[data-tiptap-input]');
        const sourceEditor = wrapper.querySelector('[data-tiptap-source]');
        const sourceToggle = wrapper.querySelector('[data-tiptap-source-toggle]');

        if (!editorElement || !input) return;

        const editor = new Editor({
            element: editorElement,
            extensions: [
                StarterKit.configure({
                    codeBlock: false,
                    link: {
                        openOnClick: false,
                        autolink: true,
                        defaultProtocol: 'https',
                    },
                }),
                StoryFigure,
                StoryFigcaption,
                CodeBlockLowlight.configure({ lowlight }),
                ContentImage.configure({
                    allowBase64: false,
                    inline: false,
                }),
                Placeholder.configure({
                    placeholder: editorElement.dataset.placeholder || '',
                    emptyEditorClass: 'is-editor-empty',
                }),
                TextAlign.configure({ types: ['heading', 'paragraph'] }),
                TextStyleKit,
                TableKit.configure({
                    table: { resizable: true },
                }),
            ],
            content: input.value || '',
            editorProps: {
                attributes: { class: 'tiptap-content' },
            },
            onUpdate: ({ editor: currentEditor }) => {
                input.value = currentEditor.isEmpty ? '' : currentEditor.getHTML();
                input.dispatchEvent(new Event('input', { bubbles: true }));

                const characterCount = wrapper.querySelector('[data-tiptap-character-count]');
                const textLength = currentEditor.getText().length;
                if (characterCount) characterCount.textContent = `${textLength}/2000`;
                wrapper.dispatchEvent(new CustomEvent('comment-editor-updated', {
                    bubbles: true,
                    detail: { html: input.value, textLength },
                }));

                if (sourceEditor && wrapper.dataset.tiptapSourceMode !== 'true') {
                    sourceEditor.value = input.value;
                }
            },
            onSelectionUpdate: ({ editor: currentEditor }) => updateTiptapToolbar(wrapper, currentEditor),
            onTransaction: ({ editor: currentEditor }) => updateTiptapToolbar(wrapper, currentEditor),
        });

        wrapper.querySelectorAll('[data-tiptap-command]').forEach((button) => {
            button.addEventListener('mousedown', (event) => {
                event.preventDefault();
                executeTiptapCommand(editor, button.dataset.tiptapCommand, button.dataset.tiptapValue);
                updateTiptapToolbar(wrapper, editor);
            });
        });

        wrapper.querySelectorAll('[data-tiptap-select]').forEach((select) => {
            select.addEventListener('change', () => {
                executeTiptapCommand(editor, select.dataset.tiptapSelect, select.value);
                updateTiptapToolbar(wrapper, editor);
            });
        });

        wrapper.querySelectorAll('[data-tiptap-color]').forEach((inputElement) => {
            inputElement.addEventListener('input', () => {
                executeTiptapCommand(editor, inputElement.dataset.tiptapColor, inputElement.value);
                updateTiptapToolbar(wrapper, editor);
            });
        });

        const imagePickerButton = wrapper.querySelector('[data-tiptap-image-picker]');
        const selectedImageWidth = wrapper.querySelector('[data-tiptap-selected-image-width]');
        const selectedImageHeight = wrapper.querySelector('[data-tiptap-selected-image-height]');
        const selectedImageWidthUnit = wrapper.querySelector('[data-tiptap-selected-image-width-unit]');
        const selectedImageHeightUnit = wrapper.querySelector('[data-tiptap-selected-image-height-unit]');
        const selectedImageApply = wrapper.querySelector('[data-tiptap-selected-image-apply]');
        const selectedImageFull = wrapper.querySelector('[data-tiptap-selected-image-full]');
        const selectedImageDelete = wrapper.querySelector('[data-tiptap-selected-image-delete]');
        const referenceStorageKey = `simontini-tiptap-selection:${wrapper.dataset.tiptapPickerId}`;
        let lastReferenceSelection = 0;

        const insertReferenceImage = (payload) => {
            if (
                payload?.type !== 'simontini-reference-selected'
                || payload.editor !== wrapper.dataset.tiptapPickerId
                || !payload.image?.url
                || (payload.selectedAt && payload.selectedAt <= lastReferenceSelection)
            ) return false;

            lastReferenceSelection = payload.selectedAt || Date.now();

            editor.chain().focus().setImage({
                src: payload.image.url,
                alt: payload.image.alt_text || payload.image.title,
                title: payload.image.title,
                width: 'auto',
                height: 'auto',
            }).run();

            try {
                window.localStorage.removeItem(referenceStorageKey);
            } catch (error) {
                // The image has already been inserted; storage cleanup is optional.
            }

            return true;
        };

        const consumeStoredReference = () => {
            try {
                const stored = window.localStorage.getItem(referenceStorageKey);
                if (stored) insertReferenceImage(JSON.parse(stored));
            } catch (error) {
                // Ignore invalid or unavailable browser storage.
            }
        };

        selectedImageApply?.addEventListener('mousedown', (event) => {
            event.preventDefault();
            const widthUnit = selectedImageWidthUnit?.value === '%' ? '%' : 'px';
            const heightUnit = selectedImageHeightUnit?.value === '%' ? '%' : 'px';
            const widthMaximum = widthUnit === '%' ? 100 : 3000;
            const heightMaximum = heightUnit === '%' ? 100 : 3000;
            const width = Math.min(widthMaximum, Math.max(1, Number(selectedImageWidth?.value) || widthMaximum));
            const heightValue = Number(selectedImageHeight?.value);
            const height = heightValue ? `${Math.min(heightMaximum, Math.max(1, heightValue))}${heightUnit}` : 'auto';
            editor.chain().focus().updateAttributes('image', { width: `${width}${widthUnit}`, height }).run();
        });

        selectedImageFull?.addEventListener('mousedown', (event) => {
            event.preventDefault();
            editor.chain().focus().updateAttributes('image', { width: '100%', height: 'auto' }).run();
        });

        selectedImageDelete?.addEventListener('mousedown', (event) => {
            event.preventDefault();
            editor.chain().focus().deleteSelection().run();
        });

        imagePickerButton?.addEventListener('click', (event) => {
            event.preventDefault();
            try {
                window.localStorage.removeItem(referenceStorageKey);
            } catch (error) {
                // Opening the Reference picker does not require browser storage.
            }

            const referenceWindow = window.open(
                wrapper.dataset.tiptapReferencePageUrl,
                'simontiniReferencePicker',
                'width=1200,height=850,scrollbars=yes,resizable=yes',
            );

            if (!referenceWindow) {
                window.alert('Jendela Reference diblokir browser. Izinkan pop-up untuk situs ini lalu coba lagi.');
            }
        });

        window.addEventListener('message', (event) => {
            if (event.origin === window.location.origin) insertReferenceImage(event.data);
        });

        window.addEventListener('storage', (event) => {
            if (event.key === referenceStorageKey && event.newValue) {
                try {
                    insertReferenceImage(JSON.parse(event.newValue));
                } catch (error) {
                    // Ignore malformed storage events.
                }
            }
        });

        window.addEventListener('focus', () => window.setTimeout(consumeStoredReference, 150));

        const setSourceMode = (enabled) => {
            if (!sourceEditor || !sourceToggle) return;

            wrapper.dataset.tiptapSourceMode = enabled ? 'true' : 'false';
            sourceToggle.classList.toggle('tiptap-button-active', enabled);

            wrapper.querySelectorAll('[data-tiptap-command], [data-tiptap-select], [data-tiptap-color], [data-tiptap-image-picker]').forEach((control) => {
                control.disabled = enabled;
                control.classList.toggle('opacity-40', enabled);
                control.classList.toggle('cursor-not-allowed', enabled);
            });

            if (enabled) {
                sourceEditor.value = editor.isEmpty ? '' : editor.getHTML();
                editorElement.classList.add('hidden');
                sourceEditor.classList.remove('hidden');
                sourceEditor.focus();
            } else {
                editor.commands.setContent(sourceEditor.value || '', { emitUpdate: false });
                input.value = editor.isEmpty ? '' : editor.getHTML();
                input.dispatchEvent(new Event('input', { bubbles: true }));
                sourceEditor.classList.add('hidden');
                editorElement.classList.remove('hidden');
                editor.commands.focus();
                updateTiptapToolbar(wrapper, editor);
            }
        };

        sourceToggle?.addEventListener('click', (event) => {
            event.preventDefault();
            setSourceMode(wrapper.dataset.tiptapSourceMode !== 'true');
        });

        sourceEditor?.addEventListener('input', () => {
            input.value = sourceEditor.value;
            input.dispatchEvent(new Event('input', { bubbles: true }));
        });

        wrapper.dataset.tiptapInitialized = 'true';
        wrapper.dataset.tiptapSourceMode = 'false';
        wrapper.tiptapEditor = editor;
        const characterCount = wrapper.querySelector('[data-tiptap-character-count]');
        const textLength = editor.getText().length;
        if (characterCount) characterCount.textContent = `${textLength}/2000`;
        wrapper.dispatchEvent(new CustomEvent('comment-editor-updated', {
            bubbles: true,
            detail: { html: input.value, textLength },
        }));
        updateTiptapToolbar(wrapper, editor);
    });
};

if (document.readyState === 'loading') {
    document.addEventListener('DOMContentLoaded', initializeTiptapEditors);
    document.addEventListener('DOMContentLoaded', initializeTinyMceEditors);
} else {
    initializeTiptapEditors();
    initializeTinyMceEditors();
}

document.addEventListener('livewire:init', initializeTiptapEditors);
document.addEventListener('livewire:init', initializeTinyMceEditors);
document.addEventListener('livewire:init', () => {
    window.Livewire?.hook('morph.updated', () => {
        window.setTimeout(() => {
            initializeTiptapEditors();
            initializeTinyMceEditors();
            syncContentEditorsFromInputs();
        }, 0);
    });
    window.Livewire?.hook('morph.removing', ({ el }) => {
        el.querySelectorAll?.('[data-tinymce-wrapper]').forEach((wrapper) => {
            wrapper.tinyMceEditor?.remove();
        });
    });
});
document.addEventListener('livewire:navigated', () => {
    initializeTiptapEditors();
    initializeTinyMceEditors();
});

document.addEventListener('click', (event) => {
    const toggle = event.target.closest('[data-comment-reply-toggle]');
    const close = event.target.closest('[data-comment-reply-close]');
    const trigger = toggle || close;

    if (!trigger) return;

    const commentId = trigger.dataset.commentReplyToggle || trigger.dataset.commentReplyClose;
    const panel = document.querySelector(`[data-comment-reply-panel="${commentId}"]`);

    if (!panel) return;

    const shouldOpen = Boolean(toggle) && panel.classList.contains('hidden');
    panel.classList.toggle('hidden', !shouldOpen);
    toggle?.setAttribute('aria-expanded', shouldOpen ? 'true' : 'false');

    window.setTimeout(updateCommentThreadLines, 250);

    if (shouldOpen) {
        window.setTimeout(() => panel.querySelector('[name="display_name"]')?.focus(), 50);
    }
});
