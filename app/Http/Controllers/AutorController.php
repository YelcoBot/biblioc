<?php

namespace App\Http\Controllers;

use App\Models\Autor;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;

class AutorController extends Controller
{
    public function index()
    {
        return view('autor');
    }

    public function list()
    {
        $data = array();

        try {
            $autores = Autor::all();

            foreach ($autores as $autor) {
                $row = array();

                $buttons = "<button idautor = '" . $autor->id . "' type='button' class='btn btn-primary btn-edit'><i class='fa fa-magic'></i>&nbsp;&nbsp;Editar</button>&nbsp;&nbsp;<button idautor = '" . $autor->id . " type='button' class='btn btn-danger btn-delete'><i class='fa fa-trash'></i>&nbsp;&nbsp;Eliminar</button>";

                array_push($row, $autor->nombre);
                array_push($row, $buttons);

                array_push($data, $row);
            }
        } catch (Exception $ex) {
            $data = array();
        }

        return response()->json(['status' => 'OK', 'timestamp' => Carbon::now(), "message" => "Autores consultados correctamente!!", "data" => $data, "exception" => null]);
    }

    public function store(Request $request)
    {
        try {
            $autor = new Autor();
            if ($request->metodo != "Crear") {
                $id  = $request->id;
                $autor = Autor::find($id);
            }
            $autor->nombre = $request->nombre;

            $autor->save();
        } catch (Exception $ex) {
            return response()->json(['status' => 'NOK', 'timestamp' => Carbon::now(), "message" => "Error al registrar el autor!!", "data" => $autor, "exception" => $ex]);
        }

        return response()->json(['status' => 'OK', 'timestamp' => Carbon::now(), "message" => "Autor registrado correctamente!!", "data" => $autor, "exception" => null]);
    }

    public function show($id)
    {
        $autor = new Autor();
        try {
            $autor = Autor::find($id);
            if ($autor == null) {
                return response()->json(['status' => 'NOK', 'timestamp' => Carbon::now(), "message" => "Autor inexistente!!", "data" => null, "exception" => null]);
            }
        } catch (Exception $ex) {
            return response()->json(['status' => 'NOK', 'timestamp' => Carbon::now(), "message" => "Error al consultar el autor!!", "data" => $autor, "exception" => $ex]);
        }
        return response()->json(['status' => 'OK', 'timestamp' => Carbon::now(), "message" => "Autor consultado correctamente!!", "data" => $autor, "exception" => null]);
    }

    public function destroy($id)
    {
        $autor = new Autor();
        try {
            $autor = Autor::find($id);
            if ($autor == null) {
                return response()->json(['status' => 'NOK', 'timestamp' => Carbon::now(), "message" => "Autor inexistente!!", "data" => null, "exception" => null]);
            }

            Autor::destroy($id);
        } catch (Exception $ex) {
            return response()->json(['status' => 'NOK', 'timestamp' => Carbon::now(), "message" => "Error al eliminar el autor!!", "data" => $autor, "exception" => $ex]);
        }
        return response()->json(['status' => 'OK', 'timestamp' => Carbon::now(), "message" => "Autor eliminado correctamente!!", "data" => $autor, "exception" => null]);
    }
}

