<?php

namespace Database\Factories;

use App\Models\MentorshipApplication;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\MentorshipApplication>
 */
class MentorshipApplicationFactory extends Factory
{
    protected $model = MentorshipApplication::class;

    public function definition(): array
    {
        return [
            'first_name'         => $this->faker->firstName,
            'second_name'        => $this->faker->lastName,
            'email'              => $this->faker->unique()->safeEmail,
            'contact_number'     => $this->faker->phoneNumber,
            'occupation'         => $this->faker->jobTitle,
            'designation'        => $this->faker->jobTitle,
            'organization'       => $this->faker->company,
            'programme_choice'   => $this->faker->randomElement(['Leadership', 'Technology', 'Business']),
            'linkedin'           => $this->faker->url,
            'pledge_agree'       => $this->faker->boolean(80),
            'submitted_at'       => $this->faker->dateTimeBetween('-2 months', 'now'),
            'is_confirmed'       => $this->faker->boolean(70),
            'confirmation_token' => $this->faker->uuid,
            'username'           => $this->faker->userName,
            'password'           => bcrypt('password'), // Always hash passwords
            'is_eligible'        => $this->faker->randomElement([null, 0, 1]),
            'session_date'       => $this->faker->optional()->date(),
            'remarks'            => $this->faker->sentence,
        ];
    }
}
