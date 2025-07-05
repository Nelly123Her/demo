<!--begin::Modal - Show Registro en Caja-->
<div class="modal fade" id="kt_modal_show_registro" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered mw-750px">
        <div class="modal-content rounded-4 shadow-lg">

            <!--begin::Modal header-->
            <div class="modal-header bg-light-primary border-0 py-5 px-7">
                <h2 class="modal-title fw-bold text-dark">🧾 Corte de Caja</h2>
                <button type="button" class="btn btn-sm btn-icon btn-active-light-primary" data-bs-dismiss="modal">
                    {!! getIcon('cross', 'fs-2') !!}
                </button>
            </div>
            <!--end::Modal header-->

            <!--begin::Modal body-->
            <div class="modal-body py-10 px-10">

                <!--begin::Info-->
                <div class="mb-10 text-center">
                    <div class="fs-6 text-muted mb-2">Fecha Hora:</div>
                    <div class="fs-4 fw-bold text-gray-800" id="show-fecha">-</div>
                </div>
                <!--end::Info-->

                <div class="separator separator-dashed my-5"></div>

                <!--begin::Registro Data-->
                <div class="row g-5">
                    <div class="col-md-6">
                        <div class="d-flex flex-column">
                            <span class="text-muted fw-semibold"> ID Registro:</span>
                            <span class="fs-5 fw-bold text-primary" id="show-id">-</span>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="d-flex flex-column">
                            <span class="text-muted fw-semibold">Monto Total:</span>
                            <span class="fs-5 fw-bold text-success" id="show-monto">-</span>
                        </div>
                    </div>
                    <div class="col-md-12 pt-4">
                        <div class="d-flex flex-column">
                            <span class="text-muted fw-semibold">Estado:</span>
                            <span class="fs-5 fw-bold text-uppercase text-dark" id="show-estado">-</span>
                        </div>
                    </div>
                </div>
                <!--end::Registro Data-->

            </div>
            <!--end::Modal body-->

        </div>
    </div>
</div>
<!--end::Modal - Show Registro en Caja-->