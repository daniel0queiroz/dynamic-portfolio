<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\FeedbackDataTable;
use App\Http\Controllers\Controller;
use App\Models\Feedback;
use Illuminate\Http\Request;

class FeedbackController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(FeedbackDataTable $dataTable)
    {
        return $dataTable->render('admin.feedback.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.feedback.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name.en' => ['required', 'max:50'],
            'position.en' => ['nullable', 'max:100'],
            'description.en' => ['required', 'max:1000'],
        ]);

        $feedback = new Feedback();
        $feedback->name = $request->input('name');
        $feedback->position = $request->input('position');
        $feedback->description = $request->input('description');
        $feedback->save();

        toastr('Created Successfully!', 'success');

        return redirect()->route('admin.feedback.index');
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
        $feedback = Feedback::findOrFail($id);
        return view('admin.feedback.edit', compact('feedback'));
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
            'name.en' => ['required', 'max:50'],
            'position.en' => ['nullable', 'max:100'],
            'description.en' => ['required', 'max:1000'],
        ]);

        $feedback = Feedback::findOrFail($id);
        $feedback->name = $request->input('name');
        $feedback->position = $request->input('position');
        $feedback->description = $request->input('description');
        $feedback->save();

        toastr('Updated Successfully!', 'success');

        return redirect()->route('admin.feedback.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $feedback = Feedback::findOrFail($id);
        $feedback->delete();
    }
}
