<x-default-layout>
@php
    $items = $items ?? [];
@endphp
    @section('title')
        Punto de Venta
    @endsection

    @section('breadcrumbs')
        {{ Breadcrumbs::render('ventas.punto-de-venta') }}
    @endsection

    <div>
        <div>
            <div class="card card-xl-stretch shadow-sm border-0 rounded-4">
                {{-- HEADER --}}
                <div class="card-header bg-light border-0 pt-4 pb-3 px-4 shadow-sm d-flex flex-column">
                    <div class="d-flex flex-wrap align-items-center gap-2 mb-3">
                        <button class="btn btn-outline-primary btn-sm rounded-pill fw-semibold px-4 py-1">
                            {!! getIcon('tools', 'fs-6 me-2') !!} Ferretería Venta
                        </button>
                        <button class="btn btn-outline-success btn-sm rounded-pill fw-semibold px-4 py-1" data-bs-toggle="modal" data-bs-target="#productoModal">
                            {!! getIcon('plus', 'fs-6 me-2') !!} Nuevo Producto
                        </button>
                    </div>

                    {{-- Folios row with horizontal scroll --}}
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
                        <div class="col-md-6">
                            <label class="form-label fw-bold">Buscar Producto</label>
                            <div class="input-group input-group-sm">
                                <span class="input-group-text rounded-2">{!! getIcon('search') !!}</span>
                                <input type="text" 
                                       class="form-control form-control-sm rounded-2" 
                                       placeholder="Ej. Martillo, Tornillo..." 
                                       wire:model.debounce.500ms="codigo"
                                       wire:input="buscarProducto">
                            </div>
                        </div>
                        <div class="col-md-2">
                            <label class="form-label">Cantidad</label>
                            <input type="number" class="form-control form-control-sm rounded-2" placeholder="1" wire:model="cantidad" min="1">
                        </div>
                        <div class="col-md-2 d-flex flex-column gap-2 align-items-stretch">
                            <button class="btn btn-success btn-sm w-100 fw-semibold rounded-pill agregar-btn" wire:click="agregar">
                                {!! getIcon('plus-circle', 'fs-6 me-1') !!} Agregar
                            </button>
                        </div>
                        <div class="col-md-2 d-flex flex-column gap-2 align-items-stretch">
                            <button class="btn btn-outline-danger btn-sm w-100 fw-semibold rounded-pill borrar-btn" wire:click="borrarUltimo">
                                {!! getIcon('trash', 'fs-6 me-1') !!} Borrar
                            </button>
                        </div>
                    </div>

                    {{-- TABLA Y VISTA PREVIA --}}
                    <div class="row g-3">
                        <div class="col-12">
                            @if(count($items) > 0)
                                <table class="table table-hover table-borderless text-gray-700 fw-medium fs-6 elegant-table">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Código</th>
                                            <th>Descripción</th>
                                            <th>Precio Venta</th>
                                            <th>Cantidad</th>
                                            <th>Importe</th>
                                            <th>Acciones</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($items as $index => $item)
                                            <tr>
                                                <td>{{ $index + 1 }}</td>
                                                <td>{{ $item['codigo'] }}</td>
                                                <td>{{ $item['descripcion'] }}</td>
                                                <td>${{ number_format($item['precio_venta'], 2) }}</td>
                                                <td>{{ $item['cantidad'] }}</td>
                                                <td>${{ number_format($item['importe'], 2) }}</td>
                                                <td>
                                                    <button wire:click="editar({{ $index }})" class="btn btn-sm btn-warning rounded-pill fw-semibold">
                                                        {!! getIcon('pencil') !!}
                                                    </button>
                                                    <button wire:click="borrarItem({{ $index }})" class="btn btn-sm btn-danger rounded-pill fw-semibold">
                                                        {!! getIcon('trash') !!}
                                                    </button>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            @else
                                <div class="alert alert-info text-center">
                                    <i class="fas fa-info-circle me-2"></i>
                                    Agrega productos para mostrar la tabla de venta.
                                </div>
                            @endif
                        </div>

                        {{-- PREVIEW IMAGE --}}
                        @if (!empty($selectedProductName))
                        <div class="col-md-3">
                            <div class="shadow-sm rounded-4 p-3 bg-white d-flex flex-column align-items-center justify-content-center" style="min-height: 280px; border: 1px solid #f1f1f1;">
                                <div class="w-100 d-flex justify-content-center align-items-center" style="height: 140px;">
                                    <img src="{{ $previewImage }}" class="rounded-3 shadow" alt="Preview" style="max-width: 90px; max-height: 120px;">
                                </div>
                                <div class="w-100 text-center pt-2 pb-3 px-2">
                                    <h6 class="fw-semibold mb-1">{{ $selectedProductName }}</h6>
                                    <span class="badge bg-success fs-6">${{ number_format($selectedProductPrice, 2) }}</span>
                                </div>
                            </div>
                        </div>
                        @endif
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
                        <h1 class="text-success fw-bolder display-3 mb-0">${{ number_format($total ?? 0, 2) }}</h1>
                        <button class="btn btn-lg btn-success rounded-2 fw-bold mt-2 px-5" data-bs-toggle="modal" data-bs-target="#cobrarNotaModal">
                            {!! getIcon('cash', 'fs-4 me-2') !!} COBRAR
                        </button>
                    </div>
                </div>
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
                    <button class="btn btn-secondary btn-sm rounded-2 fw-semibold px-3 py-1" data-bs-dismiss="modal">Cancelar</button>
                    <button class="btn btn-primary btn-lg rounded-2 fw-bold px-4 py-2">
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
                    <button class="btn btn-info btn-sm rounded-2 text-white fw-semibold px-3 py-1">
                        {!! getIcon('printer', 'me-2') !!} IMPRIMIR CORTE
                    </button>
                    <button class="btn btn-success btn-sm rounded-2 text-white fw-semibold px-3 py-1">
                        {!! getIcon('check-circle', 'me-2') !!} CIERRE DE CAJA
                    </button>
                    <button class="btn btn-warning btn-sm rounded-2 fw-semibold px-3 py-1">
                        {!! getIcon('lock', 'me-2') !!} Confirmar Cierre
                    </button>
                </div>
                <button class="btn btn-secondary btn-sm rounded-2 fw-semibold px-3 py-1" data-bs-dismiss="modal">Cancelar</button>
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
                <button class="btn btn-success btn-sm rounded-2 fw-semibold px-3 py-1">{!! getIcon('printer', 'me-1') !!} FACTURAR</button>
                <button class="btn btn-secondary btn-sm rounded-2 fw-semibold px-3 py-1" data-bs-dismiss="modal">CERRAR</button>
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
                            <button type="submit" class="btn btn-primary btn-lg rounded-2 fw-bold px-4 py-2">
                                {!! getIcon('save', 'me-2') !!}Guardar Producto
                            </button>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-secondary btn-sm rounded-2 fw-semibold px-3 py-1" data-bs-dismiss="modal">Cerrar</button>
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
                            <button class="btn btn-success btn-sm rounded-2 fw-semibold px-3 py-1">
                                {!! getIcon('check-circle', 'me-2') !!} REGISTRAR
                            </button>
                            <button type="button" class="btn btn-secondary btn-sm rounded-2 fw-semibold px-3 py-1 ms-2" data-bs-dismiss="modal">SALIR</button>
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
                                    <button class="btn btn-warning btn-sm rounded-2 fw-semibold px-2 py-1">
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
                        <button class="btn btn-danger btn-sm rounded-2 fw-semibold px-3 py-1">
                            {!! getIcon('check-circle', 'me-2') !!} REGISTRAR
                        </button>
                        <button type="button" class="btn btn-secondary btn-sm rounded-2 fw-semibold px-3 py-1 ms-2" data-bs-dismiss="modal">SALIR</button>
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
                                <button class="btn btn-warning btn-sm rounded-2 fw-semibold px-2 py-1">
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
</x-default-layout>
<style>
.scrollbar-hidden::-webkit-scrollbar {
    display: none;
}
.scrollbar-hidden {
    -ms-overflow-style: none;
    scrollbar-width: none;
}
.hover-scale:hover {
    transform: scale(1.2);
    transition: transform 0.2s ease-in-out;
}

