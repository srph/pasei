<?php

namespace App\Http\Controllers;

use App\Section;
use App\Subject;
use App\Resource;
use App\User;
use App\Http\Requests\AttachSubjectSectionRequest;

class SectionSubjectsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Section $section)
    {
        $resources = $section->resources()
            ->with('subject', 'teacher')
            ->get();

        return view('dashboard.sections-subjects.index')
            ->with('section', $section)
            ->with('resources', $resources);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function attach(Section $section)
    {
        $callback = function($query) use($section) {
            $query->where('resources.class_id', '=', $section->id);
        };

        $subjects = Subject::orderBy('name', 'asc')
            ->whereDoesntHave('resources', $callback)
            ->get();

        $teachers = User::orderBy('last_name', 'asc')
            ->orderBy('middle_name', 'asc')
            ->orderBy('first_name', 'asc')
            ->where('user_type_id', 2)
            ->whereDoesntHave('resources', $callback)
            ->get();

        return view('dashboard.sections-subjects.attach')
            ->with('section', $section)
            ->with('subjects', $subjects)
            ->with('teachers', $teachers);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(AttachSubjectSectionRequest $request, Section $section)
    {
        $inputs = array_merge([
            'class_id' => $section->id
        ], $request->only([
            'user_id',
            'subject_id'
        ]));

        (new Resource())->fill($inputs)->save();

        session()->flash('sections.subjects.attach.success', 'The subject was successfully added to the class');

        return redirect()->route('classes.subjects.index', $section->id);
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function detach($id)
    {
        //
    }
}
