<?php

namespace App\Http\Controllers;

use App\Models\Skpd;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class DashboardController extends Controller
{
    public function ping(Request $request)
    {
        $ip = $request->input('url');
        $details = collect(checkIp($ip));
        $db = Skpd::where("skpd_ip", $ip)->firstOrFail();
        $db->skpd_status = isset($details['status']) ? $details['status'] : 0;
        $db->save();
        $db->data_ping = $details;
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
            $value->data_ping = null;
        }
        return responseJson("data skpd", $data);
    }
}
