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

Route::get('/', 'HomeController@index');
Route::resource('students', 'StudentsController');
Route::resource('teachers', 'TeachersController');
Route::resource('subjects', 'SubjectsController');
Route::resource('classes', 'SectionsController');

Route::get('classes/{class}/subjects', 'SectionSubjectsController@index')->name('classes.subjects.index');
Route::get('classes/{class}/subjects/attach', 'SectionSubjectsController@attach')->name('classes.subjects.attach');
Route::post('classes/{class}/subjects/attach', 'SectionSubjectsController@store')->name('classes.subjects.store');
Route::delete('classes/{class}/subjects', 'SectionSubjectsController@detach')->name('classes.subjects.detach');

Route::get('classes/{class}/students/attach', 'SectionStudentsController@attach')->name('classes.students.attach');
Route::post('classes/{class}/students/attach', 'SectionStudentsController@store')->name('classes.students.store');
Route::delete('classes/{class}/students', 'SectionStudentsController@detach')->name('classes.students.detach');