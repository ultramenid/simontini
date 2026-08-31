<?php

use App\Livewire\DataVisualizationForm;
use App\Livewire\DataVisualizationIndex;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Support\Facades\DB;
use Livewire\Livewire;

uses(DatabaseTransactions::class);

it('renders the protected data and chart CMS page as a table', function () {
    $this->withSession(['id' => 1])
        ->get('/cms/data-visualizations')
        ->assertOk()
        ->assertSee('Data &amp; Grafik', false)
        ->assertSee('<table', false)
        ->assertSee('Tampilan daftar')
        ->assertSee('Tampilan card')
        ->assertSee('data-card-chart', false)
        ->assertSee('Tambah Data &amp; Grafik', false);
});

it('shows twelve data visualization cards per page', function () {
    $now = now();

    DB::table('data_visualizations')->insert(
        collect(range(1, 13))->map(fn ($index) => [
            'title' => sprintf('Visualisasi %02d', $index),
            'description' => 'Data contoh',
            'provider' => 'internal',
            'chart_type' => 'column',
            'chart_data' => json_encode(['columns' => ['Bulan', 'Nilai'], 'rows' => [['Januari', (string) $index]]]),
            'is_active' => true,
            'created_at' => $now,
            'updated_at' => $now,
        ])->all()
    );

    $response = $this->withSession(['id' => 1])
        ->get('/cms/data-visualizations')
        ->assertOk()
        ->assertSee('Visualisasi 13')
        ->assertSee('Visualisasi 02')
        ->assertDontSee('Visualisasi 01');

    expect(substr_count($response->getContent(), 'data-visualization-card-'))->toBe(12);
});

it('opens a separate add page from the table', function () {
    $this->withSession(['id' => 1])
        ->get('/cms/data-visualizations')
        ->assertSee(route('cms.data-visualizations.add'), false);

    $this->withSession(['id' => 1])
        ->get('/cms/data-visualizations/add')
        ->assertOk()
        ->assertSee('Tambah Data &amp; Grafik', false)
        ->assertSee('+ Kolom')
        ->assertSee('Preview');
});

it('requires a title but allows mixed and empty table cells', function () {
    Livewire::test(DataVisualizationForm::class)
        ->set('columns', ['', 'Data campuran'])
        ->set('rows', [['', 'bukan-angka'], ['2026', '']])
        ->call('save')
        ->assertHasErrors(['title' => 'required'])
        ->assertHasNoErrors(['columns.0', 'rows.0.0', 'rows.0.1', 'rows.1.1']);
});

it('stores letters numbers and empty cells in the same table', function () {
    Livewire::test(DataVisualizationForm::class)
        ->set('title', 'Data Campuran')
        ->set('columns', ['Periode', 'Keterangan', 'Nilai'])
        ->set('rows', [['2025', 'Hutan', '220'], ['2026', '', '']])
        ->call('save')
        ->assertHasNoErrors();

    $item = DB::table('data_visualizations')->where('title', 'Data Campuran')->first();
    $data = json_decode($item->chart_data, true);

    expect($data['rows'])->toBe([['2025', 'Hutan', '220'], ['2026', '', '']]);
});

it('stores optional top bottom text and legend settings', function () {
    Livewire::test(DataVisualizationForm::class)
        ->set('title', 'Grafik dengan Keterangan')
        ->set('top_text', 'Luas Deforestasi Bulanan')
        ->set('top_align', 'left')
        ->set('top_font_size', 28)
        ->set('top_font_weight', '900')
        ->set('top_font_family', 'Georgia')
        ->set('top_italic', true)
        ->set('bottom_text', 'Sumber: Simontini 2026')
        ->set('bottom_align', 'right')
        ->set('bottom_font_size', 12)
        ->set('bottom_font_weight', '600')
        ->set('bottom_font_family', 'Arial')
        ->set('bottom_italic', true)
        ->set('show_legend', false)
        ->set('legend_position', 'top')
        ->set('columns', ['Bulan', 'Hektare'])
        ->set('rows', [['Januari', '220']])
        ->call('save')
        ->assertHasNoErrors();

    $item = DB::table('data_visualizations')->where('title', 'Grafik dengan Keterangan')->first();
    $data = json_decode($item->chart_data, true);

    expect($data)
        ->top_text->toBe('Luas Deforestasi Bulanan')
        ->top_align->toBe('left')
        ->top_font_size->toBe(28)
        ->top_font_weight->toBe('900')
        ->top_font_family->toBe('Georgia')
        ->top_italic->toBeTrue()
        ->bottom_text->toBe('Sumber: Simontini 2026')
        ->bottom_align->toBe('right')
        ->bottom_font_size->toBe(12)
        ->bottom_font_weight->toBe('600')
        ->bottom_font_family->toBe('Arial')
        ->bottom_italic->toBeTrue()
        ->show_legend->toBeFalse()
        ->legend_position->toBe('top');
});

