<?php

namespace App\Http\Controllers;

use Auth;
use App\Section;
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
                ->with('resources.subject', 'resources.teacher')
                ->first();

			return view('students.home')->with('section', $section);
    	}

    	if ( $user->user_type_id === 2 ) {
			return view('teachers.home');
    	}

        return view('dashboard.home');
    }
}
