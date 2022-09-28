<?php

namespace Tests\Feature;

use Tests\TestCase;

class UserTest extends TestCase
{
    public function test_register_user()
    {
        $data = [
            'name' => $this->faker->sentence,
            'email' => $this->faker->email,
            'password'=> $this->faker->password
        ];

        $this->post(route('auth.register'), $data)
            ->dump()
            ->assertStatus(201);
    }
}
