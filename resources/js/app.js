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
import GLightbox from 'glightbox';
import 'glightbox/dist/css/glightbox.min.css';
import Chart from 'chart.js/auto';
import { Flow, SankeyController } from 'chartjs-chart-sankey';

Chart.register(SankeyController, Flow);

const visualizationColors = ['#376A64', '#D95C4F', '#E3A72F', '#5A7FB8', '#8A63A9', '#4F9D69', '#C96B9B', '#7C6F64', '#22A6B3'];

window.renderDataVisualizationChart = (canvas, type, chartData) => {
    if (!canvas || !chartData?.columns || !chartData?.rows) return;

    Chart.getChart(canvas)?.destroy();
    const chartContainer = canvas.parentElement;
    const previousGrid = chartContainer?.querySelector('[data-area-chart-grid]');
    previousGrid?.querySelectorAll('canvas').forEach((gridCanvas) => Chart.getChart(gridCanvas)?.destroy());
    previousGrid?.remove();
    canvas.style.display = '';

    const labels = chartData.rows.map((row) => row[0]);
    const series = chartData.columns.slice(1);
    const isCircular = type === 'pie' || type === 'doughnut';
    const isLine = type === 'line' || type === 'area';
    const isBarChart = type === 'bar' || type === 'column';
    const topText = String(chartData.top_text || '').trim();
    const bottomText = String(chartData.bottom_text || '').trim();
    const titleAlignment = { left: 'start', center: 'center', right: 'end' }[chartData.top_align] || 'center';
    const footerAlignment = { left: 'start', center: 'center', right: 'end' }[chartData.bottom_align] || 'center';
    const topFontSize = Math.min(72, Math.max(10, Number(chartData.top_font_size) || 18));
    const bottomFontSize = Math.min(72, Math.max(10, Number(chartData.bottom_font_size) || 13));
    const topFontWeight = chartData.top_font_weight || 'bold';
    const bottomFontWeight = chartData.bottom_font_weight || 'normal';
    const topFontFamily = chartData.top_font_family || 'Poppins';
    const bottomFontFamily = chartData.bottom_font_family || 'Poppins';
    const topFontStyle = chartData.top_italic ? 'italic' : 'normal';
    const bottomFontStyle = chartData.bottom_italic ? 'italic' : 'normal';
    const showLegend = chartData.show_legend !== false;
    const legendPosition = chartData.legend_position === 'top' ? 'top' : 'bottom';
    const compactPreview = chartData.compact_preview === true;
    const valueAxisTicks = Array.isArray(chartData.value_axis_ticks)
        ? [...new Set(chartData.value_axis_ticks
            .filter((value) => value !== null && value !== undefined && value !== '')
            .map(Number)
            .filter(Number.isFinite))].sort((first, second) => first - second)
        : [];
    const showValueAxisLine = chartData.show_value_axis_line !== false;
    const chartWidth = chartContainer?.clientWidth || canvas.clientWidth || 0;
    const isNarrowChart = chartWidth > 0 && chartWidth < 640;
    const responsiveTopFontSize = isNarrowChart ? Math.min(topFontSize, 14) : topFontSize;
    const responsiveBottomFontSize = isNarrowChart ? Math.min(bottomFontSize, 10) : bottomFontSize;
    const responsiveAxisFontSize = isNarrowChart ? 10 : (compactPreview ? 9 : 13);
    const responsiveAxisPadding = isNarrowChart ? 6 : (compactPreview ? 4 : 12);
    const responsiveValueAxisPadding = isNarrowChart ? 6 : (compactPreview ? 4 : 10);
    const responsiveMaxBarThickness = isNarrowChart ? 72 : 100;
    const wrapChartText = (text, fontSize, fontWeight, fontFamily, fontStyle) => {
        if (!isNarrowChart || !text) return text;

        const context = canvas.getContext('2d');
        if (!context) return text;

        const words = text.split(/\s+/).filter(Boolean);
        const lines = [];
        let currentLine = '';
        const maximumLineWidth = Math.max(160, chartWidth - 56);

        context.save();
        context.font = `${fontStyle} ${fontWeight} ${fontSize}px ${fontFamily}`;

        words.forEach((word) => {
            const candidate = currentLine ? `${currentLine} ${word}` : word;

            if (currentLine && context.measureText(candidate).width > maximumLineWidth) {
                lines.push(currentLine);
                currentLine = word;
            } else {
                currentLine = candidate;
            }
        });

        if (currentLine) lines.push(currentLine);
        context.restore();

        return lines.length > 1 ? lines : text;
    };
    const responsiveTopText = wrapChartText(topText, responsiveTopFontSize, topFontWeight, topFontFamily, topFontStyle);
    const responsiveBottomText = wrapChartText(bottomText, responsiveBottomFontSize, bottomFontWeight, bottomFontFamily, bottomFontStyle);

    if (type === 'area-grid') {
        canvas.style.display = 'none';
        const grid = document.createElement('div');
        grid.dataset.areaChartGrid = '';
        grid.className = 'flex h-full min-h-0 w-full flex-col';

        if (topText) {
            const heading = document.createElement('h3');
            heading.className = 'mb-3 shrink-0 text-center text-lg font-semibold text-gray-900';
            heading.textContent = topText;
            heading.style.textAlign = chartData.top_align || 'center';
            heading.style.fontSize = `${responsiveTopFontSize}px`;
            heading.style.fontWeight = topFontWeight;
            heading.style.fontFamily = topFontFamily;
            heading.style.fontStyle = topFontStyle;
            heading.style.color = '#000000';
            grid.appendChild(heading);
        }

        const entries = chartData.rows
            .map((row, index) => ({
                label: String(row[0] || `Data ${index + 1}`),
                value: Math.max(0, Number(row[1]) || 0),
            }))
            .filter((entry) => entry.value > 0)
            .sort((a, b) => b.value - a.value);

        const treemap = document.createElement('div');
        treemap.className = 'relative min-h-0 flex-1 overflow-hidden bg-white';
        treemap.style.aspectRatio = '16 / 9';

        const layoutTreemap = (items, x = 0, y = 0, width = 160, height = 90) => {
            if (!items.length) return [];
            if (items.length === 1) return [{ ...items[0], x, y, width, height }];

            const total = items.reduce((sum, item) => sum + item.value, 0);
            let splitIndex = 1;
            let runningTotal = items[0].value;
            let smallestDifference = Math.abs(total / 2 - runningTotal);

            for (let index = 1; index < items.length - 1; index += 1) {
                runningTotal += items[index].value;
                const difference = Math.abs(total / 2 - runningTotal);
                if (difference < smallestDifference) {
                    splitIndex = index + 1;
                    smallestDifference = difference;
                }
            }

            const firstGroup = items.slice(0, splitIndex);
            const secondGroup = items.slice(splitIndex);
            const firstTotal = firstGroup.reduce((sum, item) => sum + item.value, 0);
            const ratio = firstTotal / total;

            if (width >= height) {
                const firstWidth = width * ratio;
                return [
                    ...layoutTreemap(firstGroup, x, y, firstWidth, height),
                    ...layoutTreemap(secondGroup, x + firstWidth, y, width - firstWidth, height),
                ];
            }

            const firstHeight = height * ratio;
            return [
                ...layoutTreemap(firstGroup, x, y, width, firstHeight),
                ...layoutTreemap(secondGroup, x, y + firstHeight, width, height - firstHeight),
            ];
        };

        layoutTreemap(entries).forEach((entry, index) => {
            const tile = document.createElement('div');
            tile.className = 'group absolute flex items-center justify-center overflow-visible border border-white text-center font-bold uppercase leading-tight text-white';
            tile.style.left = `${entry.x / 1.6}%`;
            tile.style.top = `${entry.y / 0.9}%`;
            tile.style.width = `${entry.width / 1.6}%`;
            tile.style.height = `${entry.height / 0.9}%`;
            tile.style.backgroundColor = visualizationColors[index % visualizationColors.length];
            tile.style.fontSize = compactPreview ? '9px' : `${Math.max(11, Math.min(20, Math.sqrt(entry.width * entry.height) * 0.42))}px`;

            const label = document.createElement('span');
            label.className = 'max-w-[90%] break-words px-1';
            label.textContent = entry.label;
            tile.appendChild(label);

            const tooltip = document.createElement('span');
            tooltip.className = 'pointer-events-none absolute left-1/2 top-1/2 z-10 hidden -translate-x-1/2 -translate-y-[calc(100%+1.5rem)] whitespace-nowrap bg-white px-3 py-2 text-xs font-bold normal-case text-gray-800 shadow-lg group-hover:block';
            tooltip.textContent = `${entry.value.toLocaleString('id-ID')} ${chartData.columns[1] || ''}`.trim();
            tile.appendChild(tooltip);
            treemap.appendChild(tile);
        });

        if (!entries.length) {
            const empty = document.createElement('p');
            empty.className = 'flex h-full items-center justify-center text-sm text-gray-400';
            empty.textContent = 'Belum ada nilai untuk ditampilkan.';
            treemap.appendChild(empty);
        }

        grid.appendChild(treemap);

        if (bottomText) {
            const footer = document.createElement('p');
            footer.className = 'mt-2 shrink-0 text-center text-sm text-gray-600';
            footer.textContent = bottomText;
            footer.style.textAlign = chartData.bottom_align || 'center';
            footer.style.fontSize = `${responsiveBottomFontSize}px`;
            footer.style.fontWeight = bottomFontWeight;
            footer.style.fontFamily = bottomFontFamily;
            footer.style.fontStyle = bottomFontStyle;
            grid.appendChild(footer);
        }

        chartContainer?.appendChild(grid);
        return;
    }

    if (type === 'sankey') {
        const nodeColor = (node) => {
            const text = String(node || '');
            const hash = [...text].reduce((total, character) => total + character.charCodeAt(0), 0);
            return visualizationColors[hash % visualizationColors.length];
        };
        const flows = chartData.rows
            .filter((row) => row[0] && row[1] && Number(row[2]) > 0)
            .map((row) => ({ from: String(row[0]), to: String(row[1]), flow: Number(row[2]) }));

        new Chart(canvas, {
            type: 'sankey',
            data: {
                datasets: [{
                    label: chartData.columns[2] || 'Nilai',
                    data: flows,
                    colorFrom: (context) => nodeColor(context.dataset.data[context.dataIndex]?.from),
                    colorTo: (context) => nodeColor(context.dataset.data[context.dataIndex]?.to),
                    colorMode: 'gradient',
                    alpha: 0.55,
                    size: 'max',
                }],
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: { display: false },
                    title: { display: Boolean(topText), text: responsiveTopText, position: 'top', align: titleAlignment, color: '#000000', font: { family: topFontFamily, size: responsiveTopFontSize, weight: topFontWeight, style: topFontStyle } },
                    subtitle: { display: Boolean(bottomText), text: responsiveBottomText, position: 'bottom', align: footerAlignment, color: '#6b7280', font: { family: bottomFontFamily, size: responsiveBottomFontSize, weight: bottomFontWeight, style: bottomFontStyle } },
                },
            },
        });
        return;
    }

    const datasets = isCircular
        ? [{
            label: series[0] || 'Nilai',
            data: chartData.rows.map((row) => Number(row[1]) || 0),
            backgroundColor: labels.map((_, index) => visualizationColors[index % visualizationColors.length]),
            borderWidth: 0,
        }]
        : series.map((name, seriesIndex) => ({
            label: name,
            data: chartData.rows.map((row) => Number(row[seriesIndex + 1]) || 0),
            backgroundColor: isLine ? `${visualizationColors[seriesIndex % visualizationColors.length]}35` : visualizationColors[seriesIndex % visualizationColors.length],
            borderColor: visualizationColors[seriesIndex % visualizationColors.length],
            borderWidth: isLine ? 2 : 0,
            pointRadius: isLine ? 3 : 0,
            tension: 0.25,
            fill: type === 'area',
            ...(isBarChart ? {
                barPercentage: 0.72,
                categoryPercentage: 0.72,
                maxBarThickness: responsiveMaxBarThickness,
                borderRadius: 0,
                borderSkipped: false,
            } : {}),
        }));

    const categoryScale = {
        grid: { display: false },
        border: { display: true, color: '#111827', width: 1 },
        ticks: {
            color: '#111827',
            padding: responsiveAxisPadding,
            autoSkip: true,
            maxRotation: 0,
            ...(compactPreview ? { maxTicksLimit: 5 } : {}),
            font: { size: responsiveAxisFontSize },
        },
    };
    const valueScale = {
        beginAtZero: valueAxisTicks.length < 2,
        grid: { color: '#D1D5DB', lineWidth: 1, drawTicks: false },
        border: { display: showValueAxisLine, color: '#111827', width: 1 },
        ...(valueAxisTicks.length >= 2 ? {
            min: valueAxisTicks[0],
            max: valueAxisTicks[valueAxisTicks.length - 1],
            afterBuildTicks: (scale) => {
                scale.ticks = valueAxisTicks.map((value) => ({ value }));
            },
        } : {}),
        ticks: {
            color: '#111827',
            padding: responsiveValueAxisPadding,
            callback: (value) => Number(value).toLocaleString('id-ID'),
            ...(valueAxisTicks.length >= 2 ? { autoSkip: false } : {}),
            ...(compactPreview ? { maxTicksLimit: 4 } : {}),
            font: { size: responsiveAxisFontSize },
        },
    };

    new Chart(canvas, {
        type: type === 'line' || type === 'area' ? 'line' : type === 'bar' || type === 'column' ? 'bar' : type,
        data: { labels, datasets },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            layout: { padding: { left: isNarrowChart ? 0 : 4, right: isNarrowChart ? 6 : 12, bottom: isNarrowChart ? 0 : 4 } },
            plugins: {
                legend: { display: showLegend, position: legendPosition },
                title: { display: Boolean(topText), text: responsiveTopText, position: 'top', align: titleAlignment, color: '#000000', font: { family: topFontFamily, size: responsiveTopFontSize, weight: topFontWeight, style: topFontStyle } },
                subtitle: { display: Boolean(bottomText), text: responsiveBottomText, position: 'bottom', align: footerAlignment, color: '#6b7280', font: { family: bottomFontFamily, size: responsiveBottomFontSize, weight: bottomFontWeight, style: bottomFontStyle } },
                tooltip: { mode: isCircular ? 'nearest' : 'index', intersect: isCircular },
            },
            indexAxis: type === 'bar' ? 'y' : 'x',
            scales: isCircular
                ? {}
                : type === 'bar'
                    ? { x: valueScale, y: categoryScale }
                    : { x: categoryScale, y: valueScale },
        },
    });
};

