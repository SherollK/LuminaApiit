<?php

namespace Database\Factories;


use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\User;


/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Events>
 */
class EventsFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            
                'user_id' => User::factory(),
                'title' => $this->faker->sentence(),
                'description' => $this->faker->paragraph(10),
                'slug' => $this->faker->slug(3),
                'image' => $this->faker->imageUrl(),
                'date' => $this->faker->dateTimeBetween('-1 week', '+1 week'),
                'time' => $this->faker->time('H:i'),
                'location' => $this->faker->sentence(),
            //
        ];
    }
}
