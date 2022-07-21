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
use Illuminate\Support\Facades\Storage;

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
            $this->attachResourceItemDetails('file_name', $savedFilename, $item->id);
        }

        if ($request->filled('link')){
            $this->attachResourceItemDetails('link', $request->link, $item->id);
            $this->attachResourceItemDetails('open_in_new_tab', $request->open_in_new_tab, $item->id);
        }

        if ($request->filled('description') && $request->filled('html_snippet')){
            $this->attachResourceItemDetails('description', $request->description, $item->id);
            $this->attachResourceItemDetails('html_snippet', $request->html_snippet, $item->id);
        }


        return [ 'data' => $item, 'message' => 'Successfully created resource'];
    }

    public function destroy(ResourceItem $resourceItem)
    {
        $itemDetail = $resourceItem->resourceDetails()->where('key','file_name')->first();

        if ($itemDetail) {
            Storage::disk('public')->delete('/pdf/' . $itemDetail->value);
        }

//        $resourceItem->delete();

        return response()->noContent();
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

    private function attachResourceItemDetails($detailKey, $detailValue, $resourceItemId)
    {
        ResourceDetail::create([
                'key' => $detailKey,
                'value' => $detailValue,
                'resource_item_id' => $resourceItemId
            ]);
    }
}
