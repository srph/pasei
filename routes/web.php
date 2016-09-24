<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/

Auth::routes();

Route::get('logout', [
	'as' => 'logout',
	'uses' => 'Auth\LoginController@logout'
]);

Route::group(['middleware' => 'auth'], function() {
	Route::get('/', 'HomeController@index');
	Route::resource('students', 'StudentsController');
	Route::resource('students/{student}/parents', 'ParentsController');
	Route::resource('teachers', 'TeachersController');
	Route::resource('subjects', 'SubjectsController');
	Route::resource('classes', 'SectionsController');

	Route::get('classes/{class}/subjects', 'SectionSubjectsController@index')->name('classes.subjects.index');
	Route::get('classes/{class}/subjects/attach', 'SectionSubjectsController@attach')->name('classes.subjects.attach');
	Route::post('classes/{class}/subjects/attach', 'SectionSubjectsController@store')->name('classes.subjects.store');
	Route::delete('classes/{class}/subjects/{subject}', 'SectionSubjectsController@detach')->name('classes.subjects.detach');

	Route::get('classes/{class}/students/attach', 'SectionStudentsController@attach')->name('classes.students.attach');
	Route::post('classes/{class}/students/attach', 'SectionStudentsController@store')->name('classes.students.store');
	Route::delete('classes/{class}/students/{student}', 'SectionStudentsController@detach')->name('classes.students.detach');

	Route::get('subjects/{subject}/grades/{student}', 'GradesController@edit')->name('grades.edit');
	Route::put('subjects/{subject}/grades/{student}', 'GradesController@grade')->name('grades.update');

	Route::get('me', 'MeController@settings')->name('me.settings');
	Route::put('me', 'MeController@update')->name('me.update');
});