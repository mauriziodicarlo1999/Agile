<?php

namespace Database\Factories;

use App\Models\Image;
use App\Models\Topic;
use Illuminate\Database\Eloquent\Factories\Factory;

class TopicFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Topic::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {

        $user = \App\Models\User::factory()->create();
        $image = Image::factory()->create();
        return [
            'titolo' => $this->faker->name(),
            'descrizione' => $this->faker->text('100'),
            'id_creatore' => $user->id,
            'id_copertina' => $image->id
        ];
    }
}
