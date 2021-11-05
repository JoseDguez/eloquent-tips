<?php

namespace Database\Factories;

use App\Models\Video;
use Illuminate\Database\Eloquent\Factories\Factory;

class VideoFactory extends Factory
{
    const STATUSES = ['Pendiente', 'Activo', 'Cancelado'];

    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Video::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'title' => $this->faker->sentence(),
            'status' => self::STATUSES[$this->faker->numberBetween(0, 2)],
            'likes' => $this->faker->numberBetween(1, 150),
            'dislikes' => $this->faker->numberBetween(1, 150),
            'author' => $this->faker->firstName()
        ];
    }
}
