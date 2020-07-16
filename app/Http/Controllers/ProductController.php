<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Products;
//use App\Http\Resources\ProductResource;
use Yajra\DataTables\DataTables;

class ProductController extends Controller
{
    public function index()
    {
    return DataTables::of(Products::query())
        ->addColumn('action', function (Products $value) {
            return view('actions.product',[
                'value' => $value
            ]);
        })
        ->toJson();
    }

    public function store(Request $request)
    {
    $db = new Products;
    $save = $this->handleRequest($db, $request);
    return $save
        ? responseJson('Product Berhasi Ditambahkan')
        : responseJson('Product Gagal Ditambahkan');
    }


    public function show($id)
    {
        $db = Products::find($id);
//        return new ProductResource($db);
        return $db;
    }

    public function update(Request $request, $id)
    {
        $db = Products::find($id);
    $save = $this->handleRequest($db, $request);
    return $save
        ? responseJson('Product Berhasi Diupdate')
        : responseJson('Product Gagal Diupdate');
    }


    public function destroy($id)
    {
        $db = Products::find($id);
        $save = $db->delete();

        return $save
            ? responseJson('Product Berhasi Dihapus')
            : responseJson('Product Gagal Dihapus');
    }

    private function handleRequest($db, $request)
    {
        $db->product_id= $request->product_id;
$db->brand_id= $request->brand_id;
$db->product_name= $request->product_name;
        return $db->save();
    }
}
