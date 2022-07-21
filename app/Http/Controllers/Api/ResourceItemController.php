<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreResourceItemRequest;
use App\Http\Resources\ResourceItemResource;
use App\Models\ResourceDetail;
use App\Models\ResourceItem;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Http\UploadedFile;

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

    public function store(StoreResourceItemRequest $request)
    {
        $item = ResourceItem::create([
            'title' => $request->title,
            'resource_item_type_id' => $request->resource_item_type_id
        ]);

        if ($request->hasFile('pdf_file')) {
            $savedFilename = $this->uploadFile($request->file('pdf_file'), 'pdf');
            ResourceDetail::create([
                'key' => 'file_name',
                'value' => $savedFilename,
                'resource_item_id' => $item->id
            ]);
        }

        if ($request->filled('link')){
            ResourceDetail::create([
                'key' => 'link',
                'value' => $request->link,
                'resource_item_id' => $item->id
            ]);
            ResourceDetail::create([
                'key' => 'open_in_new_tab',
                'value' => $request->open_in_new_tab,
                'resource_item_id' => $item->id
            ]);
        }


        return [ 'data' => $item, 'message' => 'Successfully created resource'];
    }

    private function uploadFile(UploadedFile $file, $path)
    {
        $originalName = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
        $extension = $file->getClientOriginalExtension();
        $time = now()->getTimestamp();

        $filename = "{$originalName}-{$time}.{$extension}";

        $file->storeAs($path, $filename, 'public');

        return $filename;
    }
}
