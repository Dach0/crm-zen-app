<?php

namespace App\Http\Controllers;

use App\Models\ResourceItem;
use Illuminate\Support\Collection;

class WebsiteController extends Controller
{
    public function index()
    {
        $resourceItems = ResourceItem::with(
            'resourceDetails:id,key,value,resource_item_id',
                     'resourceType:id,type')
            ->get()
            ->map( function ($item) {
                return [
                    'title' => $item->title,
                    'resourceType' => $item->resourceType->type,
                    'details' => $this->transformDetails($item->resourceDetails)
                ];
    });
//dd($resourceItems->toArray());
        return view('home', ['resourceItems' => $resourceItems]);
    }

    private function transformDetails($details): array
    {
        return collect($details)->mapWithKeys(fn ($item) => [ $item->key => $item->value ])->toArray();
    }
}
