<x-default-layout>
    @section('title', 'Complementos de Pago 2.0')

    @section('breadcrumbs')
        {{ Breadcrumbs::render('ventas.complementos-de-pago') }}
    @endsection

    <div class="card">
        <div class="card-header border-0 pt-6">
            <div class="card-title gap-3">
                <div class="d-flex align-items-center position-relative">
                    {!! getIcon('magnifier', 'fs-3 position-absolute ms-5') !!}
                    <input type="text" class="form-control form-control-solid w-250px ps-13"
                           placeholder="Buscar folio" id="complementosSearchInput" />
                </div>

                <div class="position-relative">
                    <input class="form-control form-control-solid w-250px ps-13" placeholder="Filtrar por fecha"
                           id="dateRangePicker" />
                    {!! getIcon('calendar', 'fs-3 position-absolute top-50 translate-middle-y ms-5') !!}
                </div>
            </div>
        </div>

        <div class="card-body py-4">
            <div class="table-responsive">
                {{ $dataTable->table() }}
            </div>
        </div>
    </div>

    @push('scripts')
        {{ $dataTable->scripts() }}

        {{-- Date Range Picker --}}
        <script>
            $(function () {
                const table = window.LaravelDataTables['complementos-pago-table'];

                // Búsqueda por texto
                document.getElementById('complementosSearchInput').addEventListener('keyup', function () {
                    table.search(this.value).draw();
                });

                // Date range picker
                $('#dateRangePicker').daterangepicker({
                    autoUpdateInput: false,
                    locale: {
                        cancelLabel: 'Limpiar',
                        applyLabel: 'Aplicar',
                        format: 'YYYY-MM-DD',
                    }
                });

                $('#dateRangePicker').on('apply.daterangepicker', function (ev, picker) {
                    $(this).val(picker.startDate.format('YYYY-MM-DD') + ' - ' + picker.endDate.format('YYYY-MM-DD'));
                    table.draw();
                });

                $('#dateRangePicker').on('cancel.daterangepicker', function () {
                    $(this).val('');
                    table.draw();
                });

                // Agregar parámetros al request
                table.on('preXhr.dt', function (e, settings, data) {
                    const rango = $('#dateRangePicker').val();
                    if (rango) {
                        const [start, end] = rango.split(' - ');
                        data.start_date = start;
                        data.end_date = end;
                    } else {
                        data.start_date = '';
                        data.end_date = '';
                    }
                });
            });
        </script>
    @endpush
</x-default-layout>