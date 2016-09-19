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
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'year_level',
        'school_year',
    ];

    /**
     * Many-to-many relationship
     *
     * @return Collection
     */
    public function getYearLevelFormattedAttribute() {
        return ordinal($this->year_level) . ' Year';
    }

    /**
     * Many-to-many relationship
     *
     * @return Collection
     */
    public function students() {
    	return $this->belongsToMany(User::class, 'class_user', 'class_id', 'user_id');
    }

    /**
     * Many-to-many relationship
     *
     * @return Collection
     */
    public function subjects() {
    	return $this->hasManyThrough(Subject::class, Resource::class, 'class_id', 'id');
    }

    /**
     * Many-to-many relationship
     *
     * @return Collection
     */
    public function resources() {
        return $this->hasMany(Resource::class, 'class_id', 'id');
    }
}