it('creates a chart from table data', function () {
    Livewire::test(DataVisualizationForm::class)
        ->set('title', 'Tren Deforestasi')
        ->set('description', 'Grafik tren tahunan')
        ->set('chart_type', 'line')
        ->set('columns', ['Tahun', 'Deforestasi'])
        ->set('rows', [['2024', '3304'], ['2025', '3739']])
        ->call('save')
        ->assertHasNoErrors();

    $item = DB::table('data_visualizations')->where('title', 'Tren Deforestasi')->first();
    $data = json_decode($item->chart_data, true);

    expect($item->chart_type)->toBe('line')
        ->and($data['columns'])->toBe(['Tahun', 'Deforestasi'])
        ->and($data['rows'])->toBe([['2024', '3304'], ['2025', '3739']]);
});

it('dispatches the currently selected chart type to preview', function () {
    Livewire::test(DataVisualizationForm::class)
        ->set('chart_type', 'pie')
        ->set('columns', ['Bulan', 'Nilai'])
        ->set('rows', [['Januari', '100'], ['Februari', '80']])
        ->call('preview')
        ->assertDispatched('data-visualization-preview', chartType: 'pie');
});

it('dispatches current text and legend settings to preview', function () {
    Livewire::test(DataVisualizationForm::class)
        ->set('top_text', 'Judul Atas')
        ->set('bottom_text', 'Catatan Bawah')
        ->set('show_legend', false)
        ->set('legend_position', 'top')
        ->call('preview')
        ->assertDispatched('data-visualization-preview', function ($name, $params) {
            return $params['chartData']['top_text'] === 'Judul Atas'
                && $params['chartData']['bottom_text'] === 'Catatan Bawah'
                && $params['chartData']['show_legend'] === false
                && $params['chartData']['legend_position'] === 'top';
        });
});

it('updates chart appearance in realtime when a setting changes', function () {
    Livewire::test(DataVisualizationForm::class)
        ->set('show_legend', false)
        ->assertDispatched('data-visualization-preview')
        ->set('legend_position', 'top')
        ->assertDispatched('data-visualization-preview')
        ->set('top_text', 'Judul Realtime')
        ->assertDispatched('data-visualization-preview')
        ->set('bottom_text', 'Catatan Realtime')
        ->assertDispatched('data-visualization-preview');
});

it('supports area grid and sankey chart data', function () {
    Livewire::test(DataVisualizationForm::class)
        ->set('title', 'Grid Area Hutan')
        ->set('chart_type', 'area-grid')
        ->set('columns', ['Tahun', 'Hutan', 'Non Hutan'])
        ->set('rows', [['2025', '70', '30']])
        ->call('save')
        ->assertHasNoErrors();

    Livewire::test(DataVisualizationForm::class)
        ->set('title', 'Aliran Ekspor')
        ->set('chart_type', 'sankey')
        ->set('columns', ['Sumber', 'Tujuan', 'Nilai'])
        ->set('rows', [['Indonesia', 'Jepang', '100']])
        ->call('save')
        ->assertHasNoErrors();

    $this->assertDatabaseHas('data_visualizations', ['chart_type' => 'area-grid']);
    $this->assertDatabaseHas('data_visualizations', ['chart_type' => 'sankey']);
});

it('updates status and removes a visualization', function () {
    $id = DB::table('data_visualizations')->insertGetId([
        'title' => 'Grafik Uji',
        'provider' => 'internal',
        'chart_type' => 'bar',
        'chart_data' => json_encode(['columns' => ['Tahun', 'Nilai'], 'rows' => [['2026', '10']]]),
        'is_active' => true,
        'created_at' => now(),
        'updated_at' => now(),
    ]);

    Livewire::test(DataVisualizationIndex::class)
        ->call('toggleStatus', $id);

    $this->assertDatabaseHas('data_visualizations', ['id' => $id, 'is_active' => false]);

    Livewire::test(DataVisualizationIndex::class)
        ->call('delete', $id);

    $this->assertDatabaseMissing('data_visualizations', ['id' => $id]);
});

