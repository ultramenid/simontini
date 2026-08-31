<?php

namespace App\Livewire;

use Illuminate\Support\Facades\DB;
use Livewire\Component;

class DataVisualizationForm extends Component
{
    public ?int $visualizationId = null;

    public string $title = '';

    public string $description = '';

    public string $chart_type = 'bar';

    public string $top_text = '';

    public string $top_align = 'center';

    public $top_font_size = 18;

    public string $top_font_weight = 'bold';

    public string $top_font_family = 'Poppins';

    public bool $top_italic = false;

    public string $bottom_text = '';

    public string $bottom_align = 'center';

    public $bottom_font_size = 13;

    public string $bottom_font_weight = 'normal';

    public string $bottom_font_family = 'Poppins';

    public bool $bottom_italic = false;

    public bool $show_legend = true;

    public string $legend_position = 'bottom';

    public array $columns = ['Kategori', 'Nilai'];

    public array $rows = [
        ['', ''],
        ['', ''],
        ['', ''],
    ];

    public bool $is_active = true;

    public function mount(?int $visualizationId = null): void
    {
        $this->visualizationId = $visualizationId;

        if ($visualizationId === null) {
            return;
        }

        $item = DB::table('data_visualizations')->find($visualizationId);
        abort_if($item === null, 404);

        $this->title = $item->title;
        $this->description = $item->description ?? '';
        $this->chart_type = $item->chart_type ?? 'bar';
        $chartData = json_decode($item->chart_data ?? '', true);
        $this->columns = $chartData['columns'] ?? ['Kategori', 'Nilai'];
        $this->rows = $chartData['rows'] ?? [['', '']];
        $this->top_text = $chartData['top_text'] ?? '';
        $this->top_align = $chartData['top_align'] ?? 'center';
        $this->top_font_size = (int) ($chartData['top_font_size'] ?? 18);
        $this->top_font_weight = $chartData['top_font_weight'] ?? 'bold';
        $this->top_font_family = $chartData['top_font_family'] ?? 'Poppins';
        $this->top_italic = (bool) ($chartData['top_italic'] ?? false);
        $this->bottom_text = $chartData['bottom_text'] ?? '';
        $this->bottom_align = $chartData['bottom_align'] ?? 'center';
        $this->bottom_font_size = (int) ($chartData['bottom_font_size'] ?? 13);
        $this->bottom_font_weight = $chartData['bottom_font_weight'] ?? 'normal';
        $this->bottom_font_family = $chartData['bottom_font_family'] ?? 'Poppins';
        $this->bottom_italic = (bool) ($chartData['bottom_italic'] ?? false);
        $this->show_legend = (bool) ($chartData['show_legend'] ?? true);
        $this->legend_position = $chartData['legend_position'] ?? 'bottom';
        $this->is_active = (bool) $item->is_active;
    }

    protected function rules(): array
    {
        $rules = [
            'title' => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string', 'max:1000'],
            'chart_type' => ['required', 'in:line,area,bar,column,doughnut,pie,area-grid,sankey'],
            'top_text' => ['nullable', 'string', 'max:255'],
            'top_align' => ['required', 'in:left,center,right'],
            'top_font_size' => ['required', 'integer', 'min:10', 'max:72'],
            'top_font_weight' => ['required', 'in:normal,600,bold,900'],
            'top_font_family' => ['required', 'in:Poppins,Arial,Helvetica,Georgia,Times New Roman,Verdana,monospace'],
            'top_italic' => ['boolean'],
            'bottom_text' => ['nullable', 'string', 'max:255'],
            'bottom_align' => ['required', 'in:left,center,right'],
            'bottom_font_size' => ['required', 'integer', 'min:10', 'max:72'],
            'bottom_font_weight' => ['required', 'in:normal,600,bold,900'],
            'bottom_font_family' => ['required', 'in:Poppins,Arial,Helvetica,Georgia,Times New Roman,Verdana,monospace'],
            'bottom_italic' => ['boolean'],
            'show_legend' => ['boolean'],
            'legend_position' => ['required', 'in:top,bottom'],
            'columns' => ['required', 'array', 'min:2', 'max:10'],
            'columns.*' => ['nullable', 'string', 'max:100'],
            'rows' => ['required', 'array', 'min:1', 'max:100'],
            'is_active' => ['boolean'],
        ];

        foreach ($this->rows as $rowIndex => $row) {
            $rules["rows.{$rowIndex}"] = ['array', 'size:'.count($this->columns)];

            for ($columnIndex = 0; $columnIndex < count($this->columns); $columnIndex++) {
                $rules["rows.{$rowIndex}.{$columnIndex}"] = ['nullable', 'string', 'max:100'];
            }
        }

        return $rules;
    }

    protected function validationAttributes(): array
    {
        return [
            'chart_type' => 'jenis grafik',
            'top_text' => 'teks atas',
            'top_align' => 'posisi teks atas',
            'top_font_size' => 'ukuran teks atas',
            'top_font_weight' => 'ketebalan teks atas',
            'top_font_family' => 'jenis font teks atas',
            'top_italic' => 'italic teks atas',
            'bottom_text' => 'teks bawah',
            'bottom_align' => 'posisi teks bawah',
            'bottom_font_size' => 'ukuran teks bawah',
            'bottom_font_weight' => 'ketebalan teks bawah',
            'bottom_font_family' => 'jenis font teks bawah',
            'bottom_italic' => 'italic teks bawah',
            'show_legend' => 'legend',
            'legend_position' => 'posisi legend',
            'columns.*' => 'nama kolom',
            'rows.*.*' => 'isi tabel',
            'is_active' => 'status',
        ];
    }

