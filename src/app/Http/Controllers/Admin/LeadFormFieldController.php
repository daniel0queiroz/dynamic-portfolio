<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\LeadFormField;
use App\Models\ServicePage;
use Illuminate\Http\Request;

class LeadFormFieldController extends Controller
{
    public function index() {}

    public function create(Request $request)
    {
        $page = ServicePage::findOrFail($request->query('service_page_id'));
        return view('admin.lead-form-field.create', compact('page'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'service_page_id' => ['required', 'exists:service_pages,id'],
            'label.en'        => ['required', 'max:200'],
            'type'            => ['required', 'in:text,email,tel,textarea,select'],
            'sort_order'      => ['nullable', 'integer', 'min:0'],
        ]);

        $field = new LeadFormField();
        $field->service_page_id = $request->input('service_page_id');
        $field->label           = $request->input('label');
        $field->placeholder     = $request->input('placeholder') ?: null;
        $field->type            = $request->input('type');
        $field->is_required     = $request->boolean('is_required');
        $field->sort_order      = $request->input('sort_order', 0);
        $field->options         = $this->buildOptions($request);
        $field->save();

        toastr()->success('Field added successfully!', 'Congrats');

        return redirect()->route('admin.service-page.edit', $request->input('service_page_id'));
    }

    public function show($id) {}

    public function edit($id)
    {
        $field = LeadFormField::with('servicePage')->findOrFail($id);
        return view('admin.lead-form-field.edit', compact('field'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'label.en'   => ['required', 'max:200'],
            'type'       => ['required', 'in:text,email,tel,textarea,select'],
            'sort_order' => ['nullable', 'integer', 'min:0'],
        ]);

        $field = LeadFormField::findOrFail($id);
        $field->label       = $request->input('label');
        $field->placeholder = $request->input('placeholder') ?: null;
        $field->type        = $request->input('type');
        $field->is_required = $request->boolean('is_required');
        $field->sort_order  = $request->input('sort_order', 0);
        $field->options     = $this->buildOptions($request);
        $field->save();

        toastr()->success('Field updated successfully!', 'Congrats');

        return redirect()->route('admin.service-page.edit', $field->service_page_id);
    }

    public function destroy($id)
    {
        $field = LeadFormField::findOrFail($id);
        $pageId = $field->service_page_id;
        $field->delete();

        return redirect()->route('admin.service-page.edit', $pageId);
    }

    private function buildOptions(Request $request): ?string
    {
        if ($request->input('type') !== 'select') {
            return null;
        }

        $values     = $request->input('option_value', []);
        $labelsEn   = $request->input('option_label_en', []);
        $labelsEs   = $request->input('option_label_es', []);
        $labelsPt   = $request->input('option_label_pt', []);

        $options = [];
        foreach ($values as $i => $value) {
            if (empty(trim($value)) || empty(trim($labelsEn[$i] ?? ''))) {
                continue;
            }
            $options[] = [
                'value' => trim($value),
                'label' => [
                    'en' => trim($labelsEn[$i] ?? ''),
                    'es' => trim($labelsEs[$i] ?? ''),
                    'pt' => trim($labelsPt[$i] ?? ''),
                ],
            ];
        }

        return count($options) ? json_encode($options) : null;
    }
}
