<!--begin::sidebar menu-->
<div class="app-sidebar-menu overflow-hidden flex-column-fluid">
	<!--begin::Menu wrapper-->
	<div id="kt_app_sidebar_menu_wrapper" class="app-sidebar-wrapper hover-scroll-overlay-y my-5" data-kt-scroll="true" data-kt-scroll-activate="true" data-kt-scroll-height="auto" data-kt-scroll-dependencies="#kt_app_sidebar_logo, #kt_app_sidebar_footer" data-kt-scroll-wrappers="#kt_app_sidebar_menu" data-kt-scroll-offset="5px" data-kt-scroll-save-state="true">
		<!--begin::Menu-->
		<div class="menu menu-column menu-rounded menu-sub-indention px-3 fw-semibold fs-6" id="#kt_app_sidebar_menu" data-kt-menu="true" data-kt-menu-expand="false">
			<!--begin:Menu item-->
			<div data-kt-menu-trigger="click" class="menu-item menu-accordion {{ request()->routeIs('dashboard') ? 'here show' : '' }}">
				<!--begin:Menu link-->
				<span class="menu-link">
					<span class="menu-icon">{!! getIcon('element-11', 'fs-2') !!}</span>
					<span class="menu-title">Dashboards</span>
					<span class="menu-arrow"></span>
				</span>
				<!--end:Menu link-->
				
			</div>
			<!--end:Menu item-->
		
		
	<!--begin:Menu item-->
			<div class="menu-item pt-5">
				<!--begin:Menu content-->
				<div class="menu-content">
					<span class="menu-heading fw-bold text-uppercase fs-7">Venta</span>
				</div>
				<!--end:Menu content-->
			</div>
			<!--end:Menu item-->
			<!--begin:Menu item-->
<div data-kt-menu-trigger="click" class="menu-item menu-accordion {{ request()->routeIs('ventas.*') ? 'here show' : '' }}">
    <!--begin:Menu link-->
    <span class="menu-link">
        <span class="menu-icon">{!! getIcon('abstract-28', 'fs-2') !!}</span>
        <span class="menu-title">Ventas</span>
        <span class="menu-arrow"></span>
    </span>
    <!--end:Menu link-->

    <!--begin:Menu sub-->
    <div class="menu-sub menu-sub-accordion">
        <!-- Punto de Venta -->
        <div class="menu-item">
            <a class="menu-link {{ request()->routeIs('ventas.punto-de-venta') ? 'active' : '' }}" href="{{ route('ventas.punto-de-venta') }}">
                <span class="menu-bullet"><span class="bullet bullet-dot"></span></span>
                <span class="menu-title">Punto de Venta</span>
            </a>
        </div>

        <!-- Notas de Venta -->
        <div class="menu-item">
            <a class="menu-link {{ request()->routeIs('ventas.notas-de-venta') ? 'active' : '' }}" href="{{ route('ventas.notas-de-venta') }}">
                <span class="menu-bullet"><span class="bullet bullet-dot"></span></span>
                <span class="menu-title">Notas de Venta</span>
            </a>
        </div>

        <!-- Registro en Caja -->
        <div class="menu-item">
            <a class="menu-link {{ request()->routeIs('ventas.registro-en-caja.index') ? 'active' : '' }}"
			href="{{ route('ventas.registro-en-caja.index') }}">
				<span class="menu-bullet"><span class="bullet bullet-dot"></span></span>
				<span class="menu-title">Registro en Caja</span>
			</a>
        </div>

        <!-- Facturación 4.0 -->
        <div class="menu-item">
            <a class="menu-link {{ request()->routeIs('ventas.facturacion-4-0') ? 'active' : '' }}" href="{{ route('ventas.facturacion-4-0') }}">
                <span class="menu-bullet"><span class="bullet bullet-dot"></span></span>
                <span class="menu-title">Facturación 4.0</span>
            </a>
        </div>

        <!-- Complementos de Pago -->
        <div class="menu-item">
            <a class="menu-link {{ request()->routeIs('ventas.complementos-de-pago') ? 'active' : '' }}" href="{{ route('ventas.complementos-de-pago') }}">
                <span class="menu-bullet"><span class="bullet bullet-dot"></span></span>
                <span class="menu-title">Complementos de Pago</span>
            </a>
        </div>
    </div>
    <!--end:Menu sub-->
</div>
<!--end:Menu item-->
		



		
		</div>
		<!--end::Menu-->
	</div>
	<!--end::Menu wrapper-->
</div>
<!--end::sidebar menu-->