it('provides spreadsheet drag selection and clipboard controls', function () {
    $view = file_get_contents(resource_path('views/livewire/data-visualization-form.blade.php'));
    $script = file_get_contents(resource_path('js/app.js'));

    expect($view)
        ->toContain('data-spreadsheet')
        ->toContain('data-spreadsheet-cell')
        ->and($script)
        ->toContain('spreadsheetCellsInSelection')
        ->toContain("document.addEventListener('pointermove'")
        ->toContain("['c', 'x'].includes(shortcut)")
        ->toContain("document.addEventListener('paste'");
});

it('publishes active visualizations as public and embed pages', function () {
    $id = DB::table('data_visualizations')->insertGetId([
        'title' => 'Grafik Publik Simontini',
        'description' => 'Deskripsi grafik publik.',
        'provider' => 'internal',
        'chart_type' => 'line',
        'chart_data' => json_encode([
            'columns' => ['Tahun', 'Hektare'],
            'rows' => [['2025', '120'], ['2026', '180']],
        ]),
        'is_active' => true,
        'created_at' => now(),
        'updated_at' => now(),
    ]);

    $this->get(route('data-visualizations.show', $id))
        ->assertOk()
        ->assertSee('Grafik Publik Simontini')
        ->assertDontSee('Data &amp; Grafik Simontini', false)
        ->assertDontSee('Deskripsi grafik publik.')
        ->assertDontSee('Diperbarui')
        ->assertSee('published-data-visualization', false);

    $this->get(route('data-visualizations.embed', $id))
        ->assertOk()
        ->assertSee('published-data-visualization', false)
        ->assertSee('h-full overflow-hidden', false)
        ->assertDontSee('Deskripsi grafik publik.');
});

it('does not publish inactive visualizations', function () {
    $id = DB::table('data_visualizations')->insertGetId([
        'title' => 'Grafik Nonaktif',
        'provider' => 'internal',
        'chart_type' => 'bar',
        'chart_data' => json_encode(['columns' => ['Tahun', 'Nilai'], 'rows' => [['2026', '10']]]),
        'is_active' => false,
        'created_at' => now(),
        'updated_at' => now(),
    ]);

    $this->get(route('data-visualizations.show', $id))->assertNotFound();
    $this->get(route('data-visualizations.embed', $id))->assertNotFound();
});

it('provides active visualization options for the TinyMCE picker', function () {
    $activeId = DB::table('data_visualizations')->insertGetId([
        'title' => 'Grafik untuk Artikel',
        'provider' => 'internal',
        'chart_type' => 'column',
        'chart_data' => json_encode(['columns' => ['Tahun', 'Nilai'], 'rows' => [['2026', '25']]]),
        'is_active' => true,
        'created_at' => now(),
        'updated_at' => now(),
    ]);
    DB::table('data_visualizations')->insert([
        'title' => 'Grafik Draft',
        'provider' => 'internal',
        'chart_type' => 'bar',
        'chart_data' => json_encode(['columns' => ['Tahun', 'Nilai'], 'rows' => [['2026', '10']]]),
        'is_active' => false,
        'created_at' => now(),
        'updated_at' => now(),
    ]);

    $this->withSession(['id' => 1])
        ->getJson(route('cms.data-visualizations.options'))
        ->assertOk()
        ->assertJsonPath('data.0.id', $activeId)
        ->assertJsonPath('data.0.title', 'Grafik untuk Artikel')
        ->assertJsonPath('data.0.embed_url', route('data-visualizations.embed', $activeId))
        ->assertJsonMissing(['title' => 'Grafik Draft']);

    $view = file_get_contents(resource_path('views/components/tinymce-editor.blade.php'));
    $script = file_get_contents(resource_path('js/app.js'));

    expect($view)->toContain('data-tinymce-visualization-options-url')
        ->and($script)->toContain("addButton('addDataVisualization'")
        ->toContain('story-data-visualization')
        ->toContain('aspect-ratio:16 / 9')
        ->toContain('scrolling="no"')
        ->toContain('repaintEditorAfterAtomicDialog')
        ->toContain("editor.dispatch('SelectionChange')")
        ->toContain('insertAtomicContent');
});
