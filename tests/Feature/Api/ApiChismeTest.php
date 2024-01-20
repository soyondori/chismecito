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
    public function test_a_user_can_get_chismes(): void 
    {
        $authors = User::factory()->count(3)->create();
        $authors->map(function ($author) {
            Chisme::factory(['author_id' => $author->id])->create();
        });
        
        Sanctum::actingAs(
            User::factory()->create(),
            ['*']
        );

        $response = $this->get('/api/chismes');
        $response->assertOk();
        $response->assertJsonIsArray();
        $response->assertJsonStructure([
            '*' => $this->jsonChismeStructure()
        ]);
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