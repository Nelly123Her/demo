<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\RegistroCaja;

class RegistroCajaFactory extends Factory
{
    protected $model = RegistroCaja::class;

    public function definition(): array
    {
        $fechaApertura = $this->faker->dateTimeBetween('-30 days', 'now');
        $fechaCierre = (clone $fechaApertura)->modify('+'.rand(1, 2).' days');

        return [
            'fecha_apertura' => $fechaApertura,
            'fecha_cierre' => $fechaCierre,
            'efectivo' => $this->faker->randomFloat(2, 500, 4000),
            'tc_dolar' => 1.00,
            'estado' => $this->faker->randomElement(['ACTIVA', 'FINALIZADA']),
        ];
    }
}