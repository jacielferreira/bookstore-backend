<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class PingTest extends TestCase
{
    /** @test */
    public function guest_cannot_books_ping()
    {
        $this->json('get', 'api/books')->assertStatus(401);
    }

    /** @test */
    public function guest_cannot_book_by_isbn_ping()
    {
        $this->json('get', 'api/books/123456')->assertStatus(401);
    }
}
