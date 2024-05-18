<?php

namespace Database\Seeders;
use App\Models\Category;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;


class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $categories = [
            [
                'title' => 'APIIT Law School',
                'slug' => Str::slug('APIIT Law School'),
                'text_color' => null,
                'bg_color' => null,
            ],
            [
                'title' => 'Industrial opportunities',
                'slug' => Str::slug('Industrial opportunities'),
                'text_color' => null,
                'bg_color' => null,
            ],
            [
                'title' => 'APIIT Computing School',
                'slug' => Str::slug('APIIT Computing School'),
                'text_color' => null,
                'bg_color' => null,
            ],
            [
                'title' => 'Alumni connections',
                'slug' => Str::slug('Alumni connections'),
                'text_color' => null,
                'bg_color' => null,
            ],
            [
                'title' => 'Hackathons',
                'slug' => Str::slug('Hackathons'),
                'text_color' => null,
                'bg_color' => null,
            ],
            [
                'title' => 'Mock Debates',
                'slug' => Str::slug('Mock Debates'),
                'text_color' => null,
                'bg_color' => null,
            ],
            [
                'title' => 'APIIT Business School',
                'slug' => Str::slug('APIIT Business School'),
                'text_color' => null,
                'bg_color' => null,
            ],
            [
                'title' => 'Fun events',
                'slug' => Str::slug('Fun events'),
                'text_color' => null,
                'bg_color' => null,
            ],
            [
                'title' => 'Networking events',
                'slug' => Str::slug('Networking events'),
                'text_color' => null,
                'bg_color' => null,
            ],
            [
                'title' => 'Internships',
                'slug' => Str::slug('Internships'),
                'text_color' => null,
                'bg_color' => null,
            ],
        ];

        DB::table('categories')->insert($categories);
    //      \App\Models\Post::factory(100)->create();
        //  \App\Models\Category::factory(8)->create();
        //  \App\Models\Events::factory(20)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@test.com',
        //     'password' => bcrypt('password'),
        // ]);
        // \App\Models\User::factory()->create([
        //     'name' => 'Test Admin',
        //     'email' => 'admin@admin.com',
        //     'password' => bcrypt('password'),
            
        // ]);
        // \App\Models\User::factory()->create([
        //     'name' => 'Test Editor',
        //     'email' => 'editor@editor.com',
        //     'password' => bcrypt('password'),
            
        // ]);



    }
}
