<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests\UpdateAuthRequest;
use App\User;
use Illuminate\Support\Facades\Auth;

class MeController extends Controller
{
	/**
	 * Show the form to change user's account
	 *
	 * @return \Illuminate\Http\Response
	 */
    public function settings() {
    	$user = Auth::user();

    	if ( $user->type_id === 1 ) {
    		return view('teachers.me')->with('user', $user);
    	}

        if ( $user->type_id === 2 ) {
		  return view('teachers.me')->with('user', $user);
        }

        return view('teachers.me')->with('user', $user);
    }

	/**
	 * Show the form to change user's account
	 *
	 * @param App\Http\Requests\UpdateAuthRequest $request
	 * @return \Illuminate\Http\Response
	 */
    public function update(UpdateAuthRequest $request) {
    	$user = Auth::user();
    	$user->email = $request->get('email');

    	if ( $request->has('email') ) {
    		$user->password = bcrypt($request->password);
    	}

    	$user->save();

    	return redirect()->back();
    }
}
