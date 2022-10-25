<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LibroAutor extends Model
{
    use HasFactory;

    protected $table = 'libro_autor';

    protected $fillable = [
        'id_libro',
        'id_autor',
    ];    
}
