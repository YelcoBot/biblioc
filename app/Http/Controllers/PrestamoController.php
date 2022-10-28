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
                $buttons = "";

                if ($prestamo->devuelto != 1) {
                    $buttons = "<button idprestamo = '" . $prestamo->id . "' type='button' class='btn btn-primary btn-edit'><i class='fa fa-magic'></i>&nbsp;&nbsp;Entregar</button>";
                }
                $buttons .= "<button idprestamo = '" . $prestamo->id . "' type='button' class='btn btn-success btn-edit'><i class='fa fa-eye'></i>&nbsp;&nbsp;Ver</button>";

                array_push($row, $prestamo->estudiante->nombre . " " . $prestamo->estudiante->apellido);
                array_push($row, $prestamo->libro->titulo . " " . $prestamo->libro->editorial->nombre);
                array_push($row, Carbon::parse($prestamo->fecha_pres)->format('m/d/Y'));
                array_push($row, $prestamo->devuelto == 1 ? "Si" : "No");
                array_push($row, $prestamo->estado_dev == 1 && $prestamo->devuelto == 1 ? "Bueno" : ($prestamo->estado_dev == 0 && $prestamo->devuelto == 1 ?  "Malo" : ""));
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

                $prestamo->devuelto = true;
                $prestamo->fecha_dev = Carbon::now();
                $prestamo->estado_dev = $request->estado_dev == "on" ? true : false;
                $prestamo->observacion = $request->observacion;
            } else {
                $prestamo->devuelto = false;
                $prestamo->fecha_pres = $request->fecha_pres;
                $prestamo->estado_pres = $request->estado_pres == "on" ? true : false;
                $prestamo->id_libro = $request->id_libro;
                $prestamo->id_estudiante = $request->id_estudiante;
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
            $prestamo->libro = $prestamo->libro;
            $prestamo->estudiante = $prestamo->estudiante;
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
