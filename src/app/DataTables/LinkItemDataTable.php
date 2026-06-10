<?php

namespace App\DataTables;

use App\Models\LinkItem;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;

class LinkItemDataTable extends DataTable
{
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        return (new EloquentDataTable($query))
            ->editColumn('name', fn($row) => $row->getTranslation('name', 'en', false))
            ->editColumn('is_active', fn($row) => $row->is_active
                ? '<span class="badge badge-success">Active</span>'
                : '<span class="badge badge-danger">Inactive</span>')
            ->addColumn('action', fn($row) =>
                '<a href="' . route('admin.link-item.edit', $row->id) . '" class="btn btn-primary"><i class="fas fa-edit"></i></a>' .
                '<a href="' . route('admin.link-item.destroy', $row->id) . '" class="btn btn-danger delete-item ml-1"><i class="fas fa-trash"></i></a>'
            )
            ->rawColumns(['is_active', 'action'])
            ->setRowId('id');
    }

    public function query(LinkItem $model): QueryBuilder
    {
        return $model->newQuery()->orderBy('sort_order');
    }

    public function html(): HtmlBuilder
    {
        return $this->builder()
            ->setTableId('link-item-table')
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
            Column::make('sort_order')->width(80)->title('Order'),
            Column::make('name')->width(300),
            Column::make('url'),
            Column::make('is_active')->width(100)->title('Status'),
            Column::computed('action')
                ->exportable(false)
                ->printable(false)
                ->width(150)
                ->addClass('text-center'),
        ];
    }

    protected function filename(): string
    {
        return 'LinkItems_' . date('YmdHis');
    }
}