const spreadsheetSelection = {
    root: null,
    start: null,
    end: null,
    dragging: false,
    moved: false,
};

const spreadsheetCoordinates = (cell) => ({
    row: Number(cell?.dataset.row ?? -1),
    column: Number(cell?.dataset.column ?? -1),
});

const spreadsheetCellsInSelection = () => {
    if (!spreadsheetSelection.root || !spreadsheetSelection.start || !spreadsheetSelection.end) return [];

    const start = spreadsheetCoordinates(spreadsheetSelection.start);
    const end = spreadsheetCoordinates(spreadsheetSelection.end);
    const minRow = Math.min(start.row, end.row);
    const maxRow = Math.max(start.row, end.row);
    const minColumn = Math.min(start.column, end.column);
    const maxColumn = Math.max(start.column, end.column);

    return Array.from(spreadsheetSelection.root.querySelectorAll('[data-spreadsheet-cell]')).filter((cell) => {
        const coordinates = spreadsheetCoordinates(cell);
        return coordinates.row >= minRow
            && coordinates.row <= maxRow
            && coordinates.column >= minColumn
            && coordinates.column <= maxColumn;
    });
};

const clearSpreadsheetSelection = () => {
    spreadsheetSelection.root?.querySelectorAll('[data-spreadsheet-cell]').forEach((cell) => {
        cell.classList.remove('is-selected', 'is-selection-start');
    });

    spreadsheetSelection.root = null;
    spreadsheetSelection.start = null;
    spreadsheetSelection.end = null;
    spreadsheetSelection.dragging = false;
    spreadsheetSelection.moved = false;
};

const clearSpreadsheetCellValues = () => {
    spreadsheetCellsInSelection().forEach((cell) => {
        const input = cell.querySelector('input');
        if (!input) return;

        input.value = '';
        input.dispatchEvent(new Event('input', { bubbles: true }));
    });
};

const isEditingSingleSpreadsheetCell = (target, cells = spreadsheetCellsInSelection()) => {
    const input = target?.closest?.('[data-spreadsheet-cell] input');

    return cells.length === 1 && Boolean(input) && cells[0].contains(input);
};

const paintSpreadsheetSelection = () => {
    if (!spreadsheetSelection.root) return;

    spreadsheetSelection.root.querySelectorAll('[data-spreadsheet-cell]').forEach((cell) => {
        cell.classList.remove('is-selected', 'is-selection-start');
    });
    spreadsheetCellsInSelection().forEach((cell) => cell.classList.add('is-selected'));
    spreadsheetSelection.start?.classList.add('is-selection-start');
};

document.addEventListener('pointerdown', (event) => {
    if (event.button !== 0) return;

    const cell = event.target.closest?.('[data-spreadsheet-cell]');
    const root = cell?.closest?.('[data-spreadsheet]');
    if (!cell || !root) {
        clearSpreadsheetSelection();

        return;
    }

    spreadsheetSelection.root = root;
    spreadsheetSelection.start = cell;
    spreadsheetSelection.end = cell;
    spreadsheetSelection.dragging = true;
    spreadsheetSelection.moved = false;
    paintSpreadsheetSelection();
});

document.addEventListener('focusin', (event) => {
    if (!spreadsheetSelection.root || spreadsheetSelection.root.contains(event.target)) return;

    clearSpreadsheetSelection();
});

document.addEventListener('pointermove', (event) => {
    if (!spreadsheetSelection.dragging || !spreadsheetSelection.root) return;

    const pointedElement = document.elementFromPoint(event.clientX, event.clientY);
    const cell = pointedElement?.closest?.('[data-spreadsheet-cell]');
    if (!cell || !spreadsheetSelection.root.contains(cell) || cell === spreadsheetSelection.end) return;

    event.preventDefault();
    spreadsheetSelection.end = cell;
    spreadsheetSelection.moved = true;
    paintSpreadsheetSelection();
});

document.addEventListener('pointerup', () => {
    if (!spreadsheetSelection.dragging) return;

    spreadsheetSelection.dragging = false;
});

document.addEventListener('keydown', async (event) => {
    if (spreadsheetSelection.root && !spreadsheetSelection.root.isConnected) {
        clearSpreadsheetSelection();
    }

    const cells = spreadsheetCellsInSelection();

    if (['Backspace', 'Delete'].includes(event.key) && cells.length) {
        if (isEditingSingleSpreadsheetCell(event.target, cells)) return;

        event.preventDefault();
        clearSpreadsheetCellValues();

        return;
    }

    const shortcut = event.key.toLowerCase();
    if (!(event.ctrlKey || event.metaKey) || !['c', 'x'].includes(shortcut)) return;

    if (!cells.length || !spreadsheetSelection.root) return;
    if (isEditingSingleSpreadsheetCell(event.target, cells)) return;

    const start = spreadsheetCoordinates(spreadsheetSelection.start);
    const end = spreadsheetCoordinates(spreadsheetSelection.end);
    const minRow = Math.min(start.row, end.row);
    const maxRow = Math.max(start.row, end.row);
    const minColumn = Math.min(start.column, end.column);
    const maxColumn = Math.max(start.column, end.column);
    const values = [];

    for (let row = minRow; row <= maxRow; row += 1) {
        const rowValues = [];
        for (let column = minColumn; column <= maxColumn; column += 1) {
            const cell = spreadsheetSelection.root.querySelector(`[data-spreadsheet-cell][data-row="${row}"][data-column="${column}"]`);
            rowValues.push(cell?.querySelector('input')?.value ?? '');
        }
        values.push(rowValues.join('\t'));
    }

    event.preventDefault();
    await navigator.clipboard?.writeText(values.join('\n'));

    if (shortcut === 'x') {
        clearSpreadsheetCellValues();
    }
});

document.addEventListener('paste', (event) => {
    if (spreadsheetSelection.root && !spreadsheetSelection.root.isConnected) {
        clearSpreadsheetSelection();
    }

    if (!spreadsheetSelection.root || !spreadsheetSelection.start) return;

    const text = event.clipboardData?.getData('text/plain');
    if (!text) return;

    const cells = spreadsheetCellsInSelection();
    const isTabularPaste = /[\t\r\n]/.test(text);
    if (!isTabularPaste && isEditingSingleSpreadsheetCell(event.target, cells)) return;

    const start = spreadsheetCoordinates(spreadsheetSelection.start);
    const pastedRows = text.replace(/\r/g, '').split('\n').filter((row, index, rows) => row !== '' || index < rows.length - 1);
    let changed = false;

    pastedRows.forEach((rowText, rowOffset) => {
        rowText.split('\t').forEach((value, columnOffset) => {
            const cell = spreadsheetSelection.root.querySelector(`[data-spreadsheet-cell][data-row="${start.row + rowOffset}"][data-column="${start.column + columnOffset}"]`);
            const input = cell?.querySelector('input');
            if (!input) return;

            input.value = value;
            input.dispatchEvent(new Event('input', { bubbles: true }));
            changed = true;
        });
    });

    if (changed) event.preventDefault();
});

const lowlight = createLowlight(common);
let submittedCommentPositionApplied = false;
let pendingSubmittedComment = null;

const showPendingSubmittedComment = () => {
    if (!pendingSubmittedComment) return;

    const { commentId, parentId } = pendingSubmittedComment;
    const target = document.getElementById(`comment-${commentId}`);
    if (!target) return;

    // Clear the pending state before scheduling the scroll. Livewire can run
    // several DOM hooks during one response; this prevents duplicate scrolls.
    pendingSubmittedComment = null;

    if (parentId && target.getClientRects().length === 0) {
        const parent = document.getElementById(`comment-${parentId}`);
        parent?.querySelector('[data-comment-replies-toggle]')?.click();
    }

    window.setTimeout(() => {
        target.scrollIntoView({ behavior: 'smooth', block: 'center' });
    }, parentId ? 250 : 0);
};

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

const StoryGallery = Node.create({
    name: 'storyGallery',
    group: 'block',
    content: 'storyFigure{2,}',
    defining: true,
    isolating: true,
    parseHTML: () => [
        { tag: 'div[data-story-gallery]' },
        { tag: 'div.story-content-gallery' },
    ],
    renderHTML: () => [
        'div',
        {
            class: 'story-content-gallery',
            'data-story-gallery': '',
        },
        0,
    ],
});

const storyGalleryTemplate = `
    <div class="story-content-gallery" data-story-gallery>
        <figure class="story-content-figure"><img src="https://placehold.co/1200x750?text=Gambar+Galeri+1" alt="Ganti dengan gambar galeri pertama" width="100%"><figcaption class="story-content-caption">Caption gambar pertama.</figcaption></figure>
        <figure class="story-content-figure"><img src="https://placehold.co/1200x750?text=Gambar+Galeri+2" alt="Ganti dengan gambar galeri kedua" width="100%"><figcaption class="story-content-caption">Caption gambar kedua.</figcaption></figure>
        <figure class="story-content-figure"><img src="https://placehold.co/1200x750?text=Gambar+Galeri+3" alt="Ganti dengan gambar galeri ketiga" width="100%"><figcaption class="story-content-caption">Caption gambar ketiga.</figcaption></figure>
    </div>
`;

