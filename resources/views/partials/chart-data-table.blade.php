{{-- Chart data as a plain HTML table, so search engines, AI answer engines and screen readers can read the numbers drawn on the canvas. --}}
@php
    $columns = array_values(array_filter($chartData['columns'] ?? [], 'is_scalar'));
    $rows = array_filter($chartData['rows'] ?? [], 'is_array');
    $caption = filled($chartData['top_text'] ?? null) ? $chartData['top_text'] : $title;
@endphp
@if ($columns && $rows)
    <table class="chart-data-table">
        <caption>{{ $caption }}</caption>
        <thead>
            <tr>
                @foreach ($columns as $column)
                    <th scope="col">{{ $column }}</th>
                @endforeach
            </tr>
        </thead>
        <tbody>
            @foreach ($rows as $row)
                <tr>
                    @foreach ($columns as $index => $column)
                        @if ($index === 0)
                            <th scope="row">{{ $row[$index] ?? '' }}</th>
                        @else
                            <td>{{ $row[$index] ?? '' }}</td>
                        @endif
                    @endforeach
                </tr>
            @endforeach
        </tbody>
    </table>
    @if (filled($chartData['bottom_text'] ?? null))
        <p class="chart-data-source">{{ $chartData['bottom_text'] }}</p>
    @endif
@endif
