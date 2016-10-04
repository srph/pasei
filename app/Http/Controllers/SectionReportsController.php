<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Section;
use App\User;

class SectionReportsController extends Controller
{
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function reports(Section $section)
    {
        return view('dashboard.sections-reports.index')
            ->with('section', $section);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function generate(Request $request, Section $section)
    {
        // We could split this into multiple queries, but #yolo.
        $subjects = $section->resources()
            ->select(
                'subjects.id as subject_id',
                'subjects.name as subject_name',
                'subjects.is_conventional as subject_is_conventional',
                'users.*',
                'user_subject.pace_grade',
                'user_subject.conventional_grade'
            )
            ->join('subjects', 'resources.subject_id', '=', 'subjects.id')
            ->leftJoin('class_user', 'resources.class_id', '=', 'class_user.class_id')
            ->join('users', 'class_user.user_id', '=', 'users.id')
            ->leftJoin('user_subject', function($query) {
                $query->on('subjects.id', '=', 'user_subject.subject_id')
                    ->on('users.id', '=', 'user_subject.user_id');;
            })
            ->get()
            ->groupBy('subject_name');

        $filename = "class_{$section->name}_{$section->school_year}_reports";

        $excel = Excel::create($filename, function($excel) use($subjects) {
            $subjects->flatMap(function($students, $name) use($excel) {
                $excel->sheet($name, function($sheet) use($students) {
                    $sheet->fromArray($students->map(function($student) {
                        $fullname = fullname($student->first_name, $student->middle_name, $student->last_name);

                        $grade = $student->subject_is_conventional
                            ? $student->conventional_grade
                            : ($student->pace_grade * 0.9) + ($student->conventional_grade * 0.1);

                        return [
                            'Student' => $fullname,
                            'Grade'   => $grade
                        ];
                    }));
                });
            });
        });

        $excel->store('xls');

        return response()->download(storage_path("exports/{$filename}.xls"));
    }
}
