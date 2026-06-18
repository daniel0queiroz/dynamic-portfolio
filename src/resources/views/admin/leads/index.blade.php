@extends('admin.layouts.layout')

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Leads</h1>
        </div>

        <div class="section-body">
            <div class="row mb-3">
                <div class="col-12">
                    <form method="GET" action="{{ route('admin.leads.index') }}" class="d-flex align-items-center gap-2 flex-wrap">
                        <select name="service_page_id" class="form-control" style="max-width:260px">
                            <option value="">All landing pages</option>
                            @foreach ($servicePages as $sp)
                                <option value="{{ $sp->id }}" {{ request('service_page_id') == $sp->id ? 'selected' : '' }}>
                                    {{ $sp->getTranslation('title', 'en', true) }}
                                </option>
                            @endforeach
                        </select>
                        <button class="btn btn-primary ml-2">Filter</button>
                        @if(request('service_page_id'))
                            <a href="{{ route('admin.leads.index') }}" class="btn btn-secondary ml-1">Clear</a>
                            <a href="{{ route('admin.leads.export', ['service_page_id' => request('service_page_id')]) }}"
                               class="btn btn-success ml-1">
                                <i class="fas fa-file-csv"></i> Export CSV
                            </a>
                        @else
                            <a href="{{ route('admin.leads.export') }}" class="btn btn-success ml-1">
                                <i class="fas fa-file-csv"></i> Export All CSV
                            </a>
                        @endif
                    </form>
                </div>
            </div>

            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            @if ($leads->isEmpty())
                                <p class="text-muted">No leads captured yet.</p>
                            @else
                                <div class="table-responsive">
                                    <table class="table table-striped table-hover">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Service</th>
                                                <th>Lang</th>
                                                <th>First Answer</th>
                                                <th>Date</th>
                                                <th class="text-center">Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($leads as $lead)
                                                <tr>
                                                    <td>{{ $lead->id }}</td>
                                                    <td>
                                                        <a href="{{ url('service/' . $lead->servicePage?->slug) }}" target="_blank" class="text-muted" style="font-size:12px">
                                                            {{ $lead->servicePage?->getTranslation('title', 'en', true) }}
                                                        </a>
                                                    </td>
                                                    <td><span class="badge badge-primary">{{ strtoupper($lead->locale) }}</span></td>
                                                    <td>
                                                        @php $first = $lead->answers->first(); @endphp
                                                        @if ($first)
                                                            <strong>{{ $first->field?->getTranslation('label', 'en', true) }}:</strong>
                                                            {{ Str::limit($first->value, 40) }}
                                                        @endif
                                                    </td>
                                                    <td style="white-space:nowrap">{{ $lead->created_at->format('d/m/Y H:i') }}</td>
                                                    <td class="text-center">
                                                        <a href="{{ route('admin.leads.show', $lead->id) }}" class="btn btn-sm btn-info">
                                                            <i class="fas fa-eye"></i>
                                                        </a>
                                                        <a href="{{ route('admin.leads.destroy', $lead->id) }}" class="btn btn-sm btn-danger delete-item ml-1">
                                                            <i class="fas fa-trash"></i>
                                                        </a>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                                <div class="mt-3">
                                    {{ $leads->links() }}
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
