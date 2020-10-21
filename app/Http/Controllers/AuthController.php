<?php

namespace App\Http\Controllers;

use App\Notifications\RegisterNotif;
use App\Notifications\RegisterSuccessNotif;
use App\User;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{
    use AuthenticatesUsers;

    /**
     * username
     *
     * @return string
     */
    public function username()
    {
        return "username";
    }

    /**
     * @param Request $request
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response|\Symfony\Component\HttpFoundation\Response
     * @throws \Illuminate\Validation\ValidationException
     */
    public function login(Request $request)
    {
        $token = $this->attemptLogin($request);
        if ($token) {
            return responseJson("login success", ['token' => $token]);
        }
    }

    /**
     * @param Request $request
     * @return \Illuminate\Contracts\Routing\ResponseFactory|Response
     * @throws ValidationException
     */
    public function register(Request $request)
    {
        $this->validate($request, [
            'name' => ['required', 'string', 'max:255'],
            'provider_id' => ['required'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'username' => ['required', 'string', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:6', 'confirmed'],
            'phone' => ['required', 'string', 'max:255', 'unique:users', 'regex:/^([0-9\s\-\+\(\)]*)$/', 'min:10'],
        ]);

        $db = new User;
        $db->role = "user";
        $db->provider_id = $request->provider_id;
        $db->name = $request->name;
        $db->email = $request->email;
        $db->username = $request->username;
        $db->password = Hash::make($request->password);
        $db->phone = $request->phone;
        $db->api_token = Str::random(100);
//        $db = User::find(3);
        if($db->save()){
            $db->notify(new RegisterNotif());
            //kirim notif lewat email dan telegram
            return responseJson('Cek email dan lakukan verifikasi akun');
        }
    }

    /**
     * @param Request $request
     * @return \Illuminate\Contracts\Routing\ResponseFactory|Response
     * @throws ValidationException
     */
    public function konfirmasi($token)
    {
        $token = decrypt($token);
        $db = User::whereApiToken($token)->firstOrFail();
        if($db->email_verified_at != null){
            abort('404');
        }
        $db->email_verified_at = now();
        if($db->save()){
            $db->notify(new RegisterSuccessNotif());
        }
        return redirect('/#pages/successregister');
    }

    public function logout(Request $request)
    {
        $this->guard()->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        if ($response = $this->loggedOut($request)) {
            return $response;
        }

        return $request->wantsJson()
            ? new Response('', 204)
            : redirect('/');
    }

    /**
     * attemptLogin
     *
     * @param  mixed $request
     *
     * @return bool
     */
    public function attemptLogin($request)
    {
        $request->validate([
            'username' => 'required',
            'password' => 'required',
            'device_name' => 'required'
        ]);

        $user = User::where('username', $request->username)->whereIn('role', ['user'])->first();

        if (!$user || !Hash::check($request->password, $user->password)) {
            throw ValidationException::withMessages([
                'username' => ['The provided credentials are incorrect.'],
            ]);
        } else {
            return $user->createToken($request->device_name)->plainTextToken;
        }

    }

    /**
     * check
     *
     * @return Response
     */
    public function check()
    {
        $id = auth()->id();
        $user = User::joinData()->where("user_id", $id)->first();
        if ($user) {
            return response($user);
        }
        return response(["message" => "Unauthenticated"]);
    }

    /**
     * SocialSignup
     *
     * @param  mixed $provider
     *
     * @return response json
     */
    /*    public function SocialSignup($provider)
        {
            // Socialite will pick response data automatic
            $user = Socialite::driver($provider)->stateless()->user();
            if ($user) {
                return $this->SignUpOrLogin($user);
            }else{
                return response()->json(["message" => "Autentikasi gagal"]);
            }
        }

        public function SignUpOrLogin($user)
        {
            $check = User::where("email", $user->email)->first();
            if ($check) {
                $db = User::find($check->id);

            } else {
                $db = new User;
            }
            $db->api_token = $user->token;
            $db->name = $user->name;
            $db->role = "user";
            $db->email = $user->email;
            $db->username = Str::random();
            $db->password = bcrypt(Str::random());
            $db->avatar = $user->avatar;
            $db->avatar_original = $user->avatar_original;
            $db->save();
            return response()->json($db);

        }*/
}
