<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\Chisme;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Laravel\Sanctum\Sanctum;
use Tests\TestCase;

class ApiChismeTest extends TestCase
{
    use RefreshDatabase;
    public function test_get_chismes(): void 
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
            ->get('/api/chismes');

        $response->assertOk();
        $response->assertJsonIsArray();
        $response->assertJsonStructure([
            '*' => $this->jsonChismeStructure()
        ]);
    }

    public function test_get_chismes_unauthenticated(): void
    {
        $response = $this
            ->withHeader('accept','application/json')
            ->get('/api/chismes');

        $response->assertUnauthorized();
    }

    public function test_create_chisme(): void
    {
        Sanctum::actingAs(
            User::factory()->create(),
            ['*']
        );

        $response = $this
            ->withHeader('accept','application/json')
            ->postJson('/api/chismes', [
                'title' => 'A really GOOD chisme',
                'content' => '<h1>Fijate paty...</h1>'
            ]);

        $response->assertCreated();
    }

    public function test_create_invalid_chisme(): void
    {
        Sanctum::actingAs(
            User::factory()->create(),
            ['*']
        );

        $response = $this
            ->withHeader('accept','application/json')
            ->postJson('/api/chismes', [
                'content' => '<h1>Fijate paty...</h1>'
            ]);

        $response->assertUnprocessable();
    }

    public function test_create_chisme_unauthenticated(): void
    {
        $response = $this
            ->withHeader('accept','application/json')
            ->postJson('/api/chismes', [
                'title' => 'A really GOOD chisme',
                'content' => '<h1>Fijate paty...</h1>'
            ]);

        $response->assertUnauthorized();
    }

    protected function jsonChismeStructure()
    {
        return [
            'title',
            'content',
            'author_id',
            'author' => [
                'id',
                'name',
                'email'
            ],
            'comments' => [
                '*' => [
                    'id',
                    'author_id',
                    'chisme_id',
                    'content',
                ]
            ]
        ];
    }
}