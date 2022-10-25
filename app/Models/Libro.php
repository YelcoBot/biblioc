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
        'archivo',
        'id_editorial',
        'id_categoria',        
    ];

    public function editorial()
    {
        return $this->belongsTo(Editorial::class, 'id_editorial');
    }

    public function categoria()
    {
        return $this->belongsTo(Categoria::class, 'id_categoria');
    }

    public function autores()
    {
        return $this->hasMany(LibroAutor::class, 'id_libro');
    }

    
}
