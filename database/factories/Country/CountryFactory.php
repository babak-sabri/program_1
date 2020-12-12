<?php

namespace Database\Factories\Country;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Country\Country;

class CountryFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Country::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
			'name'	=> $this->faker->country,
			'iso2'	=> $this->faker->randomElement(['aa', 'bb', 'cc']),
			'iso3'	=> $this->faker->randomElement(['aaa', 'bbb', 'ccc'])
        ];
    }
}
