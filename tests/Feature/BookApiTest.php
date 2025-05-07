<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Author;

class BookApiTest extends TestCase
{
    // /**
    //  * A basic feature test example.
    //  */
    // public function test_example(): void
    // {
    //     $response = $this->get('/');

    //     $response->assertStatus(200);
    // }

    use RefreshDatabase;

    public function test_create_book()
    {
        $author = Author::factory()->create();

        $response = $this->postJson('/api/books', [
            'title' => 'Test Book Title',
            'author_id' => $author->id,
            'isbn' => '1234567891012',
        ]);

        $response->assertStatus(201)
                ->assertJson([
                    'data' => [
                        'title' => 'Test Book Title',
                    ]
                ]);
    }

    public function test_get_books()
    {
        $response = $this->getJson('/api/books');
        
        $response->assertStatus(200)
                ->assertJsonStructure([
                    'data' => [
                        '*' => ['id', 'title', 'isbn', 'author', 'created_at'],
                    ]
                ]);
    }

}
