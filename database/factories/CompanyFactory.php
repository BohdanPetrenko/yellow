<?php

namespace Database\Factories;

use App\Models\Company;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class CompanyFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Company::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name'        => $this->faker->name,
            'user_id'     => User::query()->inRandomOrder()->firstOrFail(),
            'title'       => $this->faker->title,
            'phone'       => $this->faker->phoneNumber,
            'description' => $this->faker->realText(60),
        ];
    }
}
