<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class DatosResource extends JsonResource
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
            'Usuario'=> $this->usuario->email,
            'token'=> $this->usuario->api_token,
            'continente' =>  $this->continente,
            'pais' =>  $this->pais,
            'capital' =>  $this->capital,
            'GMT_UTC' =>  $this->GMT_UTC,
            'latitud' =>  $this->latitud,
            'longuitud' =>  $this->longuitud,
        ];
    }
}
