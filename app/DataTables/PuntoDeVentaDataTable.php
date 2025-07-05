<?php

namespace App\DataTables;

use App\Models\PuntoVenta;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;

class PuntoDeVentaDataTable extends DataTable
{
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        return (new EloquentDataTable($query))
            ->editColumn('precio_venta', fn($row) => '$' . number_format($row->precio_venta, 2))
            ->editColumn('cantidad', fn($row) => number_format($row->cantidad, 2))
            ->editColumn('importe', fn($row) => '$' . number_format($row->importe, 2))
            ->addColumn('imagen', function($row) {
                if ($row->imagen_url) {
                    return '<img src="' . $row->imagen_url . '" class="img-thumbnail" style="width: 60px;" />';
                }
                return '<span class="text-muted">No image</span>';
            })
            ->rawColumns(['imagen'])
            ->setRowId('id');
    }

    public function query(PuntoVenta $model): QueryBuilder
    {
        return $model->newQuery();
    }

    public function html(): HtmlBuilder
    {
        return $this->builder()
            ->setTableId('punto-venta-table')
            ->columns($this->getColumns())
            ->minifiedAjax()
            ->dom("Brt<'row d-flex justify-content-between'<'col-md-5'i><'col-md-7'p>>")
            ->buttons(['copy', 'csv', 'excel', 'pdf', 'print'])
            ->addTableClass('table align-middle table-row-dashed fs-6 gy-5 text-gray-600 fw-semibold')
            ->setTableHeadClass('text-start text-muted fw-bold fs-7 text-uppercase gs-0')
            ->orderBy(0);
    }

    protected function getColumns(): array
    {
        return [
            Column::make('numero')->title('No'),
            Column::make('codigo')->title('Código'),
            Column::make('descripcion')->title('Descripción'),
            Column::make('precio_venta')->title('P Venta'),
            Column::make('cantidad')->title('Cantidad'),
            Column::make('importe')->title('Importe'),
            Column::computed('imagen')->title('Imagen')->exportable(false)->printable(false),
        ];
    }

    protected function filename(): string
    {
        return 'PuntoDeVenta_' . date('YmdHis');
    }
}