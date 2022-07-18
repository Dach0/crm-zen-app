<?php

namespace App\Http\Controllers;

use App\Models\ResourceItem;
use Illuminate\Http\Request;

class WebsiteController extends Controller
{
    public function index()
    {
        $recourceItems = ResourceItem::all();

        return view('home', ['resourceItems' => $recourceItems]);
    }
}
