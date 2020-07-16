<?php

namespace App\Http\Controllers;

use App\Models\Kunjungan;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

//use App\Http\Resources\KunjunganResource;

class KunjunganController extends Controller
{
    public function index(Request $request)
    {
        $data = Kunjungan::joinAll()->select(['tb_kunjungan.*', 'tower_kode', 'kecamatan_nama','kelurahan_nama', 'provider_name']);
        if(isset($request->filter_tahun)){
            $data = $data->whereYear("kunjungan_tanggal",$request->filter_tahun);
        }
        return DataTables::of($data)
            ->addColumn('action', function (Kunjungan $value) {
                return view('actions.kunjungan', [
                    'value' => $value
                ]);
            })
            ->editColumn('kunjungan_gambar', function(Kunjungan $value){
                return makeHref($value->kunjungan_gambar);
            })
            ->rawColumns(['action', 'kunjungan_gambar'])
            ->toJson();
    }

    public function store(Request $request)
    {
        $db = new Kunjungan;
        $save = $this->handleRequest($db, $request);
        return $save
            ? responseJson('Kunjungan Berhasi Ditambahkan')
            : responseJson('Kunjungan Gagal Ditambahkan');
    }


    public function show($id)
    {
        $db = Kunjungan::find($id);
//        return new KunjunganResource($db);
        return $db;
    }

    public function update(Request $request, $id)
    {
        $db = Kunjungan::find($id);
        $save = $this->handleRequest($db, $request);
        return $save
            ? responseJson('Kunjungan Berhasi Diupdate')
            : responseJson('Kunjungan Gagal Diupdate');
    }


    public function destroy($id)
    {
        $db = Kunjungan::find($id);
        $save = $db->delete();

        return $save
            ? responseJson('Kunjungan Berhasi Dihapus')
            : responseJson('Kunjungan Gagal Dihapus');
    }

    private function handleRequest($db, $request)
    {
        $rules = [
            "kunjungan_tanggal" => [
                "required"
            ],
            "tower_id" => [
                "required"
            ],
            "kunjungan_gambar" => [
                "required"
            ],
        ];
        $this->validate($request, $rules);

        $db->kunjungan_tanggal = $request->kunjungan_tanggal;
        $db->tower_id = $request->tower_id;
        if ($request->hasFile('file')) {
            $filename = my_upload_file($request->file('file'));
            $db->kunjungan_gambar = $filename;
        }

        return $db->save();
    }
}
