<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;

class UserAccountController extends Controller {
    public function create() {
        return Inertia::render( 'account/Create' );
    }

    public function store( Request $request ) {
        $user = User::create( $request->validate( [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
        ] ) );

        Auth::login( $user );

        return Redirect::route( 'listing.index' )
            ->with( 'success', 'Account created successfully' );
    }
}
