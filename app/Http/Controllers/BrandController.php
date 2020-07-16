<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Brands;
//use App\Http\Resources\BrandResource;
use Yajra\DataTables\DataTables;

class BrandController extends Controller
{
    public function index()
    {
    return DataTables::of(Brands::query())
        ->addColumn('action', function (Brands $value) {
            return view('actions.brand',[
                'value' => $value
            ]);
        })
        ->toJson();
    }

    public function store(Request $request)
    {
    $db = new Brands;
    $save = $this->handleRequest($db, $request);
    return $save
        ? responseJson('Brand Berhasi Ditambahkan')
        : responseJson('Brand Gagal Ditambahkan');
    }


    public function show($id)
    {
        $db = Brands::find($id);
//        return new BrandResource($db);
        return $db;
    }

    public function update(Request $request, $id)
    {
        $db = Brands::find($id);
    $save = $this->handleRequest($db, $request);
    return $save
        ? responseJson('Brand Berhasi Diupdate')
        : responseJson('Brand Gagal Diupdate');
    }


    public function destroy($id)
    {
        $db = Brands::find($id);
        $save = $db->delete();

        return $save
            ? responseJson('Brand Berhasi Dihapus')
            : responseJson('Brand Gagal Dihapus');
    }

    private function handleRequest($db, $request)
    {
        $db->brand_id = $request->brand_id;
                $db->brand_name = $request->brand_name;
                $db->brand_status = $request->brand_status;
    
        return $db->save();
    }
}
