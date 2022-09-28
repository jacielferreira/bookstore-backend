<?php

namespace Tests\Feature;

use App\Http\Resources\Book\BookResource;
use App\Models\Book;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\Request;
use Laravel\Sanctum\Sanctum;
use Tests\TestCase;
use Illuminate\Http\Response;

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

    public function test_create_book()
    {
        Sanctum::actingAs(User::factory()->create());
        $data = [
            'name' => $this->faker->sentence,
            'isbn' => $this->faker->numerify,
            'value'=> $this->faker->randomFloat(2,1,10)
        ];

        $this->post(route('books.store'), $data)
            ->dump()
            ->assertStatus(201);
    }

    public function test_showing_all_books()
    {
        Sanctum::actingAs(User::factory()->create());
        $this->get(route('books.index'))
            ->dump()
            ->assertStatus(201);
    }

    public function test_showing_book_by_isbn()
    {
        Sanctum::actingAs(User::factory()->create());
        $this->get(route('books.index'))
            ->dump()
            ->assertStatus(201);
    }

    public function test_delete_book_by_id()
    {
        Sanctum::actingAs(User::factory()->create());
        $data = [
            'name' => $this->faker->sentence,
            'isbn' => 123456789,
            'value'=> $this->faker->randomFloat(2,1,10)
        ];
        $this->post(route('books.store'), $data)
            ->dump()
            ->assertStatus(201);
        $response = $this->call('GET', '/api/books/123456789');
        $this->assertEquals(201, $response->getStatusCode());
    }

    public function test_update_book()
    {
        Sanctum::actingAs(User::factory()->create());
        $data = [
            'name' => $this->faker->sentence,
            'isbn' => $this->faker->numerify,
            'value'=> $this->faker->randomFloat(2,1,10)
        ];
        $newData = [
            'name' => $this->faker->sentence,
            'isbn' => $this->faker->numerify,
            'value'=> $this->faker->randomFloat(2,1,10)
        ];
        $this->post(route('books.store'), $data)
            ->dump()
            ->assertStatus(201);
        $this->put(route('books.update', 1), $newData)
            ->dump()
            ->assertStatus(201);
    }

}
