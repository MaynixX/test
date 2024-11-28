<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CategoryResource extends JsonResource
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
            "uri" => $this->getUri(),
            // "stack" => $this->getCategoriesStack(),
            "description" => $this->description,
            "icon" => $this->icon,
            "image" => $this->image,
            "seo_title" => $this->seo_title,
            "seo_description" => $this->seo_description,
            "add_to_sitemap" => $this->add_to_sitemap,
            "nofollow" => $this->nofollow,
            "is_active" => $this->is_active,
            "created_at" => $this->created_at,
            "updated_at" => $this->updated_at
        ];
    }
}
