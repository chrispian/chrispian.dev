<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PostProjectSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\PostProject::factory()->create([
            ['title' => 'chrispian.dev'],
            ['title' => 'chrispian.com']
        ]);

    }
}
