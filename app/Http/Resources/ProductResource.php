<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ProductResource extends JsonResource
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
            "product_id"=> $this->product_id,
"brand_id"=> $this->brand_id,
"product_name"=> $this->product_name,
"brand"=> $this->brand,
            "links" => generate_links_api("product", $this->product_id)
        ];
    }
}
