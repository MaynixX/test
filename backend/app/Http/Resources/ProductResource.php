<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProductResource extends JsonResource
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
            "images" => new ProductImageCollection($this->images),
            "documents" => new ProductImageCollection($this->documents),
            "category_id" => $this->category_id,
            "brand_id" => $this->brand_id,
            "nomenclature_id" => $this->nomenclature_id,
            "tags" => $this->tags,
            "preview_image" => $this->preview_image,
            "description" => $this->description,
            "access_level" => $this->access_level,
            "seo_title" => $this->seo_title,
            "seo_description" => $this->seo_description,
            "is_active" => $this->is_active,
            "gift" => $this->gift,
            "created_at" => $this->created_at,
            "updated_at" => $this->updated_at
        ];
    }
}
