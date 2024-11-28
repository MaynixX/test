<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class TradeOfferResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            "id" => $this->id,
            "title" => $this->title,
            "alias" => $this->alias,
            "properties" => new PropertyValueCollection($this->properties),
            "images" => new TradeOfferImageCollection($this->images),
            "product_id" => $this->product_id,
            "preview_image" => $this->preview_image,
            "sku" => $this->sku,
            "price" => $this->price,
            "old_price" => $this->old_price,
            "is_active" => $this->is_active,
            "created_at" => $this->created_at,
            "updated_at" => $this->updated_at
        ];
    }
}
