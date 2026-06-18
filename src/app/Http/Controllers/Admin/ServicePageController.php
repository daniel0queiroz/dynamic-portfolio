<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\ServicePageDataTable;
use App\Http\Controllers\Controller;
use App\Models\ServicePage;
use Illuminate\Http\Request;

class ServicePageController extends Controller
{
    public function index(ServicePageDataTable $dataTable)
    {
        return $dataTable->render('admin.service-page.index');
    }

    public function create()
    {
        return view('admin.service-page.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'slug'         => ['required', 'max:100', 'unique:service_pages,slug', 'regex:/^[a-z0-9\-]+$/'],
            'title.en'     => ['required', 'max:200'],
            'subtitle.en'  => ['required', 'max:1000'],
            'image'        => ['nullable', 'image', 'max:5000'],
            'mobile_image' => ['nullable', 'image', 'max:5000'],
            'video_url'    => ['nullable', 'url', 'max:500'],
        ]);

        $page = new ServicePage();
        $page->slug         = $request->input('slug');
        $page->title        = $request->input('title');
        $page->subtitle     = $request->input('subtitle');
        $page->video_url    = $request->input('video_url') ?: null;
        $page->is_active    = $request->boolean('is_active', true);
        $page->image        = handleUpload('image') ?: null;
        $page->mobile_image = handleUpload('mobile_image') ?: null;
        $page->save();

        toastr()->success('Landing page created successfully!', 'Congrats');

        return redirect()->route('admin.service-page.edit', $page->id);
    }

    public function show($id) {}

    public function edit($id)
    {
        $page = ServicePage::with('faqs')->findOrFail($id);
        return view('admin.service-page.edit', compact('page'));
    }

    public function update(Request $request, $id)
    {
        $page = ServicePage::findOrFail($id);

        $request->validate([
            'slug'         => ['required', 'max:100', 'regex:/^[a-z0-9\-]+$/', 'unique:service_pages,slug,' . $id],
            'title.en'     => ['required', 'max:200'],
            'subtitle.en'  => ['required', 'max:1000'],
            'image'        => ['nullable', 'image', 'max:5000'],
            'mobile_image' => ['nullable', 'image', 'max:5000'],
            'video_url'    => ['nullable', 'url', 'max:500'],
        ]);

        $page->slug      = $request->input('slug');
        $page->title     = $request->input('title');
        $page->subtitle  = $request->input('subtitle');
        $page->video_url = $request->input('video_url') ?: null;
        $page->is_active = $request->boolean('is_active');

        $desktopPath = handleUpload('image', $page);
        if ($desktopPath) {
            $page->image = $desktopPath;
        } elseif ($request->boolean('remove_image')) {
            deleteFileIfExist($page->image);
            $page->image = null;
        }

        $mobilePath = handleUpload('mobile_image', $page);
        if ($mobilePath) {
            $page->mobile_image = $mobilePath;
        } elseif ($request->boolean('remove_mobile_image')) {
            deleteFileIfExist($page->mobile_image);
            $page->mobile_image = null;
        }

        $page->save();

        toastr()->success('Landing page updated successfully!', 'Congrats');

        return redirect()->back();
    }

    public function destroy($id)
    {
        $page = ServicePage::findOrFail($id);
        deleteFileIfExist($page->image);
        deleteFileIfExist($page->mobile_image);
        $page->delete();
    }
}
