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
        'conv_grade',
    ];

    /**
     * Getter for the calculated grade
     * 
     * @return string
     */
    public function getFinalGradeAttribute() {
        $grade = ($this->pace_grade * 0.9) + ($this->conv_grade * 0.1);
        return number_format($grade, 2);
    }

    /**
     * A flag to check if the grade is failing
     *
     * @return string
     */
    public function isFailing($conv) {
        return $conv
            ? $this->final_grade < 75
            : $this->grade < 75;
    }
}
