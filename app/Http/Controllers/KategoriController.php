<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Kategori;
//use App\Http\Resources\KategoriResource;
use Yajra\DataTables\DataTables;

class KategoriController extends Controller
{
    public function index()
    {
    return DataTables::of(Kategori::query())
        ->addColumn('action', function (Kategori $value) {
            return view('actions.kategori',[
                'value' => $value
            ]);
        })
        ->toJson();
    }

    public function store(Request $request)
    {
    $db = new Kategori;
    $save = $this->handleRequest($db, $request);
    return $save
        ? responseJson('Kategori Berhasi Ditambahkan')
        : responseJson('Kategori Gagal Ditambahkan');
    }


    public function show($id)
    {
        $db = Kategori::find($id);
//        return new KategoriResource($db);
        return $db;
    }

    public function update(Request $request, $id)
    {
        $db = Kategori::find($id);
    $save = $this->handleRequest($db, $request);
    return $save
        ? responseJson('Kategori Berhasi Diupdate')
        : responseJson('Kategori Gagal Diupdate');
    }


    public function destroy($id)
    {
        $db = Kategori::find($id);
        $save = $db->delete();

        return $save
            ? responseJson('Kategori Berhasi Dihapus')
            : responseJson('Kategori Gagal Dihapus');
    }

    private function handleRequest($db, $request)
    {
        $rules = [
             "kategori_nama" => [
        "required"
       ],
             "kategori_slug" => [
        "required"
       ],
             "kategori_status" => [
        "required"
       ],
             "kategori_gambar" => [
        "required"
       ],
   ];
$this->validate($request, $rules);

        $db->kategori_nama = $request->kategori_nama;
                                    $db->kategori_slug = $request->kategori_slug;
                                    $db->kategori_status = $request->kategori_status;
                        if($request->hasFile('file')){
            $filename = my_upload_file($request->file('file'));
            $db->kategori_gambar = $filename;
        }
    
        return $db->save();
    }
}
