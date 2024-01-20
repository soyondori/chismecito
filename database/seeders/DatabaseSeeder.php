<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Database\Seeders\UserSeeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $users = User::factory()->count(10)->create();

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
