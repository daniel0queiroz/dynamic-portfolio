@extends('admin.layouts.layout')

@section('content')
    <section class="section">
        <div class="section-header">
            <div class="section-header-back">
                <a href="{{ route('admin.leads.index') }}" class="btn btn-icon"><i class="fas fa-arrow-left"></i></a>
            </div>
            <h1>Lead #{{ $lead->id }}</h1>
        </div>

        <div class="section-body">
            <div class="row">
                <div class="col-12 col-md-8 col-lg-6">
                    <div class="card">
                        <div class="card-header">
                            <h4>Lead Details</h4>
                        </div>
                        <div class="card-body">
                            <table class="table table-bordered">
                                <tbody>
                                    <tr>
                                        <th style="width:35%">Service</th>
                                        <td>
                                            <a href="{{ url('service/' . $lead->servicePage?->slug) }}" target="_blank">
                                                {{ $lead->servicePage?->getTranslation('title', 'en', true) }}
                                            </a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>Language</th>
                                        <td>{{ strtoupper($lead->locale) }}</td>
                                    </tr>
                                    <tr>
                                        <th>IP Address</th>
                                        <td>{{ $lead->ip_address }}</td>
                                    </tr>
                                    <tr>
                                        <th>LGPD Consent</th>
                                        <td>{{ $lead->lgpd_consent ? 'Yes ✓' : 'No' }}</td>
                                    </tr>
                                    <tr>
                                        <th>Submitted</th>
                                        <td>{{ $lead->created_at->format('d/m/Y H:i:s') }}</td>
                                    </tr>
                                </tbody>
                            </table>

                            <h5 class="mt-4 mb-3">Answers</h5>
                            <table class="table table-striped">
                                <thead>
                                    <tr><th>Field</th><th>Answer</th></tr>
                                </thead>
                                <tbody>
                                    @forelse ($lead->answers as $answer)
                                        <tr>
                                            <td class="font-weight-bold" style="width:38%">
                                                {{ $answer->field?->getTranslation('label', 'en', true) }}
                                            </td>
                                            <td>
                                                @if ($answer->field?->type === 'select')
                                                    {{ $answer->field->getOptionLabel($answer->value, 'en') }}
                                                    <small class="text-muted">({{ $answer->value }})</small>
                                                @else
                                                    {{ $answer->value }}
                                                @endif
                                            </td>
                                        </tr>
                                    @empty
                                        <tr><td colspan="2" class="text-muted">No answers recorded.</td></tr>
                                    @endforelse
                                </tbody>
                            </table>

                            <div class="mt-4">
                                <a href="{{ route('admin.leads.index') }}" class="btn btn-secondary">Back to list</a>
                                <a href="{{ route('admin.leads.destroy', $lead->id) }}" class="btn btn-danger ml-2 delete-item">Delete lead</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
