<?php

namespace Database\Seeders;

use App\Models\BlogPost;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
         \App\Models\User::factory(1)->create([
             'name' => 'Brent',
             'email' => 'brent@spatie.be'
         ]);

        $files = scandir(__DIR__ . '/blogPosts');

        foreach ($files as $file) {
            if (in_array($file, ['.', '..'])) {
                continue;
            }

            $body = file_get_contents(__DIR__ . "/blogPosts/{$file}");

            preg_match('/[\d]{4}-[\d]{2}-[\d]{2}/', $file, $matches);

            $date = $matches[0];

            $title = ucfirst(str_replace(["{$date}-", '-', '.md'], ['', ' ', ''], $file));

            BlogPost::create([
                'author' => 'Brent',
                'title' => $title,
                'body' => $body,
                'date' => $date,
                'likes' => rand(10, 1000),
            ]);
        }
    }
}
