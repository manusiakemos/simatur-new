<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Items;
use App\Http\Resources\ItemResource;
use Yajra\DataTables\DataTables;

class ItemController extends Controller
{
    public function index()
    {
    return DataTables::of(Items::query())
        ->addColumn('action', function (Items $value) {
            return view('actions.item',[
                'value' => $value
            ]);
        })
        ->toJson();
    }

    public function store(Request $request)
    {
    $db = new Items;
    $save = $this->handleRequest($db, $request);
    return $save
        ? responseJson('Item Berhasi Ditambahkan')
        : responseJson('Item Gagal Ditambahkan');
    }


    public function show($id)
    {
        $db = Items::find($id);
        return new ItemResource($db);
    }

    public function update(Request $request, $id)
    {
        $db = Items::find($id);
    $save = $this->handleRequest($db, $request);
    return $save
        ? responseJson('Item Berhasi Diupdate')
        : responseJson('Item Gagal Diupdate');
    }


    public function destroy($id)
    {
        $db = Items::find($id);
        $save = $db->delete();

        return $save
            ? responseJson('Item Berhasi Dihapus')
            : responseJson('Item Gagal Dihapus');
    }

    private function handleRequest($db, $request)
    {
        $db->id= $request->id;
$db->name= $request->name;
        return $db->save();
    }
}
