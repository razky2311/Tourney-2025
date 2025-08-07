<?php

namespace App\Filament\Admin\Widgets;

use App\Models\Game;
use Filament\Widgets\ChartWidget;
use Illuminate\Support\Facades\DB;

class GameChart extends ChartWidget
{
    protected static ?string $heading = 'Statistik Game per Tanggal';

    protected function getData(): array
    {
        $data = Game::selectRaw('DATE(game_date) as date, COUNT(*) as total')
            ->groupBy('date')
            ->orderBy('date')
            ->get();

        return [
            'datasets' => [
                [
                    'label' => 'Total Game',
                    'data' => $data->pluck('total'),
                ],
            ],
            'labels' => $data->pluck('date')->map(fn($date) => \Carbon\Carbon::parse($date)->format('d M')),
        ];
    }

    protected function getType(): string
    {
        return 'line'; // Bisa juga 'bar', 'pie', dsb
    }
}
