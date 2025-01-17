<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Dato extends Model
{
    use HasFactory;

    protected $connection = 'mysql';
    
    protected $table = "datos";
    
    protected $fillable = [
        'solo_amanecer',
        'continente',
        'pais',
        'capital',
        'GMT_UTC',
        'latitud',
        'longuitud',
        'id_usuario',
    ];

    
    public function usuario(){
        return $this->belongsTo(User::class,'id_usuario');
    }
}
