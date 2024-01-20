<?php

namespace Tests\Unit\Contexts;

use App\Models\User;
use App\Contexts\Chismes;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

final class ChismesTest extends TestCase
{
    use RefreshDatabase;

    public function test_chisme_create_success(): void
    {
        $user = User::factory()->create();

        $args = [
            'title' => 'Chisme test',
            'content' => '<h1>Content</h1>',
            'user_id' => $user->id
        ];

        $chisme = Chismes::create($args);

        $this->assertEquals($args['title'], $chisme->title);
        $this->assertEquals($args['content'], $chisme->content);
        $this->assertEquals($args['user_id'], $chisme->user_id);
    }
}