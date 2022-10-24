<?php

namespace App\Http\Controllers;

use App\Models\Rol;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;

class RolController extends Controller
{
    public function index()
    {
        return view('rol');
    }

    public function list()
    {
        $data = array();

        try {
            $roles = Rol::all();

            foreach ($roles as $rol) {
                $row = array();

                $buttons = "<button idrol = '" . $rol->id . "' type='button' class='btn btn-primary btn-edit'><i class='fa fa-magic'></i>&nbsp;&nbsp;Editar</button>&nbsp;&nbsp;<button idrol = '" . $rol->id . " type='button' class='btn btn-danger btn-delete'><i class='fa fa-trash'></i>&nbsp;&nbsp;Eliminar</button>";

                array_push($row, $rol->nombre);
                array_push($row, $rol->estado == 1 ? "Activo" : "Inactivo");
                array_push($row, $buttons);

                array_push($data, $row);
            }
        } catch (Exception $ex) {
            $data = array();
        }

        return response()->json(['status' => 'OK', 'timestamp' => Carbon::now(), "message" => "Roles consultados correctamente!!", "data" => $data, "exception" => null]);
    }

    public function store(Request $request)
    {
        try {
            $rol = new Rol();
            if ($request->metodo != "Crear") {
                $id  = $request->id;
                $rol = Rol::find($id);
            }
            $rol->nombre = $request->nombre;
            $rol->estado = $request->estado == "on" ? true : false;

            $rol->save();
        } catch (Exception $ex) {
            return response()->json(['status' => 'NOK', 'timestamp' => Carbon::now(), "message" => "Error al registrar el rol!!", "data" => $rol, "exception" => $ex]);
        }

        return response()->json(['status' => 'OK', 'timestamp' => Carbon::now(), "message" => "Rol registrado correctamente!!", "data" => $rol, "exception" => null]);
    }

    public function show($id)
    {
        $rol = new Rol();
        try {
            $rol = Rol::find($id);
            if ($rol == null) {
                return response()->json(['status' => 'NOK', 'timestamp' => Carbon::now(), "message" => "Rol inexistente!!", "data" => null, "exception" => null]);
            }
        } catch (Exception $ex) {
            return response()->json(['status' => 'NOK', 'timestamp' => Carbon::now(), "message" => "Error al consultar el rol!!", "data" => $rol, "exception" => $ex]);
        }
        return response()->json(['status' => 'OK', 'timestamp' => Carbon::now(), "message" => "Rol consultado correctamente!!", "data" => $rol, "exception" => null]);
    }

    public function destroy($id)
    {
        $rol = new Rol();
        try {
            $rol = Rol::find($id);
            if ($rol == null) {
                return response()->json(['status' => 'NOK', 'timestamp' => Carbon::now(), "message" => "Rol inexistente!!", "data" => null, "exception" => null]);
            }

            Rol::destroy($id);
        } catch (Exception $ex) {
            return response()->json(['status' => 'NOK', 'timestamp' => Carbon::now(), "message" => "Error al eliminar el rol!!", "data" => $rol, "exception" => $ex]);
        }
        return response()->json(['status' => 'OK', 'timestamp' => Carbon::now(), "message" => "Rol eliminado correctamente!!", "data" => $rol, "exception" => null]);
    }
}
