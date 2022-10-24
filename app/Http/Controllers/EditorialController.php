<?php

namespace App\Http\Controllers;

use App\Models\Editorial;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;

class EditorialController extends Controller
{
    public function index()
    {
        return view('editorial');
    }

    public function list()
    {
        $data = array();

        try {
            $editoriales = Editorial::all();

            foreach ($editoriales as $editorial) {
                $row = array();

                $buttons = "<button ideditorial = '" . $editorial->id . "' type='button' class='btn btn-primary btn-edit'><i class='fa fa-magic'></i>&nbsp;&nbsp;Editar</button>&nbsp;&nbsp;<button ideditorial = '" . $editorial->id . " type='button' class='btn btn-danger btn-delete'><i class='fa fa-trash'></i>&nbsp;&nbsp;Eliminar</button>";

                array_push($row, $editorial->nombre);
                array_push($row, $buttons);

                array_push($data, $row);
            }
        } catch (Exception $ex) {
            $data = array();
        }

        return response()->json(['status' => 'OK', 'timestamp' => Carbon::now(), "message" => "Editoriales consultadas correctamente!!", "data" => $data, "exception" => null]);
    }

    public function store(Request $request)
    {
        try {
            $editorial = new Editorial();
            if ($request->metodo != "Crear") {
                $id  = $request->id;
                $editorial = Editorial::find($id);
            }
            $editorial->nombre = $request->nombre;

            $editorial->save();
        } catch (Exception $ex) {
            return response()->json(['status' => 'NOK', 'timestamp' => Carbon::now(), "message" => "Error al registrar la editorial!!", "data" => $editorial, "exception" => $ex]);
        }

        return response()->json(['status' => 'OK', 'timestamp' => Carbon::now(), "message" => "Editorial registrada correctamente!!", "data" => $editorial, "exception" => null]);
    }

    public function show($id)
    {
        $editorial = new Editorial();
        try {
            $editorial = Editorial::find($id);
            if ($editorial == null) {
                return response()->json(['status' => 'NOK', 'timestamp' => Carbon::now(), "message" => "Editorial inexistente!!", "data" => null, "exception" => null]);
            }
        } catch (Exception $ex) {
            return response()->json(['status' => 'NOK', 'timestamp' => Carbon::now(), "message" => "Error al consultar la editorial!!", "data" => $editorial, "exception" => $ex]);
        }
        return response()->json(['status' => 'OK', 'timestamp' => Carbon::now(), "message" => "Editorial consultada correctamente!!", "data" => $editorial, "exception" => null]);
    }

    public function destroy($id)
    {
        $editorial = new Editorial();
        try {
            $editorial = Editorial::find($id);
            if ($editorial == null) {
                return response()->json(['status' => 'NOK', 'timestamp' => Carbon::now(), "message" => "Editorial inexistente!!", "data" => null, "exception" => null]);
            }

            Editorial::destroy($id);
        } catch (Exception $ex) {
            return response()->json(['status' => 'NOK', 'timestamp' => Carbon::now(), "message" => "Error al eliminar la editorial!!", "data" => $editorial, "exception" => $ex]);
        }
        return response()->json(['status' => 'OK', 'timestamp' => Carbon::now(), "message" => "Editorial eliminada correctamente!!", "data" => $editorial, "exception" => null]);
    }
}
