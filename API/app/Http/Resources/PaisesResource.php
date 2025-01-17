<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class PaisesResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            "continente" => $this->continente->nombre,
            "nombre" => $this->nombre,
            "capital" => $this->capital,
            "latitud" => $this->latitud,
            "longuitud" => $this->longuitud,
            "GMT" => $this->GMT_UTC,
        ];
    }
}
