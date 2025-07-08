<div>
    <div class="card shadow-lg border-0 rounded-3">
        {{-- HEADER --}}
        <div class="card-header bg-light border-0 pt-4 pb-3 px-4 shadow-sm">
            <div class="d-flex flex-wrap align-items-center gap-2 mb-3">
                <button class="btn btn-outline-primary btn-sm rounded-pill fw-semibold px-4 py-1">
                    {!! getIcon('tools', 'fs-6 me-2') !!} Ferretería Venta
                </button>
                <button class="btn btn-outline-success btn-sm rounded-pill fw-semibold px-4 py-1" data-bs-toggle="modal" data-bs-target="#productoModal">
                    {!! getIcon('plus', 'fs-6 me-2') !!} Nuevo Producto
                </button>
            </div>
            <div class="d-flex gap-2 overflow-auto py-2 px-3 bg-light rounded-2 scrollbar-hidden" style="border-radius: 0.75rem; white-space: nowrap; max-width: 100%;">
                @foreach(range(10001, 10010) as $folio)
                    <span class="badge bg-primary text-white px-3 py-2 fw-semibold rounded-2" style="cursor:pointer;">
                        {!! getIcon('tag', 'fs-6 me-2') !!} FOLIO: {{ $folio }}
                    </span>
                @endforeach
            </div>
        </div>

        {{-- ERROR MESSAGE --}}
        @if (session()->has('error'))
            <div class="alert alert-danger d-flex align-items-center m-4">
                {!! getIcon('info-circle', 'fs-4 me-2') !!}
                <span>{{ session('error') }}</span>
            </div>
        @endif

        {{-- FORMULARIO --}}
        <div class="card-body p-4">
            <div class="row mb-4 align-items-end g-3">
                <div class="col-md-3">
                    <label class="form-label">Código de producto</label>
                    <input type="text" class="form-control form-control-sm rounded-pill" placeholder="Ej. 12345" wire:model="codigo">
                </div>
                <div class="col-md-2">
                    <label class="form-label">Cantidad</label>
                    <input type="number" class="form-control form-control-sm rounded-pill" placeholder="1" wire:model="cantidad" min="1">
                </div>
                <div class="col-md-2">
                    <button class="btn btn-success btn-sm w-100 fw-semibold rounded-pill" style="font-size:0.97rem;" onclick="let modal = new bootstrap.Modal(document.getElementById('productDetailModal')); modal.show();">
                        {!! getIcon('plus-circle', 'fs-6 me-1') !!} Agregar
                    </button>
                </div>
                <div class="col-md-2">
                    <button class="btn btn-outline-danger btn-sm w-100 fw-semibold rounded-pill" style="font-size:0.97rem;" wire:click="borrarUltimo">
                        {!! getIcon('trash', 'fs-6 me-1') !!} Borrar
                    </button>
                </div>
            </div>

            {{-- TABLA Y VISTA PREVIA --}}
            <div class="row g-3">
                <div class="col-12">
                    <table class="table table-hover table-borderless text-gray-700 fw-medium fs-6 elegant-table">
                        <thead class="bg-light">
                            <tr>
                                <th>#</th>
                                <th>Código</th>
                                <th>Descripción</th>
                                <th>Precio</th>
                                <th>Cantidad</th>
                                <th>Importe</th>
                                <th>ACCIONES</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($items as $index => $item)
                                <tr>
                                    <td>{{ $index + 1 }}</td>
                                    <td>{{ $item['codigo'] }}</td>
                                    <td>{{ $item['descripcion'] }}</td>
                                    <td>${{ number_format($item['precio_venta'], 2) }}</td>
                                    <td>{{ $item['cantidad'] }}</td>
                                    <td>${{ number_format($item['importe'], 2) }}</td>
                                    <td>
                                        <div class="btn-group" role="group">
                                            <!-- View Button -->
                                            <button type="button" class="btn btn-sm btn-light-primary" data-bs-toggle="modal" data-bs-target="#viewProductModal-{{ $index }}">
                                                {!! getIcon('eye') !!}
                                            </button>


                                            <!-- Delete Button -->
                                            <button class="btn btn-sm btn-light-danger" wire:click="borrarUltimo">
                                                {!! getIcon('trash') !!}
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
    {{-- View Product Modals --}}
    @foreach($items as $index => $item)
    <div class="modal fade" id="viewProductModal-{{ $index }}" tabindex="-1" aria-hidden="true" wire:ignore.self>
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content rounded-3 shadow">
                <div class="modal-header bg-primary text-white justify-content-center">
                    {!! getIcon('eye', 'fs-2 me-2') !!}
                    <h5 class="modal-title">Detalle del Producto</h5>
                </div>
                <div class="modal-body">
                    <div class="text-center mb-3">
                        <img src="{{ $item['imagen_url'] ?? asset('images/no-image.png') }}" alt="Producto" class="img-fluid rounded shadow-sm" style="max-height:200px;">
                    </div>
                    <p><strong>Código:</strong> {{ $item['codigo'] }}</p>
                    <p><strong>Descripción:</strong> {{ $item['descripcion'] }}</p>
                    <p><strong>Precio unitario:</strong> ${{ number_format($item['precio_venta'], 2) }}</p>
                    <p><strong>Cantidad:</strong> {{ $item['cantidad'] }}</p>
                    <p><strong>Importe:</strong> ${{ number_format($item['importe'], 2) }}</p>
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                </div>
            </div>
        </div>
    </div>
    @endforeach
                    </table>
                </div>
            </div>
        </div>

        {{-- FOOTER --}}
        <div class="card-footer bg-light shadow-sm d-flex justify-content-between align-items-center border-top px-4 py-3 gap-4 flex-wrap">
            <div class="d-flex flex-column gap-1">
                <p class="mb-0 text-success fw-bold">Los Precios ya incluyen IVA</p>
                <p class="mb-0 text-muted small">{{ $totalArticulos ?? 0 }} Artículo(s) ingresado(s)</p>
                <p class="mb-0 text-muted small">Cajero: ADMINISTRADOR</p>
                <p class="mb-0 text-muted small">
                    {{ now()->isoFormat('dddd, D [de] MMMM [del] YYYY') }} |
                    {{ now()->format('H:i:s') }}
                </p>
            </div>
            <div class="text-end d-flex flex-column align-items-end gap-2">
                <h4 class="text-gray-700 mb-1 fw-bold">TOTAL</h4>
                <h1 class="text-success fw-bolder display-3 mb-0">TOTAL: ${{ number_format($this->total, 2) }}</h1>
                <button class="btn btn-lg btn-success rounded-2 fw-bold mt-2 px-5" data-bs-toggle="modal" data-bs-target="#cobrarNotaModal">
                    {!! getIcon('cash', 'fs-4 me-2') !!} COBRAR
                </button>
            </div>
        </div>
    </div>

    <div class="modal fade" id="cobrarNotaModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered mw-650px">
            <div class="modal-content shadow rounded-3">
                <div class="modal-header bg-success text-white shadow-sm justify-content-center">
                    {!! getIcon('credit-card', 'fs-2 me-2') !!}
                    <h5 class="modal-title text-center flex-grow-1">Confirmar Cobro</h5>
                </div>
                <div class="modal-body py-5 text-center">
                    <p class="fs-5">¿Estás seguro de que deseas procesar esta venta?</p>
                    <h3 class="text-success fw-bold mb-4">${{ number_format($this->total, 2) }}</h3>
                    <div class="d-flex justify-content-center gap-3">
                        <button class="btn btn-secondary btn-sm rounded-pill px-3" data-bs-dismiss="modal">Cancelar</button>
                        <button class="btn btn-primary btn-sm rounded-pill px-3 fw-semibold">
                            {!! getIcon('credit-card', 'fs-4 me-2') !!} Confirmar Pago
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="cierreCajaModal" tabindex="-1" aria-labelledby="cierreCajaModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content shadow rounded-3">
                <div class="modal-header bg-warning text-dark justify-content-center">
                    {!! getIcon('lock', 'fs-2 me-2') !!}
                    <h5 class="modal-title text-center flex-grow-1" id="cierreCajaModalLabel">CIERRE DE CAJA</h5>
                </div>
                <div class="modal-body p-4">
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label class="form-label fw-semibold">Fecha y Hora</label>
                            <input type="text" class="form-control form-control-sm rounded-pill" value="{{ now()->format('Y-m-d H:i:s') }}" readonly />
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-semibold">Cajero</label>
                            <input type="text" class="form-control form-control-sm rounded-pill" value="ADMINISTRADOR" readonly />
                        </div>
                        <div class="col-md-12 mt-3">
                            <label class="form-label fw-semibold">Observaciones</label>
                            <textarea class="form-control form-control-sm rounded-3" rows="3" placeholder="Notas u observaciones..."></textarea>
                        </div>
                    </div>

                    <div class="row mt-4 g-3">
                        <div class="col-md-4 text-center">
                            <h6 class="text-muted">Ventas Efectivo</h6>
                            <p class="fs-4 text-success fw-bold">$0.00</p>
                        </div>
                        <div class="col-md-4 text-center">
                            <h6 class="text-muted">Cobros</h6>
                            <p class="fs-4 text-success fw-bold">$0.00</p>
                        </div>
                        <div class="col-md-4 text-center">
                            <h6 class="text-muted">Salidas</h6>
                            <p class="fs-4 text-danger fw-bold">$0.00</p>
                        </div>
                    </div>
                </div>
                <div class="modal-footer justify-content-between">
                    <div class="d-flex gap-2">
                        <button class="btn btn-info btn-sm rounded-pill text-white">
                            {!! getIcon('printer', 'me-2') !!} IMPRIMIR CORTE
                        </button>
                        <button class="btn btn-success btn-sm rounded-pill text-white">
                            {!! getIcon('check-circle', 'me-2') !!} CIERRE DE CAJA
                        </button>
                        <button class="btn btn-warning btn-sm rounded-pill fw-semibold">
                            {!! getIcon('lock', 'me-2') !!} Confirmar Cierre
                        </button>
                    </div>
                    <button class="btn btn-secondary btn-sm rounded-pill" data-bs-dismiss="modal">Cancelar</button>
                </div>
            </div>
        </div>
    </div>

    <!-- MODAL CREAR CFDI -->
    <div class="modal fade" id="crearCFDIModal" tabindex="-1" aria-labelledby="crearCFDIModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl modal-dialog-centered">
            <div class="modal-content shadow rounded-3">
                <div class="modal-header bg-success text-white justify-content-center">
                    {!! getIcon('file-text', 'fs-2 me-2') !!}
                    <h5 class="modal-title text-center flex-grow-1" id="crearCFDIModalLabel">CREAR CFDI</h5>
                </div>
                <div class="modal-body p-4">
                    <div class="row g-3">
                        <div class="col-md-2">
                            <label class="form-label fw-semibold">* Fecha y Hora</label>
                            <input type="datetime-local" class="form-control form-control-sm rounded-pill" />
                        </div>
                        <div class="col-md-2">
                            <label class="form-label fw-semibold">* Tipo CFDI</label>
                            <select class="form-select form-select-sm rounded-pill">
                                <option selected>Ingreso</option>
                            </select>
                        </div>
                        <div class="col-md-2">
                            <label class="form-label fw-semibold">* Forma de pago</label>
                            <select class="form-select form-select-sm rounded-pill">
                                <option selected>01 - Efectivo</option>
                            </select>
                        </div>
                        <div class="col-md-2">
                            <label class="form-label fw-semibold">* Serie</label>
                            <select class="form-select form-select-sm rounded-pill">
                                <option selected>A</option>
                            </select>
                        </div>
                        <div class="col-md-2">
                            <label class="form-label fw-semibold">* Folio</label>
                            <input type="text" class="form-control form-control-sm rounded-pill" />
                        </div>
                        <div class="col-md-2">
                            <label class="form-label fw-semibold">Cliente</label>
                            <select class="form-select form-select-sm rounded-pill">
                                <option selected>Cliente público</option>
                            </select>
                        </div>
                        <div class="col-md-2">
                            <label class="form-label fw-semibold">RFC</label>
                            <input type="text" class="form-control form-control-sm rounded-pill" />
                        </div>
                        <div class="col-md-2">
                            <label class="form-label fw-semibold">USO DE CFDI</label>
                            <select class="form-select form-select-sm rounded-pill">
                                <option>G01 - Adquisición</option>
                            </select>
                        </div>
                        <div class="col-md-2">
                            <label class="form-label fw-semibold">* CONCEPTO</label>
                            <input type="text" class="form-control form-control-sm rounded-pill" />
                        </div>
                        <div class="col-md-2">
                            <label class="form-label fw-semibold">* CANTIDAD</label>
                            <input type="number" class="form-control form-control-sm rounded-pill" min="1" value="1" />
                        </div>
                        <div class="col-md-2">
                            <label class="form-label fw-semibold">* UNIDAD</label>
                            <input type="text" class="form-control form-control-sm rounded-pill" value="PZA" />
                        </div>
                        <div class="col-md-2">
                            <label class="form-label fw-semibold">* PRECIO UNIT</label>
                            <input type="number" class="form-control form-control-sm rounded-pill" min="0" step="0.01" />
                        </div>
                        <div class="col-md-2">
                            <label class="form-label fw-semibold">IMPORTE</label>
                            <div class="input-group input-group-sm">
                                <input type="text" class="form-control form-control-sm rounded-pill" disabled value="0" />
                                <button class="btn btn-success btn-sm rounded-pill" type="button">
                                    {!! getIcon('plus') !!}
                                </button>
                            </div>
                        </div>
                    </div>

                    <div class="mt-4">
                        <table class="table table-bordered table-sm table-hover table-striped rounded-3 overflow-hidden text-center">
                            <thead class="bg-light">
                                <tr>
                                    <th>CLAVESAT</th>
                                    <th>CANTIDAD</th>
                                    <th>DESCRIPCION</th>
                                    <th>PRECIO</th>
                                    <th>IMPORTE</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td colspan="5" class="text-muted">Ningún dato disponible en esta tabla</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>

                    <div class="row mt-3 g-3">
                        <div class="col-md-6">
                            <label class="form-label">Observaciones</label>
                            <textarea class="form-control form-control-sm rounded-3" rows="3" placeholder="Observaciones..."></textarea>
                        </div>
                        <div class="col-md-6 text-end">
                            <p class="mb-2">Subtotal $: <input type="text" class="form-control form-control-sm rounded-pill w-25 d-inline-block" value="0" disabled /></p>
                            <p class="mb-2">IVA $: <input type="text" class="form-control form-control-sm rounded-pill w-25 d-inline-block" value="0" disabled /></p>
                            <p>Total $: <input type="text" class="form-control form-control-sm rounded-pill w-25 d-inline-block" value="0" disabled /></p>
                        </div>
                    </div>
                </div>
                <div class="modal-footer justify-content-between">
                    <button class="btn btn-success btn-sm rounded-pill">{!! getIcon('printer', 'me-1') !!} FACTURAR</button>
                    <button class="btn btn-secondary btn-sm rounded-pill" data-bs-dismiss="modal">CERRAR</button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="productoModal" tabindex="-1" aria-labelledby="productoModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content shadow rounded-3">
                <div class="modal-header bg-primary text-white justify-content-center">
                    {!! getIcon('box', 'fs-2 me-2') !!}
                    <h5 class="modal-title text-center flex-grow-1" id="productoModalLabel">NUEVO PRODUCTO O SERVICIO</h5>
                </div>
                <div class="modal-body p-4">
                    <form>
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label class="form-label fw-semibold">Código de Barras</label>
                                <input type="text" class="form-control form-control-sm rounded-pill" placeholder="Código de barras" />
                            </div>
                            <div class="col-md-6">
                                <label class="form-label fw-semibold">Categoría</label>
                                <input type="text" class="form-control form-control-sm rounded-pill" placeholder="Categoría" />
                            </div>
                            <div class="col-md-12">
                                <label class="form-label fw-semibold">Descripción</label>
                                <input type="text" class="form-control form-control-sm rounded-pill" placeholder="Nombre del producto" />
                            </div>
                            <div class="col-md-4">
                                <label class="form-label fw-semibold">Precio de Costo $</label>
                                <input type="number" class="form-control form-control-sm rounded-pill" placeholder="0.00" />
                            </div>
                            <div class="col-md-4">
                                <label class="form-label fw-semibold">Precio de Venta $</label>
                                <input type="number" class="form-control form-control-sm rounded-pill" placeholder="0.00" />
                            </div>
                            <div class="col-md-4">
                                <label class="form-label fw-semibold">Precio de Mayoreo $</label>
                                <input type="number" class="form-control form-control-sm rounded-pill" placeholder="0.00" />
                            </div>
                            <div class="col-md-6">
                                <label class="form-label fw-semibold">Unidad de Medida</label>
                                <select class="form-select form-select-sm rounded-pill">
                                    <option selected>Pieza</option>
                                </select>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label fw-semibold">Existencia</label>
                                <input type="number" class="form-control form-control-sm rounded-pill" placeholder="0" />
                            </div>
                            <div class="col-md-4">
                                <label class="form-label fw-semibold">Máximo</label>
                                <input type="number" class="form-control form-control-sm rounded-pill" placeholder="0" />
                            </div>
                            <div class="col-md-4">
                                <label class="form-label fw-semibold">Mínimo</label>
                                <input type="number" class="form-control form-control-sm rounded-pill" placeholder="0" />
                            </div>
                            <div class="col-md-4">
                                <label class="form-label fw-semibold">Clave Prod/Serv</label>
                                <input type="text" class="form-control form-control-sm rounded-pill" placeholder="Clave SAT" />
                            </div>
                            <div class="col-md-12">
                                <label class="form-label fw-semibold">Tipo Prod/Serv</label>
                                <select class="form-select form-select-sm rounded-pill">
                                    <option selected>PRODUCTO</option>
                                    <option>SERVICIO</option>
                                </select>
                            </div>
                        </div>
                        <div class="mt-4 text-end">
                            <button type="submit" class="btn btn-primary btn-sm rounded-pill fw-semibold px-4">
                                {!! getIcon('save', 'me-2') !!}Guardar Producto
                            </button>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-secondary btn-sm rounded-pill" data-bs-dismiss="modal">Cerrar</button>
                </div>
            </div>
        </div>
    </div>

    <!-- ENTRADA DE EFECTIVO MODAL -->
    <div class="modal fade" id="entradaEfectivoModal" tabindex="-1" aria-labelledby="entradaEfectivoModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content shadow rounded-3">
                <div class="modal-header bg-info text-white justify-content-center">
                    {!! getIcon('arrow-down-circle', 'fs-2 me-2') !!}
                    <h5 class="modal-title text-center flex-grow-1" id="entradaEfectivoModalLabel">Registro de entrada de efectivo</h5>
                </div>
                <div class="modal-body p-4">
                    <form>
                        <div class="row g-3 mb-3">
                            <div class="col-md-6">
                                <label class="form-label fw-semibold">Cantidad</label>
                                <input type="number" class="form-control form-control-sm rounded-pill" placeholder="Ej. 1000.00" />
                            </div>
                            <div class="col-md-6">
                                <label class="form-label fw-semibold">Razón</label>
                                <input type="text" class="form-control form-control-sm rounded-pill" placeholder="Ej. Pago de abonos" />
                            </div>
                        </div>
                        <div class="text-end mb-4">
                            <button class="btn btn-success btn-sm rounded-pill fw-semibold px-3">
                                {!! getIcon('check-circle', 'me-2') !!} REGISTRAR
                            </button>
                            <button type="button" class="btn btn-secondary btn-sm rounded-pill ms-2" data-bs-dismiss="modal">SALIR</button>
                        </div>
                    </form>
                    <table class="table table-bordered table-sm table-hover table-striped rounded-3 overflow-hidden text-center">
                        <thead class="bg-light">
                            <tr>
                                <th>HORA</th>
                                <th>CONCEPTO</th>
                                <th>EFECTIVO</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>3:50</td>
                                <td>PAGO DE ABONOS</td>
                                <td>1000.00</td>
                                <td>
                                    <button class="btn btn-warning btn-sm rounded-pill">
                                        {!! getIcon('trash') !!}
                                    </button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- SALIDA DE EFECTIVO MODAL -->
    <div class="modal fade" id="salidaEfectivoModal" tabindex="-1" aria-labelledby="salidaEfectivoModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content shadow rounded-3">
                <div class="modal-header bg-danger text-white justify-content-center">
                    {!! getIcon('arrow-up-circle', 'fs-2 me-2') !!}
                    <h5 class="modal-title text-center flex-grow-1" id="salidaEfectivoModalLabel">Registro de salida de efectivo</h5>
                </div>
                <div class="modal-body p-4">
                    <form>
                        <div class="row g-3 mb-3">
                            <div class="col-md-6">
                                <label class="form-label fw-semibold">Cantidad</label>
                                <input type="number" class="form-control form-control-sm rounded-pill" placeholder="Ej. 500.00" />
                            </div>
                            <div class="col-md-6">
                                <label class="form-label fw-semibold">Razón</label>
                                <input type="text" class="form-control form-control-sm rounded-pill" placeholder="Ej. Pago de servicios" />
                            </div>
                        </div>
                        <div class="text-end mb-4">
                            <button class="btn btn-danger btn-sm rounded-pill fw-semibold px-3">
                                {!! getIcon('check-circle', 'me-2') !!} REGISTRAR
                            </button>
                            <button type="button" class="btn btn-secondary btn-sm rounded-pill ms-2" data-bs-dismiss="modal">SALIR</button>
                        </div>
                    </form>
                    <table class="table table-bordered table-sm table-hover table-striped rounded-3 overflow-hidden text-center">
                        <thead class="bg-light">
                            <tr>
                                <th>HORA</th>
                                <th>CONCEPTO</th>
                                <th>EFECTIVO</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>15:00</td>
                                <td>PAGO DE SERVICIOS</td>
                                <td>500.00</td>
                                <td>
                                    <button class="btn btn-warning btn-sm rounded-pill">
                                        {!! getIcon('trash') !!}
                                    </button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <!-- PRODUCT DETAIL MODAL -->
    <div class="modal fade" id="productDetailModal" tabindex="-1" aria-labelledby="productDetailModalLabel" aria-hidden="true" wire:ignore.self>
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content rounded-3 shadow">
                <div class="modal-header bg-primary text-white">
                    <h5 class="modal-title" id="productDetailModalLabel">{{ $this->selectedProduct['name'] ?? '' }}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <div id="productCarousel" class="carousel slide mb-3" data-bs-ride="carousel">
                        <div class="carousel-inner">
                            <div class="carousel-item active">
                                <img src="{{ $this->selectedProduct['imagen_url'] ?? asset('images/no-image.png') }}" class="d-block w-100 rounded" alt="Imagen de producto">
                            </div>
                        </div>
                    </div>
                    <p><strong>Descripción:</strong> {{ $this->selectedProduct['description'] ?? 'No disponible' }}</p>
                    <p><strong>Precio unitario:</strong> ${{ number_format($this->selectedProduct['precio_venta'] ?? 0, 2) }}</p>
                    <p><strong>Existencia:</strong> {{ $this->selectedProduct['stock'] ?? 0 }}</p>
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">⬅ Atrás</button>
                    <button type="button" class="btn btn-success" wire:click="agregar">✅ Aceptar</button>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
<script>
    document.addEventListener('livewire:load', function () {
        Livewire.on('openProductModal', () => {
            let modal = new bootstrap.Modal(document.getElementById('productDetailModal'));
            modal.show();
        });
    });
</script>