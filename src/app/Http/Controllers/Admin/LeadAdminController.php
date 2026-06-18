<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Lead;
use App\Models\ServicePage;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\StreamedResponse;

class LeadAdminController extends Controller
{
    public function index(Request $request)
    {
        $servicePages = ServicePage::orderBy('id')->get();

        $query = Lead::with(['servicePage', 'answers.field'])
            ->latest();

        if ($request->filled('service_page_id')) {
            $query->where('service_page_id', $request->input('service_page_id'));
        }

        $leads = $query->paginate(25)->withQueryString();

        return view('admin.leads.index', compact('leads', 'servicePages'));
    }

    public function show($id)
    {
        $lead = Lead::with(['servicePage', 'answers.field'])->findOrFail($id);

        return view('admin.leads.show', compact('lead'));
    }

    public function destroy($id)
    {
        Lead::findOrFail($id)->delete();

        toastr()->success('Lead deleted.', 'Done');

        return redirect()->route('admin.leads.index');
    }

    public function export(Request $request): StreamedResponse
    {
        $query = Lead::with(['servicePage', 'answers.field'])->latest();

        if ($request->filled('service_page_id')) {
            $query->where('service_page_id', $request->input('service_page_id'));
        }

        $leads = $query->get();

        $headers = [
            'Content-Type'        => 'text/csv; charset=UTF-8',
            'Content-Disposition' => 'attachment; filename="leads-' . now()->format('Y-m-d') . '.csv"',
        ];

        return response()->stream(function () use ($leads) {
            $handle = fopen('php://output', 'w');
            fputs($handle, "\xEF\xBB\xBF"); // UTF-8 BOM for Excel

            // Build header row from first lead's fields (if any)
            $fieldLabels = [];
            if ($leads->isNotEmpty()) {
                foreach ($leads->first()->answers as $answer) {
                    $fieldLabels[] = $answer->field?->getTranslation('label', 'en', true) ?? 'Field';
                }
            }

            fputcsv($handle, array_merge(['ID', 'Service', 'Locale', 'IP', 'LGPD', 'Date'], $fieldLabels));

            foreach ($leads as $lead) {
                $answers = [];
                foreach ($lead->answers as $answer) {
                    $val = $answer->field?->type === 'select'
                        ? $answer->field->getOptionLabel($answer->value, 'en')
                        : $answer->value;
                    $answers[] = $val;
                }

                fputcsv($handle, array_merge([
                    $lead->id,
                    $lead->servicePage?->getTranslation('title', 'en', true),
                    strtoupper($lead->locale),
                    $lead->ip_address,
                    $lead->lgpd_consent ? 'Yes' : 'No',
                    $lead->created_at->format('d/m/Y H:i'),
                ], $answers));
            }

            fclose($handle);
        }, 200, $headers);
    }
}
