<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Platform;
use Illuminate\Http\Request;

class CourseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $search = $request->search;
        $levels = $request->level;

        // dd($levels);

        $courses = Course::where(function ($query) use ($search) {
            if(!empty($search)) {
                $query->where('name', 'like', '%' . $search . '%');
            }
        })->when($levels, function ($query) use ($levels) {
            $fields = array();
            // array_push($z, 'she', 'it');

            foreach($levels as $level) {
                if($level == 'beginner') {
                    $field = 0;
                } elseif($level == 'intermediate') {
                    $field = 1;
                } else {
                    $field = 2;
                }
                array_push($fields, $field);
            }
            // $query->where('difficulty_level', $field);
            $query->whereIn('difficulty_level', $fields);
        })->paginate(12);

        // $courses = Course::with(['platform', 'topics', 'series', 'authors', 'reviews'])->paginate(12);

        // return response()->json($courses);

        return view('course.index', [
            'courses' => $courses
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Course  $course
     * @return \Illuminate\Http\Response
     */
    // public function show(Course $course)
    // {
    //     //
    // }
    public function show($slug)
    {
        $course = Course::where('slug', $slug)->with(['platform', 'topics', 'series', 'authors', 'reviews'])->first();

        // return response()->json($course);

        if( empty($course) ) {
            return abort(404);
        }

        return view('course.single',[
            'course' => $course,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Course  $course
     * @return \Illuminate\Http\Response
     */
    public function edit(Course $course)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Course  $course
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Course $course)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Course  $course
     * @return \Illuminate\Http\Response
     */
    public function destroy(Course $course)
    {
        //
    }
}
