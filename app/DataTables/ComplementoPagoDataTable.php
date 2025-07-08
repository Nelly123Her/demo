<?php

namespace App\DataTables;

use App\Models\ComplementoPago;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Services\DataTable;

class ComplementoPagoDataTable extends DataTable
{
    /**
     * Construye el DataTable.
     */
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        return (new EloquentDataTable($query))
            ->editColumn('subtotal', fn($f) => number_format($f->subtotal, 2))
            ->editColumn('total', fn($f) => number_format($f->total, 2))
            ->editColumn('fecha_hora', fn($f) => \Carbon\Carbon::parse($f->fecha_hora)->format('Y-m-d H:i:s'))
            ->addColumn('pdf', fn($f) => $f->pdf_url ? "<a href='$f->pdf_url' target='_blank'>PDF</a>" : '-')
            ->addColumn('xml', fn($f) => $f->xml_url ? "<a href='$f->xml_url' target='_blank'>XML</a>" : '-')
            ->rawColumns(['pdf', 'xml'])
            ->setRowId('id');
    }

    /**
     * Fuente de datos.
     */
 public function query(ComplementoPago $model): QueryBuilder
{
    $query = $model->newQuery();

    $startDate = request('start_date');
    $endDate = request('end_date');

    if ($startDate && $endDate) {
        $query->whereBetween('fecha_hora', [
            $startDate . ' 00:00:00',
            $endDate . ' 23:59:59'
        ]);
    }

    return $query;
}

    /**
     * Configuración de HTML.
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
            ->setTableId('complementos-pago-table')
            ->columns($this->getColumns())
            ->minifiedAjax()
            ->dom("Brt<'row d-flex justify-content-between'<'col-sm-12 col-md-5'i><'col-sm-12 col-md-7'p>>")
            ->buttons(['copy', 'csv', 'excel', 'pdf', 'print'])
            ->addTableClass('table align-middle table-row-dashed fs-6 gy-5 text-gray-600 fw-semibold')
            ->setTableHeadClass('text-start text-muted fw-bold fs-7 text-uppercase gs-0')
            ->orderBy(1)
            ->parameters([
                'language' => [
                    'search' => null, // oculta el label por defecto
                ],
            ]);
    }

    /**
     * Columnas mostradas en el DataTable.
     */
    protected function getColumns(): array
    {
        return [
            Column::make('serie_folio')->title('Serie Folio'),
            Column::make('fecha_hora')->title('Fecha Hora'),
            Column::make('cliente')->title('Cliente'),
            Column::make('subtotal')->title('Subtotal'),
            Column::make('total')->title('Total'),
            Column::make('folio_fiscal')->title('Folio Fiscal'),
            Column::make('metodo_pago')->title('Método Pago'),
            Column::make('estado')->title('Estado'),
            Column::computed('pdf')->title('PDF')->exportable(false)->printable(false),
            Column::computed('xml')->title('XML')->exportable(false)->printable(false),
        ];
    }

    /**
     * Nombre del archivo de exportación.
     */
    protected function filename(): string
    {
        return 'ComplementosPago_' . date('YmdHis');
    }
}