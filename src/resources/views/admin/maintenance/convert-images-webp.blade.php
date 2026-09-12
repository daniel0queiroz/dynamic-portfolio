@extends('admin.layouts.layout')

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Convert Images to WebP</h1>
        </div>
        <div class="section-body">
            <div class="card">
                <div class="card-body">
                    <p>
                        <strong>Converted:</strong> {{ count($results['converted']) }} &nbsp;
                        <strong>Skipped:</strong> {{ count($results['skipped']) }} &nbsp;
                        <strong>Errors:</strong> {{ count($results['errors']) }}
                    </p>

                    @if(count($results['converted']))
                        <h5>Converted</h5>
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>Old file</th>
                                    <th>New file</th>
                                    <th>Old size</th>
                                    <th>New size</th>
                                    <th>Rows updated</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($results['converted'] as $item)
                                    <tr>
                                        <td>{{ $item['old'] }}</td>
                                        <td>{{ $item['new'] }}</td>
                                        <td>{{ number_format($item['old_size'] / 1024, 1) }} KB</td>
                                        <td>{{ number_format($item['new_size'] / 1024, 1) }} KB</td>
                                        <td>{{ $item['rows_updated'] }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    @endif

                    @if(count($results['skipped']))
                        <h5>Skipped</h5>
                        <ul>
                            @foreach($results['skipped'] as $skipped)
                                <li>{{ $skipped }}</li>
                            @endforeach
                        </ul>
                    @endif

                    @if(count($results['errors']))
                        <h5 class="text-danger">Errors</h5>
                        <ul>
                            @foreach($results['errors'] as $error)
                                <li class="text-danger">{{ $error }}</li>
                            @endforeach
                        </ul>
                    @endif

                    @if(count($results['converted']) === 0 && count($results['skipped']) === 0)
                        <p>No JPEG/PNG uploads found to convert — everything is already WebP (or nothing left to do).</p>
                    @endif
                </div>
            </div>
        </div>
    </section>
@endsection
