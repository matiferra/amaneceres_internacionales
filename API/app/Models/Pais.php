<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pais extends Model
{
    use HasFactory;

    protected $connection = 'mysql_paises';

    protected $table = "paises";

    protected $fillable = [
        'nombre',
        'capital',
        'GMT_UTC',
        'latitud',
        'longuitud',
        'id_continente',
    ];

    public function continente(){
        return $this->belongsTo(Continente::class, 'id_continente');
    }
}
