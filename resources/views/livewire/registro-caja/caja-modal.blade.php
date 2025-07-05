<div wire:ignore.self class="modal fade" id="kt_modal_caja" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered mw-650px">
        <div class="modal-content">
            <div class="modal-header pb-0 border-0 justify-content-end">
                <button type="button" class="btn btn-sm btn-icon btn-active-color-primary" data-bs-dismiss="modal">
                    {!! getIcon('cross', 'fs-1') !!}
                </button>
            </div>

            <div class="modal-body scroll-y mx-5 mx-xl-18 pt-0 pb-15">
                <h2 class="text-center mb-10">
                    {{ $isEditing ? 'Editar Registro' : 'Nuevo Registro' }}
                </h2>

                <form wire:submit.prevent="submit">
                    <div class="mb-5">
                        <label class="form-label">Efectivo</label>
                        <input type="number" class="form-control" wire:model.defer="efectivo">
                        @error('efectivo') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>

                    <div class="mb-5">
                        <label class="form-label">Tipo de Cambio</label>
                        <input type="number" step="0.01" class="form-control" wire:model.defer="tc_dolar">
                        @error('tc_dolar') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>

                    <div class="mb-5">
                        <label class="form-label">Fecha Apertura</label>
                        <input type="date" class="form-control" wire:model.defer="fecha_apertura">
                        @error('fecha_apertura') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>

                    <div class="mb-5">
                        <label class="form-label">Fecha Cierre</label>
                        <input type="date" class="form-control" wire:model.defer="fecha_cierre">
                        @error('fecha_cierre') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>

                    <div class="mb-5">
                        <label class="form-label">Estado</label>
                        <select class="form-select" wire:model.defer="estado">
                            <option value="">Seleccionar</option>
                            <option value="abierto">Abierto</option>
                            <option value="cerrado">Cerrado</option>
                        </select>
                        @error('estado') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>

                    <div class="text-center">
                        <button type="submit" class="btn btn-primary">
                            {{ $isEditing ? 'Actualizar' : 'Guardar' }}
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>