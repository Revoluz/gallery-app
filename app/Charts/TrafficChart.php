<?php

namespace App\Charts;

use Carbon\Carbon;
use App\Models\Gallery;
use ArielMejiaDev\LarapexCharts\LarapexChart;

class TrafficChart
{
    protected $chart;

    public function __construct(LarapexChart $chart)
    {
        $this->chart = $chart;
    }

    public function build($month, $total, $year): \ArielMejiaDev\LarapexCharts\AreaChart
    {
        // $year;
        // $data = Gallery::selectRaw('MONTH(created_at) as month, YEAR(created_at) as year, COUNT(*) as total')
        //     ->whereYear('created_at', $year)
        //     ->groupBy('month', 'year')
        //     ->get();

        // dd($data);

        // dd($data);
        // $dataUpload = Gallery::groupBy();
        return $this->chart->areaChart()
            ->setTitle('Gallery Uploads during ' . $year)
            ->setSubtitle('Total galleries uploaded per month.')
            ->addData('Data Upload', $total)
            ->setXAxis($month);
    }
}
