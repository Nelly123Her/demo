<x-default-layout>

    @section('title')
        Registro de Caja
    @endsection

    @section('breadcrumbs')
        {{ Breadcrumbs::render('ventas.registro-en-caja') }}
    @endsection

    <div class="card">
        <div class="card-header border-0 pt-6">
            <div class="card-title">
                <div class="d-flex align-items-center position-relative my-1">
                    {!! getIcon('magnifier', 'fs-3 position-absolute ms-5') !!}
                    <input type="text" data-kt-user-table-filter="search" class="form-control form-control-solid w-250px ps-13" placeholder="Buscar registro" id="registroSearchInput"/>
                </div>
            </div>

            <div class="card-toolbar">
                <div class="d-flex justify-content-end" data-kt-user-table-toolbar="base">
                    <button type="button" class="btn btn-light-primary" data-bs-toggle="modal" data-bs-target="#kt_modal_caja">
                        {!! getIcon('plus-square','fs-3', '', 'i') !!} Nuevo Registro
                    </button>
                </div>

                <div class="d-flex justify-content-end align-items-center d-none" data-kt-user-table-toolbar="selected">
                    <div class="fw-bold me-5">
                        <span class="me-2" data-kt-user-table-select="selected_count"></span> seleccionados
                    </div>
                    <button type="button" class="btn btn-danger" data-kt-user-table-select="delete_selected">
                        Eliminar
                    </button>
                </div>
            </div>
        </div>

        <div class="card-body py-4">
            <div class="table-responsive">
                {{ $dataTable->table(['id' => 'registro-caja-table']) }}
                {{-- 
                    Asegúrate de que en la definición de las columnas del DataTable (en el backend o en la vista de filas, 
                    donde se generan los botones de acción para cada registro), el botón "Editar" luzca así:

                    <button class="btn btn-sm btn-warning btn-edit-registro" data-id="{{ $id }}">
                        {!! getIcon('pencil') !!}
                    </button>

                    <!--
                        Ejemplo de estructura correcta para el botón Editar:
                        <button class="btn btn-sm btn-warning btn-edit-registro" data-id="{{ $id }}">
                            {!! getIcon('pencil') !!}
                        </button>
                        Este botón asegura que el listener JS para .btn-edit-registro con data-id funcione correctamente.
                    -->
                    Esto garantiza que la clase btn-edit-registro esté en el botón y no solo en el icono.
                --}}
            </div>
        </div>
    </div>

  
    {{-- Livewire Modal --}}
    <!-- Nuevo Registro Modal -->
    <div class="modal fade" id="kt_modal_caja" tabindex="-1" aria-labelledby="kt_modal_caja_label" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content shadow rounded-3">
                <div class="modal-header bg-primary text-white">
                    {!! getIcon('plus-square', 'fs-2 me-2') !!}
                    <h5 class="modal-title" id="kt_modal_caja_label">Nuevo Registro de Caja</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Cerrar"></button>
                </div>
                <div class="modal-body">
                    <form wire:submit.prevent="guardar">
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label class="form-label fw-semibold">Fecha de Apertura</label>
                                <input type="datetime-local" wire:model.defer="fecha_apertura" class="form-control" required />
                            </div>
                            <div class="col-md-6">
                                <label class="form-label fw-semibold">Monto Inicial</label>
                                <input type="number" wire:model.defer="efectivo" class="form-control" step="0.01" placeholder="Ej. 1000.00" required />
                            </div>
                            <div class="col-md-12">
                                <label class="form-label fw-semibold">Observaciones</label>
                                <textarea wire:model.defer="observaciones" class="form-control" rows="4" placeholder="Notas u observaciones..."></textarea>
                            </div>
                        </div>
                        <div class="text-end mt-4">
                            <button type="submit" class="btn btn-primary fw-bold">
                                {!! getIcon('save', 'me-2') !!} Guardar Registro
                            </button>
                            <button type="button" class="btn btn-secondary ms-2" data-bs-dismiss="modal">Cancelar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!--begin::Show Registro Modal-->
    <div class="modal fade" id="kt_modal_show_registro" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered mw-750px">
            <div class="modal-content rounded-4 shadow-sm border border-success border-2">
                <!--begin::Modal header-->
                <div class="modal-header bg-success px-5 py-4 rounded-top-3">
                    <h3 class="modal-title text-white">
                        <i class="ki-duotone ki-information fs-2x me-2 text-white"></i>
                        Detalle de Registro
                    </h3>
                    <button type="button" class="btn btn-sm btn-icon btn-active-light" data-bs-dismiss="modal">
                        {!! getIcon('cross', 'fs-2 text-white') !!}
                    </button>
                </div>
                <!--end::Modal header-->

                <!--begin::Modal body-->
                <div class="modal-body py-10 px-10">
                    <div class="mb-7 text-center">
                        <span class="badge badge-light fs-6 py-2 px-4">Información detallada del registro seleccionado</span>
                    </div>

                    <div class="row g-5 mb-5">
                        <div class="col-md-6">
                            <div class="bg-light-info p-4 rounded">
                                <div class="fw-semibold text-gray-600 mb-2">🆔 ID</div>
                                <div class="fw-bold fs-5 text-gray-800" id="show-id">--</div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="bg-light p-4 rounded">
                                <div class="fw-semibold text-gray-600 mb-2">📅 Fecha</div>
                                <div class="fw-bold fs-5 text-gray-800" id="show-fecha">--</div>
                            </div>
                        </div>
                    </div>

                    <div class="row g-5 mb-5">
                        <div class="col-md-6">
                            <div class="bg-light-success p-4 rounded">
                                <div class="fw-semibold text-gray-600 mb-2">💵 Monto</div>
                                <div class="fw-bold fs-5 text-success" id="show-monto">--</div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="bg-light-primary p-4 rounded">
                                <div class="fw-semibold text-gray-600 mb-2">📌 Estado</div>
                                <div class="fw-bold fs-5 text-primary text-uppercase" id="show-estado">--</div>
                            </div>
                        </div>
                    </div>

                    <div class="d-flex justify-content-center mt-10 gap-4">
                        <button type="button" class="btn btn-success fw-bold px-6 py-3">
                            IMPRIMIR CORTE
                        </button>
                        <button type="button" class="btn btn-secondary fw-bold px-6 py-3" data-bs-dismiss="modal">
                            SALIR
                        </button>
                    </div>
                </div>
                <!--end::Modal body-->
            </div>
        </div>
    </div>
    <!--end::Show Registro Modal-->

    <!--begin::Editar Registro Modal-->
    <div class="modal fade" id="kt_modal_editar_registro" tabindex="-1" aria-labelledby="kt_modal_editar_registro_label" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content shadow rounded-3">
                <div class="modal-header bg-warning text-dark">
                    {!! getIcon('edit', 'fs-2 me-2') !!}
                    <h5 class="modal-title" id="kt_modal_editar_registro_label">Editar Registro</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
                </div>
                <div class="modal-body">
                    <form>
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label class="form-label fw-semibold">Fecha de Registro</label>
                                <input type="datetime-local" class="form-control" id="edit-fecha" />
                            </div>
                            <div class="col-md-6">
                                <label class="form-label fw-semibold">Monto</label>
                                <input type="number" class="form-control" step="0.01" id="edit-monto" placeholder="Ej. 1000.00" />
                            </div>
                            <div class="col-md-12">
                                <label class="form-label fw-semibold">Observaciones</label>
                                <textarea class="form-control" rows="4" id="edit-observaciones" placeholder="Notas u observaciones..."></textarea>
                            </div>
                        </div>
                        <div class="text-end mt-4">
                            <button type="submit" class="btn btn-warning fw-bold">
                                {!! getIcon('save', 'me-2') !!} Actualizar Registro
                            </button>
                            <button type="button" class="btn btn-secondary ms-2" data-bs-dismiss="modal">Cancelar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!--end::Editar Registro Modal-->

    @push('scripts')
        {{ $dataTable->scripts() }}

        <script>
            document.getElementById('registroSearchInput').addEventListener('keyup', function () {
                window.LaravelDataTables['registro-caja-table'].search(this.value).draw();
            });

            document.addEventListener('livewire:init', function () {
                Livewire.on('modal.show.caja', function () {
                    const modalEl = document.getElementById('kt_modal_caja');
                    if (modalEl) {
                        if (bootstrap && bootstrap.Modal && typeof bootstrap.Modal.getOrCreateInstance === 'function') {
                            const modal = bootstrap.Modal.getOrCreateInstance(modalEl);
                            modal.show();
                        } else {
                            console.error('Bootstrap Modal instance could not be created.');
                        }
                    } else {
                        console.error('Modal element not found: #kt_modal_caja');
                    }
                });

                Livewire.on('success', function () {
                    const modalEl = document.getElementById('kt_modal_caja');
                    const modal = bootstrap.Modal.getInstance(modalEl);
                    if (modal) modal.hide();
                    window.LaravelDataTables['registro-caja-table'].ajax.reload();
                });
            });
        </script>

        <script>
            document.addEventListener('DOMContentLoaded', function () {
                const table = document.getElementById('registro-caja-table');
                if (!table) {
                    console.error('No se encontró la tabla con id registro-caja-table');
                    return;
                }
                table.addEventListener('click', async function (e) {
                    // Mostrar registro
                    const button = e.target.closest('.btn-show-registro');
                    if (button) {
                        const id = button.getAttribute('data-id');
                        try {
                            const res = await fetch(`/api/registro-en-caja/${id}`);
                            const data = await res.json();
                            document.getElementById('show-id').textContent = data.id ?? '';
                            document.getElementById('show-fecha').textContent = data.fecha_apertura ?? 'N/A';
                            document.getElementById('show-monto').textContent = `$${parseFloat(data.efectivo).toFixed(2)}`;
                            document.getElementById('show-estado').textContent = data.estado ?? '';
                            const modalEl = document.getElementById('kt_modal_show_registro');
                            if (modalEl) {
                                if (bootstrap && bootstrap.Modal && typeof bootstrap.Modal.getOrCreateInstance === 'function') {
                                    const modal = bootstrap.Modal.getOrCreateInstance(modalEl);
                                    modal.show();
                                } else {
                                    console.error('Bootstrap Modal instance could not be created.');
                                }
                            } else {
                                console.error('Modal element not found: #kt_modal_show_registro');
                            }
                        } catch (err) {
                            alert('Error al cargar los datos del registro.');
                            console.error(err);
                        }
                        return;
                    }
                    // Editar registro
                    const editButton = e.target.closest('.btn-edit-registro');
                    if (editButton) {
                        const id = editButton.getAttribute('data-id');
                        try {
                            const res = await fetch(`/api/registro-en-caja/${id}`);
                            const data = await res.json();
                            document.getElementById('edit-fecha').value = data.fecha_apertura ?? '';
                            document.getElementById('edit-monto').value = data.efectivo ?? '';
                            document.getElementById('edit-observaciones').value = data.observaciones ?? '';
                            const modalEl = document.getElementById('kt_modal_editar_registro');
                            if (modalEl) {
                                if (bootstrap && bootstrap.Modal && typeof bootstrap.Modal.getOrCreateInstance === 'function') {
                                    const modal = bootstrap.Modal.getOrCreateInstance(modalEl);
                                    modal.show();
                                } else {
                                    console.error('Bootstrap Modal instance could not be created.');
                                }
                            } else {
                                console.error('Modal element not found: #kt_modal_editar_registro');
                            }
                        } catch (err) {
                            alert('Error al cargar los datos para editar.');
                            console.error(err);
                        }
                        return;
                    }
                });
            });
        </script>
    @endpush

</x-default-layout>