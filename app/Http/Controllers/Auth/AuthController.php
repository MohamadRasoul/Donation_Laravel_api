<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{


    public function registerAdmin(Request $request)
    {
        $request->validate([
            "email"          => "required|email|unique:users",
            "password"       => "required|confirmed"
        ]);

        $user = new User();

        $user->email = $request->email;
        $user->password = bcrypt($request->password);
        $user->save();

        $user->assignRole('Admin');

        return $this->login($request, 0);
    }


    public function registerUser(Request $request)
    {
        $request->validate([
            "first_name"     => "required",
            "last_name"      => "required",
            "email"          => "required|email|unique:users",
            "phone_number"   => "required",
            "city"           => "required",
            "region"         => "required",
            "password"       => "required|confirmed"
        ]);

        $user = User::create([
            'first_name'   => $request->first_name,
            'last_name'    => $request->last_name,
            'email'        => $request->email,
            'phone_number' => $request->phone_number,
            'city'         => $request->city,
            'region'       => $request->region,
            'password'     => bcrypt($request->password),

        ]);

        $user->assignRole('User');
        
        $token = Auth::login($user);

        return $this->profile($token);
    }


    public function login(Request $request, $role)
    {
        $credentials = $request->validate([
            "email" => "required|email",
            "password" => "required"
        ]);

        $token = Auth::attempt($credentials);
        if (!$token) {
            return response()->error("Invalid credentials");
        }

        if (!auth()->user()->hasRole($role ? "User" : "Admin")) {
            return response()->error("User role wrong !");
        }

        return $this->profile($token);
    }

    public function profile($token = null)
    {
        $user = auth()->user();
        return response()->success(
            "User profile data",
            [
                "access_token" => $token,
                "user" => new UserResource($user)
            ]
        );
    }


    public function logout()
    {
        auth()->logout();
        return response()->success("User logged out");
    }
}
