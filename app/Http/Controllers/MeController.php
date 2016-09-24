<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests\UpdateAuthRequest;
use App\User;
use Illuminate\Support\Facades\Auth;

class MeController extends Controller
{
    public function settings() {
    	$user = Auth::user();

    	if ( $user->type_id === 1 ) {
    		return view('teachers.me')->with('user', $user);
    	}

		return view('teachers.me')->with('user', $user);
    }

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
