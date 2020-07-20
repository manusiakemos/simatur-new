<?php

namespace App\Http\Controllers;

use App\Models\Provider;
use App\Models\Tower;
use App\Models\TowerProvider;
use Illuminate\Http\Request;

class MapController extends Controller
{
    public function towerProvider(Request $request)
    {
        switch ($request->type) {
            case 'provider':
                return $this->provider($request);
                break;

            case 'operator':
                return $this->operator($request);
                break;

            default:
                abort(404, 'No Type Match');
                break;
        }
    }

    private function selectDefault()
    {
        $select = ['tower_lat', 'tower_lng','tower_id', 'tower_kode', 'tower_address', 'tb_tower.provider_id', 'tb_kelurahan.*', 'kecamatan_nama','tower_is_active'];
        return $select;
    }

    private function provider($request)
    {
        if (isset($request->provider_id)) {
            $data = Tower::joinAll()->select($this->selectDefault())
                ->with(['provider'])
                ->where("tb_tower.provider_id", $request->provider_id);
        } else {
            $data = Tower::joinAll()->select($this->selectDefault())->with(['provider']);
        }

        if(isset($request->kecamatan_id)){
            $data = $data->where("tb_kelurahan.kecamatan_id", $request->kecamatan_id);
        }

        $data = $data->get();
        return responseJson('data tower berdasarkan provider pemilik tower', $data);
    }

    private function operator($request)
    {
        $provider = null;
        if (isset($request->provider_id)) {
            $provider = Provider::find($request->provider_id);
            $tp = TowerProvider::where("provider_id", $request->provider_id)->get();
            $tower_id = $tp->pluck("tower_id")->unique();
            $data = Tower::joinAll()
                ->select($this->selectDefault())
                ->whereIn("tower_id", $tower_id);
        } else {
            $data = Tower::joinAll()->select($this->selectDefault())->with(['provider']);
        }

        if(isset($request->kecamatan_id)){
            $data = $data->where("tb_kecamatan.kecamatan_id", $request->kecamatan_id);
        }

        $data = $data->get();

        if($provider){
            foreach ($data as $value) {
                $value->provider = $provider;
            }
        }
        return responseJson('data tower berdasarkan operator tower', $data);
    }
}
