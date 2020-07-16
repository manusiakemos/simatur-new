<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Yajra\DataTables\DataTables;

//use App\Http\Resources\UserResource;

class UserController extends Controller
{
    public function index()
    {
        return DataTables::of(User::query())
            ->addColumn('action', function (User $value) {
                return view('actions.user', [
                    'value' => $value
                ]);
            })
            ->editColumn('avatar', function (User $value) {
                return "<a href='{$value->avatar}' target='_blank'>{$value->avatar}<a>";
            })
            ->rawColumns(['action', 'avatar'])
            ->toJson();
    }

    public function store(Request $request)
    {
        $db = new User;
        $save = $this->handleRequest($db, $request);
        return $save
            ? responseJson('User Berhasi Ditambahkan')
            : responseJson('User Gagal Ditambahkan');
    }


    public function show($id)
    {
        $db = User::find($id);
//        return new UserResource($db);
        return $db;
    }

    public function update(Request $request, $id)
    {
        $db = User::find($id);
        $save = $this->handleRequest($db, $request);
        return $save
            ? responseJson('User Berhasi Diupdate')
            : responseJson('User Gagal Diupdate');
    }


    public function destroy($id)
    {
        $db = User::find($id);
        $save = $db->delete();

        return $save
            ? responseJson('User Berhasi Dihapus')
            : responseJson('User Gagal Dihapus');
    }

    private function handleRequest($db, $request)
    {
        $rules = [
            "name" => [
                "required"
            ],
            "email" => [
                "required"
            ],
            "username" => [
                "required"
            ],
//            "avatar" => [
//                "required"
//            ],
            "phone" => [
                "required"
            ],
            "role" => [
                "required"
            ],
//            "password" => [
//                "required"
//            ],
//            "api_token" => [
//                "required"
//            ],
//            "remember_token" => [
//                "required"
//            ],
//            "email_verified_at" => [
//                "required"
//            ],
        ];
        $this->validate($request, $rules);

        $db->id = $request->id;
        $db->name = $request->name;
        $db->email = $request->email;
        $db->username = $request->username;
        if ($request->hasFile('file')) {
            $filename = my_upload_file($request->file('file'));
            $db->avatar = $filename;
        }
        $db->phone = $request->phone;
        $db->role = $request->role;
        if($request->has("password")){
            $db->password = bcrypt($request->password);
        }
        $db->api_token = Str::random(100);
        $db->remember_token = Str::random(100);

        return $db->save();
    }
}
