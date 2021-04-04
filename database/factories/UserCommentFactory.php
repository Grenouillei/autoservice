<?php

namespace Database\Factories;

use App\Models\User;
use App\Models\UserComment;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class UserCommentFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = UserComment::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'id_user' => $this->faker->numberBetween(1,5),
            'id_good' => $this->faker->numberBetween(1,20),
            'comment' => $this->faker->text('350'),
        ];
    }
}
