<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class BackboneController extends Controller
{
    public function index()
    {
        $data = file_get_contents(storage_path("json/shape.json"));
        $x = collect(json_decode($data));
        return $x->toJson();
    }

    public function update(Request $request)
    {
        $json = collect($request->input('json'));
        file_put_contents(storage_path("json/shape.json"),$json->toJson());
        return responseJson('Data berhasil diupdate');
    }
}
