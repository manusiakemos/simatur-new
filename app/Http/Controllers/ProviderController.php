<?php

namespace App\Http\Controllers;

use App\Models\Provider;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

//use App\Http\Resources\ProviderResource;

class ProviderController extends Controller
{
    public function index()
    {
        return DataTables::of(Provider::query())
            ->addColumn('action', function (Provider $value) {
                return view('actions.provider', [
                    'value' => $value
                ]);
            })
            ->editColumn('provider_operator', function (Provider $value) {
                return boolean_text($value->provider_operator, "Ya", "Tidak");
            })
            ->editColumn('provider_color', function (Provider $value) {
                return "<span class='badge text-white p-2' style='background:$value->provider_color'>$value->provider_color</span>";
            })
            ->rawColumns(['action', 'provider_color'])
            ->toJson();
    }

    public function store(Request $request)
    {
        $db = new Provider;
        $save = $this->handleRequest($db, $request);
        return $save
            ? responseJson('Provider Berhasi Ditambahkan')
            : responseJson('Provider Gagal Ditambahkan');
    }


    public function show($id)
    {
        $db = Provider::find($id);
//        return new ProviderResource($db);
        return $db;
    }

    public function update(Request $request, $id)
    {
        $db = Provider::find($id);
        $save = $this->handleRequest($db, $request);
        return $save
            ? responseJson('Provider Berhasi Diupdate')
            : responseJson('Provider Gagal Diupdate');
    }


    public function destroy($id)
    {
        $db = Provider::find($id);
        $save = $db->delete();

        return $save
            ? responseJson('Provider Berhasi Dihapus')
            : responseJson('Provider Gagal Dihapus');
    }

    private function handleRequest($db, $request)
    {
        $rules = [
            "provider_name" => [
                "required"
            ],
            "provider_color" => [
                "required"
            ],
            "provider_type" => [
                "required"
            ],
        ];
        $this->validate($request, $rules);

        $db->provider_name = $request->provider_name;
        $db->provider_color = $request->provider_color;
        $db->provider_type = $request->provider_type;

        return $db->save();
    }
}
