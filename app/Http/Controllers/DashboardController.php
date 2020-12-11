<?php

namespace App\Http\Controllers;

use App\Models\Skpd;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class DashboardController extends Controller
{
    public function ping(Request $request)
    {
        $buka = now()->setHour('8')->setMinute(0)->setSecond(0);
        $tutup = now()->setHour('13')->setMinute(0)->setSecond(0);
        $now = now();
        if($now->dayOfWeek == 5){
            //jika jumat
            $tutup = now()->setHour('12')->setMinute(0)->setSecond(0);
        }
        if(!($now->dayOfWeek >= 1 && $now->dayOfWeek <= 5)){
            //cek hari libur
            return responseJson('tutup');
        }
        if(!now()->between($buka, $tutup)){
           return responseJson('tutup');
        }

        $ip = $request->input('url');
        $db = Skpd::where("skpd_ip", $ip)->firstOrFail();
        $details = json_decode(checkIp($ip));
        $db->skpd_status = isset($details->success) ? $details->success : 0;
        $db->data_ping = json_encode($details);
        $db->save();

        $db->data_ping = json_decode($db->data_ping);
        return responseJson("data ping", $db);
    }

    public function pinglocal($skpd_id)
    {
        $data = Skpd::find($skpd_id);
        return responseJson("ping local", $data);
    }

    public function listWifi($tipe = null)
    {
        $data = Skpd::query();
        if ($tipe) {
            $data = $data->where("skpd_tipe", $tipe);
        }
        $data = $data->orderBy("skpd_tipe")->get();
        foreach ($data as $value) {
            $value->data_ping = json_decode($value->data_ping);
        }
        return responseJson("data skpd", $data);
    }
}
