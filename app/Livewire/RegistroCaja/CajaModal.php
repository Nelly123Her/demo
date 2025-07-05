<?php
namespace App\Livewire\RegistroCaja;

use Livewire\Component;
use App\Models\RegistroCaja;

class CajaModal extends Component
{
    public $efectivo, $tc_dolar, $fecha_apertura, $fecha_cierre, $estado;
    public $registroId;
    public $isEditing = false;

    protected $rules = [
        'efectivo' => 'required|numeric',
        'tc_dolar' => 'required|numeric',
        'fecha_apertura' => 'required|date',
        'fecha_cierre' => 'nullable|date',
        'estado' => 'required|string',
    ];

    protected $listeners = ['modal.show.caja' => 'loadRegistro'];

    public function loadRegistro($id = null)
    {
        $this->isEditing = (bool) $id;

        if ($id) {
            $registro = RegistroCaja::findOrFail($id);
            $this->registroId = $registro->id;
            $this->efectivo = $registro->efectivo;
            $this->tc_dolar = $registro->tc_dolar;
            $this->fecha_apertura = $registro->fecha_apertura?->format('Y-m-d');
            $this->fecha_cierre = $registro->fecha_cierre?->format('Y-m-d');
            $this->estado = $registro->estado;
        } else {
            $this->reset(['registroId', 'efectivo', 'tc_dolar', 'fecha_apertura', 'fecha_cierre', 'estado']);
        }

        $this->dispatchBrowserEvent('modal.show.caja');
    }

    public function submit()
    {
        $this->validate();

        RegistroCaja::updateOrCreate(
            ['id' => $this->registroId],
            $this->only(['efectivo', 'tc_dolar', 'fecha_apertura', 'fecha_cierre', 'estado'])
        );

        $this->dispatch('success');

        $this->reset(['registroId', 'efectivo', 'tc_dolar', 'fecha_apertura', 'fecha_cierre', 'estado', 'isEditing']);
    }

    public function render()
    {
        return view('livewire.registro-caja.caja-modal');
    }
}