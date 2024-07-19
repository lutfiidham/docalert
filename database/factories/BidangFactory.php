<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\Bidang;
use App\Models\Cabang;
use App\Models\User;

class BidangFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Bidang::class;

    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            'cabang_id' => Cabang::factory(),
            'nama' => $this->faker->word(),
            'id_kepala_bidang' => User::factory(),
        ];
    }
}
