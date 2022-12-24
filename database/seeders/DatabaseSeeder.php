<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Author;
use App\Models\Course;
use App\Models\Platform;
use App\Models\Review;
use Illuminate\Database\Seeder;
use App\Models\Series;
use App\Models\Topic;
use App\Models\User;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {

        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        // Create User
        User::create([
            'name' => 'admin',
            'email' => 'raihanulhaq@gmail.com',
            'password' => bcrypt('password'),
            'type' => 1,
        ]);

        // $series = ['PHP', 'JavaScript', 'WordPress', 'Laravel'];
        $series = [
            [
                'name' => 'Laravel',
                'slug' => 'laravel',
                'image' => 'https://fakeimg.pl/250x100/?text=Laravel',
            ],
            [
                'name' => 'PHP',
                'slug' => 'php',
                'image' => 'https://fakeimg.pl/250x100/?text=PHP',
            ],
            [
                'name' => 'Livewire',
                'slug' => 'livewire',
                'image' => 'https://fakeimg.pl/250x100/?text=Livewire',
            ],
            [
                'name' => 'Vue.js',
                'slug' => 'vue-js',
                'image' => 'https://fakeimg.pl/250x100/?text=Vue.js',
            ],
        ];
        foreach ($series as $item){
            // $slug = strtolower(str_replace(' ', '-', $item['name']));
            // 'slug' => $slug,
            Series::create([
                'name' => $item['name'],
                'slug' => $item['slug'],
                'image' => $item['image'],
            ]);
        }

        $topics =['Eloquent', 'Validation', 'Testing', 'Refactoring'];
        foreach ($topics as $item) {
            $slug = strtolower(str_replace(' ', '-', $item));
            Topic::create([
                'name' => $item,
                'slug' => $slug,
            ]);
        }

        $platforms =['Laracasts', 'Laravel Daily', 'Codecourse'];
        foreach ($platforms as $item) {
            $slug = strtolower(str_replace(' ', '-', $item));
            Platform::create([
                'name' => $item,
                'slug' => $slug,
            ]);
        }

        // $authors = ['RH Emran', 'Rasel Ahmed', 'Habibur Rahman', 'Sazzad Khan', 'Rabiul Islam', 'Abdur Rahim'];
        // foreach($authors as $item) {
        //     Author::create([
        //         'name' => $item,
        //     ]);
        // }

        // Create 10 Author
        Author::factory(10)->create();

        // Create 50 Users
        User::factory(50)->create();

        // Create 100 Courses
        Course::factory(100)->create();

        $courses = Course::all();
        foreach($courses as $course) {
            $topics = Topic::all()->random(rand(1, 4))->pluck('id')->toArray();
            // dd($topics);
            $course->topics()->attach($topics);

            $authors = Author::all()->random(rand(1, 6))->pluck('id')->toArray();
            // dd($authors);
            $course->authors()->attach($authors);

            $series = Series::all()->random(rand(1, 4))->pluck('id')->toArray();
            // dd($series);
            $course->series()->attach($series);
        }

        // Create 100 Review
        Review::factory(100)->create();

    }
}