/* Modern Elegant Table Styles */
.elegant-table {
    width: 100%;
    border-radius: 0.75rem;
    overflow: hidden;
    border: 1px solid #e5e7eb;
}
.elegant-table thead {
    background: linear-gradient(90deg, #f3f4f6, #e5e7eb);
    color: #374151;
    font-weight: 700;
}
.elegant-table th, .elegant-table td {
    padding: 0.85rem 1rem;
    border-bottom: 1px solid #e5e7eb;
}
.elegant-table tbody tr:hover {
    background-color: #f9fafb;
    cursor: pointer;
}

/* Modern Agregar and Borrar Buttons */
.agregar-btn {
    background: linear-gradient(90deg, #16a34a, #22c55e);
    color: #fff;
    font-weight: 600;
    border-radius: 50px;
    transition: transform 0.2s ease, box-shadow 0.2s ease;
    box-shadow: 0 4px 10px rgba(34, 197, 94, 0.4);
}
.agregar-btn:hover {
    transform: scale(1.05);
    box-shadow: 0 8px 20px rgba(34, 197, 94, 0.6);
}
.borrar-btn {
    border: none;
    color: #ef4444;
    background: transparent;
    font-weight: 600;
    transition: color 0.2s ease, transform 0.2s ease;
}
.borrar-btn:hover {
    color: #dc2626;
    transform: scale(1.05);
}

/* Metronic-style Action Buttons for DataTable */
.btn-light-primary {
    background-color: #e0edff;
    color: #2563eb;
    border: none;
}
.btn-light-primary:hover, .btn-light-primary:focus {
    background-color: #d1e4ff;
    color: #1d4ed8;
}
.btn-light-danger {
    background-color: #fee2e2;
    color: #dc2626;
    border: none;
}
.btn-light-danger:hover, .btn-light-danger:focus {
    background-color: #fecaca;
    color: #b91c1c;
}
</style>