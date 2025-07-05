<div class="modal fade" id="kt_modal_edit_registro" tabindex="-1" aria-hidden="true" wire:ignore.self>
    <div class="modal-dialog modal-dialog-centered mw-650px">
        <div class="modal-content">
            <div class="modal-header">
                <h2 class="fw-bold">Editar Registro</h2>
                <div class="btn btn-icon btn-sm btn-active-icon-primary" data-bs-dismiss="modal">
                    {!! getIcon('cross', 'fs-1') !!}
                </div>
            </div>

            <div class="modal-body py-10 px-lg-17">
                <form wire:submit.prevent="submit" class="form">
                    <!-- example field -->
                    <div class="mb-5">
                        <label class="form-label">Fecha Apertura</label>
                        <input type="date" class="form-control" wire:model.defer="registro.fecha_apertura">
                    </div>

                    <!-- add other fields -->

                    <div class="text-end">
                        <button type="submit" class="btn btn-primary">
                            Guardar cambios
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>