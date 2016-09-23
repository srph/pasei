<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Section;
use App\User;
use App\Http\Requests\AttachStudentSectionRequest;

class SectionStudentsController extends Controller
{
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function attach(Section $section)
    {
        // \DB::enableQueryLog();

        $users = User::orderBy('id', 'desc')
            ->where('user_type_id', 1)
            ->whereDoesntHave('sections', function($query) use($section) {
                $query->where('class_user.class_id', '=', $section->id);
            })
            ->get();

        // dd(\DB::getQueryLog());

        return view('dashboard.sections-students.attach')
            ->with('section', $section)
            ->with('users', $users);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(AttachStudentSectionRequest $request, Section $section)
    {
        $section->students()->attach($request->get('user_id'));

        session()->flash('sections.students.attach.success', 'The student was successfully added to the class');

        return redirect()->route('classes.show', $section->id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function detach(Section $section, User $student)
    {
        $section->students()->detach($student->id);
        session()->flash('sections.students.detach.success', 'The student was successfully removed from the class');
        return redirect()->back();
    }
}
