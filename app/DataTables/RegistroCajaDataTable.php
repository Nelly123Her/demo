<?php

namespace App\DataTables;

use App\Models\RegistroCaja;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Services\DataTable;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;

class RegistroCajaDataTable extends DataTable
{
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        return (new EloquentDataTable($query))
            ->editColumn('fecha_apertura', fn($row) => $row->fecha_apertura?->format('d M Y'))
            ->editColumn('fecha_cierre', fn($row) => $row->fecha_cierre?->format('d M Y'))
            ->editColumn('efectivo', fn($row) => number_format($row->efectivo, 2))
            ->editColumn('tc_dolar', fn($row) => number_format($row->tc_dolar, 2))
            ->editColumn('estado', fn($row) => ucfirst($row->estado))
            ->addColumn('actions', fn($row) => view('ventas.registro-en-caja.columns._actions', compact('row')))
            ->setRowId('id');
    }

    public function query(RegistroCaja $model): QueryBuilder
    {
        return $model->newQuery();
    }

public function html(): HtmlBuilder
{
    return $this->builder()
        ->setTableId('registro-caja-table')
        ->columns($this->getColumns())
        ->minifiedAjax()
        ->dom('Brt<"row d-flex justify-content-between" <"col-md-5" i><"col-md-7" p>>')
        ->buttons([
            'copy', 'csv', 'excel', 'pdf', 'print'
        ])
        ->addTableClass('table align-middle table-row-dashed fs-6 gy-5 dataTable no-footer text-gray-600 fw-semibold')
        ->setTableHeadClass('text-start text-muted fw-bold fs-7 text-uppercase gs-0')
        ->orderBy(1)
        ->drawCallback("function() {" . file_get_contents(resource_path('views/ventas/registro-en-caja/columns/_draw-scripts.js')) . "}");
}

    protected function getColumns(): array
    {
        return [
            Column::make('id')->title('ID'),
            Column::make('fecha_apertura')->title('Apertura'),
            Column::make('fecha_cierre')->title('Cierre'),
            Column::make('efectivo')->title('Efectivo'),
            Column::make('tc_dolar')->title('TC Dólar'),
            Column::make('estado')->title('Estado'),
            Column::computed('actions')
                ->title('Acciones')
                ->exportable(false)
                ->printable(false)
                ->width(60)
                ->addClass('text-end text-nowrap'),
        ];
    }

    protected function filename(): string
    {
        return 'RegistroCaja_' . date('YmdHis');
    }
}