<?php

namespace Database\Seeders;

use App\Models\User;
use Database\Factories\BlogPostFactory;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
         User::factory(1)->create([
             'name' => 'Brent',
             'email' => 'brent@spatie.be'
         ]);

        $files = scandir(resource_path('content'));

        foreach ($files as $file) {
            if (in_array($file, ['.', '..'])) {
                continue;
            }

            preg_match('/[\d]{4}-[\d]{2}-[\d]{2}/', $file, $matches);

            $date = $matches[0];

            BlogPostFactory::new([
                'author' => 'Brent',
                'title' => ucfirst(str_replace(["{$date}-", '-', '.md'], ['', ' ', ''], $file)),
                'content_path' => "content/{$file}",
                'date' => $date,
            ])->create();
        }
    }
}
