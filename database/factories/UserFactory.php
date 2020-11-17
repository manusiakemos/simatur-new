<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

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
    public function definition()
    {
        $faker = $this->faker;
        return [
            'email' => $faker->safeEmail,
            'username' => "super-admin",
            'password' => bcrypt(123123),
            'name' => $faker->name(),
            'avatar' => "",
            'phone' => $faker->phoneNumber,
            'role' => "super-admin",
        ];
    }
}
