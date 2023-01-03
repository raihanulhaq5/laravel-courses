<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Course;
use App\Models\Platform;
use App\Models\Series;

class CourseController extends Controller
{
    public function index(){
        $courses = Course::latest()->with('submittedBy')->take(12)->get();

        return response()->json($courses);
    }

    public function allCourses(Request $request){

        // return response()->json($request->all());

        $courses = Course::where(function($query) use($request) {
            if(!empty($request->search)){
                $query->where('name', 'like', '%'.$request->search.'%');
            }

            if(!empty($request->price)){
                $price_free = [0.00];

                if(in_array('free', $request->price) && in_array('paid', $request->price)){
                    // Do nothing
                }
                elseif(in_array('free', $request->price)){
                    $query->whereIn('price', $price_free);
                }
                elseif(in_array('paid', $request->price)){
                    $query->whereNotIn('price', $price_free);
                }
            }

            if(!empty($request->duration)){
                $duration = [];
                if(in_array('1h-5h', $request->duration)){
                    // $query->where('duration', 0);
                    $duration[] = 0;
                }

                if(in_array('5h-10h', $request->duration)){
                    // $query->where('duration', 1);
                    $duration[] = 1;

                }

                if(in_array('10h+', $request->duration)){
                    // $query->where('duration', 2);
                    $duration[] = 2;
                }

                if(!empty($duration)){
                    $query->whereIn('duration', $duration);
                }
            }

            if(!empty($request->platform)){
                $query->whereIn('platform_id', $request->platform);
            }

        })->paginate(12);

        $platforms = Platform::select(['id', 'name'])->get();
        $series = Series::select(['id', 'name'])->get();


        return response()->json(([
            'courses' => $courses,
            'platforms' => $platforms,
            'series' => $series,
        ]));
    }
}
