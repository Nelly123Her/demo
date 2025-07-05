<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\PuntoVenta>
 */
class PuntoVentaFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */

    public function definition(): array
    {
        $cantidad = $this->faker->numberBetween(1, 10);
        $precio = $this->faker->randomFloat(2, 10, 100);

        return [
            'numero' => $this->faker->unique()->numberBetween(1, 9999),
            'codigo' => strtoupper($this->faker->bothify('PRD-####')),
            'descripcion' => $this->faker->words(3, true),
            'precio_venta' => $precio,
            'cantidad' => $cantidad,
            'importe' => $precio * $cantidad,
            'folio_venta' => $this->faker->numberBetween(10000, 99999),
        ];
    }
}
