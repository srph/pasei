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
        return $this->is_conventional
            ? $this->conventional_grade < 75
            : $this->grade < 75;
    }

    /**
     * Getter for the calculated grade
     *
     * Used along with `scopeGrade` (join).
     *
     * @return string
     */
    public function getGradeAttribute() {
        $grade = $this->is_conventional
            ? $this->conventional_grade
            : ($this->pace_grade * 0.9) + ($this->conventional_grade * 0.1);

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
            ->select('subjects.*', 'user_subject.pace_grade', 'user_subject.conventional_grade')
            ->leftJoin('user_subject', 'subjects.id', '=', 'user_subject.subject_id');
    }
}
