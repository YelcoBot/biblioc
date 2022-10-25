<?php

namespace App\Http\Controllers;

use App\Models\User;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index()
    {
        return view('usuario');
    }

    public function list()
    {
        $data = array();

        try {
            $users = User::all();

            foreach ($users as $user) {
                $row = array();

                $buttons = "<button iduser = '" . $user->id . "' type='button' class='btn btn-primary btn-edit'><i class='fa fa-magic'></i>&nbsp;&nbsp;Editar</button>&nbsp;&nbsp;<button iduser = '" . $user->id . " type='button' class='btn btn-danger btn-delete'><i class='fa fa-trash'></i>&nbsp;&nbsp;Eliminar</button>";

                array_push($row, $user->nombre . " " . $user->apellido);
                array_push($row, $user->rol->nombre);
                array_push($row, $user->email);
                array_push($row, $user->estado == 1 ? "Activo" : "Inactivo");
                array_push($row, $buttons);

                array_push($data, $row);
            }
        } catch (Exception $ex) {
            $data = array();
        }

        return response()->json(['status' => 'OK', 'timestamp' => Carbon::now(), "message" => "Usuarios consultados correctamente!!", "data" => $data, "exception" => null]);
    }

    public function store(Request $request)
    {
        try {
            $user = new User();
            if ($request->metodo != "Crear") {
                $id  = $request->id;
                $user = User::find($id);
            }
            $user->nombre = $request->nombre;
            $user->apellido = $request->apellido;
            $user->estado = $request->estado == "on" ? true : false;
            if ($request->metodo != "Crear") {
                if ($request->password != null) {

                    if ($request->password != $request->confpassword) {
                        return response()->json(['status' => 'NOK', 'timestamp' => Carbon::now(), "message" => "La contraseña no coincide!!", "data" => $user, "exception" => null]);
                    }

                    $user->password = Hash::make($request->password);
                }
            } else {
                $userexist = User::where('email', $request->email)->first();
                if ($userexist != null) {
                    return response()->json(['status' => 'NOK', 'timestamp' => Carbon::now(), "message" => "El correo '" . $request->email . "' ya existe!!", "data" => $user, "exception" => null]);
                }

                if ($request->password != $request->confpassword) {
                    return response()->json(['status' => 'NOK', 'timestamp' => Carbon::now(), "message" => "La contraseña no coincide!!", "data" => $user, "exception" => null]);
                }

                $user->password = Hash::make($request->password);
            }

            $user->id_rol = $request->id_rol;
            $user->email = $request->email;

            $user->save();
        } catch (Exception $ex) {
            return response()->json(['status' => 'NOK', 'timestamp' => Carbon::now(), "message" => "Error al registrar el usuario!!", "data" => $user, "exception" => $ex]);
        }

        return response()->json(['status' => 'OK', 'timestamp' => Carbon::now(), "message" => "Usuario guardado correctamente!!", "data" => $user, "exception" => null]);
    }

    public function show($id)
    {
        $user = new User();
        try {
            $user = User::find($id);
            if ($user == null) {
                return response()->json(['status' => 'NOK', 'timestamp' => Carbon::now(), "message" => "Usuario inexistente!!", "data" => null, "exception" => null]);
            }
        } catch (Exception $ex) {
            return response()->json(['status' => 'NOK', 'timestamp' => Carbon::now(), "message" => "Error al consultar el usuario!!", "data" => $user, "exception" => $ex]);
        }
        return response()->json(['status' => 'OK', 'timestamp' => Carbon::now(), "message" => "Usuario consultado correctamente!!", "data" => $user, "exception" => null]);
    }

    public function destroy($id)
    {
        $user = new User();
        try {
            $user = User::find($id);
            if ($user == null) {
                return response()->json(['status' => 'NOK', 'timestamp' => Carbon::now(), "message" => "Usuario inexistente!!", "data" => null, "exception" => null]);
            }

            User::destroy($id);
        } catch (Exception $ex) {
            return response()->json(['status' => 'NOK', 'timestamp' => Carbon::now(), "message" => "Error al eliminar el usuario!!", "data" => $user, "exception" => $ex]);
        }
        return response()->json(['status' => 'OK', 'timestamp' => Carbon::now(), "message" => "Usuario eliminado correctamente!!", "data" => $user, "exception" => null]);
    }
}
