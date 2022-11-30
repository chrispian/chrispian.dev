<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\PostProject;
use App\Models\PostSeries;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{




    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {

        DB::table('users')->insert([
            'name' => 'Chrispian BUrks',
            'email' => 'chrispian@gmail.com',
            'password' => Hash::make('password'),
        ]);

        DB::table('post_categories')->insert([
            ['title' => 'Frontend', 'slug' => 'frontend'],
            ['title' => 'Backend', 'slug' => 'backend'],
        ]);

        DB::table('post_projects')->insert([
            ['title' => 'chrispian.dev'],
            ['title' => 'chrispian.com'],
        ]);

        DB::table('post_series')->insert([
            ['title' => 'Series One'],
            ['title' => 'Series Two'],
        ]);
    }
}
