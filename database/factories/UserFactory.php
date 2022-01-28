<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class UserFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = User::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition(): array
    {
        return [
            'first_name'     => $this->faker->firstName,
            'last_name'      => $this->faker->lastName,
            'password'       => $this->faker->password(10),
            'email'          => $this->faker->unique()->safeEmail,
            'phone'          => $this->faker->phoneNumber,
            'remember_token' => $this->faker->asciify('********************'),

        ];
    }
}
