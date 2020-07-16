<?php

namespace App\Http\Controllers;

use App\Http\Resources\ChartViewCounterResource;
use App\Models\ViewCounter;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function chart()
    {
        $now = now();
        $chart = ViewCounter::select(DB::raw('vc_value as value, MONTH(created_at) as month'))
            ->where('vc_type', 'month')
            ->groupby('month')
            ->whereYear('created_at', $now->year)
            ->get();

        return responseJson('Jumlah kunjungan perbulan tahun '.$now->year,ChartViewCounterResource::collection($chart));
    }
}
