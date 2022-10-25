<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Prestamo;
use App\Models\PrestamoAutor;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;

class PrestamoController extends Controller
{
    public function index()
    {
        return view('prestamo');
    }

    public function list()
    {
        $data = array();

        try {
            $prestamos = Prestamo::all();

            foreach ($prestamos as $prestamo) {
                $row = array();

                $buttons = "<button idprestamo = '" . $prestamo->id . "' type='button' class='btn btn-primary btn-edit'><i class='fa fa-magic'></i>&nbsp;&nbsp;Editar</button>&nbsp;&nbsp;<button idprestamo = '" . $prestamo->id . " type='button' class='btn btn-danger btn-delete'><i class='fa fa-trash'></i>&nbsp;&nbsp;Eliminar</button>";

                array_push($row, $prestamo->estudiante->nombre . " " . $prestamo->estudiante->apellido);
                array_push($row, $prestamo->libro->titulo . " " . $prestamo->libro->editorial->nombre);
                array_push($row, Carbon::parse($prestamo->fecha_pres)->format('m/d/Y'));
                array_push($row, $prestamo->devuelto == 1 ? "Devuelto" : "Sin devolver");
                array_push($row, $prestamo->estado_dev == 1 ? "Bueno" : ($prestamo->estado_dev == 0 ?  "Sin devolver" : ""));
                array_push($row,  $buttons);

                array_push($data, $row);
            }
        } catch (Exception $ex) {
            $data = array();
        }

        return response()->json(['status' => 'OK', 'timestamp' => Carbon::now(), "message" => "Prestamos consultados correctamente!!", "data" => $data, "exception" => null]);
    }

    public function store(Request $request)
    {
        try {
            $prestamo = new Prestamo();
            if ($request->metodo != "Crear") {
                $id  = $request->id;
                $prestamo = Prestamo::find($id);
            }
            $prestamo->titulo = $request->titulo;
            $prestamo->n_pag = $request->n_pag;
            $prestamo->fecha_edicion = $request->fecha_edicion;
            $prestamo->id_editorial = $request->id_editorial;
            $prestamo->id_categoria = $request->id_categoria;

            $file = $request->file('archivo');
            if ($file != null) {
                $prestamo->archivo = $file->getClientOriginalName();
                $file->move("uploads", $file->getClientOriginalName());
            }

            $prestamo->save();
        } catch (Exception $ex) {
            return response()->json(['status' => 'NOK', 'timestamp' => Carbon::now(), "message" => "Error al registrar el prestamo!!", "data" => $prestamo, "exception" => $ex]);
        }

        return response()->json(['status' => 'OK', 'timestamp' => Carbon::now(), "message" => "Prestamo guardado correctamente!!", "data" => $prestamo, "exception" => null]);
    }

    public function show($id)
    {
        $prestamo = new Prestamo();
        try {
            $prestamo = Prestamo::find($id);
            if ($prestamo == null) {
                return response()->json(['status' => 'NOK', 'timestamp' => Carbon::now(), "message" => "Prestamo inexistente!!", "data" => null, "exception" => null]);
            }
            $prestamo->autores = $prestamo->autores;
        } catch (Exception $ex) {
            return response()->json(['status' => 'NOK', 'timestamp' => Carbon::now(), "message" => "Error al consultar el prestamo!!", "data" => $prestamo, "exception" => $ex]);
        }
        return response()->json(['status' => 'OK', 'timestamp' => Carbon::now(), "message" => "Prestamo consultado correctamente!!", "data" => $prestamo, "exception" => null]);
    }

    public function destroy($id)
    {
        $prestamo = new Prestamo();
        try {
            $prestamo = Prestamo::find($id);
            if ($prestamo == null) {
                return response()->json(['status' => 'NOK', 'timestamp' => Carbon::now(), "message" => "Prestamo inexistente!!", "data" => null, "exception" => null]);
            }

            Prestamo::destroy($id);
        } catch (Exception $ex) {
            return response()->json(['status' => 'NOK', 'timestamp' => Carbon::now(), "message" => "Error al eliminar el prestamo!!", "data" => $prestamo, "exception" => $ex]);
        }
        return response()->json(['status' => 'OK', 'timestamp' => Carbon::now(), "message" => "Prestamo eliminado correctamente!!", "data" => $prestamo, "exception" => null]);
    }

    public function viewer($id)
    {
        $prestamo = new Prestamo();
        try {
            $prestamo = Prestamo::find($id);
            $prestamo->urlarchivo = asset("uploads/" . $prestamo->archivo);
        } catch (Exception $ex) {
        }
        return view('viewer', ['prestamo' => $prestamo]);
    }
}
