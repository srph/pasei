<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Grade extends Model
{
    /**
     * Assigned table name
     *
     * @var string 
     */
    public $table = 'user_subject';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id',
        'subject_id',
        'pace_grade',
        'conventional_grade',
    ];

    /**
     * Getter for the calculated grade
     * 
     * When using this, it's assumed that the subject
     * is a non-conventional subject. Otherwise, simply use
     * $this->conventional_grade.
     *
     * @return string
     */
    public function getFinalGradeAttribute() {
        $grade = ($this->pace_grade * 0.9) + ($this->conventional_grade * 0.1);
        return number_format($grade, 2);
    }

    /**
     * A flag to check if the grade is failing
     *
     * @return string
     */
    public function isFailing($conv) {
        return $conv
            ? $this->conventional_grade < 75
            : $this->final_grade < 75;
    }
}
