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
     * @param boolean $conv Flag if the subject has
     * @return string
     */
    public function getFinalGradeAttribute() {
        $grade = ($this->pace_grade * 0.9) + ($this->conv_grade * 0.1);
        return number_format($grade, 2);
    }
}
