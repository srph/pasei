<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\User;

class StudentParent extends Model
{
    /**
     * Assigned table name
     *
     * @var string 
     */
    public $table = 'parents';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id',
        'name',
        'email'
    ];

	/**
	 * An inverse One-To-Many relationship
	 *
	 * @return App\User
	 */
    public function child() {
    	return $this->belongsTo(User::class);
    }
}
