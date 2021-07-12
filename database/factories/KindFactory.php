<?php

namespace Database\Factories;

use App\Models\Artist;
use App\Models\Image;
use App\Models\Kind;
use Illuminate\Database\Eloquent\Factories\Factory;

class KindFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Kind::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'nome' => $this->faker->firstName(),
        ];
    }
}
