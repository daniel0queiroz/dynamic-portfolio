<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ServicePage;
use App\Models\ServicePageFaq;
use Illuminate\Http\Request;

class ServicePageFaqController extends Controller
{
    public function index() {}

    public function create(Request $request)
    {
        $page = ServicePage::findOrFail($request->query('service_page_id'));
        return view('admin.service-page-faq.create', compact('page'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'service_page_id' => ['required', 'exists:service_pages,id'],
            'question.en'     => ['required', 'max:500'],
            'answer.en'       => ['required', 'max:2000'],
            'sort_order'      => ['nullable', 'integer', 'min:0'],
        ]);

        $faq = new ServicePageFaq();
        $faq->service_page_id = $request->input('service_page_id');
        $faq->question        = $request->input('question');
        $faq->answer          = $request->input('answer');
        $faq->sort_order      = $request->input('sort_order', 0);
        $faq->save();

        toastr()->success('FAQ added successfully!', 'Congrats');

        return redirect()->route('admin.service-page.edit', $request->input('service_page_id'));
    }

    public function show($id) {}

    public function edit($id)
    {
        $faq = ServicePageFaq::with('servicePage')->findOrFail($id);
        return view('admin.service-page-faq.edit', compact('faq'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'question.en' => ['required', 'max:500'],
            'answer.en'   => ['required', 'max:2000'],
            'sort_order'  => ['nullable', 'integer', 'min:0'],
        ]);

        $faq = ServicePageFaq::findOrFail($id);
        $faq->question   = $request->input('question');
        $faq->answer     = $request->input('answer');
        $faq->sort_order = $request->input('sort_order', 0);
        $faq->save();

        toastr()->success('FAQ updated successfully!', 'Congrats');

        return redirect()->route('admin.service-page.edit', $faq->service_page_id);
    }

    public function destroy($id)
    {
        $faq = ServicePageFaq::findOrFail($id);
        $pageId = $faq->service_page_id;
        $faq->delete();

        return redirect()->route('admin.service-page.edit', $pageId);
    }
}
