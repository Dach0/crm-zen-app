<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\ResourceItem;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;

class ResourceItemController extends Controller
{
    public function index(): Collection
    {
        return ResourceItem::with('resourceType')->get();
    }
}
