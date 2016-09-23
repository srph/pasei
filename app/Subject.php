<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Resource;

class Subject extends Model
{
	/**
	 * Has-many relationship
	 *
	 * @return Collection<App\Resource>
	 */
    public function resources() {
    	return $this->hasMany(Resource::class);
    }

    /**
     * Getter for the calculated grade
     *
     * Used along with `scopeGrade` (join).
     *
     * @return string
     */
    public function getIsFailingAttribute() {
        return $this->has_conv
            ? $this->grade < 75
            : $this->pace_grade < 75;
    }

    /**
     * Getter for the calculated grade
     *
     * Used along with `scopeGrade` (join).
     *
     * @return string
     */
    public function getGradeAttribute() {
        $grade = $this->has_conv
            ? ($this->pace_grade * 0.9) + ($this->conv_grade * 0.1)
            : $this->pace_grade;

        return number_format($grade, 2);
    }

    /**
     * Scope a queryo to get respective grade of the student
     * to this subject.
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeGrade($query) {
        $query
            ->select('subjects.*', 'user_subject.pace_grade', 'user_subject.conv_grade')
            ->leftJoin('user_subject', 'subjects.id', '=', 'user_subject.subject_id');
    }
}
