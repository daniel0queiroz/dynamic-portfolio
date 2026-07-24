@extends('admin.layouts.layout')

@push('styles')
    <style>
        #portfolioitem-table td.reorder-handle { cursor: grab; }
    </style>
@endpush

@section('content')
    <section class="section">
          <div class="section-header">
            <div class="section-header-back">
              <a href="javascript:history.back()" class="btn btn-icon"><i class="fas fa-arrow-left"></i></a>
            </div>
            <h1>Portfolio Item</h1>
          </div>

          <div class="section-body">
            <div class="row">
              <div class="col-12">
                <div class="card">
                  <div class="card-header">
                    <h4>All Portfolio Item</h4>
                    <div class="card-header-action">
                        <a href="{{route('admin.portfolio-item.create')}}" class="btn btn-success">Create New <i class="fas fa-plus"></i></a>
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
            $('#portfolioitem-table').on('init.dt', function () {
                var tbody = document.querySelector('#portfolioitem-table tbody');

                Sortable.create(tbody, {
                    handle: 'td.reorder-handle',
                    animation: 150,
                    forceFallback: true,
                    onEnd: function () {
                        var order = Array.from(tbody.querySelectorAll('tr')).map(function (tr) {
                            return tr.id;
                        });

                        $.post("{{ route('admin.portfolio-item.reorder') }}", { order: order })
                            .done(function () {
                                toastr.success('Order updated!', 'Success');
                                window.LaravelDataTables['portfolioitem-table'].ajax.reload(null, false);
                            })
                            .fail(function () {
                                toastr.error('Could not save the new order.', 'Error');
                                window.LaravelDataTables['portfolioitem-table'].ajax.reload(null, false);
                            });
                    },
                });
            });
        });
    </script>
@endpush