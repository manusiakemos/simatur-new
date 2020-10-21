<?php

namespace App\Http\Controllers;

use App\Models\Provider;
use App\Models\Tower;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Yajra\DataTables\DataTables;

//use App\Http\Resources\TowerResource;


class TowerController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth:airlock')->except('index');
    }

    public function index(Request $request)
    {
        $data = Tower::select(['tb_tower.*', 'kecamatan_nama', 'kelurahan_nama', 'provider_name'])->joinAll();
        if (isset($request->filter_provider)) {
            $data = $data->where('tb_tower.provider_id', $request->filter_provider);
        }
        if (isset($request->filter_kecamatan)) {
            $data = $data->where('tb_kelurahan.kecamatan_id', $request->filter_kecamatan);
        }
        return DataTables::of($data)
            ->addColumn('action', function (Tower $value) {
                return view('actions.tower', [
                    'value' => $value
                ]);
            })
            ->editColumn('tower_is_active', function (Tower $value) {
                return boolean_text($value->tower_is_active);
            })
            ->toJson();
    }

    public function store(Request $request)
    {
        $db = new Tower;
        $save = $this->handleRequest($db, $request);
        return $save
            ? responseJson('Tower Berhasi Ditambahkan')
            : responseJson('Tower Gagal Ditambahkan');
    }


    public function show($id)
    {
        $db = Tower::joinAll()->find($id);
//        return new TowerResource($db);
        return $db;
    }

    public function update(Request $request, $id)
    {
        $db = Tower::find($id);
        $save = $this->handleRequest($db, $request);
        return $save
            ? responseJson('Tower Berhasi Diupdate')
            : responseJson('Tower Gagal Diupdate');
    }


    public function destroy($id)
    {
        $db = Tower::find($id);
        $save = $db->delete();

        return $save
            ? responseJson('Tower Berhasi Dihapus')
            : responseJson('Tower Gagal Dihapus');
    }

    private function handleRequest($db, $request)
    {
        $rules = [
            "provider_id" => [
                "required"
            ],
            "kelurahan_id" => [
                "required"
            ],
            "tower_address" => [
                "required"
            ],
            /*  "tower_desc" => [
                  "required"
              ],*/
            "tower_lng" => [
                "required"
            ],
            "tower_lat" => [
                "required"
            ],
            "tower_status" => [
                "required"
            ],
            "tower_size_type" => [
                "required"
            ],
            /*"tower_owner_type" => [
                "required"
            ],*/
            /* "tower_year" => [
                 "required"
             ],*/
            "tower_is_active" => [
                "required"
            ],
            "tower_height" => [
                "required"
            ],
        ];
        $this->validate($request, $rules);
        $db->provider_id = $request->provider_id;
        $db->kelurahan_id = $request->kelurahan_id;
        $db->tower_address = $request->tower_address;
        $db->tower_desc = $request->tower_desc;
        $db->tower_lng = $request->tower_lng;
        $db->tower_lat = $request->tower_lat;
        $db->tower_status = $request->tower_status;
        $db->tower_size_type = $request->tower_size_type;
        $db->tower_year = $request->tower_year;
        $db->tower_is_active = $request->tower_is_active;
        $db->tower_height = $request->tower_height;

        $kelurahan_id = $request->kelurahan_id;
        if ($db->save()) {
            $provider = Provider::find($request->provider_id);
            if ($provider) {
                $tower_id = $db->tower_id;
                $name = Str::limit(Str::slug($provider->provider_name), 10, "");
                $db->tower_kode = strtoupper($kelurahan_id . '-' . $name . '-' . $tower_id);
                $db->save();
            }
        }

        return true;
    }

    private function generateKode()
    {
        $tower = Tower::all();
        $providers = Provider::all();
        foreach ($tower as $value) {
            $db = Tower::find($value->tower_id);
            $kelurahan_id = $db->kelurahan_id;
            $tower_id = $db->tower_id;
            $provider = $providers->where("provider_id", $db->provider_id)->first();
            $db->tower_kode = strtoupper($kelurahan_id . '-' . Str::limit(Str::slug($provider->provider_name, ""), 10, "") . '-' . $tower_id);
            $db->save();
        }
    }
}
