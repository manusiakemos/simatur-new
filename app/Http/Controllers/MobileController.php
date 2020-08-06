<?php

namespace App\Http\Controllers;

use App\Models\Arsip;
use App\Models\Kunjungan;
use App\Models\Tower;
use Illuminate\Http\Request;

class MobileController extends Controller
{
    /**
     * @param Request $request
     * @param $case
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response
     */
    public function __invoke(Request $request, $case)
    {
        switch ($case) {
            case "arsip":
                return Arsip::all();
                break;

            //api data tower
            case "tower":
                !isset($request->perpage) ? $perpage = 10 : $perpage = $request->perpage;
                $query_tower = Tower::with(['provider']);
                if ($request->page = false) {
                    $Tower = $query_tower->get()->toArray()['data'];
                } else {
                    $Tower = $query_tower->paginate($perpage)->toArray()['data'];
                }
                if (count($Tower) == 0) {
                    return responseJson("Data Tidak Ditemukan", [], false, "empty");
                }
                return responseJson("Data Tower Kabupaten Tabalong", $Tower, true, "success", 200);
                break;

            case "kunjungan":
                isset($request->year) ? $year = $request->year : $year = date("Y");
                $kunjungan = Kunjungan::whereYear("kunjungan_tanggal", $year)->get();
                if($request->all_tower == false){
                    if(count($kunjungan) == 0){
                        return responseJson("Data Kunjungan Tahun {$year} Tidak Ditemukan", [], false, "success");
                    }
                    $tower = Tower::whereIn('tower_id', $kunjungan->pluck('tower_id')->toArray())->get();
                }else{
                    $tower = Tower::all();
                }
                foreach ($tower as $value){
                    $value->sudah_dikunjungi = count($kunjungan->where("tower_id", $value->tower_id)) > 0 ? true : false;
                }

                return responseJson("Data Kunjungan Tahun {$year}", $tower, true, "success");
                break;

            default:
                return responseJson("act not found", [], false, "act not found");
                break;
        };
    }
}
