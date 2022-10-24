<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Libro extends Model
{
    use HasFactory;

    protected $table = 'libro';

    protected $fillable = [
        'titulo',
        'n_pag',
        'fecha_edicion',
        'id_editorial',
        'id_categoria',
    ];
}
