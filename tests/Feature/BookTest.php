<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Laravel\Sanctum\Sanctum;
use Tests\TestCase;

class BookTest extends TestCase
{
    public function test_it_cant_create_a_book_not_logged()
    {
        $data = [
            'name' => $this->faker->sentence,
            'isbn' => $this->faker->numerify,
            'value'=> $this->faker->randomFloat(2,1,10)
        ];

        $this->post(route('books.store'), $data)
            ->dump()
            ->assertStatus(401);
    }

    public function test_it_cant_create_a_book()
    {
        Sanctum::actingAs(User::factory()->create());
        $data = [
            'name' => $this->faker->sentence,
            'isbn' => $this->faker->numerify,
            'value'=> $this->faker->randomFloat(2,1,10)
        ];

        $this->post(route('books.store'), $data)
            ->dump()
            ->assertStatus(201)
            ->assertJson(compact('data'));
    }
}
