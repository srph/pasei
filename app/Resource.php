<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Resource extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id',
        'class_id',
        'subject_id',
    ];

	/**
	 * Belongs-to relationship
	 *
	 * @return App\User
	 */
    public function teacher() {
    	return $this->belongsTo(User::class, 'user_id');
    }

	/**
	 * Belongs-to relationship
	 *
	 * @return App\Section
	 */
    public function section() {
    	return $this->belongsTo(Section::class, 'class_id');
    }

	/**
	 * Belongs-to relationship
	 *
	 * @return App\Subject
	 */
    public function subject() {
    	return $this->belongsTo(Subject::class, 'subject_id');
    }
}
