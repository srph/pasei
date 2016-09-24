<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\StoreStudentRequest;
use App\Http\Requests\UpdateStudentRequest;
use App\User;

class StudentsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $query = $request->get('query');
        
        $users = User::where('user_type_id', 1)
            ->orderBy('id', 'desc')
            ->search($query)
            ->paginate(20);

        return view('dashboard.students.index')
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
        return view('dashboard.students.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreStudentRequest $request)
    {
        $inputs = array_merge([
            'password'      => bcrypt('123'),
            'user_type_id'  => 1
        ], $request->only([
            'first_name',
            'last_name',
            'middle_name',
            'email'
        ]));

        (new User($inputs))->save();

        session()->flash('students.store.success', 'Student was successfully enrolled!');

        return redirect()->route('students.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        return view('dashboard.students.show')
            ->with('user', $user);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        return view('dashboard.students.edit')
            ->with('user', $user);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateStudentRequest $request, User $user)
    {
        $inputs = $request->only([
            'first_name',
            'last_name',
            'middle_name',
            'email'
        ]);

        $user->fill($inputs)->save();

        session()->flash('students.update.success', 'Teacher was successfully registered!');

        return redirect()->route('students.show', $user->id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        //
    }
}
