<?php

namespace App\Http\Controllers;

use App\Models\TowerProvider;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

//use App\Http\Resources\TowerProviderResource;

class TowerProviderController extends Controller
{
    public function index(Request $request)
    {
        $data = TowerProvider::joinall()->select(['tb_tower_provider.*','provider_name'])
            ->where("tb_tower_provider.tower_id", $request->tower_id);
        return DataTables::of($data)
            ->addColumn('action', function (TowerProvider $value) {
                return view('actions.tower_provider', [
                    'value' => $value
                ]);
            })
            ->toJson();
    }

    public function store(Request $request)
    {
        $db = new TowerProvider;
        $save = $this->handleRequest($db, $request);
        return $save
            ? responseJson('TowerProvider Berhasi Ditambahkan')
            : responseJson('TowerProvider Gagal Ditambahkan');
    }


    public function show($id)
    {
        $db = TowerProvider::find($id);
//        return new TowerProviderResource($db);
        return $db;
    }

    public function update(Request $request, $id)
    {
        $db = TowerProvider::find($id);
        $save = $this->handleRequest($db, $request);
        return $save
            ? responseJson('TowerProvider Berhasi Diupdate')
            : responseJson('TowerProvider Gagal Diupdate');
    }


    public function destroy($id)
    {
        $db = TowerProvider::find($id);
        $save = $db->delete();

        return $save
            ? responseJson('TowerProvider Berhasi Dihapus')
            : responseJson('TowerProvider Gagal Dihapus');
    }

    private function handleRequest($db, $request)
    {
        $rules = [
            "tower_id" => [
                "required"
            ],
            "provider_id" => [
                "required"
            ],
            "koneksi_tipe" => [
                "required"
            ],
        ];
        $this->validate($request, $rules);

        $db->tower_id = $request->tower_id;
        $db->provider_id = $request->provider_id;
        $db->koneksi_tipe = $request->koneksi_tipe;

        return $db->save();
    }
}
