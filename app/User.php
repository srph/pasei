<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\SoftDeletes;

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
    public function getMiddleInitials() {
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
     * @return Collection
     */
    public function sections() {
        // 1: Student, 2: Teacher
        return $this->user_type_id === 1
            ? $this->belongsToMany(Section::class, 'class_user', 'class_id', 'user_id')
            : $this->hasManyThrough(Section::class, Resource::class, 'class_id');
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
}
