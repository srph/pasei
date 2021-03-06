<?php

namespace App\Http\Controllers;

use App\Subject;
use App\Resource;
use App\User;
use App\Grade;
use App\Http\Requests\UpdateGradeRequest;
use Mail;
use App\Mail\FailingGrade;

class GradesController extends Controller
{
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Subject $subject, User $student)
    {
        // @REFACTOR: Optimize
        $resource = Resource::where('subject_id', $subject->id)->firstOrFail();

        $grade = Grade::where('subject_id', $subject->id)
            ->where('user_id', $student->id)
            ->firstOrNew([]);

        return view('teachers.grade')
            ->with('resource', $resource)
            // So we'll just no longer need to lazy-load the subject
            ->with('subject', $subject)
            ->with('grade', $grade)
            ->with('student', $student);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function grade(UpdateGradeRequest $request, Subject $subject, User $student)
    {
        $inputs = array_merge([
            'user_id' => $student->id,
            'subject_id' => $subject->id
        ], $request->only(!$subject->is_conventional ? [
            'pace_grade',
            'conventional_grade'
        ] : ['conventional_grade']));

        $grade = Grade::where('subject_id', $subject->id)
            ->where('user_id', $student->id)
            ->firstOrNew([])
            ->fill($inputs);

        $grade->save();

        $final = $subject->is_conventional
            ? $grade->conventional_grade
            : $grade->final_grade;

        if ( $final < 75 ) {
            $student->parents->map(function($parent) use($student, $grade, $subject) {
                Mail::to($parent->email)->send(new FailingGrade($student, $grade, $subject, $parent));
            });
        }

        return redirect()->to('/');
    }
}
