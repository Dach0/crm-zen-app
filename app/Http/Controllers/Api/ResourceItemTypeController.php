<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\ResourceItemType;
use Illuminate\Http\Request;

class ResourceItemTypeController extends Controller
{
    public function index()
    {
        return ResourceItemType::get(['id', 'type']);
    }
}