const initializeTinyMceEditors = () => {
    document.querySelectorAll('[data-tinymce-wrapper]').forEach((wrapper) => {
        if (wrapper.dataset.tinymceInitialized === 'true') return;

        const editorElement = wrapper.querySelector('[data-tinymce-editor]');
        const input = wrapper.querySelector('[data-tinymce-input]');
        if (!editorElement || !input) return;

        const isCaptionEditor = wrapper.dataset.tinymcePreset === 'caption';
        const referenceStorageKey = `simontini-tiptap-selection:${wrapper.dataset.tinymcePickerId}`;
        let lastReferenceSelection = 0;
        let referenceInsertionMode = 'image';
        let lightboxImageToReplace = null;
        let lightboxGalleryToAppend = null;
        let lightboxManagerDialogApi = null;
        let beforeAfterImageToReplace = null;
        let beforeAfterManagerDialogApi = null;
        let beforeAfterPointerGesture = null;
        let suppressedBeforeAfterClick = null;
        let preferredAtomicInsertionBlock = null;
        let referencePickerModal = null;

        wrapper.dataset.tinymceInitialized = 'true';

        tinymce.init({
            target: editorElement,
            license_key: 'gpl',
            convert_urls: false,
            relative_urls: false,
            remove_script_host: false,
            skin: false,
            content_css: false,
            height: isCaptionEditor ? 220 : 560,
            min_height: isCaptionEditor ? 180 : 360,
            resize: true,
            menubar: isCaptionEditor ? false : 'file edit view insert format tools table help',
            plugins: 'advlist anchor autolink charmap code codesample fullscreen image link lists media preview searchreplace table visualblocks wordcount',
            toolbar: isCaptionEditor
                ? 'undo redo | fontsize | bold italic underline | alignleft aligncenter alignright | link removeformat | code'
                : 'undo redo | blocks fontsize | addImage addLightbox addBeforeAfter addDataVisualization addVideo addBorderMerah addStopper | bold italic underline strikethrough forecolor backcolor | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image media table | code codesample removeformat | fullscreen preview',
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
            font_size_formats: isCaptionEditor
                ? '10px 11px 12px 14px 16px 18px 20px 24px'
                : '8pt 10pt 12pt 14pt 16pt 18pt 24pt 30pt 36pt 48pt',
            content_style: `body { font-family: Arial, sans-serif; font-size: ${isCaptionEditor ? '12px' : '16px'}; line-height: 1.7; padding: 16px; } img, video, iframe { max-width: 100%; } .story-content-gallery { display: flex; width: 100%; gap: 12px; overflow-x: auto; scroll-snap-type: x mandatory; } .story-content-gallery > .story-content-figure { flex: 0 0 100%; width: 100%; margin: 0; scroll-snap-align: start; } .story-before-after-figure, .story-before-after, .story-before-after img { -webkit-user-drag: none; user-select: none; } .story-before-after { position: relative; width: 100%; aspect-ratio: 16 / 9; overflow: hidden; background: #e5e7eb; user-select: none; } .story-before-after-after { position: absolute; inset: 0; width: 100%; height: 100%; clip-path: inset(0 0 0 var(--before-after-position)); } .story-before-after-divider { position: absolute; top: 0; bottom: 0; left: var(--before-after-position); width: 3px; background: #fff; transform: translateX(-50%); pointer-events: none; } .story-before-after-handle { position: absolute; top: 50%; left: var(--before-after-position); z-index: 2; display: flex; width: 52px; height: 52px; align-items: center; justify-content: center; border: 3px solid #fff; border-radius: 9999px; background: rgba(0,0,0,.55); color: #fff; font-size: 22px; transform: translate(-50%, -50%); pointer-events: none; } .story-before-after-label, .story-before-after-caption { display: none !important; } .story-before-after-range { position: absolute; inset: 0; z-index: 3; width: 100%; height: 100%; margin: 0; cursor: ew-resize; opacity: 0; } .story-data-visualization { width: 100%; margin: 24px 0; } .story-data-visualization iframe { display: block; width: 100%; height: 100%; pointer-events: none; }`,
            setup(editor) {
                const atomicBlockSelector = '.story-lightbox-gallery, .story-before-after-figure, .story-data-visualization';
                const normalizeInlineStoppers = () => {
                    editor.getBody()?.querySelectorAll('.story-inline-stopper').forEach((stopper) => {
                        const previousNode = stopper.previousSibling;
                        if (previousNode?.nodeType === 3) {
                            previousNode.textContent = previousNode.textContent.replace(/[\u00a0 ]+$/, '');
                        }

                        stopper.style.width = '.7em';
                        stopper.style.height = '.7em';
                        stopper.style.marginLeft = '1px';
                        stopper.style.background = '#FF0000';
                        stopper.style.verticalAlign = 'middle';
                    });
                };

                const closeReferencePickerModal = (resetMode = true) => {
                    if (!referencePickerModal) return;

                    document.removeEventListener('keydown', referencePickerModal.onKeydown, true);
                    referencePickerModal.iframeWindow?.removeEventListener('keydown', referencePickerModal.onKeydown, true);
                    document.body.style.overflow = referencePickerModal.previousBodyOverflow;
                    referencePickerModal.element.remove();
                    referencePickerModal = null;

                    if (resetMode) {
                        referenceInsertionMode = 'image';
                        lightboxImageToReplace = null;
                        lightboxGalleryToAppend = null;
                        beforeAfterImageToReplace = null;
                    }
                };

                const placeCaretAfterBlock = (atomicBlock, silent = false) => {
                    if (!atomicBlock?.isConnected) return false;

                    let paragraph = atomicBlock.nextElementSibling;
                    if (!paragraph || paragraph.tagName !== 'P') {
                        paragraph = editor.getDoc().createElement('p');
                        paragraph.innerHTML = '<br>';
                        editor.dom.insertAfter(paragraph, atomicBlock);
                    }

                    editor.getBody().querySelectorAll('[data-mce-selected], .mceSelected').forEach((selectedElement) => {
                        selectedElement.removeAttribute('data-mce-selected');
                        selectedElement.classList.remove('mceSelected');
                    });
                    if (silent) {
                        const range = editor.getDoc().createRange();
                        range.setStart(paragraph, 0);
                        range.collapse(true);
                        const nativeSelection = editor.getWin().getSelection();
                        nativeSelection.removeAllRanges();
                        nativeSelection.addRange(range);
                    } else {
                        editor.selection.setCursorLocation(paragraph, 0);
                    }
                    if (!silent) editor.nodeChanged();
                    return true;
                };

                const repaintEditorAfterAtomicDialog = (atomicBlock, scrollPosition) => {
                    if (!atomicBlock?.isConnected) return;

                    normalizeAtomicStoryBlocks();
                    placeCaretAfterBlock(atomicBlock);
                    editor.nodeChanged();
                    editor.dispatch('SelectionChange');

                    const editorBody = editor.getBody();
                    editorBody.style.transform = 'translateZ(0)';
                    void editorBody.offsetHeight;
                    editor.getWin().requestAnimationFrame(() => {
                        editorBody.style.removeProperty('transform');
                        editor.getWin().scrollTo(scrollPosition.x, scrollPosition.y);
                    });
                };

                const installBeforeAfterPointerControls = () => {
                    const editorDocument = editor.getDoc();
                    if (!editorDocument || editorDocument.documentElement.dataset.beforeAfterPointerControls === 'true') return;

                    editorDocument.documentElement.dataset.beforeAfterPointerControls = 'true';
                    const resolveComparison = (event) => {
                        const directComparison = event.target?.closest?.('[data-story-before-after]')
                            || event.target?.closest?.('.story-before-after-figure')?.querySelector('[data-story-before-after]');
                        if (directComparison) return directComparison;

                        return (editorDocument.elementsFromPoint?.(event.clientX, event.clientY) || [])
                            .map((element) => element.closest?.('[data-story-before-after]')
                                || element.closest?.('.story-before-after-figure')?.querySelector('[data-story-before-after]'))
                            .find(Boolean) || null;
                    };
                    const isHandlePoint = (comparison, event, padding = 14) => {
                        const bounds = comparison?.querySelector('.story-before-after-handle')?.getBoundingClientRect();
                        return Boolean(bounds)
                            && event.clientX >= bounds.left - padding
                            && event.clientX <= bounds.right + padding
                            && event.clientY >= bounds.top - padding
                            && event.clientY <= bounds.bottom + padding;
                    };
                    const stopPointerEvent = (event) => {
                        event.preventDefault();
                        event.stopPropagation();
                        event.stopImmediatePropagation();
                    };

                    editorDocument.addEventListener('pointerdown', (event) => {
                        const comparison = resolveComparison(event);
                        if (!comparison || !isHandlePoint(comparison, event)) return;

                        const range = comparison.querySelector('[data-before-after-range]');
                        if (!range) return;

                        stopPointerEvent(event);
                        beforeAfterPointerGesture = {
                            range,
                            comparison,
                            figure: comparison.closest('.story-before-after-figure'),
                            pointerId: event.pointerId,
                            startX: event.clientX,
                            dragged: false,
                        };

                        try {
                            range.setPointerCapture?.(event.pointerId);
                        } catch (error) {
                            // The document-level listeners below remain the fallback.
                        }

                        const moveSlider = (moveEvent) => {
                            const gesture = beforeAfterPointerGesture;
                            if (!gesture || gesture.pointerId !== moveEvent.pointerId) return;

                            stopPointerEvent(moveEvent);
                            const bounds = gesture.comparison.getBoundingClientRect();
                            if (!bounds.width) return;

                            const position = Math.min(100, Math.max(0, ((moveEvent.clientX - bounds.left) / bounds.width) * 100));
                            gesture.dragged = gesture.dragged || Math.abs(moveEvent.clientX - gesture.startX) >= 1;
                            gesture.range.value = String(Math.round(position));
                            gesture.comparison.style.setProperty('--before-after-position', `${position}%`);
                        };
                        const finishSlider = (finishEvent) => {
                            const gesture = beforeAfterPointerGesture;
                            if (!gesture || gesture.pointerId !== finishEvent.pointerId) return;

                            stopPointerEvent(finishEvent);
                            gesture.range.setAttribute('value', gesture.range.value);
                            suppressedBeforeAfterClick = {
                                figure: gesture.figure,
                                until: Date.now() + 1000,
                            };

                            if (gesture.range.hasPointerCapture?.(finishEvent.pointerId)) {
                                gesture.range.releasePointerCapture(finishEvent.pointerId);
                            }
                            editorDocument.removeEventListener('pointermove', moveSlider, true);
                            editorDocument.removeEventListener('pointerup', finishSlider, true);
                            editorDocument.removeEventListener('pointercancel', finishSlider, true);
                            beforeAfterPointerGesture = null;
                            editor.nodeChanged();
                            editor.dispatch('change');
                        };

                        editorDocument.addEventListener('pointermove', moveSlider, true);
                        editorDocument.addEventListener('pointerup', finishSlider, true);
                        editorDocument.addEventListener('pointercancel', finishSlider, true);
                    }, true);

                    editorDocument.addEventListener('click', (event) => {
                        const comparison = resolveComparison(event);
                        const figure = comparison?.closest('.story-before-after-figure');
                        const recentlyDragged = figure
                            && suppressedBeforeAfterClick?.figure === figure
                            && Date.now() <= suppressedBeforeAfterClick.until;
                        if (!comparison || (!isHandlePoint(comparison, event) && !recentlyDragged)) return;

                        suppressedBeforeAfterClick = null;
                        stopPointerEvent(event);
                    }, true);

                    editorDocument.addEventListener('dragstart', (event) => {
                        if (!resolveComparison(event)) return;
                        stopPointerEvent(event);
                    }, true);
                };

                const placeCaretAfterAtomicBlock = () => {
                    const selectionNode = editor.selection.getNode();
                    const element = selectionNode?.nodeType === 1
                        ? selectionNode
                        : selectionNode?.parentElement;
                    const atomicBlock = element?.closest?.(atomicBlockSelector);
                    if (!atomicBlock) return false;
                    return placeCaretAfterBlock(atomicBlock);
                };

                const insertAtomicContent = (html) => {
                    if (preferredAtomicInsertionBlock?.isConnected) {
                        placeCaretAfterBlock(preferredAtomicInsertionBlock);
                    } else {
                        placeCaretAfterAtomicBlock();
                    }
                    preferredAtomicInsertionBlock = null;
                    const markerId = `story-caret-${Date.now()}-${Math.random().toString(36).slice(2, 7)}`;
                    editor.insertContent(`${html}<p id="${markerId}"><br></p>`);
                    const marker = editor.getDoc().getElementById(markerId);
                    if (marker) {
                        marker.removeAttribute('id');
                        editor.selection.setCursorLocation(marker, 0);
                    }
                };

                const normalizeAtomicStoryBlocks = () => {
                    editor.getBody().querySelectorAll('.story-lightbox-gallery .story-before-after-figure, .story-lightbox-gallery .story-lightbox-gallery').forEach((nestedBlock) => {
                        const parentGallery = nestedBlock.parentElement?.closest('.story-lightbox-gallery');
                        const oldWrapper = nestedBlock.parentElement;
                        if (!parentGallery) return;

                        editor.dom.insertAfter(nestedBlock, parentGallery);
                        if (oldWrapper !== parentGallery && oldWrapper?.matches('figure') && !oldWrapper.textContent.trim() && !oldWrapper.querySelector('img, video, iframe')) {
                            oldWrapper.remove();
                        }
                    });

                    editor.getBody().querySelectorAll(atomicBlockSelector).forEach((block) => {
                        block.setAttribute('contenteditable', 'false');
                        block.setAttribute('data-mce-contenteditable', 'false');

                        if (block.matches('.story-before-after-figure')) {
                            block.setAttribute('draggable', 'false');
                            block.querySelectorAll('img, [data-before-after-range]').forEach((element) => {
                                element.setAttribute('draggable', 'false');
                            });
                            block.querySelectorAll('.story-before-after-label, .story-before-after-caption').forEach((element) => element.remove());
                        }

                        if (!block.nextElementSibling) {
                            const paragraph = editor.getDoc().createElement('p');
                            paragraph.innerHTML = '<br>';
                            editor.dom.insertAfter(paragraph, block);
                        }
                    });
                };

                const createLightboxGalleryItems = (images, galleryId) => images.map((image) => {
                    const imageUrl = editor.dom.encode(image.url);
                    const imageTitle = editor.dom.encode(image.title || '');
                    const imageDescription = editor.dom.encode(image.caption || image.alt_text || image.title || '');

                    return `<figure class="story-content-figure" style="width: 100%; margin: 0; padding: 0; box-sizing: border-box;"><a class="glightbox2 gbox" href="${imageUrl}" data-gallery="${galleryId}" data-glightbox="description: ${imageDescription}" style="display: block; width: 100%; aspect-ratio: 16 / 9; margin: 0; padding: 0; overflow: hidden;"><img src="${imageUrl}" alt="${imageDescription}" title="${imageTitle}" style="display: block; width: 100%; height: 100%; aspect-ratio: 16 / 9; margin: 0; padding: 0; object-fit: cover; object-position: center; cursor: zoom-in;"></a>${imageDescription ? `<figcaption class="story-content-caption" style="margin: 4px 0 0; padding: 0; color: #000; font-size: 12px; font-weight: 400; line-height: 1.5;">${imageDescription}</figcaption>` : ''}</figure>`;
                }).join('');

                const insertReferenceImage = (payload) => {
                    if (
                        !['simontini-reference-selected', 'simontini-reference-gallery-selected'].includes(payload?.type)
                        || payload.editor !== wrapper.dataset.tinymcePickerId
                        || (!payload.image?.url && !payload.images?.length)
                        || (payload.selectedAt && payload.selectedAt <= lastReferenceSelection)
                    ) return false;

                    lastReferenceSelection = payload.selectedAt || Date.now();
                    const selectedImages = (payload.images?.length ? payload.images : [payload.image])
                        .filter((image) => image?.url);

                    if (!selectedImages.length) return false;

                    if (referenceInsertionMode === 'replace-before-after' && beforeAfterImageToReplace?.figure?.isConnected) {
                        const replacement = selectedImages[0];
                        const targetFigure = beforeAfterImageToReplace.figure;
                        const targetSide = beforeAfterImageToReplace.side;
                        const targetImage = targetFigure.querySelector(`.story-before-after-image--${targetSide}`);
                        const description = replacement.alt_text || replacement.title || '';

                        editor.undoManager.transact(() => {
                            editor.dom.setAttrib(targetImage, 'src', replacement.url);
                            editor.dom.setAttrib(targetImage, 'alt', description);
                        });
                        editor.nodeChanged();
                        editor.dispatch('change');
                        beforeAfterImageToReplace = null;
                        beforeAfterManagerDialogApi?.close();
                        window.setTimeout(() => openBeforeAfterDialog(targetFigure), 0);
                    } else if (referenceInsertionMode === 'before-after') {
                        if (selectedImages.length !== 2) {
                            window.alert('Before/After membutuhkan tepat 2 gambar.');
                            return false;
                        }

                        const beforeImage = selectedImages[0];
                        const afterImage = selectedImages[1];
                        const beforeUrl = editor.dom.encode(beforeImage.url);
                        const afterUrl = editor.dom.encode(afterImage.url);
                        const beforeDescription = editor.dom.encode(beforeImage.caption || beforeImage.alt_text || beforeImage.title || 'Before');
                        const afterDescription = editor.dom.encode(afterImage.caption || afterImage.alt_text || afterImage.title || 'After');

                        insertAtomicContent(`<figure class="story-before-after-figure" contenteditable="false" data-mce-contenteditable="false" draggable="false" style="width: 100%; margin: 24px 0; padding: 0;"><div class="story-before-after" data-story-before-after style="--before-after-position: 50%; position: relative; width: 100%; aspect-ratio: 16 / 9; overflow: hidden;"><img class="story-before-after-image story-before-after-image--before" src="${beforeUrl}" alt="${beforeDescription}" draggable="false" style="display: block; width: 100%; height: 100%; object-fit: cover;"><div class="story-before-after-after" data-before-after-after style="position: absolute; inset: 0; clip-path: inset(0 0 0 var(--before-after-position));"><img class="story-before-after-image story-before-after-image--after" src="${afterUrl}" alt="${afterDescription}" draggable="false" style="display: block; width: 100%; height: 100%; object-fit: cover;"></div><span class="story-before-after-divider" aria-hidden="true"></span><span class="story-before-after-handle" aria-hidden="true">&#8596;</span><input class="story-before-after-range" data-before-after-range type="range" min="0" max="100" value="50" draggable="false" aria-label="Geser perbandingan gambar Before dan After"></div></figure>`);
                    } else if (referenceInsertionMode === 'append-lightbox' && lightboxGalleryToAppend?.isConnected) {
                        const galleryToRefresh = lightboxGalleryToAppend;
                        const galleryId = lightboxGalleryToAppend.getAttribute('data-story-lightbox-gallery')
                            || lightboxGalleryToAppend.querySelector('a.glightbox2')?.getAttribute('data-gallery')
                            || `story-gallery-${Date.now()}-${Math.random().toString(36).slice(2, 7)}`;

                        editor.undoManager.transact(() => {
                            lightboxGalleryToAppend.insertAdjacentHTML('beforeend', createLightboxGalleryItems(selectedImages, galleryId));
                        });
                        editor.nodeChanged();
                        editor.dispatch('change');
                        lightboxGalleryToAppend = null;
                        const refreshImage = galleryToRefresh.querySelector(':scope > figure:last-child img');
                        lightboxManagerDialogApi?.close();
                        window.setTimeout(() => {
                            if (refreshImage?.isConnected) openLightboxImageDialog(refreshImage);
                        }, 0);
                    } else if (referenceInsertionMode === 'replace-lightbox' && lightboxImageToReplace?.isConnected) {
                        const replacement = selectedImages[0];
                        const replacementAnchor = lightboxImageToReplace.closest('a.glightbox2');
                        const replacementFigure = lightboxImageToReplace.closest('figure');
                        const replacementCaption = replacementFigure?.querySelector('figcaption');
                        const description = replacement.alt_text || replacement.title || '';

                        editor.undoManager.transact(() => {
                            editor.dom.setAttrib(lightboxImageToReplace, 'src', replacement.url);
                            editor.dom.setAttrib(lightboxImageToReplace, 'alt', description);
                            editor.dom.setAttrib(lightboxImageToReplace, 'title', replacement.title || '');
                            editor.dom.setAttrib(replacementAnchor, 'href', replacement.url);
                            editor.dom.setAttrib(replacementAnchor, 'data-glightbox', `description: ${description}`);
                            if (replacementCaption) replacementCaption.textContent = description;
                        });
                        editor.nodeChanged();
                        editor.dispatch('change');
                        const refreshImage = lightboxImageToReplace;
                        lightboxImageToReplace = null;
                        lightboxManagerDialogApi?.close();
                        window.setTimeout(() => {
                            if (refreshImage?.isConnected) openLightboxImageDialog(refreshImage);
                        }, 0);
                    } else if (referenceInsertionMode === 'lightbox') {
                        const galleryId = `story-gallery-${Date.now()}-${Math.random().toString(36).slice(2, 7)}`;
                        const galleryItems = createLightboxGalleryItems(selectedImages, galleryId);

                        insertAtomicContent(`<div class="story-content-gallery story-lightbox-gallery" data-story-gallery data-story-lightbox-gallery="${galleryId}" contenteditable="false" data-mce-contenteditable="false" style="width: 100%; margin: 24px 0; padding: 0; box-sizing: border-box;">${galleryItems}</div>`);
                    } else {
                        const image = selectedImages[0];
                        const imageUrl = editor.dom.encode(image.url);
                        const imageTitle = editor.dom.encode(image.title || '');
                        const imageDescription = editor.dom.encode(image.alt_text || image.title || '');
                        editor.insertContent(
                            `<figure class="media-caption story-single-image-figure" style="width: 100%; margin: 24px 0; padding: 0; box-sizing: border-box;"><div class="story-single-image" style="display: block; width: 100%; aspect-ratio: 16 / 9; margin: 0; padding: 0; overflow: hidden; background: #e5e7eb;"><img src="${imageUrl}" alt="${imageDescription}" title="${imageTitle}" style="display: block; width: 100%; height: 100%; aspect-ratio: 16 / 9; margin: 0; padding: 0; object-fit: cover; object-position: center;"></div>${imageDescription ? `<figcaption class="media-caption-text story-content-caption" style="margin: 4px 0 0; padding: 0; color: #000; font-size: 12px; font-weight: 400; line-height: 1.5;">${imageDescription}</figcaption>` : ''}</figure>`,
                        );
                    }

                    referenceInsertionMode = 'image';
                    closeReferencePickerModal(false);

                    try {
                        window.localStorage.removeItem(referenceStorageKey);
                    } catch (error) {
                        // The image is already inserted.
                    }

                    return true;
                };

                const openReferencePicker = (mode) => {
                    referenceInsertionMode = mode;

                    try {
                        window.localStorage.removeItem(referenceStorageKey);
                    } catch (error) {
                        // Opening the picker does not require browser storage.
                    }

                    const pickerUrl = new URL(wrapper.dataset.tinymceReferencePageUrl, window.location.origin);
                    pickerUrl.searchParams.set('modal', '1');
                    if (['lightbox', 'append-lightbox', 'before-after'].includes(mode)) pickerUrl.searchParams.set('multiple', '1');
                    if (mode === 'before-after') {
                        pickerUrl.searchParams.set('limit', '2');
                        pickerUrl.searchParams.set('purpose', 'before-after');
                    }

                    closeReferencePickerModal(false);

                    const overlay = document.createElement('div');
                    overlay.dataset.tinymceReferenceModal = '';
                    overlay.style.cssText = 'position:fixed;inset:0;z-index:100000;display:flex;align-items:center;justify-content:center;padding:20px;background:rgba(15,23,42,.68);';

                    const dialog = document.createElement('div');
                    dialog.setAttribute('role', 'dialog');
                    dialog.setAttribute('aria-modal', 'true');
                    dialog.setAttribute('aria-label', 'Pilih gambar dari Reference');
                    dialog.style.cssText = 'display:flex;width:min(1280px,96vw);height:min(860px,92vh);flex-direction:column;overflow:hidden;border:1px solid #d1d5db;background:#fff;box-shadow:0 24px 60px rgba(15,23,42,.3);';

                    const header = document.createElement('div');
                    header.style.cssText = 'display:flex;align-items:center;justify-content:space-between;gap:16px;border-bottom:1px solid #e5e7eb;padding:14px 18px;';
                    const heading = document.createElement('strong');
                    heading.textContent = mode === 'before-after' ? 'Pilih Gambar Before/After' : 'Pilih Gambar dari Reference';
                    heading.style.cssText = 'color:#111827;font:600 16px/1.4 Arial,sans-serif;';
                    const closeButton = document.createElement('button');
                    closeButton.type = 'button';
                    closeButton.setAttribute('aria-label', 'Tutup pemilih gambar');
                    closeButton.textContent = '×';
                    closeButton.style.cssText = 'width:36px;height:36px;border:0;background:#f3f4f6;color:#374151;font:400 26px/1 Arial,sans-serif;cursor:pointer;';

                    const iframe = document.createElement('iframe');
                    iframe.src = pickerUrl.toString();
                    iframe.title = 'Reference Simontini';
                    iframe.style.cssText = 'display:block;width:100%;height:100%;flex:1;border:0;background:#f9fafb;';

                    header.append(heading, closeButton);
                    dialog.append(header, iframe);
                    overlay.append(dialog);
                    document.body.append(overlay);

                    const previousBodyOverflow = document.body.style.overflow;
                    document.body.style.overflow = 'hidden';
                    const onKeydown = (event) => {
                        if (!['Escape', 'Esc'].includes(event.key) && event.keyCode !== 27) return;
                        event.preventDefault();
                        closeReferencePickerModal();
                    };
                    referencePickerModal = { element: overlay, previousBodyOverflow, onKeydown, iframeWindow: null };
                    document.addEventListener('keydown', onKeydown, true);
                    closeButton.addEventListener('click', () => closeReferencePickerModal());
                    overlay.addEventListener('pointerdown', (event) => {
                        if (event.target === overlay) closeReferencePickerModal();
                    });
                    iframe.addEventListener('load', () => {
                        if (!referencePickerModal?.element.isConnected) return;

                        referencePickerModal.iframeWindow = iframe.contentWindow;
                        referencePickerModal.iframeWindow?.addEventListener('keydown', onKeydown, true);
                        iframe.contentWindow?.focus();
                    });
                };

                const consumeStoredReference = () => {
                    try {
                        const stored = window.localStorage.getItem(referenceStorageKey);
                        if (stored) insertReferenceImage(JSON.parse(stored));
                    } catch (error) {
                        // Ignore unavailable storage or invalid data.
                    }
                };

                const openLightboxImageDialog = (imageElement) => {
                    if (lightboxManagerDialogApi) return;

                    const anchor = imageElement.closest('a.glightbox2');
                    const figure = imageElement.closest('figure');
                    const gallery = figure?.closest('.story-lightbox-gallery');
                    if (!anchor || !figure || !gallery) return;

                    const galleryFigures = Array.from(gallery.querySelectorAll(':scope > figure'));
                    const editorWindow = editor.getWin();
                    const editorScrollPosition = { x: editorWindow.scrollX, y: editorWindow.scrollY };
                    const pageScrollPosition = { x: window.scrollX, y: window.scrollY };
                    const dialogId = `lightbox-order-${Date.now()}-${Math.random().toString(36).slice(2, 7)}`;
                    let pendingFigures = [...galleryFigures];
                    const pendingCaptions = new Map(galleryFigures.map((galleryFigure) => [
                        galleryFigure,
                        galleryFigure.querySelector('figcaption')?.textContent?.trim() || '',
                    ]));
                    const thumbnailItems = galleryFigures.map((galleryFigure, index) => {
                        const thumbnail = galleryFigure.querySelector('img');
                        const thumbnailUrl = editor.dom.encode(thumbnail?.getAttribute('src') || '');
                        const itemCaption = editor.dom.encode(pendingCaptions.get(galleryFigure) || '');

                        return `<div data-lightbox-order-item data-figure-index="${index}" style="min-width: 0; overflow: visible; border: 1px solid #d1d5db; border-radius: 7px; background: #fff; padding: 12px;"><div style="display: flex; min-width: 0; align-items: center; gap: 10px;"><button type="button" draggable="true" data-lightbox-drag-handle title="Tarik untuk mengubah urutan" aria-label="Tarik gambar ke-${index + 1}" style="display: flex; width: 34px; height: 52px; flex: 0 0 34px; align-items: center; justify-content: center; border: 0; border-radius: 5px; background: #111827; color: #fff; font-size: 18px; line-height: 1; cursor: grab;">&#8942;&#8942;</button><img src="${thumbnailUrl}" alt="" style="display: block; width: 120px; height: 68px; flex: 0 0 120px; border-radius: 4px; object-fit: cover; pointer-events: none;"><div data-lightbox-order-label style="min-width: 0; flex: 1; color: #1f2937; font-size: 13px; font-weight: 700;">Gambar ke-${index + 1}</div><button type="button" data-lightbox-replace data-figure-index="${index}" style="border: 1px solid #376a64; border-radius: 5px; background: #fff; padding: 7px 11px; color: #376a64; font-size: 12px; font-weight: 700; cursor: pointer;">Ganti</button><button type="button" data-lightbox-remove data-figure-index="${index}" style="border: 1px solid #dc2626; border-radius: 5px; background: #fff; padding: 7px 11px; color: #dc2626; font-size: 12px; font-weight: 700; cursor: pointer;">Hapus</button></div><label style="display: block; margin-top: 10px; color: #4b5563; font-size: 12px; font-weight: 600;">Deskripsi gambar</label><textarea rows="2" data-lightbox-caption data-figure-index="${index}" placeholder="Tulis deskripsi gambar" style="display: block; width: 100%; min-height: 64px; margin: 5px 0 3px; box-sizing: border-box; resize: vertical; border: 1px solid #cbd5e1; border-radius: 5px; padding: 9px 10px; color: #1f2937; font-family: inherit; font-size: 13px; line-height: 1.45; outline: none;">${itemCaption}</textarea></div>`;
                    }).join('');

                    const applyPendingOrder = () => {
                        galleryFigures
                            .filter((galleryFigure) => !pendingFigures.includes(galleryFigure))
                            .forEach((galleryFigure) => galleryFigure.remove());
                        if (!pendingFigures.length) {
                            gallery.remove();
                            return;
                        }
                        pendingFigures.forEach((galleryFigure) => gallery.append(galleryFigure));
                    };

                    const applyImageDetails = () => {
                        editor.undoManager.transact(() => {
                            pendingFigures.forEach((galleryFigure) => {
                                const currentImage = galleryFigure.querySelector('img');
                                const currentAnchor = galleryFigure.querySelector('a.glightbox2');
                                const currentCaption = galleryFigure.querySelector('figcaption');
                                const description = pendingCaptions.get(galleryFigure) || '';

                                editor.dom.setAttrib(currentImage, 'alt', description);
                                editor.dom.setAttrib(currentAnchor, 'data-glightbox', `description: ${description}`);

                                if (description) {
                                    const caption = currentCaption || editor.getDoc().createElement('figcaption');
                                    caption.className = 'story-content-caption';
                                    caption.style.cssText = 'margin: 4px 0 0; padding: 0; color: #000; font-size: 12px; font-weight: 400; line-height: 1.5;';
                                    caption.textContent = description;
                                    if (!currentCaption) galleryFigure.append(caption);
                                } else {
                                    currentCaption?.remove();
                                }
                            });
                            applyPendingOrder();
                        });
                        editor.nodeChanged();
                        editor.dispatch('change');
                    };

                    let closeOnEscape = null;
                    let closeOnOutside = null;
                    let dialogElement = null;
                    let dialogClosed = false;
                    const escapeEventTargets = [window, document, editor.getWin(), editor.getDoc()]
                        .filter((target, index, targets) => target && targets.indexOf(target) === index);
                    const dialogApi = editor.windowManager.open({
                        title: 'Kelola Galeri GLightbox',
                        size: 'large',
                        body: {
                            type: 'panel',
                            items: [
                                {
                                    type: 'htmlpanel',
                                    html: `<div style="margin-bottom: 8px; color: #4b5563; font-size: 13px;">Galeri ini berisi <strong data-lightbox-image-count>${galleryFigures.length}</strong> gambar. Tarik pegangan hitam ke atas atau bawah untuk mengubah urutan.</div><div data-lightbox-order="${dialogId}" style="display: flex; max-height: 460px; flex-direction: column; gap: 10px; overflow-y: auto; margin-bottom: 12px; padding: 2px 7px 8px 2px;">${thumbnailItems}</div>`,
                                },
                            ],
                        },
                        buttons: [
                            { type: 'custom', name: 'append', text: 'Tambah Gambar' },
                            { type: 'cancel', text: 'Batal' },
                            { type: 'submit', text: 'Simpan', primary: true },
                        ],
                        onAction(api, details) {
                            if (details.name === 'append') {
                                applyImageDetails();
                                lightboxGalleryToAppend = gallery;
                                openReferencePicker('append-lightbox');
                            }

                        },
                        onSubmit(api) {
                            applyImageDetails();
                            api.close();
                        },
                        onClose() {
                            dialogClosed = true;
                            escapeEventTargets.forEach((target) => {
                                if (closeOnEscape) {
                                    target.removeEventListener('keydown', closeOnEscape, true);
                                    target.removeEventListener('keyup', closeOnEscape, true);
                                }
                            });
                            if (closeOnOutside) document.removeEventListener('pointerdown', closeOnOutside, true);
                            if (lightboxManagerDialogApi === dialogApi) lightboxManagerDialogApi = null;
                            preferredAtomicInsertionBlock = gallery;
                            const restoreEditorPosition = () => {
                                editorWindow.scrollTo(editorScrollPosition.x, editorScrollPosition.y);
                                window.scrollTo(pageScrollPosition.x, pageScrollPosition.y);
                            };
                            window.setTimeout(() => {
                                repaintEditorAfterAtomicDialog(gallery, editorScrollPosition);
                                restoreEditorPosition();
                            }, 0);
                        },
                    });
                    lightboxManagerDialogApi = dialogApi;

                    closeOnEscape = (event) => {
                        if (!['Escape', 'Esc'].includes(event.key) && event.keyCode !== 27) return;
                        if (dialogClosed) return;

                        event.preventDefault();
                        event.stopPropagation();
                        event.stopImmediatePropagation();
                        dialogApi.close();
                    };
                    escapeEventTargets.forEach((target) => {
                        target.addEventListener('keydown', closeOnEscape, true);
                        target.addEventListener('keyup', closeOnEscape, true);
                    });

                    const dialogWraps = document.querySelectorAll('.tox-dialog-wrap');
                    const currentDialogWrap = dialogWraps[dialogWraps.length - 1];
                    dialogElement = currentDialogWrap?.querySelector('.tox-dialog');
                    closeOnOutside = (event) => {
                        if (dialogElement?.contains(event.target)) return;
                        dialogApi.close();
                    };
                    document.addEventListener('pointerdown', closeOnOutside, true);

                    window.setTimeout(() => {
                        const orderContainer = document.querySelector(`[data-lightbox-order="${dialogId}"]`);
                        if (!orderContainer) return;

                        let draggedItem = null;

                        const syncPendingFigures = () => {
                            pendingFigures = Array.from(orderContainer.querySelectorAll('[data-lightbox-order-item]'))
                                .map((item) => galleryFigures[Number(item.dataset.figureIndex)])
                                .filter(Boolean);
                            orderContainer.querySelectorAll('[data-lightbox-order-item]').forEach((item, index) => {
                                const label = item.querySelector('[data-lightbox-order-label]');
                                if (label) label.textContent = `Gambar ke-${index + 1}`;
                            });
                            const count = document.querySelector('[data-lightbox-image-count]');
                            if (count) count.textContent = String(pendingFigures.length);
                        };

                        orderContainer.addEventListener('input', (event) => {
                            const captionInput = event.target.closest('[data-lightbox-caption]');
                            if (!captionInput) return;

                            const captionFigure = galleryFigures[Number(captionInput.dataset.figureIndex)];
                            if (captionFigure) pendingCaptions.set(captionFigure, captionInput.value);
                        });

                        orderContainer.addEventListener('click', (event) => {
                            const replaceButton = event.target.closest('[data-lightbox-replace]');
                            if (replaceButton) {
                                const targetFigure = galleryFigures[Number(replaceButton.dataset.figureIndex)];
                                const targetImage = targetFigure?.querySelector('img');
                                if (!targetImage) return;

                                applyImageDetails();
                                lightboxImageToReplace = targetImage;
                                openReferencePicker('replace-lightbox');
                                return;
                            }

                            const removeButton = event.target.closest('[data-lightbox-remove]');
                            if (!removeButton) return;

                            if (pendingFigures.length <= 1) {
                                window.alert('Galeri minimal memiliki satu gambar. Hapus blok GLightbox dari editor jika ingin menghapus seluruh galeri.');
                                return;
                            }

                            const targetFigure = galleryFigures[Number(removeButton.dataset.figureIndex)];
                            pendingFigures = pendingFigures.filter((galleryFigure) => galleryFigure !== targetFigure);
                            pendingCaptions.delete(targetFigure);
                            removeButton.closest('[data-lightbox-order-item]')?.remove();
                            syncPendingFigures();
                        });

                        orderContainer.addEventListener('dragstart', (event) => {
                            const handle = event.target.closest('[data-lightbox-drag-handle]');
                            if (!handle) {
                                event.preventDefault();
                                return;
                            }

                            draggedItem = handle.closest('[data-lightbox-order-item]');
                            draggedItem.style.opacity = '.55';
                            event.dataTransfer.effectAllowed = 'move';
                        });

                        orderContainer.addEventListener('dragover', (event) => {
                            const targetItem = event.target.closest('[data-lightbox-order-item]');
                            if (!draggedItem || !targetItem || targetItem === draggedItem) return;

                            event.preventDefault();
                            const bounds = targetItem.getBoundingClientRect();
                            const insertBefore = event.clientY < bounds.top + bounds.height / 2;
                            targetItem.parentNode.insertBefore(draggedItem, insertBefore ? targetItem : targetItem.nextSibling);
                            syncPendingFigures();
                        });

                        orderContainer.addEventListener('drop', (event) => {
                            event.preventDefault();
                            syncPendingFigures();
                        });

                        orderContainer.addEventListener('dragend', () => {
                            if (draggedItem) draggedItem.style.opacity = '1';
                            draggedItem = null;
                            syncPendingFigures();
                        });
                    }, 0);
                };

                const openBeforeAfterDialog = (figure) => {
                    if (!figure?.isConnected) return;

                    const beforeImage = figure.querySelector('.story-before-after-image--before');
                    const afterImage = figure.querySelector('.story-before-after-image--after');
                    if (!beforeImage || !afterImage) return;

                    const editorWindow = editor.getWin();
                    const editorScrollPosition = { x: editorWindow.scrollX, y: editorWindow.scrollY };
                    const pageScrollPosition = { x: window.scrollX, y: window.scrollY };
                    const dialogId = `before-after-manager-${Date.now()}-${Math.random().toString(36).slice(2, 7)}`;
                    let beforeDescription = beforeImage.getAttribute('alt') || '';
                    let afterDescription = afterImage.getAttribute('alt') || '';

                    const applyDetails = () => {
                        editor.undoManager.transact(() => {
                            editor.dom.setAttrib(beforeImage, 'alt', beforeDescription);
                            editor.dom.setAttrib(afterImage, 'alt', afterDescription);
                        });
                        editor.nodeChanged();
                        editor.dispatch('change');
                    };

                    const rowHtml = (side, image, description) => `<div style="border: 1px solid #d1d5db; border-radius: 7px; background: #fff; padding: 12px;"><div style="display: flex; align-items: center; gap: 12px;"><img data-before-after-preview="${side}" src="${editor.dom.encode(image.getAttribute('src') || '')}" alt="" style="display: block; width: 150px; height: 84px; flex: 0 0 150px; border-radius: 5px; object-fit: cover;"><strong style="flex: 1; color: #1f2937; font-size: 14px;">${side === 'before' ? 'Before' : 'After'}</strong><button type="button" data-before-after-replace="${side}" style="border: 1px solid #376a64; border-radius: 5px; background: #fff; padding: 8px 13px; color: #376a64; font-size: 12px; font-weight: 700; cursor: pointer;">Ganti Gambar</button></div><label style="display: block; margin-top: 10px; color: #4b5563; font-size: 12px; font-weight: 600;">Deskripsi ${side === 'before' ? 'Before' : 'After'}</label><textarea rows="2" data-before-after-description="${side}" style="display: block; width: 100%; min-height: 64px; margin-top: 5px; box-sizing: border-box; resize: vertical; border: 1px solid #cbd5e1; border-radius: 5px; padding: 9px 10px; font-family: inherit; font-size: 13px; line-height: 1.45;">${editor.dom.encode(description)}</textarea></div>`;

                    let closeOnEscape = null;
                    let closeOnOutside = null;
                    let dialogElement = null;
                    let dialogClosed = false;
                    const escapeEventTargets = [window, document, editor.getWin(), editor.getDoc()]
                        .filter((target, index, targets) => target && targets.indexOf(target) === index);
                    const dialogApi = editor.windowManager.open({
                        title: 'Kelola Before/After',
                        size: 'large',
                        body: {
                            type: 'panel',
                            items: [{
                                type: 'htmlpanel',
                                html: `<div data-before-after-manager="${dialogId}" style="display: flex; max-height: 510px; flex-direction: column; gap: 10px; overflow-y: auto; padding: 2px 7px 8px 2px;">${rowHtml('before', beforeImage, beforeDescription)}${rowHtml('after', afterImage, afterDescription)}</div>`,
                            }],
                        },
                        buttons: [
                            { type: 'custom', name: 'swap', text: 'Tukar Before/After' },
                            { type: 'cancel', text: 'Batal' },
                            { type: 'submit', text: 'Simpan', primary: true },
                        ],
                        onAction(api, details) {
                            if (details.name !== 'swap') return;

                            applyDetails();
                            editor.undoManager.transact(() => {
                                const beforeSrc = beforeImage.getAttribute('src');
                                const beforeAlt = beforeImage.getAttribute('alt');
                                editor.dom.setAttrib(beforeImage, 'src', afterImage.getAttribute('src'));
                                editor.dom.setAttrib(beforeImage, 'alt', afterImage.getAttribute('alt'));
                                editor.dom.setAttrib(afterImage, 'src', beforeSrc);
                                editor.dom.setAttrib(afterImage, 'alt', beforeAlt);
                            });
                            const previousBeforeDescription = beforeDescription;
                            beforeDescription = afterDescription;
                            afterDescription = previousBeforeDescription;

                            const manager = document.querySelector(`[data-before-after-manager="${dialogId}"]`);
                            const beforePreview = manager?.querySelector('[data-before-after-preview="before"]');
                            const afterPreview = manager?.querySelector('[data-before-after-preview="after"]');
                            const beforeField = manager?.querySelector('[data-before-after-description="before"]');
                            const afterField = manager?.querySelector('[data-before-after-description="after"]');
                            if (beforePreview) beforePreview.src = beforeImage.getAttribute('src') || '';
                            if (afterPreview) afterPreview.src = afterImage.getAttribute('src') || '';
                            if (beforeField) beforeField.value = beforeDescription;
                            if (afterField) afterField.value = afterDescription;

                            editor.dispatch('change');
                        },
                        onSubmit(api) {
                            applyDetails();
                            api.close();
                        },
                        onClose() {
                            dialogClosed = true;
                            escapeEventTargets.forEach((target) => {
                                if (closeOnEscape) {
                                    target.removeEventListener('keydown', closeOnEscape, true);
                                    target.removeEventListener('keyup', closeOnEscape, true);
                                }
                            });
                            if (closeOnOutside) document.removeEventListener('pointerdown', closeOnOutside, true);
                            if (beforeAfterManagerDialogApi === dialogApi) beforeAfterManagerDialogApi = null;
                            preferredAtomicInsertionBlock = figure;
                            window.setTimeout(() => {
                                repaintEditorAfterAtomicDialog(figure, editorScrollPosition);
                                window.scrollTo(pageScrollPosition.x, pageScrollPosition.y);
                            }, 0);
                        },
                    });
                    beforeAfterManagerDialogApi = dialogApi;

                    closeOnEscape = (event) => {
                        if (!['Escape', 'Esc'].includes(event.key) && event.keyCode !== 27) return;
                        if (dialogClosed) return;
                        event.preventDefault();
                        event.stopPropagation();
                        event.stopImmediatePropagation();
                        dialogApi.close();
                    };
                    escapeEventTargets.forEach((target) => {
                        target.addEventListener('keydown', closeOnEscape, true);
                        target.addEventListener('keyup', closeOnEscape, true);
                    });

                    const dialogWraps = document.querySelectorAll('.tox-dialog-wrap');
                    const currentDialogWrap = dialogWraps[dialogWraps.length - 1];
                    dialogElement = currentDialogWrap?.querySelector('.tox-dialog');
                    closeOnOutside = (event) => {
                        if (dialogElement?.contains(event.target)) return;
                        dialogApi.close();
                    };
                    document.addEventListener('pointerdown', closeOnOutside, true);

                    window.setTimeout(() => {
                        const manager = document.querySelector(`[data-before-after-manager="${dialogId}"]`);
                        if (!manager) return;

                        manager.addEventListener('input', (event) => {
                            const field = event.target.closest('[data-before-after-description]');
                            if (!field) return;
                            if (field.dataset.beforeAfterDescription === 'before') beforeDescription = field.value;
                            else afterDescription = field.value;
                        });

                        manager.addEventListener('click', (event) => {
                            const replaceButton = event.target.closest('[data-before-after-replace]');
                            if (!replaceButton) return;

                            applyDetails();
                            beforeAfterImageToReplace = { figure, side: replaceButton.dataset.beforeAfterReplace };
                            openReferencePicker('replace-before-after');
                        });
                    }, 0);
                };

                editor.ui.registry.addButton('addImage', {
                    text: '+ Image',
                    tooltip: 'Pilih gambar dari Reference',
                    onAction: () => openReferencePicker('image'),
                });
                editor.ui.registry.addButton('addLightbox', {
                    text: '+ GLightbox',
                    tooltip: 'Pilih gambar dari Reference dan buka sebagai lightbox',
                    onAction: () => openReferencePicker('lightbox'),
                });
                editor.ui.registry.addButton('addBeforeAfter', {
                    text: '+ Before/After',
                    tooltip: 'Bandingkan dua gambar dengan penggeser Before dan After',
                    onAction: () => openReferencePicker('before-after'),
                });
                editor.ui.registry.addButton('addDataVisualization', {
                    text: '+ Data/Grafik',
                    tooltip: 'Pilih Data & Grafik yang sudah dipublikasikan',
                    onAction: async () => {
                        const optionsUrl = wrapper.dataset.tinymceVisualizationOptionsUrl;
                        if (!optionsUrl) return;

                        let visualizations = [];
                        try {
                            const response = await fetch(optionsUrl, {
                                headers: { Accept: 'application/json' },
                                credentials: 'same-origin',
                            });
                            if (!response.ok) throw new Error('Gagal memuat Data & Grafik.');
                            const payload = await response.json();
                            visualizations = Array.isArray(payload.data) ? payload.data : [];
                        } catch (error) {
                            editor.notificationManager.open({
                                text: error.message || 'Gagal memuat Data & Grafik.',
                                type: 'error',
                            });
                            return;
                        }

                        if (!visualizations.length) {
                            editor.notificationManager.open({
                                text: 'Belum ada Data & Grafik aktif. Publikasikan grafik dari menu Data & Grafik terlebih dahulu.',
                                type: 'info',
                            });
                            return;
                        }

                        let selected = visualizations[0];
                        const previousBodyOverflow = document.body.style.overflow;
                        const modal = document.createElement('div');
                        modal.dataset.visualizationCardPicker = '';
                        modal.setAttribute('role', 'dialog');
                        modal.setAttribute('aria-modal', 'true');
                        modal.setAttribute('aria-label', 'Pilih Data dan Grafik');
                        Object.assign(modal.style, {
                            position: 'fixed',
                            inset: '0',
                            zIndex: '100000',
                            display: 'flex',
                            alignItems: 'center',
                            justifyContent: 'center',
                            padding: '16px',
                            background: 'rgba(15, 23, 42, .55)',
                        });

                        const panel = document.createElement('div');
                        Object.assign(panel.style, {
                            display: 'flex',
                            width: 'min(1400px, 100%)',
                            maxHeight: 'calc(100vh - 32px)',
                            flexDirection: 'column',
                            overflow: 'hidden',
                            border: '1px solid #dbe2e8',
                            background: '#fff',
                            boxShadow: '0 24px 70px rgba(15, 23, 42, .24)',
                        });

                        const header = document.createElement('div');
                        Object.assign(header.style, {
                            display: 'flex',
                            alignItems: 'center',
                            justifyContent: 'space-between',
                            gap: '16px',
                            padding: '16px 18px',
                            borderBottom: '1px solid #e5e7eb',
                        });
                        const heading = document.createElement('div');
                        heading.innerHTML = '<h2 style="margin:0;color:#111827;font-size:18px;font-weight:700;">Pilih Data &amp; Grafik</h2><p style="margin:4px 0 0;color:#6b7280;font-size:12px;">Klik salah satu card grafik aktif yang ingin dimasukkan.</p>';
                        const closeButton = document.createElement('button');
                        closeButton.type = 'button';
                        closeButton.setAttribute('aria-label', 'Tutup');
                        closeButton.textContent = '×';
                        Object.assign(closeButton.style, {
                            border: '0',
                            background: 'transparent',
                            color: '#374151',
                            fontSize: '26px',
                            lineHeight: '1',
                            cursor: 'pointer',
                        });
                        header.append(heading, closeButton);

                        const cardGrid = document.createElement('div');
                        Object.assign(cardGrid.style, {
                            display: 'grid',
                            gridTemplateColumns: 'repeat(4, minmax(0, 1fr))',
                            alignItems: 'start',
                            gap: '12px',
                            height: 'min(540px, calc(100vh - 250px))',
                            overflowY: 'auto',
                            padding: '16px 18px',
                            background: '#f8fafc',
                        });

                        const cards = [];
                        const pickerIframeWindows = [];
                        const previewObservers = [];
                        const visualizationsPerPage = 8;
                        let currentVisualizationPage = 1;
                        const updateVisualizationGridColumns = () => {
                            cardGrid.style.gridTemplateColumns = window.innerWidth >= 1100
                                ? 'repeat(4, minmax(0, 1fr))'
                                : window.innerWidth >= 650
                                    ? 'repeat(2, minmax(0, 1fr))'
                                    : 'minmax(0, 1fr)';
                        };
                        const updateSelectedCard = () => {
                            cards.forEach(({ card, badge, item }) => {
                                const isSelected = String(item.id) === String(selected.id);
                                card.setAttribute('aria-pressed', isSelected ? 'true' : 'false');
                                card.style.borderColor = isSelected ? '#376a64' : '#dbe2e8';
                                card.style.boxShadow = isSelected ? '0 0 0 2px rgba(55, 106, 100, .18)' : 'none';
                                badge.style.visibility = isSelected ? 'visible' : 'hidden';
                            });
                        };

                        visualizations.forEach((item) => {
                            const card = document.createElement('button');
                            card.type = 'button';
                            card.dataset.visualizationCard = String(item.id);
                            Object.assign(card.style, {
                                display: 'block',
                                minWidth: '0',
                                overflow: 'hidden',
                                padding: '0',
                                border: '1px solid #dbe2e8',
                                background: '#fff',
                                textAlign: 'left',
                                cursor: 'pointer',
                                outline: 'none',
                            });

                            const preview = document.createElement('div');
                            Object.assign(preview.style, {
                                position: 'relative',
                                width: '100%',
                                aspectRatio: '16 / 9',
                                overflow: 'hidden',
                                borderBottom: '1px solid #e5e7eb',
                                background: '#fff',
                            });
                            const iframe = document.createElement('iframe');
                            iframe.src = item.embed_url;
                            iframe.title = item.title || 'Preview Data dan Grafik';
                            iframe.loading = 'lazy';
                            iframe.scrolling = 'no';
                            iframe.tabIndex = -1;
                            Object.assign(iframe.style, {
                                position: 'absolute',
                                top: '0',
                                left: '0',
                                width: '960px',
                                height: '540px',
                                border: '0',
                                pointerEvents: 'none',
                                transformOrigin: 'top left',
                            });
                            const fitPreview = () => {
                                const scale = preview.clientWidth / 960;
                                iframe.style.transform = `scale(${scale})`;
                            };
                            if (typeof ResizeObserver !== 'undefined') {
                                const previewObserver = new ResizeObserver(fitPreview);
                                previewObserver.observe(preview);
                                previewObservers.push(previewObserver);
                            } else {
                                window.requestAnimationFrame(fitPreview);
                            }
                            iframe.addEventListener('load', () => {
                                const iframeWindow = iframe.contentWindow;
                                if (!iframeWindow) return;
                                pickerIframeWindows.push(iframeWindow);
                                iframeWindow.addEventListener('keydown', onPickerKeydown, true);
                            });
                            preview.append(iframe);

                            const details = document.createElement('div');
                            Object.assign(details.style, { padding: '10px 12px 12px' });
                            const meta = document.createElement('div');
                            Object.assign(meta.style, {
                                display: 'flex',
                                alignItems: 'center',
                                justifyContent: 'space-between',
                                gap: '10px',
                                marginBottom: '5px',
                            });
                            const type = document.createElement('span');
                            type.textContent = String(item.chart_type || 'Grafik').replaceAll('-', ' ');
                            Object.assign(type.style, {
                                color: '#376a64',
                                fontSize: '11px',
                                fontWeight: '700',
                                textTransform: 'uppercase',
                                letterSpacing: '.06em',
                            });
                            const badge = document.createElement('span');
                            badge.textContent = 'Dipilih';
                            Object.assign(badge.style, {
                                color: '#376a64',
                                fontSize: '11px',
                                fontWeight: '700',
                            });
                            meta.append(type, badge);
                            const title = document.createElement('strong');
                            title.textContent = item.title || 'Data & Grafik Simontini';
                            Object.assign(title.style, {
                                display: 'block',
                                overflow: 'hidden',
                                color: '#111827',
                                fontSize: '13px',
                                lineHeight: '1.45',
                                textOverflow: 'ellipsis',
                                whiteSpace: 'nowrap',
                            });
                            details.append(meta, title);
                            card.append(preview, details);
                            card.addEventListener('click', () => {
                                selected = item;
                                updateSelectedCard();
                            });
                            cards.push({ card, badge, item });
                            cardGrid.append(card);
                        });

                        const pagination = document.createElement('div');
                        Object.assign(pagination.style, {
                            display: 'flex',
                            alignItems: 'center',
                            justifyContent: 'space-between',
                            gap: '16px',
                            padding: '10px 18px',
                            borderTop: '1px solid #e5e7eb',
                            background: '#f8fafc',
                        });
                        const paginationSummary = document.createElement('span');
                        Object.assign(paginationSummary.style, {
                            color: '#6b7280',
                            fontSize: '12px',
                        });
                        const paginationButtons = document.createElement('div');
                        Object.assign(paginationButtons.style, {
                            display: 'flex',
                            alignItems: 'center',
                            gap: '6px',
                        });
                        pagination.append(paginationSummary, paginationButtons);

                        const renderVisualizationPage = () => {
                            const totalPages = Math.max(1, Math.ceil(cards.length / visualizationsPerPage));
                            currentVisualizationPage = Math.min(totalPages, Math.max(1, currentVisualizationPage));
                            const firstIndex = (currentVisualizationPage - 1) * visualizationsPerPage;
                            const lastIndex = Math.min(firstIndex + visualizationsPerPage, cards.length);

                            cards.forEach(({ card }, index) => {
                                card.style.display = index >= firstIndex && index < lastIndex ? 'block' : 'none';
                            });

                            paginationSummary.textContent = `Menampilkan ${firstIndex + 1}–${lastIndex} dari ${cards.length} data`;
                            paginationButtons.replaceChildren();

                            const createPageButton = (label, page, disabled = false, active = false) => {
                                const button = document.createElement('button');
                                button.type = 'button';
                                button.textContent = label;
                                button.disabled = disabled;
                                button.setAttribute('aria-label', label === '‹' ? 'Halaman sebelumnya' : label === '›' ? 'Halaman berikutnya' : `Halaman ${label}`);
                                if (active) button.setAttribute('aria-current', 'page');
                                Object.assign(button.style, {
                                    display: 'inline-flex',
                                    width: '32px',
                                    height: '32px',
                                    alignItems: 'center',
                                    justifyContent: 'center',
                                    border: `1px solid ${active ? '#376a64' : '#d1d5db'}`,
                                    background: active ? '#376a64' : '#fff',
                                    color: active ? '#fff' : disabled ? '#9ca3af' : '#374151',
                                    fontSize: '12px',
                                    fontWeight: '700',
                                    cursor: disabled ? 'not-allowed' : 'pointer',
                                });
                                if (!disabled) {
                                    button.addEventListener('click', () => {
                                        currentVisualizationPage = page;
                                        renderVisualizationPage();
                                        cardGrid.scrollTop = 0;
                                    });
                                }
                                return button;
                            };

                            paginationButtons.append(createPageButton('‹', currentVisualizationPage - 1, currentVisualizationPage === 1));
                            for (let page = 1; page <= totalPages; page += 1) {
                                paginationButtons.append(createPageButton(String(page), page, false, page === currentVisualizationPage));
                            }
                            paginationButtons.append(createPageButton('›', currentVisualizationPage + 1, currentVisualizationPage === totalPages));
                        };

                        const footer = document.createElement('div');
                        Object.assign(footer.style, {
                            display: 'flex',
                            justifyContent: 'flex-end',
                            gap: '10px',
                            padding: '12px 18px',
                            borderTop: '1px solid #e5e7eb',
                            background: '#fff',
                        });
                        const cancelButton = document.createElement('button');
                        cancelButton.type = 'button';
                        cancelButton.textContent = 'Batal';
                        const insertButton = document.createElement('button');
                        insertButton.type = 'button';
                        insertButton.textContent = 'Masukkan Grafik';
                        [cancelButton, insertButton].forEach((button) => {
                            Object.assign(button.style, {
                                minHeight: '38px',
                                padding: '0 15px',
                                border: '1px solid #d1d5db',
                                background: '#fff',
                                color: '#1f2937',
                                fontSize: '13px',
                                fontWeight: '700',
                                cursor: 'pointer',
                            });
                        });
                        Object.assign(insertButton.style, {
                            borderColor: '#376a64',
                            background: '#376a64',
                            color: '#fff',
                        });
                        footer.append(cancelButton, insertButton);
                        panel.append(header, cardGrid, pagination, footer);
                        modal.append(panel);

                        const closePicker = () => {
                            if (!modal.isConnected) return;
                            document.removeEventListener('keydown', onPickerKeydown, true);
                            window.removeEventListener('keydown', onPickerKeydown, true);
                            window.removeEventListener('resize', updateVisualizationGridColumns);
                            pickerIframeWindows.forEach((iframeWindow) => {
                                iframeWindow.removeEventListener('keydown', onPickerKeydown, true);
                            });
                            previewObservers.forEach((observer) => observer.disconnect());
                            document.body.style.overflow = previousBodyOverflow;
                            modal.remove();
                            editor.focus();
                        };
                        const onPickerKeydown = (event) => {
                            if (event.key !== 'Escape') return;
                            event.preventDefault();
                            event.stopPropagation();
                            closePicker();
                        };
                        closeButton.addEventListener('click', closePicker);
                        cancelButton.addEventListener('click', closePicker);
                        modal.addEventListener('click', (event) => {
                            if (event.target === modal) closePicker();
                        });
                        insertButton.addEventListener('click', () => {
                            const embedUrl = editor.dom.encode(selected.embed_url);
                            const title = editor.dom.encode(selected.title || 'Data & Grafik Simontini');
                            insertAtomicContent(`<figure class="story-data-visualization" data-story-data-visualization data-visualization-id="${selected.id}" contenteditable="false" style="display:block;width:100%;margin:24px 0;padding:0;"><div style="position:relative;width:100%;aspect-ratio:16 / 9;overflow:hidden;background:#fff;"><iframe src="${embedUrl}" title="${title}" width="100%" height="100%" frameborder="0" scrolling="no" loading="lazy" style="position:absolute;inset:0;display:block;width:100%;height:100%;border:0;overflow:hidden;" referrerpolicy="strict-origin-when-cross-origin"></iframe></div></figure>`);
                            normalizeAtomicStoryBlocks();
                            closePicker();
                        });

                        updateSelectedCard();
                        updateVisualizationGridColumns();
                        renderVisualizationPage();
                        document.addEventListener('keydown', onPickerKeydown, true);
                        window.addEventListener('keydown', onPickerKeydown, true);
                        window.addEventListener('resize', updateVisualizationGridColumns, { passive: true });
                        document.body.style.overflow = 'hidden';
                        document.body.append(modal);
                        cards[0]?.card.focus();
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
                editor.ui.registry.addButton('addStopper', {
                    text: '+ Stopper',
                    tooltip: 'Tambahkan kotak merah di ujung kalimat',
                    onAction: () => {
                        editor.focus();
                        editor.undoManager.transact(() => {
                            editor.insertContent('<span class="story-inline-stopper" data-story-inline-stopper="true" contenteditable="false" aria-hidden="true" style="display:inline-block;width:.7em;height:.7em;margin-left:1px;background:#FF0000;vertical-align:middle;line-height:1;">&nbsp;</span>');
                        });
                        editor.nodeChanged();
                    },
                });
                editor.on('init', () => {
                    editor.setContent(input.value || editorElement.value || '');
                    normalizeInlineStoppers();
                    normalizeAtomicStoryBlocks();
                    installBeforeAfterPointerControls();
                    wrapper.tinyMceEditor = editor;
                });
                editor.on('change input undo redo blur', () => {
                    input.value = editor.getContent();
                    input.dispatchEvent(new Event('input', { bubbles: true }));
                    input.dispatchEvent(new Event('change', { bubbles: true }));
                });
                editor.on('click', (event) => {
                    const selectionNode = editor.selection.getNode();
                    const clickedBeforeAfter = event.target?.closest?.('.story-before-after-figure')
                        || selectionNode?.closest?.('.story-before-after-figure')
                        || (selectionNode?.matches?.('.story-before-after-figure') ? selectionNode : null);
                    if (clickedBeforeAfter) {
                        const clickedHandleBounds = clickedBeforeAfter
                            .querySelector('.story-before-after-handle')
                            ?.getBoundingClientRect();
                        const clickedOnHandle = Boolean(clickedHandleBounds)
                            && event.clientX >= clickedHandleBounds.left - 12
                            && event.clientX <= clickedHandleBounds.right + 12
                            && event.clientY >= clickedHandleBounds.top - 12
                            && event.clientY <= clickedHandleBounds.bottom + 12;
                        if (
                            clickedOnHandle
                            || (
                                suppressedBeforeAfterClick?.figure === clickedBeforeAfter
                                && Date.now() <= suppressedBeforeAfterClick.until
                            )
                        ) {
                            suppressedBeforeAfterClick = null;
                            event.preventDefault();
                            event.stopPropagation();
                            return;
                        }
                        event.preventDefault();
                        openBeforeAfterDialog(clickedBeforeAfter);
                        return;
                    }

                    const clickedGallery = event.target?.closest?.('.story-lightbox-gallery')
                        || selectionNode?.closest?.('.story-lightbox-gallery')
                        || (selectionNode?.matches?.('.story-lightbox-gallery') ? selectionNode : null);
                    const image = clickedGallery?.querySelector('a.glightbox2 img');
                    if (!image) {
                        preferredAtomicInsertionBlock = null;
                        return;
                    }

                    event.preventDefault();
                    openLightboxImageDialog(image);
                });
                editor.on('input change', (event) => {
                    const range = event.target?.closest?.('[data-before-after-range]');
                    const comparison = range?.closest?.('[data-story-before-after]');
                    if (range && comparison) comparison.style.setProperty('--before-after-position', `${range.value}%`);
                });
                editor.on('keydown', (event) => {
                    if (event.key !== 'Enter') return;
                    if (!placeCaretAfterAtomicBlock()) return;

                    event.preventDefault();
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

const initializePublicStoryGalleries = () => {
    document.querySelectorAll('.public-story-content .story-content-gallery, .public-story-content .story-lightbox-gallery').forEach((gallery) => {
        if (gallery.hasAttribute('data-story-lightbox-gallery')) {
            gallery.classList.add('story-content-gallery');
            gallery.style.removeProperty('display');
            gallery.style.removeProperty('grid-template-columns');
            gallery.style.removeProperty('gap');
            gallery.querySelectorAll(':scope > figure').forEach((figure) => figure.classList.add('story-content-figure'));
        }

        if (gallery.dataset.storyGalleryInitialized === 'true') return;

        const slides = Array.from(gallery.querySelectorAll(':scope > .story-content-figure'));
        if (slides.length < 2) return;

        const shell = document.createElement('div');
        const previous = document.createElement('button');
        const next = document.createElement('button');
        const counter = document.createElement('span');
        let activeIndex = 0;
        let scrollFrame = null;
        let dragging = false;
        let dragStartX = 0;
        let dragStartScrollLeft = 0;

        const isLightboxGallery = gallery.hasAttribute('data-story-lightbox-gallery');

        shell.className = isLightboxGallery
            ? 'story-gallery-shell story-gallery-shell--lightbox'
            : 'story-gallery-shell';
        gallery.before(shell);
        shell.append(gallery);

        previous.type = 'button';
        previous.className = 'story-gallery-button story-gallery-button--previous';
        previous.innerHTML = isLightboxGallery ? '&laquo;' : '&#8249;';
        previous.setAttribute('aria-label', 'Gambar sebelumnya');

        next.type = 'button';
        next.className = 'story-gallery-button story-gallery-button--next';
        next.innerHTML = isLightboxGallery ? '&raquo;' : '&#8250;';
        next.setAttribute('aria-label', 'Gambar berikutnya');

        counter.className = 'story-gallery-counter';
        counter.setAttribute('aria-live', 'polite');

        shell.append(previous, next, counter);
        gallery.dataset.storyGalleryInitialized = 'true';
        gallery.setAttribute('role', 'region');
        gallery.setAttribute('aria-label', 'Galeri gambar story');
        gallery.setAttribute('tabindex', '0');
        gallery.querySelectorAll('img').forEach((image) => image.setAttribute('draggable', 'false'));

        const updateControls = () => {
            const slideWidth = gallery.clientWidth || 1;
            activeIndex = Math.max(0, Math.min(slides.length - 1, Math.round(gallery.scrollLeft / slideWidth)));
            previous.disabled = activeIndex === 0;
            next.disabled = activeIndex === slides.length - 1;
            counter.textContent = `${activeIndex + 1} / ${slides.length}`;
        };

        const goTo = (index) => {
            const targetIndex = Math.max(0, Math.min(slides.length - 1, index));
            gallery.scrollTo({ left: slides[targetIndex].offsetLeft - gallery.offsetLeft, behavior: 'smooth' });
        };

        previous.addEventListener('click', () => goTo(activeIndex - 1));
        next.addEventListener('click', () => goTo(activeIndex + 1));
        gallery.addEventListener('keydown', (event) => {
            if (event.key === 'ArrowLeft') {
                event.preventDefault();
                goTo(activeIndex - 1);
            }
            if (event.key === 'ArrowRight') {
                event.preventDefault();
                goTo(activeIndex + 1);
            }
        });
        gallery.addEventListener('scroll', () => {
            if (scrollFrame !== null) window.cancelAnimationFrame(scrollFrame);
            scrollFrame = window.requestAnimationFrame(updateControls);
        }, { passive: true });
        gallery.addEventListener('pointerdown', (event) => {
            if (event.button !== 0) return;
            if (event.target.closest('a.glightbox2')) return;
            dragging = true;
            dragStartX = event.clientX;
            dragStartScrollLeft = gallery.scrollLeft;
            gallery.classList.add('is-dragging');
            gallery.setPointerCapture(event.pointerId);
        });
        gallery.addEventListener('pointermove', (event) => {
            if (!dragging) return;
            gallery.scrollLeft = dragStartScrollLeft - (event.clientX - dragStartX);
        });
        const stopDragging = (event) => {
            if (!dragging) return;
            dragging = false;
            gallery.classList.remove('is-dragging');
            if (gallery.hasPointerCapture(event.pointerId)) gallery.releasePointerCapture(event.pointerId);
            goTo(Math.round(gallery.scrollLeft / (gallery.clientWidth || 1)));
        };
        gallery.addEventListener('pointerup', stopDragging);
        gallery.addEventListener('pointercancel', stopDragging);

        updateControls();
    });
};

let publicStoryLightbox = null;

const initializePublicBeforeAfter = () => {
    document.querySelectorAll('.public-story-content [data-story-before-after]').forEach((comparison) => {
        if (comparison.dataset.beforeAfterInitialized === 'true') return;

        const range = comparison.querySelector('[data-before-after-range]');
        if (!range) return;

        const updatePosition = () => comparison.style.setProperty('--before-after-position', `${range.value}%`);
        range.addEventListener('input', updatePosition);
        range.addEventListener('change', updatePosition);
        comparison.dataset.beforeAfterInitialized = 'true';
        updatePosition();
    });
};

const initializePublicStoryLightbox = () => {
    publicStoryLightbox?.destroy();
    publicStoryLightbox = null;

    if (!document.querySelector('.public-story-content .glightbox2')) return;

    publicStoryLightbox = GLightbox({
        selector: '.public-story-content .glightbox2',
        loop: false,
        touchNavigation: true,
        keyboardNavigation: true,
        openEffect: 'fade',
        closeEffect: 'fade',
    });
};

if (document.readyState === 'loading') {
    document.addEventListener('DOMContentLoaded', initializePublicStoryGalleries);
    document.addEventListener('DOMContentLoaded', initializePublicStoryLightbox);
    document.addEventListener('DOMContentLoaded', initializePublicBeforeAfter);
} else {
    initializePublicStoryGalleries();
    initializePublicStoryLightbox();
    initializePublicBeforeAfter();
}

document.addEventListener('livewire:navigated', initializePublicStoryGalleries);
document.addEventListener('livewire:navigated', initializePublicStoryLightbox);
document.addEventListener('livewire:navigated', initializePublicBeforeAfter);
window.addEventListener('resize', initializePublicStoryGalleries);

window.tinymce = tinymce;

const keepSubmittedCommentInView = () => {
    if (submittedCommentPositionApplied) return;

    const url = new URL(window.location.href);
    const hasLegacyCommentMarker = url.searchParams.get('comment') === 'sent' || url.searchParams.has('comment_id');

    if (hasLegacyCommentMarker) {
        url.searchParams.delete('comment');
        url.searchParams.delete('comment_id');
        if (/^#comment-\d+$/.test(url.hash)) url.hash = '';
        window.history.replaceState(window.history.state, '', `${url.pathname}${url.search}${url.hash}`);
    }

    if (window.location.hash !== '#comments') return;

    const comments = document.getElementById('comments');
    if (!comments) return;

    const scrollToComments = () => {
        window.setTimeout(() => {
            const top = comments.getBoundingClientRect().top + window.scrollY - 96;
            window.scrollTo({ top: Math.max(0, top), behavior: 'auto' });
            submittedCommentPositionApplied = true;
        }, 0);
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

const referenceGallerySelection = new Map();

const updateReferenceGalleryControls = () => {
    const panel = document.querySelector('[data-reference-gallery-panel]');
    const count = document.querySelector('[data-reference-gallery-count]');
    const insertButton = document.querySelector('[data-reference-gallery-insert]');
    const exactSelection = Number(panel?.dataset.referenceSelectionExact || 0);
    if (panel) panel.hidden = referenceGallerySelection.size === 0;
    if (count) count.textContent = String(referenceGallerySelection.size);
    if (insertButton && exactSelection > 0) {
        insertButton.disabled = referenceGallerySelection.size !== exactSelection;
        insertButton.style.opacity = insertButton.disabled ? '.5' : '1';
        insertButton.style.cursor = insertButton.disabled ? 'not-allowed' : 'pointer';
    }
};

document.addEventListener('input', (event) => {
    const input = event.target.closest('[data-reference-gallery-caption]');
    if (!input) return;

    const selected = referenceGallerySelection.get(input.dataset.referenceId);
    if (selected) selected.caption = input.value;
});

document.addEventListener('click', (event) => {
    const galleryToggle = event.target.closest('[data-reference-gallery-toggle]');
    if (galleryToggle) {
        event.preventDefault();
        const referenceId = galleryToggle.dataset.referenceId;

        if (referenceGallerySelection.has(referenceId)) {
            referenceGallerySelection.delete(referenceId);
            galleryToggle.setAttribute('aria-pressed', 'false');
            galleryToggle.textContent = 'Tambah ke Galeri';
            galleryToggle.classList.remove('bg-[#8B2A1A]');
            galleryToggle.classList.add('bg-[#376A64]');
        } else {
            const selectionLimit = Number(document.querySelector('[data-reference-gallery-panel]')?.dataset.referenceSelectionLimit || 0);
            if (selectionLimit > 0 && referenceGallerySelection.size >= selectionLimit) {
                window.alert(`Maksimal pilih ${selectionLimit} gambar.`);
                return;
            }

            const captionInput = document.querySelector(`[data-reference-gallery-caption][data-reference-id="${CSS.escape(referenceId)}"]`);
            referenceGallerySelection.set(referenceId, {
                url: galleryToggle.dataset.imageUrl,
                title: galleryToggle.dataset.imageTitle,
                alt_text: galleryToggle.dataset.imageAlt,
                caption: captionInput?.value || galleryToggle.dataset.imageAlt || galleryToggle.dataset.imageTitle,
            });
            galleryToggle.setAttribute('aria-pressed', 'true');
            galleryToggle.textContent = 'Batalkan Pilihan';
            galleryToggle.classList.remove('bg-[#376A64]');
            galleryToggle.classList.add('bg-[#8B2A1A]');
        }

        updateReferenceGalleryControls();
        return;
    }

    const galleryInsert = event.target.closest('[data-reference-gallery-insert]');
    if (galleryInsert) {
        event.preventDefault();
        if (!referenceGallerySelection.size) return;

        const payload = {
            type: 'simontini-reference-gallery-selected',
            editor: galleryInsert.dataset.editorKey,
            images: Array.from(referenceGallerySelection.values()),
            selectedAt: Date.now(),
        };

        try {
            window.localStorage.setItem(`simontini-tiptap-selection:${payload.editor}`, JSON.stringify(payload));
        } catch (error) {
            // postMessage below remains available when browser storage is restricted.
        }

        if (window.opener && !window.opener.closed) {
            window.opener.postMessage(payload, window.location.origin);
            window.setTimeout(() => window.close(), 100);
        } else if (window.parent !== window) {
            window.parent.postMessage(payload, window.location.origin);
        }
        return;
    }

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
        window.setTimeout(() => window.close(), 100);
    } else if (window.parent !== window) {
        window.parent.postMessage(payload, window.location.origin);
    }
});

document.addEventListener('submit', async (event) => {
    const form = event.target.closest('[data-comment-ajax-form]');
    if (!form) return;

    event.preventDefault();

    const submitButton = form.querySelector('[type="submit"]');
    const feedback = form.querySelector('[data-comment-feedback]') || document.querySelector('[data-comment-feedback]');
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
            feedback.textContent = '';
            feedback.className = 'hidden';
        }

        pendingSubmittedComment = {
            commentId: Number(payload.comment_id),
            parentId: payload.parent_id ? Number(payload.parent_id) : null,
        };

        if (parentId) {
            form.closest('[data-comment-reply-panel]')?.classList.add('hidden');
            window.dispatchEvent(new CustomEvent('reply-turnstile-expired', {
                detail: { id: Number(parentId) },
            }));
            window.setTimeout(updateCommentThreadLines, 50);
        } else {
            const quick = form.matches('[data-quick-comment-form]');
            if (quick) form.reset();
            window.dispatchEvent(new CustomEvent('comment-submitted', { detail: { quick } }));
            window.dispatchEvent(new CustomEvent(quick
                ? 'quick-comment-turnstile-expired'
                : 'comment-turnstile-expired'));
        }

        const turnstileWidget = form.querySelector('.cf-turnstile');
        if (window.turnstile && turnstileWidget) {
            try {
                window.turnstile.reset(turnstileWidget);
            } catch (error) {
                // A fresh challenge will be rendered on the next interaction.
            }
        }

        window.Livewire?.dispatch('comment-created', { commentId: Number(payload.comment_id) });
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
    if (submitButton) {
        submitButton.dataset.originalLabel = submitButton.textContent;
        submitButton.textContent = form.dataset.loadingLabel || 'Memproses...';
        submitButton.disabled = true;
        submitButton.setAttribute('aria-busy', 'true');
    }

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
        if (submitButton) {
            submitButton.textContent = submitButton.dataset.originalLabel || submitButton.textContent;
            submitButton.disabled = false;
            submitButton.removeAttribute('aria-busy');
        }
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

const openIntendedCommentReply = () => {
    const replyTo = new URLSearchParams(window.location.search).get('reply_to');

    if (!replyTo || !/^\d+$/.test(replyTo)) return;

    const panel = document.querySelector(`[data-comment-reply-panel="${replyTo}"]`);
    const toggle = document.querySelector(`[data-comment-reply-toggle="${replyTo}"]`);

    if (!panel || !toggle) return;

    panel.classList.remove('hidden');
    toggle.setAttribute('aria-expanded', 'true');
    window.setTimeout(() => {
        document.getElementById(`comment-${replyTo}`)?.scrollIntoView({ behavior: 'smooth', block: 'center' });
        panel.querySelector('[name="display_name"]')?.focus();
        updateCommentThreadLines();
    }, 100);
};

document.addEventListener('click', (event) => {
    if (event.target.closest('[data-comment-replies-toggle]')) {
        window.setTimeout(updateCommentThreadLines, 250);
    }
});

window.addEventListener('resize', updateCommentThreadLines);

if (document.readyState === 'loading') {
    document.addEventListener('DOMContentLoaded', () => {
        updateCommentThreadLines();
        openIntendedCommentReply();
    });
} else {
    updateCommentThreadLines();
    openIntendedCommentReply();
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
        case 'insertStoryGallery': chain.insertContent(storyGalleryTemplate).run(); break;
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
                StoryGallery,
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
        let referenceImagePosition = null;

        const insertReferenceImage = (payload) => {
            if (
                payload?.type !== 'simontini-reference-selected'
                || payload.editor !== wrapper.dataset.tiptapPickerId
                || !payload.image?.url
                || (payload.selectedAt && payload.selectedAt <= lastReferenceSelection)
            ) return false;

            lastReferenceSelection = payload.selectedAt || Date.now();

            const imageAttributes = {
                src: payload.image.url,
                alt: payload.image.alt_text || payload.image.title,
                title: payload.image.title,
                width: '100%',
                height: 'auto',
            };
            const imageChain = editor.chain().focus();

            if (referenceImagePosition !== null) {
                imageChain
                    .setNodeSelection(referenceImagePosition)
                    .updateAttributes('image', imageAttributes)
                    .run();
            } else {
                imageChain.setImage(imageAttributes).run();
            }

            referenceImagePosition = null;

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
            referenceImagePosition = editor.isActive('image')
                ? editor.state.selection.from
                : null;
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
    // `morphed` runs once after the whole component is updated. Using
    // `morph.updated` here runs once for every changed DOM element and can
    // repeatedly initialize editors/Turnstile after one comment submission.
    window.Livewire?.hook('morphed', () => {
        window.setTimeout(() => {
            initializeTiptapEditors();
            initializeTinyMceEditors();
            syncContentEditorsFromInputs();
            window.initializeCommentTurnstiles?.();
            showPendingSubmittedComment();
        }, 0);
    });
    window.Livewire?.hook('morph.removing', ({ el }) => {
        const turnstileElements = [];
        if (el.matches?.('[data-turnstile-widget-id]')) turnstileElements.push(el);
        el.querySelectorAll?.('[data-turnstile-widget-id]').forEach((element) => turnstileElements.push(element));
        turnstileElements.forEach((element) => {
            try {
                window.turnstile?.remove(element.dataset.turnstileWidgetId);
            } catch (error) {
                // The widget may already have been removed by Cloudflare.
            }
        });
        el.querySelectorAll?.('[data-tiptap-wrapper]').forEach((wrapper) => {
            wrapper.tiptapEditor?.destroy();
        });
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

    if (!trigger) {
        document.querySelectorAll('[data-comment-reply-panel]:not(.hidden)').forEach((panel) => {
            if (panel.contains(event.target)) return;

            const commentId = panel.dataset.commentReplyPanel;
            panel.classList.add('hidden');
            document.querySelector(`[data-comment-reply-toggle="${commentId}"]`)
                ?.setAttribute('aria-expanded', 'false');
        });

        window.setTimeout(updateCommentThreadLines, 250);

        return;
    }

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
