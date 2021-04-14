<?php

namespace Database\Factories;

use App\Models\Good;
use Illuminate\Database\Eloquent\Factories\Factory;

class GoodFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Good::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->name,
            'brand' => $this->faker->lastName,
            'price' => $this->faker->numberBetween(50,10000),
            'code' => $this->faker->postcode,
            'qty' => $this->faker->numberBetween(1,100),
            'able' => $this->faker->boolean(70),
        ];
    }
}
