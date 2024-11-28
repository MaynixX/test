<?php

namespace App\Http\Resources;

use App\Http\Resources\PropertyCollection;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class NomenclatureResource extends JsonResource
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
            "parent_id" => $this->parent_id,
            "created_at" => $this->created_at,
            "updated_at" => $this->updated_at,
            "product_properties" => new PropertyCollection($this->productProperties),
            "trade_offer_peoperties" => new PropertyCollection($this->tradeOfferProperties)
        ];
    }
}
