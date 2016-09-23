<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests\StoreParentRequest;
use App\Http\Requests\UpdateParentRequest;
Use App\User;
Use App\StudentParent;

class ParentsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(User $user)
    {
        return view('dashboard.students-parents.index')
            ->with('user', $user);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(User $user)
    {
        return view('dashboard.students-parents.create')
            ->with('user', $user);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreParentRequest $request, User $user)
    {
        $inputs = array_merge([
            'user_id'   => $user->id
        ], $request->only([
            'name',
            'email'
        ]));

        (new StudentParent())->fill($inputs)->save();

        session()->flash('parents.store.success', 'The parent was successfully attached to a student!');

        return redirect()->route('parents.index', $user->id);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user, StudentParent $parent)
    {
        return view('dashboard.students-parents.edit')
            ->with('user', $user)
            ->with('parent', $parent);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateParentRequest $request, User $user, StudentParent $parent)
    {
        $inputs = $request->only([
            'name',
            'email'
        ]);

        $parent->fill($inputs)->save();

        session()->flash('parents.update.success', 'The parent was successfully updated!');

        return redirect()->route('parents.index', $user->id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user, StudentParent $parent)
    {
        $parent->delete();

        session()->flash('parents.destroy.success', 'The parent was successfully deleted!');
        
        return redirect()->back();
    }
}
