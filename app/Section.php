<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Section extends Model
{
    /**
     * Assigned table name
     *
     * @var string 
     */
    public $table = 'classes';

    /**
     * Many-to-many relationship
     *
     * @return Collection
     */
    public function students() {
    	return $this->belongsToMany(User::class, 'class_user', 'user_id', 'class_id');
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
    public function resources() {
        return $this->hasMany(Resource::class, 'class_id');
    }
}
