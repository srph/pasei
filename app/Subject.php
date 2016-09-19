<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Resource;

class Subject extends Model
{
	/**
	 * Has-many relationship
	 *
	 * @return Collection<App\Resource>
	 */
    public function resources() {
    	return $this->hasMany(Resource::class);
    }
}
