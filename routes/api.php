<?php

use Illuminate\Http\Request;
use App\Section;
use App\Subject;
use App\User;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:api');

Route::get('/test', function() {
	// return response()->json(Section::with('resources.subject', 'resources.teacher')->get());
	// return response()->json(
	// 	User::find(1)->classes
	// );
	return response()->json(
		User::with(['sections.students' => function($query) {
				$query->where('user_type_id', '=', 1);
			}])
			->where('user_type_id', '=', 2)
			->get()
	);
});
