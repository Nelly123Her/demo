<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\ComplementoPago>
 */
class ComplementoPagoFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
   public function definition(): array
{
    return [
        'serie_folio' => strtoupper($this->faker->unique()->bothify('CP-####')),
        'fecha_hora' => $this->faker->dateTimeBetween('-1 month', 'now'),
        'cliente' => $this->faker->name,
        'subtotal' => $this->faker->randomFloat(2, 100, 5000),
        'total' => function (array $attributes) {
            return $attributes['subtotal'] * 1.16;
        },        'folio_fiscal' => $this->faker->uuid,
        'metodo_pago' => $this->faker->randomElement(['Efectivo', 'Transferencia', 'Tarjeta']),
        'estado' => $this->faker->randomElement(['PENDIENTE', 'PAGADA', 'CANCELADA']),
        'pdf' => $this->faker->boolean(80),
        'xml' => $this->faker->boolean(90),
    ];
}
}
