<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Resource;
use App\Subject;
use App\Section;
use App\StudentParent;

class User extends Authenticatable
{
    use Notifiable, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'email',
        'password',
        'first_name',
        'last_name',
        'middle_name',
        'user_type_id',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['deleted_at'];

    /**
     * MI getter
     *
     * @return string
     */
    public function getMiddleInitialsAttribute() {
        return substr($this->middle_name, 0 , 1);
    }

    /**
     * Full name getter
     *
     * @return string
     */
    public function getFullNameAttribute() {
        return "{$this->first_name} {$this->middle_initials}. {$this->last_name}";
    }

    /**
     * Getter for the calculated grade
     *
     * @return string
     */
    public function getGradeAttribute() {
        $grade = null == $this->pace_grade
            ? $this->conventional_grade
            : ($this->pace_grade * 0.9) + ($this->conventional_grade * 0.1);

        return number_format($grade, 2);
    }

    /**
     * A flag to check if the grade is failing
     *
     * @return string
     */
    public function getIsFailingAttribute() {
        return $this->grade < 75;
    }

    /**
     * Get student's last section
     *
     * @return App\Section
     */
    public function getLastSectionAttribute() {
        return $this->sections()
            ->orderBy('id', 'desc')
            ->first();
    }

    /**
     * A flag to check if the teacher is assigned to any class
     *
     * @return boolean
     */
    public function getIsAssignedAttribute() {
        return $this->resources()
            ->whereHas('section', function($query) {
                $query->where('school_year', school_year());
            })
            ->first() != null;
    }

    /**
     * Get student's last section
     *
     * @return App\Section
     */
    public function getCurrentSectionAttribute() {
        return $this->sections()
            ->orderBy('id', 'desc')
            ->where('school_year', school_year())
            ->first();
    }

    /**
     * Belongs-to relationship
     *
     * @return Collection
     */
    public function type() {
        return $this->belongsTo(UserType::class, 'user_type_id');
    }

    /**
     * Many-to-many relationship
     *
     * @return Collection<App\Section>
     */
    public function sections() {
        return $this->belongsToMany(Section::class, 'class_user', 'user_id', 'class_id');
    }

    /**
     * Has-many relationship
     *
     * @return Collection<App\Resource>
     */ 
    public function resources() {
        return $this->hasMany(Resource::class);
    }

    /**
     * Many-to-many relationship
     *
     * @return Collection
     */
    public function grades() {
        return $this->belongsToMany(Subject::class, 'user_subject');
    }

    /**
     * Many-to-many relationship
     *
     * @return Collection
     */
    public function subjects() {
        return $this->hasManyThrough(Subject::class, Resource::class);
    }

    /**
     * Many-to-many relationship
     *
     * @return Collection
     */
    public function parents() {
        return $this->hasMany(StudentParent::class);
    }

    /**
     * Scope a queryo to get respective grade of a subject
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeGrade($query) {
        return $query
            ->select('users.*', 'user_subject.pace_grade', 'user_subject.conventional_grade')
            ->leftJoin('user_subject', 'users.id', '=', 'user_subject.user_id');
    }

    /**
     * Scope a query to search for a particular user conditionally
     *
     * @return \Illuminate\Database\Eloquent\Builder 
     */
    public function scopeSearch($query, $search) {
        return $search
            ? $query->where('first_name', 'like', "%{$search}%")
                ->orWhere('middle_name', 'like', "%{$search}%")
                ->orWhere('last_name', 'like', "%{$search}%")
            : $query;
    }
}
