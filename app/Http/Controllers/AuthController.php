<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\User;
use Illuminate\Support\Facades\Hash;
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
        if($token){
            return responseJson("login success", ['token' => $token]);
        }
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

        $user = User::where('username', $request->username)->whereIn('role',['super-admin','admin'])->first();

        if (! $user || ! Hash::check($request->password, $user->password)) {
            throw ValidationException::withMessages([
                'username' => ['The provided credentials are incorrect.'],
            ]);
        }else{
            return  $user->createToken($request->device_name)->plainTextToken;
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
