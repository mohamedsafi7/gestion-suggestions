<?php
namespace App\Http\Controllers;

use App\Models\Suggestion;
use ArielMejiaDev\LarapexCharts\LarapexChart;

class DashboardController extends Controller
{
    public function index()
    {
        // Calculate total perte_temps and gain_temps
        $perteTemps = Suggestion::sum('perte_temps') ?? 0;
        $gainTemps = Suggestion::sum('gain_temps') ?? 0;

        // Calculate the difference (profit) between perte_temps and gain_temps
        $profit = $gainTemps - $perteTemps;

        // Time Comparison Chart (Bar chart with 3 segments: Perte Temps, Gain Temps, Profit)
        $timeComparisonChart = (new LarapexChart)->barChart()
            ->setTitle('Time Comparison: Perte vs Gain vs Profit')
            ->setLabels(['Perte Temps', 'Gain Temps', 'Profit'])
            ->setDataset([
                [
                    'name' => 'Temps',
                    'data' => [(int)$perteTemps, (int)$gainTemps, (int)$profit],
                ]
            ])
            ->setColors(['#FF5733', '#00E396', '#28a745']);  // Custom colors for each bar

        // Suggestions by Status Chart
        $approved = Suggestion::where('statut', 'approuvée')->count();
        $rejected = Suggestion::where('statut', 'rejetée')->count();

        $statusChart = (new LarapexChart)->barChart()
            ->setTitle('Suggestions by Status')
            ->setLabels(['Approuvée', 'Rejetée'])
            ->setDataset([
                [
                    'name' => 'Suggestions',
                    'data' => [$approved, $rejected],
                ]
            ]);

        return view('dashboard.index', compact('timeComparisonChart', 'statusChart'));
    }
}