<?php

namespace App\Http\Middleware;

use App\Models\Settings;
use App\Models\ViewCounter;
use Carbon\Carbon;
use Closure;

class CounterView
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        //sekalian set title
//        if (!session('title')) {
//            $title = Settings::where('setting_name', 'nama_instansi')->first();
//            session()->put('title', $title->setting_value);
//        }

        //view counter
        $now = now();
        $day = $now->day;
        $month = $now->month;
        $year = $now->year;
        //total
        $db_counter_total = ViewCounter::where('vc_type', 'total')
            ->first();
        $db_counter_total->vc_value = $db_counter_total->vc_value + 1;
        $db_counter_total->save();
        //harian
        $db_counter_daily = ViewCounter::where('vc_type', 'daily')
             ->whereMonth('created_at', $month)
             ->whereYear('created_at', $year)
             ->first();
         if ($db_counter_daily) {
             if ($db_counter_daily->updated_at) {
                 $dt = Carbon::parse($db_counter_daily->updated_at);
             } else {
                 $dt = Carbon::parse($db_counter_daily->created_at);
             }
             if($day > $dt->day){
                 $db_counter_daily->vc_value = 1;
             }else{
                 $db_counter_daily->vc_value = $db_counter_daily->vc_value + 1;
             }
             $db_counter_daily->save();
         } else {
             $db_counter_daily = new ViewCounter;
             $db_counter_daily->vc_value = 1;
             $db_counter_daily->vc_type = 'daily';
             $db_counter_daily->save();
         }

        //bulanan
        $db_counter_month = ViewCounter::where('vc_type', 'month')
             ->whereMonth('created_at', $month)
             ->whereYear('created_at', $year)
             ->first();
         if ($db_counter_month) {
             $db_counter_month->vc_value = $db_counter_month->vc_value + 1;
             $db_counter_month->save();
         } else {
             $db_counter_month = new ViewCounter;
             $db_counter_month->vc_value = 1;
             $db_counter_month->vc_type = 'month';
             $db_counter_month->save();
         }

        return $next($request);
    }
}
