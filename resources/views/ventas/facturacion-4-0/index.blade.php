<x-default-layout>
    @section('title')
        Facturación 4.0
    @endsection

    @section('breadcrumbs')
        {{ Breadcrumbs::render('ventas.facturacion-4-0') }}
    @endsection

    <div class="card">
        <div class="card-header border-0 pt-6">
            <div class="card-title">
                <div class="d-flex align-items-center position-relative my-1">
                    {!! getIcon('magnifier', 'fs-3 position-absolute ms-5') !!}
                    <input type="text" id="facturacionSearchInput" class="form-control form-control-solid w-250px ps-13" placeholder="Buscar factura"/>
                </div>
            </div>
            <div class="card-toolbar">
                <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#modalCrearCFDI">
                    {!! getIcon('plus-square','fs-3') !!} Crear CFDI
                </button>
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
        <script>
            document.getElementById('facturacionSearchInput').addEventListener('keyup', function () {
                window.LaravelDataTables['facturacion-table'].search(this.value).draw();
            });
        </script>
    @endpush

</x-default-layout>

    <!-- Modal Crear CFDI -->
    <div class="modal fade" id="modalCrearCFDI" tabindex="-1" aria-labelledby="modalCrearCFDILabel" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content rounded-3 shadow-lg border-success border border-dashed">
                <div class="modal-header">
                    <h2 class="fw-bold text-success">Crear CFDI</h2>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
                </div>
                <div class="modal-body">
                    <form id="crearCFDIForm" class="bg-light-success p-4 rounded">
                        <div class="row">
                            <div class="col-md-4 mb-3">
                                <label class="form-label fw-bold text-success text-gray-700">* Fecha y Hora</label>
                                <input type="datetime-local" class="form-control form-control-solid" name="fecha_hora" required>
                            </div>
                            <div class="col-md-4 mb-3">
                                <label class="form-label fw-bold text-success text-gray-700">* Tipo CFDI</label>
                                <select class="form-select form-control-solid" name="tipo_cfdi" required>
                                    <option value="Ingreso">Ingreso</option>
                                </select>
                            </div>
                            <div class="col-md-4 mb-3">
                                <label class="form-label fw-bold text-success text-gray-700">* Forma de Pago</label>
                                <select class="form-select form-control-solid" name="forma_pago" required>
                                    <option value="">Seleccionar</option>
                                </select>
                            </div>
                            <div class="col-md-4 mb-3">
                                <label class="form-label fw-bold text-success text-gray-700">* Serie</label>
                                <select class="form-select form-control-solid" name="serie" required>
                                    <option value="">Seleccionar</option>
                                </select>
                            </div>
                            <div class="col-md-4 mb-3">
                                <label class="form-label fw-bold text-success text-gray-700">* Folio</label>
                                <input type="text" class="form-control form-control-solid" name="folio" required>
                            </div>
                            <div class="col-md-4 mb-3">
                                <label class="form-label fw-bold text-success text-gray-700">Cliente</label>
                                <select class="form-select form-control-solid" name="cliente">
                                    <option value="">Seleccionar</option>
                                </select>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label fw-bold text-success text-gray-700">RFC</label>
                                <input type="text" class="form-control form-control-solid" name="rfc">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label fw-bold text-success text-gray-700">USO DE CFDI</label>
                                <select class="form-select form-control-solid" name="uso_cfdi">
                                    <option value="G01">G01 - Adquisición de mercancías</option>
                                </select>
                            </div>
                            <div class="col-12 mb-3">
                                <label class="form-label fw-bold text-success text-gray-700">* CONCEPTO</label>
                                <input type="text" class="form-control form-control-solid" name="concepto" required>
                            </div>
                            <div class="col-md-3 mb-3">
                                <label class="form-label fw-bold text-success text-gray-700">* CANTIDAD</label>
                                <input type="number" class="form-control form-control-solid" name="cantidad" required>
                            </div>
                            <div class="col-md-3 mb-3">
                                <label class="form-label fw-bold text-success text-gray-700">* UNIDAD</label>
                                <input type="text" class="form-control form-control-solid" name="unidad" required>
                            </div>
                            <div class="col-md-3 mb-3">
                                <label class="form-label fw-bold text-success text-gray-700">* PRECIO UNITARIO</label>
                                <input type="number" class="form-control form-control-solid" name="precio_unitario" required>
                            </div>
                            <div class="col-md-3 mb-3">
                                <label class="form-label fw-bold text-success text-gray-700">IMPORTE</label>
                                <input type="number" class="form-control form-control-solid" name="importe" readonly>
                            </div>
                            <div class="col-12 mb-3">
                                <label class="form-label fw-bold text-success text-gray-700">Observaciones</label>
                                <textarea class="form-control" name="observaciones" rows="2"></textarea>
                            </div>
                            <div class="col-md-4 offset-md-8 mb-3">
                                <div class="bg-light-success p-3 rounded shadow-sm text-end">
                                    <span class="fw-bold">Subtotal $: <span id="subtotal">0</span></span><br>
                                    <span class="fw-bold">IVA $: <span id="iva">0</span></span><br>
                                    <span class="fw-bold">Total $: <span id="total">0</span></span>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer gap-2">
                            <button type="submit" class="btn btn-success fw-bold">Facturar</button>
                            <button type="button" class="btn btn-light" data-bs-dismiss="modal">Cerrar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    @push('scripts')
        {{ $dataTable->scripts() }}
        <script>
            document.getElementById('crearCFDIForm').addEventListener('submit', function (e) {
                e.preventDefault();
                alert('CFDI guardado (simulación). Implementar lógica real.');
                const modal = bootstrap.Modal.getInstance(document.getElementById('modalCrearCFDI'));
                if (modal) modal.hide();
            });
        </script>
    @endpush