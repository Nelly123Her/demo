<button type="button"
    class="btn btn-sm btn-light-primary btn-show-registro"
    data-id="{{ $row->id }}">
    {!! getIcon('eye', 'fs-5') !!}
</button>

<button type="button"
    class="btn btn-sm btn-light-warning"
    onclick="Livewire.emit('modal.show.caja', {{ $row->id }})">
    {!! getIcon('pencil', 'fs-5') !!}
</button>


    {{-- Delete --}}
    <form action="{{ route('ventas.registro-en-caja.destroy', $row->id) }}" method="POST" style="display:inline;">
        @csrf
        @method('DELETE')
        <button type="submit" class="btn btn-sm btn-light-danger"
            onclick="return confirm('¿Estás seguro de que deseas eliminar este registro?')">
            {!! getIcon('trash', 'fs-5') !!}
        </button>
    </form>
</div>