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
       $subjects = $section->resources()
            ->select(
                'users.first_name',
                'users.middle_name',
                'users.last_name',
                'user_subject.conventional_grade',
                'user_subject.pace_grade',
                'resources.subject_id',
                'resources.user_id',
                'subjects.name',
                'subjects.is_conventional'
            )
            ->leftJoin('subjects', 'resources.subject_id', '=', 'subjects.id')
            ->crossJoin('users')
            ->leftJoin('user_subject', 'resources.subject_id', '=', 'user_subject.subject_id')
            ->get()
            ->groupBy('name');

        $filename = "class_{$section->name}_reports";

        $excel = Excel::create($filename, function($excel) use($subjects) {
            $subjects->flatMap(function($grades, $key) use($excel) {
                $excel->sheet($key, function($sheet) use($grades) {
                    $sheet->fromArray($grades->map(function($grade) {
                        $fullname = fullname($grade->first_name, $grade->middle_name, $grade->last_name);

                        $grade = $grade->is_conventional
                            ? $grade->convential_grade
                            : ($grade->pace_grade * 0.9) + ($grade->conventional_grade * 0.1);

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
