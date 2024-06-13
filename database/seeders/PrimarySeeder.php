<?php

namespace Database\Seeders;

use App\Models\Editor;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class PrimarySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Editor::factory()->admin()->create([
            'firstname' => 'Редактор',
            'lastname' => 'Головний',
            'password' => Hash::make('password'),
        ]);
    }
}
