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
        return ResourceItemResource::collection(ResourceItem::with('resourceType')->get());
    }
}
