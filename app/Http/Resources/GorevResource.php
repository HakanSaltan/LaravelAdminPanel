<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class GorevResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        // return parent::toArray($request);
        return[
            'sira' => $this->sira,
            'baslik' => $this->baslik,
            'aciklama' => $this->aciklama,
            'durum' => $this->durum,
            'created_at' => $this->created_at,
        ];
    }
}
