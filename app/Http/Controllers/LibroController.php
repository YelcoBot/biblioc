<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Libro;
use App\Models\LibroAutor;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;

class LibroController extends Controller
{
    public function index()
    {
        return view('libro');
    }

    public function list()
    {
        $data = array();
        $results = array();

        try {
            $libros = Libro::all();

            foreach ($libros as $libro) {
                $row = array();

                $buttonarchivo = "";

                if ($libro->archivo != null) {
                    $buttonarchivo = "<button idlibro = '" . $libro->id . "' type='button' class='btn btn-success btn-view'><i class='fa fa-magic'></i>&nbsp;&nbsp;Visualizar</button>&nbsp;&nbsp;";
                }

                $buttons = "<button idlibro = '" . $libro->id . "' type='button' class='btn btn-primary btn-edit'><i class='fa fa-magic'></i>&nbsp;&nbsp;Editar</button>&nbsp;&nbsp;<button idlibro = '" . $libro->id . " type='button' class='btn btn-danger btn-delete'><i class='fa fa-trash'></i>&nbsp;&nbsp;Eliminar</button>";

                array_push($row, $libro->titulo);
                array_push($row, Carbon::parse($libro->fecha_edicion)->format('m/d/Y'));
                array_push($row, $libro->editorial->nombre);
                array_push($row, $buttonarchivo . $buttons);

                array_push($data, $row);

                $option = (object) [
                    'id' => $libro->id,
                    'text' => $libro->titulo . " - " . $libro->editorial->nombre,
                ];

                array_push($results, $option);
            }
        } catch (Exception $ex) {
            $data = array();
            $results = array();
        }

        return response()->json(['status' => 'OK', 'timestamp' => Carbon::now(), "message" => "Libros consultados correctamente!!", "data" => $data, "results" => $results, "exception" => null]);
    }

    public function store(Request $request)
    {
        try {
            $libro = new Libro();
            if ($request->metodo != "Crear") {
                $id  = $request->id;
                $libro = Libro::find($id);
            }
            $libro->titulo = $request->titulo;
            $libro->n_pag = $request->n_pag;
            $libro->fecha_edicion = $request->fecha_edicion;
            $libro->id_editorial = $request->id_editorial;
            $libro->id_categoria = $request->id_categoria;

            $file = $request->file('archivo');
            if ($file != null) {
                $libro->archivo = $file->getClientOriginalName();
                $file->move("uploads", $file->getClientOriginalName());
            }

            $libro->save();

            LibroAutor::where('id_libro', $libro->id)->delete();

            if ($request->autores != null) {
                foreach ($request->autores as $idautor) {
                    $libroautor = new LibroAutor();
                    $libroautor->id_libro = $libro->id;
                    $libroautor->id_autor = $idautor;
                    $libroautor->save();
                }
            }
        } catch (Exception $ex) {
            return response()->json(['status' => 'NOK', 'timestamp' => Carbon::now(), "message" => "Error al registrar el libro!!", "data" => $libro, "exception" => $ex]);
        }

        return response()->json(['status' => 'OK', 'timestamp' => Carbon::now(), "message" => "Libro guardado correctamente!!", "data" => $libro, "exception" => null]);
    }

    public function show($id)
    {
        $libro = new Libro();
        try {
            $libro = Libro::find($id);
            if ($libro == null) {
                return response()->json(['status' => 'NOK', 'timestamp' => Carbon::now(), "message" => "Libro inexistente!!", "data" => null, "exception" => null]);
            }
            $libro->autores = $libro->autores;
        } catch (Exception $ex) {
            return response()->json(['status' => 'NOK', 'timestamp' => Carbon::now(), "message" => "Error al consultar el libro!!", "data" => $libro, "exception" => $ex]);
        }
        return response()->json(['status' => 'OK', 'timestamp' => Carbon::now(), "message" => "Libro consultado correctamente!!", "data" => $libro, "exception" => null]);
    }

    public function destroy($id)
    {
        $libro = new Libro();
        try {
            $libro = Libro::find($id);
            if ($libro == null) {
                return response()->json(['status' => 'NOK', 'timestamp' => Carbon::now(), "message" => "Libro inexistente!!", "data" => null, "exception" => null]);
            }

            Libro::destroy($id);
        } catch (Exception $ex) {
            return response()->json(['status' => 'NOK', 'timestamp' => Carbon::now(), "message" => "Error al eliminar el libro!!", "data" => $libro, "exception" => $ex]);
        }
        return response()->json(['status' => 'OK', 'timestamp' => Carbon::now(), "message" => "Libro eliminado correctamente!!", "data" => $libro, "exception" => null]);
    }

    public function viewer($id)
    {
        $libro = new Libro();
        try {
            $libro = Libro::find($id);
            $libro->urlarchivo = asset("uploads/" . $libro->archivo);
        } catch (Exception $ex) {
        }
        return view('viewer', ['libro' => $libro]);
    }
}
