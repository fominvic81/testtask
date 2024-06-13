<?php

namespace Database\Seeders;

use App\Models\Article;
use App\Models\Editor;
use App\Models\Tag;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DummySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Editor::factory()
            ->has(Article::factory(5)->has(Tag::factory(5)))
            ->create([
                'firstname' => 'Редактор',
                'lastname' => 'Тестовий',
                'email' => 'dummy@app.com',
                'password' => Hash::make('password'),
            ]);
    }
}
