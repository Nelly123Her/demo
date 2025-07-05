<?php

namespace Database\Factories;

use App\Models\NotasDeVenta;
use Illuminate\Database\Eloquent\Factories\Factory;

class NotasDeVentaFactory extends Factory
{
    protected $model = NotasDeVenta::class;

    public function definition(): array
    {
        return [
            'folio' => 'FOL-' . $this->faker->unique()->numberBetween(1000, 9999),
            'fecha_hora' => $this->faker->dateTimeBetween('-7 days', 'now'),
            'cliente' => $this->faker->name,
            'servicio' => $this->faker->randomElement(['Internet', 'Cable', 'Telefonía']),
            'total' => $this->faker->randomFloat(2, 200, 1500),
            'pagado' => $this->faker->randomFloat(2, 0, 1500),
            'apertura' => $this->faker->boolean(80),
            'factura' => $this->faker->boolean(50),
            'estado' => $this->faker->randomElement(['Pagado', 'Pendiente', 'Cancelado']),
        ];
    }
}