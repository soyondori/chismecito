<?php

namespace Tests\Feature\Api;
use App\Models\Chisme;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Laravel\Sanctum\Sanctum;
use Tests\TestCase;

class ApiAuthorTest extends TestCase
{
    use RefreshDatabase;

    public function test_get_authors(): void
    {
        $authors = User::factory()->count(3)->create();
        $authors->map(function ($author) {
            Chisme::factory(['author_id' => $author->id])->create();
        });

        Sanctum::actingAs(
            User::factory()->create(),
            ['*']
        );

        $response = $this
            ->withHeader('accept','application/json')
            ->get('/api/authors');

        $response->assertOk();
        $response->assertJsonIsArray();
        $response->assertJsonStructure([
            '*' => $this->jsonAuthorStructure()
        ]);

    }

    public function test_get_authors_unauthenticated(): void
    {
        $response = $this
            ->withHeader('accept','application/json')
            ->get('/api/authors');

        $response->assertUnauthorized();
    }

    public function test_get_author(): void
    {
        $author = User::factory()->create();
        Chisme::factory(['author_id' => $author->id])->create();

        Sanctum::actingAs(
            User::factory()->create(),
            ['*']
        );

        $response = $this
            ->withHeader('accept','application/json')
            ->get('/api/authors/'. $author->id);

        $response->assertOk();
        $response->assertJsonStructure($this->jsonAuthorStructure());
    }

    public function test_get_invalid_author(): void
    {
        Sanctum::actingAs(
            User::factory()->create(),
            ['*']
        );

        $response = $this
            ->withHeader('accept','application/json')
            ->get('/api/authors/invalid_author');

        $response->assertNotFound();
    }

    public function test_get_invalid_unauthenticated(): void
    {
        $response = $this
            ->withHeader('accept','application/json')
            ->get('/api/authors/invalid_author');

        $response->assertUnauthorized();
    }

    protected function jsonAuthorStructure()
    {
        return [
            'id',
            'name',
            'email',
            'chismes' => [
                '*' => [
                    'title',
                    'content',
                    'author_id'
                ]
            ],
            'comments' => [
                '*' => [
                    'id',
                    'author_id',
                    'recipient_id',
                    'content',
                ]
            ]
        ];
    }

}