<?php

namespace App\Http\Controllers;

use App\Models\Arsip;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Yajra\DataTables\DataTables;

//use App\Http\Resources\ArsipResource;

class ArsipController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth:airlock')->except('download');
    }

    public function download($slug)
    {
        $file = Arsip::whereArsipSlug($slug)->firstOrFail();
        return response()->file(public_path("uploads/images/{$file->arsip_file}"));
    }

    public function index()
    {
        return DataTables::of(Arsip::query())
            ->addColumn('action', function (Arsip $value) {
                return view('actions.arsip', [
                    'value' => $value
                ]);
            })
            ->editColumn('arsip_file', function (Arsip $value) {
                return "<a href='{$value->arsip_file_path}'>Lihat File</a>";
            })
            ->rawColumns(['action', 'arsip_file'])
            ->toJson();
    }

    public function store(Request $request)
    {
        $db = new Arsip;
        $save = $this->handleRequest($db, $request);
        return $save
            ? responseJson('Arsip Berhasi Ditambahkan')
            : responseJson('Arsip Gagal Ditambahkan');
    }


    public function show($id)
    {
        $db = Arsip::find($id);
//        return new ArsipResource($db);
        return $db;
    }

    public function update(Request $request, $id)
    {
        $db = Arsip::find($id);
        $save = $this->handleRequest($db, $request);
        return $save
            ? responseJson('Arsip Berhasi Diupdate')
            : responseJson('Arsip Gagal Diupdate');
    }


    public function destroy($id)
    {
        $db = Arsip::find($id);
        $save = $db->delete();

        return $save
            ? responseJson('Arsip Berhasi Dihapus')
            : responseJson('Arsip Gagal Dihapus');
    }

    private function handleRequest($db, $request)
    {
        $rules = [
            "arsip_name" => [
                "required"
            ]
        ];
        $this->validate($request, $rules);
        $db->arsip_name = $request->arsip_name;
        if ($request->hasFile('file')) {
            $filename = my_upload_file($request->file('file'));
            $db->arsip_file = $filename;
        }
        $db->arsip_slug = Str::slug($request->arsip_name);

        return $db->save();
    }
}
