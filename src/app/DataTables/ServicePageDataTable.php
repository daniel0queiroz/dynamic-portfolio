<?php

namespace App\DataTables;

use App\Models\ServicePage;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;

class ServicePageDataTable extends DataTable
{
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        return (new EloquentDataTable($query))
            ->editColumn('title', fn($row) => $row->getTranslation('title', 'en', false))
            ->editColumn('is_active', fn($row) => $row->is_active
                ? '<span class="badge badge-success">Active</span>'
                : '<span class="badge badge-danger">Inactive</span>')
            ->addColumn('preview', fn($row) =>
                '<a href="' . url('service/' . $row->slug) . '" target="_blank" class="btn btn-sm btn-info"><i class="fas fa-eye"></i></a>'
            )
            ->addColumn('action', fn($row) =>
                '<a href="' . route('admin.service-page.edit', $row->id) . '" class="btn btn-primary"><i class="fas fa-edit"></i></a> ' .
                '<a href="' . route('admin.service-page.destroy', $row->id) . '" class="btn btn-danger delete-item ml-1"><i class="fas fa-trash"></i></a>'
            )
            ->rawColumns(['is_active', 'preview', 'action'])
            ->setRowId('id');
    }

    public function query(ServicePage $model): QueryBuilder
    {
        return $model->newQuery();
    }

    public function html(): HtmlBuilder
    {
        return $this->builder()
            ->setTableId('service-page-table')
            ->columns($this->getColumns())
            ->minifiedAjax()
            ->orderBy(0)
            ->selectStyleSingle()
            ->buttons([
                Button::make('excel'),
                Button::make('csv'),
                Button::make('pdf'),
                Button::make('print'),
                Button::make('reset'),
                Button::make('reload'),
            ]);
    }

    public function getColumns(): array
    {
        return [
            Column::make('id')->width(60),
            Column::make('slug')->width(150),
            Column::make('title')->width(300),
            Column::make('is_active')->width(100)->title('Status'),
            Column::computed('preview')->width(80)->title('View')->exportable(false)->printable(false),
            Column::computed('action')->exportable(false)->printable(false)->width(150)->addClass('text-center'),
        ];
    }

    protected function filename(): string
    {
        return 'ServicePages_' . date('YmdHis');
    }
}
