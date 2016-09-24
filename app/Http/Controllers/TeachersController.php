<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Http\Requests\StoreTeacherRequest;
use App\Http\Requests\UpdateTeacherRequest;

class TeachersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $query = $request->get('query');

        $users = User::where('user_type_id', 2)
            ->orderBy('id', 'desc')
            ->search($query)
            ->paginate(10);

        return view('dashboard.teachers.index')
            ->with('users', $users)
            ->with('query', $query);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('dashboard.teachers.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreTeacherRequest $request)
    {
        $inputs = array_merge([
            'password'      => bcrypt('123'),
            'user_type_id'  => 2
        ], $request->only([
            'first_name',
            'last_name',
            'middle_name',
            'email'
        ]));

        (new User($inputs))->save();

        session()->flash('teachers.store.success', 'Teacher was successfully registered!');

        return redirect()->route('teachers.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        $resources = $user->resources()
            ->with('subject', 'section')
            ->get();

        return view('dashboard.teachers.show')
            ->with('user', $user)
            ->with('resources', $resources);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        return view('dashboard.teachers.edit')
            ->with('user', $user);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateTeacherRequest $request, User $user)
    {
        $inputs = $request->only([
            'first_name',
            'last_name',
            'middle_name',
            'email'
        ]);

        $user->fill($inputs)->save();

        session()->flash('teachers.update.success', 'Teacher was successfully registered!');

        return redirect()->route('teachers.show', $user->id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
