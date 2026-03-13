<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\About;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AboutController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $about = About::first();
        return view('admin.about.index', compact('about'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'title.en' => ['required', 'max:200'],
            'description.en' => ['required', 'max:5000'],
            'image' => ['image', 'max:5000'],
            'resume' => ['nullable', 'mimes:pdf,csv,txt', 'max:10000'],
            'resume_es' => ['nullable', 'mimes:pdf,csv,txt', 'max:10000'],
            'resume_pt' => ['nullable', 'mimes:pdf,csv,txt', 'max:10000'],
        ]);

        $about = About::first();
        $imagePath = handleUpload('image', $about);
        $resumeEn = handleUpload('resume', $about);
        $resumeEs = handleUpload('resume_es', $about);
        $resumePt = handleUpload('resume_pt', $about);

        About::updateOrCreate(
            ['id' => $id],
            [
                'title' => $request->input('title'),
                'description' => $request->input('description'),
                'image' => (!empty($imagePath) ? $imagePath : $about->image),
                'resume' => (!empty($resumeEn) ? $resumeEn : $about->resume),
                'resume_es' => (!empty($resumeEs) ? $resumeEs : $about->resume_es),
                'resume_pt' => (!empty($resumePt) ? $resumePt : $about->resume_pt),
            ]
        );

        toastr()->success('Updated Successfully', 'Congrats');
        return redirect()->back();
        
    }

    public function resumeDownload()
    {
        $about = About::first();

        if (!$about) {
            abort(404, 'File not found');
        }

        $locale = app()->getLocale();
        $resume = match($locale) {
            'es' => $about->resume_es ?: $about->resume,
            'pt' => $about->resume_pt ?: $about->resume,
            default => $about->resume,
        };

        if (!$resume) {
            abort(404, 'File not found');
        }

        $filePath = Storage::disk('uploads')->path(basename($resume));

        if (!file_exists($filePath)) {
            abort(404, 'File not found');
        }

        return response()->download($filePath);
    }




    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
