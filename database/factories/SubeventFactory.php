<?php

namespace Database\Factories;

use App\Models\Event;
use App\Models\Subevent;
use Illuminate\Database\Eloquent\Factories\Factory;

class SubeventFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Subevent::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $mainEvent = Event::factory()->create();
        return [
            'titolo' => $this->faker->name,
            'data_ora_inizio' => '2020-12-16 08:00:00',
            'data_ora_fine' => '2020-12-16 12:00:00',
            'descrizione' => $this->faker->text('70'),
            'id_evento' => $mainEvent->id
        ];
    }
}
