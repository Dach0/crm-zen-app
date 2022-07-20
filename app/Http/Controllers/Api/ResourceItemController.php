<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\ResourceItemResource;
use App\Models\ResourceItem;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class ResourceItemController extends Controller
{
    public function index(): Collection|AnonymousResourceCollection
    {
        $resourceItems = ResourceItem::with('resourceType')
            ->when(request('resourceTypeFilter'), function ($query) {
                $query->where('resource_item_type_id', request('resourceTypeFilter'));
            })
            ->get();
        return ResourceItemResource::collection($resourceItems);
    }
}
