<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Chisme;
use App\Models\ChismeComment;
use App\Models\AuthorComment;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $users = User::factory()
                ->count(10)
                ->create();

        $authorComments = $users->map(function (User $recipient) use (&$users) {
            $authors = $users->random(2);

            return $authors->map(function (User $author) use (&$recipient) {
                return AuthorComment::factory([
                        'author_id' => $author->id,
                        'recipient_id' => $recipient->id,
                    ])
                    ->create();
            });
        })->flatten();

        $chismes = $users->map(function (User $user) {
            return Chisme::factory(['author_id' => $user->id])->create();
        });

        $comments = $chismes->map(function (Chisme $chisme) use (&$users) {
            $authors = $users->random(3);

            return $authors->map(function (User $author) use (&$chisme) {
                return ChismeComment::factory(['author_id' => $author->id])
                    ->for($chisme)
                    ->create();
            })->flatten();
        });
    }
}
