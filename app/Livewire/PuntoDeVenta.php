<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\PuntoVenta;

/**
 * Livewire component for managing punto de venta.
 */
class PuntoDeVenta extends Component
{
    /** @var string|null */
    public $codigo;

    /** @var \Illuminate\Support\Collection */
    public $searchResults = [];

    /** @var int */
    public $cantidad = 1;

    /** @var float|null */
    public $precio;

    /** @var array */
    public $items = [];

    /** @var string|null */
    public $previewImage = null;

    /** @var string */
    public $selectedProductName = 'Producto';

    /** @var float */
    public $selectedProductPrice = 0.00;

    /**
     * Add item to cart.
     */
    public function agregar()
    {
        $producto = PuntoVenta::where('codigo', $this->codigo)->first();

        if (!$producto) {
            session()->flash('error', 'Producto no encontrado en la base de datos.');
            return;
        }

        $importe = $producto->precio_venta * $this->cantidad;

        $item = [
            'codigo'        => $producto->codigo,
            'descripcion'   => $producto->descripcion,
            'precio_venta'  => $producto->precio_venta,
            'cantidad'      => $this->cantidad,
            'importe'       => $importe,
            'imagen'        => $producto->imagen_url ?? asset('img/default.jpg'),
        ];

        $this->items[] = $item;

        $this->selectedProductName = $producto->descripcion;
        $this->selectedProductPrice = $producto->precio_venta;
        $this->previewImage = $item['imagen'];

        $this->reset(['codigo', 'cantidad', 'precio']);
        $this->cantidad = 1;
    }

    /**
     * Remove last added item.
     */
    public function borrarUltimo()
    {
        array_pop($this->items);
    }

    /**
     * Get total price.
     *
     * @return float
     */
    public function getTotalProperty()
    {
        return collect($this->items)->sum('importe');
    }

    /**
     * Get total number of articles.
     *
     * @return int
     */
    public function getTotalArticulosProperty()
    {
        return count($this->items);
    }

    /**
     * Render the Livewire component view.
     *
     * @return \Illuminate\View\View
     */
    public function render()
    {
        $this->searchResults = [];

        if (!empty($this->codigo)) {
            $this->searchResults = PuntoVenta::where('descripcion', 'like', '%' . $this->codigo . '%')
                ->orWhere('codigo', 'like', '%' . $this->codigo . '%')
                ->limit(5)
                ->get();
        }

        return view('livewire.punto-de-venta');
    }

    /**
     * Select a product from autocomplete results.
     * @param string $codigo
     */
    public function selectProduct($codigo)
    {
        $this->codigo = $codigo;
        $this->agregar(); // Call agregar() to add the product
        $this->searchResults = []; // Clear dropdown
    }
}