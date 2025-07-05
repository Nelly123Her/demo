<?php

namespace App\DataTables;

use App\Models\NotasDeVenta;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;

class NotasDeVentaDataTable extends DataTable
{
    /**
     * Build the DataTable class.
     */
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        return (new EloquentDataTable($query))->setRowId('id');
    }

    /**
     * Get the query source of dataTable.
     */
    public function query(NotasDeVenta $model): QueryBuilder
    {
        return $model->newQuery();
    }

    /**
     * Build the HTML structure and options for DataTable.
     */
public function html(): HtmlBuilder
{
    return $this->builder()
        ->setTableId('notas-de-venta-table')
        ->columns($this->getColumns())
        ->minifiedAjax()
        ->dom("Brt<'row d-flex justify-content-between'<'col-sm-12 col-md-5'i><'col-sm-12 col-md-7'p>>")
        ->buttons([
            'copy', 'csv', 'excel', 'pdf', 'print'
        ])
        ->addTableClass('table align-middle table-row-dashed fs-6 gy-5 dataTable no-footer text-gray-600 fw-semibold')
        ->setTableHeadClass('text-start text-muted fw-bold fs-7 text-uppercase gs-0')
        ->orderBy(0)
        ->parameters([
            'language' => [
                'search' => null, // oculta el label de búsqueda
            ],
        ]);
}
    /**
     * Define the columns displayed in the DataTable.
     */
    protected function getColumns(): array
    {
        return [
            Column::make('folio')->title('Folio'),
            Column::make('fecha_hora')->title('Fecha Hora'),
            Column::make('cliente')->title('Cliente'),
            Column::make('servicio')->title('Servicio'),
            Column::make('total')->title('Total'),
            Column::make('pagado')->title('Pagado'),
            Column::make('apertura')->title('Apertura'),
            Column::make('factura')->title('Factura'),
            Column::make('estado')->title('Estado'),
        ];
    }

    /**
     * Export filename.
     */
    protected function filename(): string
    {
        return 'NotasDeVenta_' . date('YmdHis');
    }
}