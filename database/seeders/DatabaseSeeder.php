<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Author;
use App\Models\Course;
use App\Models\Platform;
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

        // $series = ['PHP', 'JavaScript', 'WordPress', 'Laravel'];
        $series = [
            [
                'name' => 'PHP',
                'image' => 'https://fakeimg.pl/250x100/?text=PHP',
            ],
            [
                'name' => 'JavaScript',
                'image' => 'https://fakeimg.pl/250x100/?text=Java Script',
            ],
            [
                'name' => 'WordPress',
                'image' => 'https://fakeimg.pl/250x100/?text=Word Press',
            ],
            [
                'name' => 'Laravel',
                'image' => 'https://fakeimg.pl/250x100/?text=Laravel',
            ],
            [
                'name' => 'CodeIgniter',
                'image' => 'https://fakeimg.pl/250x100/?text=Code Igniter',
            ]
        ];
        foreach ($series as $item){
            Series::create([
                'name' => $item['name'],
                'image' => $item['image'],
            ]);
        }

        $topics =['Eloquent', 'Validation', 'Authentication', 'Testing', 'Refactoring'];
        foreach ($topics as $item) {
            Topic::create([
                'name' => $item,
            ]);
        }

        $platforms =['laracasts', 'Youtube', 'Larajobs', 'Laravel News', 'Laracasts Forum'];
        foreach ($platforms as $item) {
            Platform::create([
                'name' => $item,
            ]);
        }

        $authors = ['RH Emran', 'Rasel Ahmed', 'Habibur Rahman', 'Sazzad Khan', 'Rabiul Islam', 'Abdur Rahim'];
        foreach($authors as $item) {
            Author::create([
                'name' => $item,
            ]);
        }

        // Create 50 Users
        User::factory(50)->create();

        // Create 100 Courses
        Course::factory(100)->create();

        $courses = Course::all();
        foreach($courses as $course) {
            $topics = Topic::all()->random(rand(1, 5))->pluck('id')->toArray();
            // dd($topics);
            $course->topics()->attach($topics);

            $authors = Author::all()->random(rand(1, 6))->pluck('id')->toArray();
            // dd($authors);
            $course->authors()->attach($authors);

            $series = Series::all()->random(rand(1, 4))->pluck('id')->toArray();
            // dd($series);
            $course->series()->attach($series);
        }



    }
}
