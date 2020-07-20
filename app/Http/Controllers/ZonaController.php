<?php

namespace App\Http\Controllers;

use App\Models\Zona;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Yajra\DataTables\DataTables;

//use App\Http\Resources\ZonaResource;

class ZonaController extends Controller
{
    public function index()
    {
        $data = Zona::select(['tb_zona.*', 'kecamatan_nama', 'kelurahan_nama'])->joinAll();
        return DataTables::of($data)
            ->addColumn('action', function (Zona $value) {
                return view('actions.zona', [
                    'value' => $value
                ]);
            })
            ->editColumn('zona_type', function (Zona $value) {
                return $value->zona_type == 'sub_urban' ? 'Sub Urban' : 'Rural';
            })
            ->editColumn('zona_sub_1', function (Zona $value) {
                return $value->zona_sub_1 != 0 ? $value->zona_sub_1 : '-';
            })
            ->editColumn('zona_sub_2', function (Zona $value) {
                return $value->zona_sub_2 != 0 ? $value->zona_sub_2 : '-';
            })
            ->editColumn('zona_rural', function (Zona $value) {
                return $value->zona_rural != 0 ? $value->zona_rural : '-';
            })
            ->toJson();
    }

    public function store(Request $request)
    {
        $db = new Zona;
        $save = $this->handleRequest($db, $request);
        return $save
            ? responseJson('Zona Berhasi Ditambahkan')
            : responseJson('Zona Gagal Ditambahkan');
    }


    public function show($id)
    {
        $db = Zona::find($id);
//        return new ZonaResource($db);
        return $db;
    }

    public function update(Request $request, $id)
    {
        $db = Zona::find($id);
        $save = $this->handleRequest($db, $request);
        return $save
            ? responseJson('Zona Berhasi Diupdate')
            : responseJson('Zona Gagal Diupdate');
    }


    public function destroy($id)
    {
        $db = Zona::find($id);
        $save = $db->delete();

        return $save
            ? responseJson('Zona Berhasi Dihapus')
            : responseJson('Zona Gagal Dihapus');
    }

    private function handleRequest($db, $request)
    {
        $rules = [
            "zona_type" => [
                "required"
            ],
            "kelurahan_id" => [
                "required"
            ],
            "zona_lat" => [
                "required"
            ],
            "zona_lng" => [
                "required"
            ],
//            "zona_sub_1" => [
//                "required"
//            ],
//            "zona_sub_2" => [
//                "required"
//            ],
//            "zona_rural" => [
//                "required"
//            ],
        ];
//        dd($request->zona_sub_1 == 'null');
        $this->validate($request, $rules);

        $db->zona_type = $request->zona_type;
        $db->kelurahan_id = $request->kelurahan_id;
        $db->zona_lat = $request->zona_lat ?? null;
        $db->zona_lng = $request->zona_lng ?? null;
        isset($request->zona_sub_1) && $request->zona_sub_1 !== 'null' ? $db->zona_sub_1 = $request->zona_sub_1 : $db->zona_sub_1 = 0;
        isset($request->zona_sub_2) && $request->zona_sub_2 !== 'null' ? $db->zona_sub_2 = $request->zona_sub_2 : $db->zona_sub_2 = 0;
        isset($request->zona_rural) && $request->zona_rural !== 'null' ? $db->zona_rural = $request->zona_rural : $db->zona_rural = 0;

        return $db->save();
    }
}
