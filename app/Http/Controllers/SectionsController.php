<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Section;
use App\Http\Requests\StoreSectionRequest;
use App\Http\Requests\UpdateSectionRequest;

class SectionsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $query = $request->get('query');

        $sections = Section::orderBy('id', 'desc')
            ->search($query)
            ->paginate(20);

        return view('dashboard.sections.index')
            ->with('sections', $sections)
            ->with('query', $query);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('dashboard.sections.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreSectionRequest $request)
    {
        $inputs = array_merge([
            'school_year' => school_year()
        ], $request->only([
            'name',
            'year_level'
        ]));

        (new Section())->fill($inputs)->save();

        session()->flash('sections.store.success', 'The section was successfully created!');

        return redirect()->route('classes.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Section $section)
    {
        $students = $section->students()->paginate(10);

        return view('dashboard.sections.show')
            ->with('section', $section)
            ->with('students', $students);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Section $section)
    {
        return view('dashboard.sections.edit')
            ->with('section', $section);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateSectionRequest $request, Section $section)
    {
        $inputs = $request->only([
            'name',
            'year_level'
        ]);

        $section->fill($inputs)->save();

        session()->flash('sections.update.success', 'The section was successfully updated!');

        return redirect()->route('classes.show', $section->id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
