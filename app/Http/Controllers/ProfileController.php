<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Resources\ProfileResource;
use App\User;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class ProfileController extends Controller
{
    public function edit()
    {
        return new ProfileResource(auth()->user());
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse|string
     * @throws \Illuminate\Validation\ValidationException
     */
    public function update(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'password' => 'nullable|confirmed',
            'username' => 'required',
            'email' => Rule::unique("users", "email")->ignore(auth()->id(), "id")
        ]);
        $id = auth()->id();
        $db = User::find($id);
        $db->name = $request->input('name');
        $db->username = $request->input('username');
        $db->email = $request->input('email');
        $db->phone = $request->input('phone');
        if ($request->password != null) {
            $db->password = bcrypt($request->password);
        }
        return $db->save() ? responseJson('Profil berhasi diupdate', new ProfileResource($db)) : '';
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function avatar(Request $request)
    {
        $this->validate($request,[
            'file' => 'image'
        ]);
        $file = $request->file('file');
        if ($file) {
            $fileName = Str::random() . "." . $file->getClientOriginalExtension();
            $file->storeAs("/images/avatars", $fileName);

            $db = User::find(auth()->id());
            $path = "/images/avatars/{$db->avatar}";
            Storage::disk('local')->delete($path);
            $db->avatar = $fileName;
            if ($db->save()) {
               return responseJson('Avatar Berhasil Diupdate', new ProfileResource(User::find(auth()->id())));
            }
        }else{
            return responseJson('file gagal');
        }
    }

    /**
     * @return ProfileResource
     */
    public function user()
    {
        return new ProfileResource(User::find(auth()->user()->id));
    }
}
