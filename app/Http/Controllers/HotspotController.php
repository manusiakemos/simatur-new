<?php

namespace App\Http\Controllers;

use App\Models\Skpd;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

//use App\Http\Resources\SkpdResource;

class HotspotController extends Controller
{
    public function index()
    {
        return DataTables::of(Skpd::query())
            ->addColumn('action', function (Skpd $value) {
                return view('actions.skpd', [
                    'value' => $value
                ]);
            })
            ->editColumn('skpd_status', function (Skpd $value) {
                return boolean_text($value->skpd_status);
            })
            ->toJson();
    }

    public function store(Request $request)
    {
        $db = new Skpd;
        $save = $this->handleRequest($db, $request);
        return $save
            ? responseJson('Skpd Berhasi Ditambahkan')
            : responseJson('Skpd Gagal Ditambahkan');
    }


    public function show($id)
    {
        $db = Skpd::find($id);
//        return new SkpdResource($db);
        return $db;
    }

    public function update(Request $request, $id)
    {
        $db = Skpd::find($id);
        $save = $this->handleRequest($db, $request);
        return $save
            ? responseJson('Skpd Berhasi Diupdate')
            : responseJson('Skpd Gagal Diupdate');
    }


    public function destroy($id)
    {
        $db = Skpd::find($id);
        $save = $db->delete();

        return $save
            ? responseJson('Skpd Berhasi Dihapus')
            : responseJson('Skpd Gagal Dihapus');
    }

    private function handleRequest($db, $request)
    {
//        dd($request->all());
        $rules = [
            "skpd_nama" => [
                "required"
            ],
            "skpd_status" => [
                "required"
            ],
            "skpd_ip" => [
                "required"
            ],
//            "skpd_tipe" => [
//                "required"
//            ],
//            "skpd_kode" => [
//                "required"
//            ],
//            "skpd_keterangan" => [
//                "required"
//            ],
            "skpd_lat" => [
                "required"
            ],
            "skpd_lng" => [
                "required"
            ],
        ];
        $this->validate($request, $rules);

        $db->skpd_nama = $request->skpd_nama;
        $db->skpd_status = $request->skpd_status;
        $db->skpd_lat = $request->skpd_lat;
        $db->skpd_lng = $request->skpd_lng;
        $db->skpd_ip = $request->skpd_ip;
        $db->skpd_tipe = $request->skpd_tipe;
        $db->skpd_kode = $request->skpd_kode;
        $db->skpd_keterangan = $request->skpd_keterangan;

        return $db->save();
    }
}
