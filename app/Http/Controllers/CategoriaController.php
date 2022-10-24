<?php

namespace App\Http\Controllers;

use App\Models\Categoria;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;

class CategoriaController extends Controller
{
    public function index()
    {
        return view('categoria');
    }

    public function list()
    {
        $data = array();

        try {
            $categorias = Categoria::all();

            foreach ($categorias as $categoria) {
                $row = array();

                $buttons = "<button idcategoria = '" . $categoria->id . "' type='button' class='btn btn-primary btn-edit'><i class='fa fa-magic'></i>&nbsp;&nbsp;Editar</button>&nbsp;&nbsp;<button idcategoria = '" . $categoria->id . " type='button' class='btn btn-danger btn-delete'><i class='fa fa-trash'></i>&nbsp;&nbsp;Eliminar</button>";

                array_push($row, $categoria->nombre);
                array_push($row, $buttons);

                array_push($data, $row);
            }
        } catch (Exception $ex) {
            $data = array();
        }

        return response()->json(['status' => 'OK', 'timestamp' => Carbon::now(), "message" => "Categorias consultadas correctamente!!", "data" => $data, "exception" => null]);
    }

    public function store(Request $request)
    {
        try {
            $categoria = new Categoria();
            if ($request->metodo != "Crear") {
                $id  = $request->id;
                $categoria = Categoria::find($id);
            }
            $categoria->nombre = $request->nombre;

            $categoria->save();
        } catch (Exception $ex) {
            return response()->json(['status' => 'NOK', 'timestamp' => Carbon::now(), "message" => "Error al registrar la categoria!!", "data" => $categoria, "exception" => $ex]);
        }

        return response()->json(['status' => 'OK', 'timestamp' => Carbon::now(), "message" => "Categoria registrada correctamente!!", "data" => $categoria, "exception" => null]);
    }

    public function show($id)
    {
        $categoria = new Categoria();
        try {
            $categoria = Categoria::find($id);
            if ($categoria == null) {
                return response()->json(['status' => 'NOK', 'timestamp' => Carbon::now(), "message" => "Categoria inexistente!!", "data" => null, "exception" => null]);
            }
        } catch (Exception $ex) {
            return response()->json(['status' => 'NOK', 'timestamp' => Carbon::now(), "message" => "Error al consultar la categoria!!", "data" => $categoria, "exception" => $ex]);
        }
        return response()->json(['status' => 'OK', 'timestamp' => Carbon::now(), "message" => "Categoria consultada correctamente!!", "data" => $categoria, "exception" => null]);
    }

    public function destroy($id)
    {
        $categoria = new Categoria();
        try {
            $categoria = Categoria::find($id);
            if ($categoria == null) {
                return response()->json(['status' => 'NOK', 'timestamp' => Carbon::now(), "message" => "Categoria inexistente!!", "data" => null, "exception" => null]);
            }

            Categoria::destroy($id);
        } catch (Exception $ex) {
            return response()->json(['status' => 'NOK', 'timestamp' => Carbon::now(), "message" => "Error al eliminar la categoria!!", "data" => $categoria, "exception" => $ex]);
        }
        return response()->json(['status' => 'OK', 'timestamp' => Carbon::now(), "message" => "Categoria eliminada correctamente!!", "data" => $categoria, "exception" => null]);
    }
}
