<?php

namespace App\Http\Controllers;

use App\Models\Provider;
use App\Models\Tower;
use App\Models\TowerProvider;
use App\Models\Zona;
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

            case 'zona':
                return $this->zona($request);
                break;

            default:
                abort(404, 'No Type Match');
                break;
        }
    }

    private function selectDefault()
    {
        $select = ['tower_lat', 'tower_lng','tb_tower.tower_id', 'tower_kode', 'tower_address', 'tb_tower.provider_id', 'tb_kelurahan.*', 'kecamatan_nama','tower_is_active','provider_color','provider_name', 'tower_is_active'];
        return $select;
    }

    private function provider($request)
    {
        if (isset($request->provider_id)) {
            $data = Tower::joinAll()->select($this->selectDefault())
                ->where("tb_tower.provider_id", $request->provider_id);
        } else {
            $data = Tower::joinAll()->select($this->selectDefault());
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
        $data = TowerProvider::joinAll()->select($this->selectDefault());
        if (isset($request->provider_id)) {
            $data = $data->where("tb_tower_provider.provider_id", $request->provider_id);
        }

        if(isset($request->kecamatan_id)){
            $data = $data->where("tb_kecamatan.kecamatan_id", $request->kecamatan_id);
        }

        $data = $data->get();
        return responseJson('data tower berdasarkan operator pengguna tower', $data);
    }

    private function zona($request)
    {
        $data = Zona::joinAll();
        if(isset($request->zona_type)){
            $data = $data->where("zona_type", $request->zona_type);
        }
        if(isset($request->kecamatan_id)){
            $data = $data->where("tb_kelurahan.kecamatan_id", $request->kecamatan_id);
        }
        $data  = $data->get();

        foreach($data as $value){
            if($value->zona_type == 'rural'){
                $value->color = '#1d5df0';
            }else  if($value->zona_type == 'sub_urban'){
                $value->color = '#f4090d';
            }
        }
        return responseJson('data zona', $data);
    }
}
