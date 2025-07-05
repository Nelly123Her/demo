<div class="modal fade" id="kt_modal_add_registro" tabindex="-1" aria-hidden="true" wire:ignore.self>
    <div class="modal-dialog modal-dialog-centered mw-650px">
        <div class="modal-content">
            <div class="modal-header">
                <h2 class="fw-bold">Registro de Caja</h2>
                <div class="btn btn-icon btn-sm btn-active-icon-primary" data-bs-dismiss="modal">
                    {!! getIcon('cross', 'fs-1') !!}
                </div>
            </div>

            <div class="modal-body py-10 px-lg-17">
                <form wire:submit.prevent="submit" class="form">
                    <div class="mb-5">
                        <label class="form-label">Fecha de Apertura</label>
                        <input type="date" class="form-control" wire:model.defer="fecha_apertura">
                        @error('fecha_apertura') <div class="text-danger">{{ $message }}</div> @enderror
                    </div>

                    <div class="mb-5">
                        <label class="form-label">Fecha de Cierre</label>
                        <input type="date" class="form-control" wire:model.defer="fecha_cierre">
                    </div>

                    <div class="mb-5">
                        <label class="form-label">Efectivo</label>
                        <input type="number" class="form-control" wire:model.defer="efectivo">
                        @error('efectivo') <div class="text-danger">{{ $message }}</div> @enderror
                    </div>

                    <div class="mb-5">
                        <label class="form-label">TC Dólar</label>
                        <input type="number" class="form-control" wire:model.defer="tc_dolar">
                        @error('tc_dolar') <div class="text-danger">{{ $message }}</div> @enderror
                    </div>

                    <div class="mb-5">
                        <label class="form-label">Estado</label>
                        <select class="form-select" wire:model.defer="estado">
                            <option value="">Selecciona...</option>
                            <option value="abierta">Abierta</option>
                            <option value="cerrada">Cerrada</option>
                        </select>
                        @error('estado') <div class="text-danger">{{ $message }}</div> @enderror
                    </div>

                    <div class="text-end">
                        <button type="submit" class="btn btn-primary">
                            Guardar
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>