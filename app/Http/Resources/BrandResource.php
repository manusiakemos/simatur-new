<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class BrandResource extends JsonResource
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
            "brand_id"=> $this->brand_id,
"brand_name"=> $this->brand_name,
"products"=> $this->products,
            "links" => generate_links_api("brand", $this->brand_id)
        ];
    }
}
