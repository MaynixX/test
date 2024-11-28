<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class BrandResource extends JsonResource
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
            "image" => $this->image,
            "index_show" => $this->index_show,
            "created_at" => $this->created_at,
            "updated_at" => $this->updated_at
        ];
    }
}
