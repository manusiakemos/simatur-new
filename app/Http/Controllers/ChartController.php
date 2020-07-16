<?php

namespace App\Http\Controllers;

use App\Models\Kecamatan;
use App\Models\Kelurahan;
use App\Models\Provider;
use App\Models\TowerProvider;
use App\Models\Tower;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ChartController extends Controller
{

    /**
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response
     */
    public function tipeKoneksi()
    {
        $data = Tower::where('tower_owner_type', 'provider')
            ->select(DB::raw("count(*) as value, tower_type as label"))
            ->groupBy('tower_type')
            ->get();

        return responseJson('Grafik Tipe Koneksi Menara Provider di Kabupaten Tabalong', $data);
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

    /**
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response
     */
    public function towerPertahun()
    {
        $chart = Tower::select(DB::raw("count(*) as value, tower_year as label"))
            ->where('tower_status', 'disetujui')
            ->where('tower_owner_type', 'provider')
            ->whereNotNull('tower_year')
            ->groupBy("tower_year");
        $data = $chart->get();
        return responseJson('Grafik Menara Provider Pertahun di Kabupaten Tabalong', $data);
    }

    /**
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response
     */
    public function pengguna_provider()
    {
        $chart = TowerProvider::joinAll()->select(DB::raw("count(*) as value, provider_name as label"))
            ->groupBy("tb_provider.provider_id");
        $data = $chart->get();
        return responseJson('Grafik Menara Provider di Kabupaten Tabalong', $data);
    }

    /**
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response
     */
    public function provider()
    {
        $data = [];
        $Provider = Provider::all();
        $chart = Tower::joinProvider()
            ->select(DB::raw("count(*) as value, tb_provider.provider_name as label, provider_color as color, tb_provider.provider_id"))
            ->where('tower_owner_type','=', 'provider')
            ->groupBy("tb_provider.provider_id");
        $charts = $chart->get();

        foreach ($Provider as $provider) {
            foreach ($charts as $value) {
                if ($value->provider_id == $provider->provider_id) {
                    $data[] = [
                        'value' => $value->value,
                        'label' => $value->label,
                        'color' => $provider->provider_color
                    ];
                }
            }
        }
        return responseJson('Grafik Menara Provider di Kabupaten Tabalong', $data);
    }

    /**
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response
     */
    public function kecamatan()
    {
        $chart = Tower::joinAll()
            ->select(DB::raw("count(*) as value, kecamatan_nama as label"))
            ->where('tower_owner_type', 'provider')
            ->groupBy("tb_kelurahan.kecamatan_id");
        $data = $chart->get();
        return responseJson('Grafik Menara Provider Per Kecamatan di Kabupaten Tabalong', $data);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response
     */
    public function kelurahan(Request $request)
    {
        $data = [];
        $chart = Tower::joinAll()
            ->select(DB::raw("count(*) as value, kelurahan_nama as label, kecamatan_nama"))
            ->where('tower_owner_type', 'provider');
        if(isset($request->kecamatan_id)){
            $chart = $chart->where("tb_kelurahan.kecamatan_id", $request->kecamatan_id);
        }
        $chart = $chart
            ->groupBy("tb_kelurahan.kelurahan_id")
            ->orderBy('kecamatan_nama');
        $charts = $chart->get();
        foreach ($charts as $chart) {
            $data[] = [
                'label' => $chart->label . ' KECAMATAN ' . $chart->kecamatan_nama,
                'value' => $chart->value,
            ];
        }
        return responseJson('Grafik Menara Provider Per Kelurahan di Kabupaten Tabalong', $data);
    }
}
