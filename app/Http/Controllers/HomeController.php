<?php

namespace App\Http\Controllers;

use Auth;
use App\Section;
use App\Grade;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
    	$user = Auth::user();

    	// @REFACTOR: Use Authorization
    	if ( $user->user_type_id === 1 ) {
            $section = $user->sections()
                // Since we don't have any validations yet (when
                // a student is added to more than 2 classes in a single year)
                // We'll use this as a workaround for testing purposes where).
                ->orderBy('id', 'desc')
                ->where('school_year', school_year())
                ->with(['resources.subject' => function($query) { $query->grade(); }])
                ->with('resources.teacher')
                ->first();

			return view('students.home')->with('section', $section);
    	}

    	if ( $user->user_type_id === 2 ) {
            $resources = $user->resources()
                // Since we don't have any validations yet (when
                // a student is added to more than 2 classes in a single year)
                // We'll use this as a workaround for testing purposes where).
                ->orderBy('resources.id', 'desc')
                ->with('subject')
                ->with(['section.students' => function($query) { $query->grade(); }])
                ->get();

			return view('teachers.home')
                ->with('resources', $resources);
    	}

        $grades = Grade::passing()
            ->get()
            ->groupBy('YEAR(created_at)')
            ->mapWithKeys(function($grades, $year) {
                return numeric_string_key_array($year, $grades->count());
            });

        $transformed = collect(\school_year_range(5))
            ->mapWithKeys(function($year) {
                return numeric_string_key_array($year, 0);
            })
            ->merge($grades)
            ->toJson();

        return view('dashboard.home')->with('grades', $transformed);
    }
}
