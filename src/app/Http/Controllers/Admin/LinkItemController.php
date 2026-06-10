<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\LinkItemDataTable;
use App\Http\Controllers\Controller;
use App\Models\LinkItem;
use Illuminate\Http\Request;

class LinkItemController extends Controller
{
    public function index(LinkItemDataTable $dataTable)
    {
        return $dataTable->render('admin.link-item.index');
    }

    public function create()
    {
        return view('admin.link-item.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name.en'    => ['required', 'max:200'],
            'url'        => ['required', 'url', 'max:500'],
            'thumbnail'  => ['required', 'image', 'max:5000'],
            'sort_order' => ['nullable', 'integer', 'min:0'],
        ]);

        $thumbnailPath = handleUpload('thumbnail');

        $item = new LinkItem();
        $item->name       = $request->input('name');
        $item->url        = $request->url;
        $item->thumbnail  = $thumbnailPath;
        $item->sort_order = $request->input('sort_order', 0);
        $item->is_active  = $request->boolean('is_active', true);
        $item->save();

        toastr()->success('Link item created successfully!', 'Success');

        return redirect()->route('admin.link-item.index');
    }

    public function show($id) {}

    public function edit($id)
    {
        $linkItem = LinkItem::findOrFail($id);
        return view('admin.link-item.edit', compact('linkItem'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name.en'    => ['required', 'max:200'],
            'url'        => ['required', 'url', 'max:500'],
            'thumbnail'  => ['nullable', 'image', 'max:5000'],
            'sort_order' => ['nullable', 'integer', 'min:0'],
        ]);

        $linkItem = LinkItem::findOrFail($id);

        $thumbnailPath = handleUpload('thumbnail', $linkItem);

        $linkItem->name       = $request->input('name');
        $linkItem->url        = $request->url;
        $linkItem->thumbnail  = !empty($thumbnailPath) ? $thumbnailPath : $linkItem->thumbnail;
        $linkItem->sort_order = $request->input('sort_order', 0);
        $linkItem->is_active  = $request->boolean('is_active');
        $linkItem->save();

        toastr()->success('Link item updated successfully!', 'Success');

        return redirect()->route('admin.link-item.index');
    }

    public function destroy($id)
    {
        $linkItem = LinkItem::findOrFail($id);
        deleteFileIfExist($linkItem->thumbnail);
        $linkItem->delete();
    }
}
