<?php

namespace App\Http\Controllers;

use App\Models\Kecamatan;
use App\Models\Kelurahan;
use App\Models\Tower;
use App\Models\TowerProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ChartController extends Controller
{

    public function __invoke(Request $request, $case)
    {
        switch ($case) {
            case 'tipe_koneksi':
                return $this->tipeKoneksi($request);
                break;

            case 'provider':
//              pemilik tower
                return $this->provider($request);
                break;

            case 'operator':
//              pengguna tower
                return $this->operator($request);
                break;
        }
    }

    private function provider($request)
    {
        $select = DB::raw("count(*) as value, provider_name as label, tb_tower.tower_id, tower_lat, tower_lng, provider_color as color");
        if (isset($request->provider_id)) {
            $data = Tower::joinAll()->select($select)
                ->where("tb_tower.provider_id", $request->provider_id);
        } else {
            $data = Tower::joinAll()->select($select);
        }

        if (isset($request->kecamatan_id)) {
            $data = $data->where("tb_kelurahan.kecamatan_id", $request->kecamatan_id);
        }
        if (isset($request->is_komersil)) {
            $data = $data->where("is_komersil", $request->is_komersil);
        }

        $data = $data->groupBy("tb_tower.provider_id")->get();
        return responseJson('data provider pemilik tower', $data);
    }

    /**
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response
     */
    public function tipeKoneksi($request)
    {

        $data = TowerProvider::joinAll()
            ->select(DB::raw("count(*) as value, koneksi_tipe as label"))
            ->groupBy('koneksi_tipe');
        if (isset($request->kecamatan_id)) {
            $data = $data->where("tb_kelurahan.kecamatan_id", $request->kecamatan_id);
        }
        if (isset($request->is_komersil)) {
            $data = $data->where("is_komersil", $request->is_komersil);
        }

        $data = $data->get();

        return responseJson('Grafik Tipe Koneksi Operator', $data);
    }

    /**
     * @return mixed
     */
    public function counterUp()
    {
        $rower = Tower::select(DB::raw("count(*) as value, 'tower' as label"));
        $provider = TowerProvider::select(DB::raw("count(*) as value, 'provider' as label"));
        $kelurahan = Kelurahan::select(DB::raw("count(*) as value, 'desa/kelurahan' as label"));
        $kecamatan = Kecamatan::select(DB::raw("count(*) as value,'kecamatan' as label"))
            ->unionAll($kelurahan)
            ->unionAll($rower)
            ->unionAll($provider);
        $data = $kecamatan->get();
        return $data;
    }

    //        pengguna tower
    private function operator($request)
    {
//        provider_id && kecamatan_id;
        $select = DB::raw("count(*) as value, provider_name as label, tp_id, provider_color as color");;
        $data = TowerProvider::joinAll()->select($select);
        if (isset($request->provider_id)) {
            $data = $data->where("tb_tower_provider.provider_id", $request->provider_id);
        }

        if (isset($request->kecamatan_id)) {
            $data = $data->where("tb_kecamatan.kecamatan_id", $request->kecamatan_id);
        }
        if (isset($request->is_komersil)) {
            $data = $data->where("is_komersil", $request->is_komersil);
        }

        $data = $data->groupBy('tb_tower_provider.provider_id')->get();
        return responseJson('data operator pengguna tower', $data);
    }
}
