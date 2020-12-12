<?php
namespace Database\Factories\User;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\User\UserDetails;

class UserDetailsFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = UserDetails::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
			'first_name'	=> $this->faker->firstName,
			'last_name'		=> $this->faker->lastName,
			'phone_number'	=> $this->faker->phoneNumber
        ];
    }
}