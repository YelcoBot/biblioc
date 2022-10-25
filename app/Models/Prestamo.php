<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Prestamo extends Model
{
    use HasFactory;

    protected $table = 'prestamo';

    protected $fillable = [
        'fecha_pres',
        'estado_pres',
        'devuelto',
        'fecha_dev',
        'estado_dev',
        'id_libro',
        'id_estudiante',
        'id_usuario',
    ];
}
