<?php

namespace App\Http\Controllers;

use App\Models\Permohonan;
use App\Notifications\PermohonanBaruNotif;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Str;
use Yajra\DataTables\DataTables;

//use App\Http\Resources\PermohonanResource;
//type ditinjau, revisi, ditolak, disetujui

class PermohonanController extends Controller
{
    public function download($id)
    {
        $data = Permohonan::find($id);
        return response()->download(public_path('/uploads/archive/' . $data->p_file));
    }

    /**
     * @return mixed
     * @throws \Exception
     */
    public function index()
    {
        $role = auth()->user()->role;
        $data = Permohonan::joinData();
        if ($role == 'user') {
            $data = $data->where('user_id', auth()->id());
        }
        return DataTables::of($data)
            ->addColumn('action', function (Permohonan $value) {
                return view('actions.permohonan', [
                    'value' => $value
                ]);
            })
            ->toJson();
    }

    /**
     * @param Request $request
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request)
    {
        $db = new Permohonan;
        $save = $this->handleRequest($db, $request);
        //jika berhasil disimpan kirim notif ke email admin
        $admins = User::where('role', '<>', 'user')->get();
        Notification::send($admins, new PermohonanBaruNotif($save));

        return $save
            ? responseJson('Permohonan Berhasi Ditambahkan')
            : responseJson('Permohonan Gagal Ditambahkan');
    }


    public function show($id)
    {
        $db = Permohonan::find($id);
//        return new PermohonanResource($db);
        return $db;
    }

    /**
     * @param Request $request
     * @param $id
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response
     * @throws \Illuminate\Validation\ValidationException
     */
    public function update(Request $request, $id)
    {
        $db = Permohonan::find($id);
        $save = $this->handleRequest($db, $request);
        $user = User::find($save->user_id);
        $user->notify(new PermohonanBaruNotif($save));
        return $save
            ? responseJson('Permohonan Berhasi Diupdate')
            : responseJson('Permohonan Gagal Diupdate');
    }


    public function destroy($id)
    {
        $db = Permohonan::find($id);
        $save = $db->delete();

        return $save
            ? responseJson('Permohonan Berhasi Dihapus')
            : responseJson('Permohonan Gagal Dihapus');
    }

    /**
     * @param $db
     * @param $request
     * @return mixed
     * @throws \Illuminate\Validation\ValidationException
     */
    private function handleRequest($db, Request $request)
    {
        $rules = collect([
            "p_keterangan" => [
                "required"
            ],
            "p_alamat" => [
                "required"
            ],
            "kelurahan_id" => [
                "required"
            ],
            "p_lat" => [
                "required"
            ],
            "p_lng" => [
                "required"
            ],
        ]);
        if (auth()->user()->role != 'user') {
            $rulesnya = [
                "p_status" => [
                    "required"
                ],
                "p_alasan" => [
                    "required"
                ],
                "user_id" => [
                    "required"
                ]
            ];
            $rules = $rules->merge($rulesnya);
        }

        if (!isset($db->p_id)) {
            $rules = $rules->merge(["file" => "required|mimes:zip"]);
        }

        $this->validate($request, $rules->all());

        if (!isset($db->p_id)) {
            //store
            $db->user_id = auth()->id();
            if (auth()->user()->role == 'user') {
//                type ditinjau, revisi, ditolak, disetujui
                $db->p_status = "ditinjau";
            }
        } else {
            $db->p_status = $request->p_status;
        }

        if (auth()->user()->role == 'user') {
            if ($request->hasFile('file')) {

                $filename = Str::slug(auth()->user()->name . $request->kelurahan_id) . '.' . $request->file('file')->getClientOriginalExtension();
                $request->file('file')->move(public_path('/uploads/archive/'), $filename);
                $db->p_file = $filename;
            }
        }

        $db->p_keterangan = $request->p_keterangan;
        $db->p_alamat = $request->p_alamat;
        $db->p_alasan = $request->p_alasan;
        $db->kelurahan_id = $request->kelurahan_id;
        $db->p_lat = $request->p_lat;
        $db->p_lng = $request->p_lng;
        $db->save();
        return $db;
    }
}
