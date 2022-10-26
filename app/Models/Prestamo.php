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
        'observacion',
        'id_libro',
        'id_estudiante',
    ];

    public function estudiante()
    {
        return $this->belongsTo(User::class, 'id_estudiante');
    }

    public function libro()
    {
        return $this->belongsTo(Libro::class, 'id_libro');
    }
}
