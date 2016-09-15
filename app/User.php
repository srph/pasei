<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
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
