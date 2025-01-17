<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Continente extends Model
{
    use HasFactory;

    protected $connection = 'mysql_paises';

    protected $table = "continentes";

    public function paises(){
        return $this->hasMany(Pais::class);
    }
}
