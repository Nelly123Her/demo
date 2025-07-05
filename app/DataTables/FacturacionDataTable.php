<?php

namespace App\DataTables;

use App\Models\Factura;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;

class FacturacionDataTable extends DataTable
{
    public function dataTable($query)
    {
        return datatables()
            ->eloquent($query)
            ->editColumn('subtotal', fn($f) => number_format($f->subtotal, 2))
            ->editColumn('total', fn($f) => number_format($f->total, 2))
            ->editColumn('pagado', fn($f) => number_format($f->pagado, 2))
            ->addColumn('pdf', fn($f) => $f->pdf_url ? "<a href='$f->pdf_url' target='_blank'>PDF</a>" : '-')
            ->addColumn('xml', fn($f) => $f->xml_url ? "<a href='$f->xml_url' target='_blank'>XML</a>" : '-')
            ->rawColumns(['pdf', 'xml'])
            ->setRowId('id');
    }

    public function query(Factura $model)
    {
        return $model->newQuery();
    }

 public function html()
{
    return $this->builder()
        ->setTableId('facturacion-table')
        ->columns($this->getColumns())
        ->minifiedAjax()
        ->dom("Brt<'row d-flex justify-content-between'<'col-sm-12 col-md-5'i><'col-sm-12 col-md-7'p>>")
        ->buttons([
            ['extend' => 'copy', 'text' => 'Copiar'],
            ['extend' => 'csv', 'text' => 'CSV'],
            ['extend' => 'excel', 'text' => 'Excel'],
            ['extend' => 'pdf', 'text' => 'PDF'],
            ['extend' => 'print', 'text' => 'Imprimir'],
          
        ])
        ->addTableClass('table align-middle table-row-dashed fs-6 gy-5 dataTable no-footer text-gray-600 fw-semibold')
        ->setTableHeadClass('text-start text-muted fw-bold fs-7 text-uppercase gs-0')
        ->orderBy(1)
        ->parameters([
            'language' => [
                'search' => 'Buscar:',
                'lengthMenu' => 'Mostrar _MENU_ registros por página',
                'zeroRecords' => 'No se encontraron registros',
                'info' => 'Mostrando página _PAGE_ de _PAGES_',
                'infoEmpty' => 'No hay registros disponibles',
                'infoFiltered' => '(filtrado de _MAX_ registros totales)',
            ],
        ]);
}
    protected function getColumns(): array
    {
        return [
            Column::make('serie_folio')->title('Serie Folio'),
            Column::make('fecha_hora')->title('Fecha Hora'),
            Column::make('cliente')->title('Cliente'),
            Column::make('subtotal')->title('Subtotal'),
            Column::make('total')->title('Total'),
            Column::make('pagado')->title('Pagado'),
            Column::make('folio_fiscal')->title('Folio Fiscal'),
            Column::make('metodo_pago')->title('Método Pago'),
            Column::make('estado')->title('Estado'),
            Column::computed('pdf')->title('PDF')->exportable(false)->printable(false),
            Column::computed('xml')->title('XML')->exportable(false)->printable(false),
        ];
    }

    protected function filename(): string
    {
        return 'Facturacion_' . date('YmdHis');
    }
}