@extends('admin.layouts.layout')

@push('styles')
    <style>
        #link-item-table td.reorder-handle { cursor: grab; }
        #link-item-table tr.sortable-ghost { opacity: 0.4; }
    </style>
@endpush

@section('content')
    <section class="section">
        <div class="section-header">
            <div class="section-header-back">
                <a href="javascript:history.back()" class="btn btn-icon"><i class="fas fa-arrow-left"></i></a>
            </div>
            <h1>Links Page</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></div>
                <div class="breadcrumb-item active">Link Items</div>
            </div>
        </div>

        <div class="section-body">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>All Link Items</h4>
                            <div class="card-header-action">
                                <a href="{{ route('admin.link-item.create') }}" class="btn btn-success">
                                    Create New <i class="fas fa-plus"></i>
                                </a>
                                <a href="{{ url('/links') }}" target="_blank" class="btn btn-info ml-1">
                                    View Page <i class="fas fa-external-link-alt"></i>
                                </a>
                            </div>
                        </div>
                        <div class="card-body">
                            {{ $dataTable->table() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/sortablejs@1.15.2/Sortable.min.js"></script>
@endpush

@push('scripts')
    {{ $dataTable->scripts(attributes: ['type' => 'module']) }}
@endpush

@push('scripts')
    <script>
        $(function () {
            $('#link-item-table').on('init.dt', function () {
                var tbody = document.querySelector('#link-item-table tbody');

                Sortable.create(tbody, {
                    handle: 'td.reorder-handle',
                    animation: 150,
                    forceFallback: true,
                    onEnd: function () {
                        var order = Array.from(tbody.querySelectorAll('tr')).map(function (tr) {
                            return tr.id;
                        });

                        $.post("{{ route('admin.link-item.reorder') }}", { order: order })
                            .done(function () {
                                toastr.success('Link order updated!', 'Success');
                                window.LaravelDataTables['link-item-table'].ajax.reload(null, false);
                            })
                            .fail(function () {
                                toastr.error('Could not save the new order.', 'Error');
                                window.LaravelDataTables['link-item-table'].ajax.reload(null, false);
                            });
                    },
                });
            });
        });
    </script>
@endpush
