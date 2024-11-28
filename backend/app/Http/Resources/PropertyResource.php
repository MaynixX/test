<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PropertyResource extends JsonResource
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
            "data_type_id" => $this->data_type_id,
            "sort_order" => $this->sort_order,
            "is_multiple" => $this->is_multiple,
            "is_selector" => $this->is_selector,
            "show_in_characteristics" => $this->show_in_characteristics,
            "show_in_filters" => $this->show_in_filters,
            "created_at" => $this->created_at,
            "updated_at" => $this->updated_at
        ];
    }
}
