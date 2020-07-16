<?php

namespace App\Http\Controllers;

use App\Models\Provider;
use App\Models\TowerProvider;
use App\Models\Tower;
use Illuminate\Http\Request;

class MapController extends Controller
{
    public function towerProvider(Request $request)
    {
        if(isset($request->provider_id)){
            $provider = Provider::find($request->provider_id);
            $tp = TowerProvider::where("provider_id", $request->provider_id)->get();
            $tower_id = $tp->pluck("tower_id")->unique();
            $data = Tower::whereIn("tower_id", $tower_id)->get();
            foreach($data as $value){
                $value->provider = $provider;
            }
        }else{
            $data = Tower::with(['provider', 'kelurahan'])->get();
        }
        return responseJson('data lat lng', $data);
    }
}
