<?php

namespace App\Http\Resources;

use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ResourceItemResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  Request  $request
     * @return array
     */
    public function toArray($request)
    {
        $itemDetails = ($this->getItemDetails());
        return [
            'id' => $this->id,
            'title' => $this->title,
            'resource_item_type_id' => $this->resource_item_type_id,
            'type' => $this->whenLoaded('resourceType', $this->resourceType->type),
            'pdf_file' => $this->whenLoaded('resourceDetails', $itemDetails['pdf_file']),
            'description' => $this->whenLoaded('resourceDetails', $itemDetails['description']),
            'html_snippet' => $this->whenLoaded('resourceDetails', $itemDetails['html_snippet']),
            'link' => $this->whenLoaded('resourceDetails', $itemDetails['link']),
            'open_in_new_tab' => $this->whenLoaded('resourceDetails', $itemDetails['open_in_new_tab']),
            'created_at' => $this->created_at->toDateString(),
            'updated_at' => $this->created_at->toDateString(),
        ];
    }

    private function getItemDetails()
    {
        return [
            'pdf_file' => $this->resourceDetails->where('key','file_name')->first()?->value ?? '',
            'description' => $this->resourceDetails->where('key','description')->first()?->value ?? '',
            'html_snippet' => $this->resourceDetails->where('key','html_snippet')->first()?->value ?? '',
            'link' => $this->resourceDetails->where('key','link')->first()?->value ?? '',
            'open_in_new_tab' => $this->resourceDetails->where('key','open_in_new_tab')->first()?->value ?? ''
        ];
    }
}