    public function addColumn(): void
    {
        if (count($this->columns) >= 10) {
            return;
        }

        $this->columns[] = 'Seri '.count($this->columns);

        foreach ($this->rows as &$row) {
            $row[] = '';
        }
    }

    public function updatedChartType(string $chartType): void
    {
        if ($chartType !== 'sankey') {
            $this->preview();

            return;
        }

        $hasData = collect($this->rows)->flatten()->contains(fn ($value) => trim((string) $value) !== '');

        if (! $hasData) {
            $this->columns = ['Sumber', 'Tujuan', 'Nilai'];
            $this->rows = array_fill(0, 3, ['', '', '']);
            $this->preview();

            return;
        }

        while (count($this->columns) < 3) {
            $this->columns[] = count($this->columns) === 1 ? 'Tujuan' : 'Nilai';
            foreach ($this->rows as &$row) {
                $row[] = '';
            }
        }

        $this->preview();
    }

    public function updatedTopText(): void
    {
        $this->preview();
    }

    public function updatedTopAlign(): void
    {
        $this->preview();
    }

    public function updatedTopFontSize(): void
    {
        $this->preview();
    }

    public function updatedTopFontWeight(): void
    {
        $this->preview();
    }

    public function updatedTopFontFamily(): void
    {
        $this->preview();
    }

    public function updatedTopItalic(): void
    {
        $this->preview();
    }

    public function updatedBottomText(): void
    {
        $this->preview();
    }

    public function updatedBottomAlign(): void
    {
        $this->preview();
    }

    public function updatedBottomFontSize(): void
    {
        $this->preview();
    }

    public function updatedBottomFontWeight(): void
    {
        $this->preview();
    }

    public function updatedBottomFontFamily(): void
    {
        $this->preview();
    }

    public function updatedBottomItalic(): void
    {
        $this->preview();
    }

    public function updatedShowLegend(): void
    {
        $this->preview();
    }

    public function updatedLegendPosition(): void
    {
        $this->preview();
    }

    public function removeColumn(int $index): void
    {
        if ($index === 0 || count($this->columns) <= 2 || ! array_key_exists($index, $this->columns)) {
            return;
        }

        array_splice($this->columns, $index, 1);

        foreach ($this->rows as &$row) {
            array_splice($row, $index, 1);
        }
    }

    public function addRow(): void
    {
        if (count($this->rows) >= 100) {
            return;
        }

        $this->rows[] = array_fill(0, count($this->columns), '');
    }

    public function removeRow(int $index): void
    {
        if (count($this->rows) <= 1 || ! array_key_exists($index, $this->rows)) {
            return;
        }

        array_splice($this->rows, $index, 1);
    }

    public function preview(): void
    {
        $this->dispatch('data-visualization-preview',
            chartType: $this->chart_type,
            chartData: [
                'columns' => array_values($this->columns),
                'rows' => array_values($this->rows),
                'top_text' => $this->top_text,
                'top_align' => $this->top_align,
                'top_font_size' => $this->top_font_size,
                'top_font_weight' => $this->top_font_weight,
                'top_font_family' => $this->top_font_family,
                'top_italic' => $this->top_italic,
                'bottom_text' => $this->bottom_text,
                'bottom_align' => $this->bottom_align,
                'bottom_font_size' => $this->bottom_font_size,
                'bottom_font_weight' => $this->bottom_font_weight,
                'bottom_font_family' => $this->bottom_font_family,
                'bottom_italic' => $this->bottom_italic,
                'show_legend' => $this->show_legend,
                'legend_position' => $this->legend_position,
            ],
        );
    }

    public function save()
    {
        $validated = $this->validate();
        $now = now();
        $values = [
            'title' => $validated['title'],
            'description' => $validated['description'] ?: null,
            'provider' => 'internal',
            'chart_type' => $validated['chart_type'],
            'chart_data' => json_encode([
                'columns' => array_values($validated['columns']),
                'rows' => array_values($validated['rows']),
                'top_text' => $validated['top_text'] ?: '',
                'top_align' => $validated['top_align'],
                'top_font_size' => $validated['top_font_size'],
                'top_font_weight' => $validated['top_font_weight'],
                'top_font_family' => $validated['top_font_family'],
                'top_italic' => $validated['top_italic'],
                'bottom_text' => $validated['bottom_text'] ?: '',
                'bottom_align' => $validated['bottom_align'],
                'bottom_font_size' => $validated['bottom_font_size'],
                'bottom_font_weight' => $validated['bottom_font_weight'],
                'bottom_font_family' => $validated['bottom_font_family'],
                'bottom_italic' => $validated['bottom_italic'],
                'show_legend' => $validated['show_legend'],
                'legend_position' => $validated['legend_position'],
            ]),
            'embed_url' => null,
            'source_url' => null,
            'is_active' => $validated['is_active'],
            'updated_at' => $now,
        ];

        if ($this->visualizationId !== null) {
            DB::table('data_visualizations')
                ->where('id', $this->visualizationId)
                ->update($values);
            $message = 'Data & grafik berhasil diperbarui.';
        } else {
            DB::table('data_visualizations')->insert($values + ['created_at' => $now]);
            $message = 'Data & grafik berhasil ditambahkan.';
        }

        session()->flash('success', $message);

        return $this->redirectRoute('cms.data-visualizations', navigate: true);
    }

    public function render()
    {
        return view('livewire.data-visualization-form');
    }
}
