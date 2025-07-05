<div>
<div>
<div class="card shadow-lg border-0 rounded-3">
    {{-- HEADER --}}
    <div class="card-header bg-light border-0 pt-4 pb-3 px-4 shadow-sm d-flex justify-content-between align-items-center">
        <div class="d-flex gap-2">
            <button class="btn btn-outline-success btn-sm rounded-pill fw-semibold px-3 py-1" style="font-size: 0.97rem;">
                {!! getIcon('basket', 'fs-6 me-2') !!} Venta Mostrador
            </button>
            <button class="btn btn-outline-warning btn-sm rounded-pill fw-semibold px-3 py-1 text-dark" style="font-size: 0.97rem;" data-bs-toggle="modal" data-bs-target="#cierreCajaModal">
                {!! getIcon('lock', 'fs-6 me-2') !!} Cierre de Caja
            </button>
            <button class="btn btn-outline-dark btn-sm rounded-pill fw-semibold px-3 py-1" style="font-size: 0.97rem;">
                {!! getIcon('plus', 'fs-6 me-2') !!} Nueva Nota
            </button>
        </div>
        <div class="d-flex gap-2">
            @foreach(range(27463, 27469) as $folio)
                <button class="btn btn-outline-info btn-sm rounded-pill fw-semibold px-3 py-1" style="font-size: 0.97rem;">
                    {!! getIcon('barcode', 'fs-6 me-2') !!} FOLIO: {{ $folio }}
                </button>
            @endforeach
            <button class="btn btn-outline-info btn-sm rounded-pill fw-semibold px-3 py-1 text-white" style="font-size: 0.97rem;" data-bs-toggle="modal" data-bs-target="#entradaEfectivoModal">
                {!! getIcon('arrow-down-circle', 'fs-6 me-2') !!} ENTRADAS
            </button>
            <button class="btn btn-outline-light btn-sm rounded-pill fw-semibold px-3 py-1 text-danger" style="font-size: 0.97rem;" data-bs-toggle="modal" data-bs-target="#salidaEfectivoModal">
                {!! getIcon('arrow-up-circle', 'fs-6 me-2') !!} SALIDAS
            </button>
            <button class="btn btn-outline-primary btn-sm rounded-pill fw-semibold px-3 py-1" style="font-size: 0.97rem;" data-bs-toggle="modal" data-bs-target="#productoModal">
                {!! getIcon('box', 'fs-6 me-2') !!} Producto
            </button>
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
                <button class="btn btn-success btn-sm w-100 fw-semibold rounded-pill" style="font-size:0.97rem;" wire:click="agregar">
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
            <div class="col-md-9">
                <table class="table align-middle table-hover table-striped table-sm rounded-3 overflow-hidden fs-6 gy-5 text-gray-700">
                    <thead class="bg-light">
                        <tr>
                            <th>#</th>
                            <th>Código</th>
                            <th>Descripción</th>
                            <th>Precio</th>
                            <th>Cantidad</th>
                            <th>Importe</th>
                            <th></th>
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
                                    <img src="{{ $item['imagen'] ?? asset('img/default.jpg') }}" alt="img" class="rounded shadow-sm" width="40" height="40" wire:click="$set('previewImage', '{{ $item['imagen'] }}')" style="cursor:pointer;">
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <div class="col-md-3">
                <div class="shadow rounded-3 p-0 bg-white d-flex flex-column align-items-center justify-content-center" style="min-height: 285px;">
                    <div class="w-100 d-flex justify-content-center align-items-center" style="height: 140px;">
                        <img src="{{ $previewImage ?? asset('img/default.jpg') }}" class="rounded-3 shadow" alt="Preview" style="max-width: 90px; max-height: 120px;">
                    </div>
                    <div class="w-100 text-center pt-2 pb-3 px-2">
                        <h6 class="fw-semibold mb-1">{{ $selectedProductName ?? 'Producto' }}</h6>
                        <span class="badge bg-success fs-6">${{ number_format($selectedProductPrice ?? 0, 2) }}</span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- FOOTER --}}
    <div class="card-footer bg-light shadow-sm d-flex justify-content-between align-items-center border-top px-4 py-3">
        <div>
            <p class="mb-0 text-success fw-bold">Los Precios ya incluyen IVA</p>
            <p class="mb-0 text-muted small">{{ $totalArticulos ?? 0 }} Artículo(s) ingresado(s)</p>
            <p class="mb-0 text-muted small">Cajero: ADMINISTRADOR</p>
            <p class="mb-0 text-muted small">
                {{ now()->isoFormat('dddd, D [de] MMMM [del] YYYY') }} |
                {{ now()->format('H:i:s') }}
            </p>
        </div>
        <div class="text-end">
            <h5 class="text-success mb-0 fw-semibold">TOTAL</h5>
            <button class="btn btn-primary btn-sm rounded-pill fw-semibold px-4 py-2 mb-2" style="font-size:1.15rem;" data-bs-toggle="modal" data-bs-target="#cobrarNotaModal">
                {!! getIcon('dollar-sign', 'fs-4 me-1') !!} COBRAR NOTA
            </button>
            <h1 class="text-success fw-bold mb-0" style="font-size: 2.3rem;">${{ number_format($total ?? 0, 2) }}</h1>
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
                <h3 class="text-success fw-bold mb-4">${{ number_format($total ?? 0, 2) }}</h3>
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
</div>
</div>