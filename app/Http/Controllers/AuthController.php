<?php

namespace App\Http\Controllers;

use App\Models\User;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function login()
    {
        if (Auth::check()) {
            return view('dashboard');
        }
        
        return view('login');
    }

    public function register()
    {
        return view('register');
    }

    public function authenticate(Request $request)
    {
        try {
            $credentials = $request->only('email', 'password');
            $remember = $request->remember == "on" ? true : false;

            if (!Auth::attempt($credentials, $remember)) {
                return response()->json(['status' => 'NOK', 'timestamp' => Carbon::now(), "message" => "Usuario o contraseña incorrecto!!", "data" => null, "exception" => null]);
            }
        } catch (Exception $ex) {
            return response()->json(['status' => 'NOK', 'timestamp' => Carbon::now(), "message" => "Error al iniciar sesión!!", "data" => null, "exception" => $ex]);
        }

        return response()->json(['status' => 'OK', 'timestamp' => Carbon::now(), "message" => "Inicio de sesión exitoso!!", "data" => null, "exception" => null]);
    }

    public function signin(Request $request)
    {
        try {
            $user = new User();
            $user->nombre = $request->nombre;
            $user->apellido = $request->apellido;
            $user->estado = true;

            $userexist = User::where('email', $request->email)->first();
            if ($userexist != null) {
                return response()->json(['status' => 'NOK', 'timestamp' => Carbon::now(), "message" => "El correo '" . $request->email . "' ya existe!!", "data" => $user, "exception" => null]);
            }

            if ($request->password != $request->confpassword) {
                return response()->json(['status' => 'NOK', 'timestamp' => Carbon::now(), "message" => "La contraseña no coincide!!", "data" => $user, "exception" => null]);
            }


            $user->email = $request->email;
            $user->password = Hash::make($request->password);
            $user->save();
        } catch (Exception $ex) {
            return response()->json(['status' => 'NOK', 'timestamp' => Carbon::now(), "message" => "Error al registrar el usuario!!", "data" => $user, "exception" => $ex]);
        }

        return response()->json(['status' => 'OK', 'timestamp' => Carbon::now(), "message" => "Usuario registrado correctamente!!", "data" => $user, "exception" => null]);
    }
}
