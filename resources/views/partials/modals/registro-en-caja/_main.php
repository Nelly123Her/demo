{{-- resources/views/ventas/registro-en-caja/show.blade.php --}}
@extends('layouts.app')

@section('content')
    @include('partials.modals.registro-en-caja.modal-registro-en-caja')

    <script>
        window.onload = function () {
            const modal = new bootstrap.Modal(document.getElementById('modal-id')); // use correct ID
            modal.show();
        }
    </script>
@endsection