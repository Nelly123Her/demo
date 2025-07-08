<x-default-layout>
    @section('title')
        Punto de Venta
    @endsection

    @section('breadcrumbs')
        {{ Breadcrumbs::render('ventas.punto-de-venta') }}
    @endsection

    @livewire('punto-de-venta') {{-- This must match App\Livewire\PuntoDeVenta --}}
</x-default-layout>