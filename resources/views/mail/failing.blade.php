Dear, <strong>{{ $parent->name }}</strong><br />
<br />
We regret to inform you that your child, <strong>{{ $student->full_name }}</strong>, has a failing grade of <strong>{{ $subject->is_conventional ? $grade->conventional_grade : $grade->final_grade }}</strong> in <strong>{{ $subject->name }}</strong>.<br />
<br />
Regards,<br />
Pasay High School