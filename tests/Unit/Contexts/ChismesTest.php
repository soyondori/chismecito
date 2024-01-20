<?php

namespace Tests\Unit\Contexts;

use App\Models\User;
use App\Models\Chisme;
use App\Contexts\Chismes;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Tests\TestCase;

final class ChismesTest extends TestCase
{
    use RefreshDatabase;

    public function test_create_chisme_success(): void
    {
        $user = User::factory()->create();

        $args = [
            'title' => 'Chisme test',
            'content' => '<h1>Content</h1>',
            'author_id' => $user->id
        ];

        $chisme = Chismes::create($args);

        $this->assertEquals($args['title'], $chisme->title);
        $this->assertEquals($args['content'], $chisme->content);
        $this->assertEquals($args['author_id'], $chisme->author->id);
        $this->assertEquals($user->name, $chisme->author->name);
    }

    public function test_get_all_chismes_success(): void
    {
        $chismeAuthor = User::factory()->create();

        for ($i=0; $i < 10; $i++) { 
            Chisme::factory(['author_id' => $chismeAuthor->id])->create();
        }

        $chismes = Chismes::getAll();
        $this->assertEquals(10, count($chismes));
    }

    public function test_get_chisme_success(): void
    {
        $chismeAuthor = User::factory()->create();
        $chisme = Chisme::factory(['author_id' => $chismeAuthor->id])->create();
        
        $result = Chismes::get($chisme->id);
        $this->assertEquals($chisme->id, $result->id);
    }

    public function test_get_chisme_fail(): void
    {
        $this->expectException(ModelNotFoundException::class);
        Chismes::get('invalid_id');
    }

    public function test_create_chisme_comment_success(): void
    {
        $chismeAuthor = User::factory()->create();
        $commentAuthor = User::factory()->create();
        $chisme = Chisme::factory(['author_id' => $chismeAuthor->id])->create();

        $args = [
            'content' => '<h1>Content</h1>',
            'chisme_id' => $chisme->id,
            'author_id' => $commentAuthor->id,
        ];

        $comment = Chismes::comment($args);

        $this->assertEquals($args['content'], $comment->content);
        $this->assertEquals($args['author_id'], $comment->author->id);
        $this->assertEquals($args['chisme_id'], $comment->chisme->id);
    }
}