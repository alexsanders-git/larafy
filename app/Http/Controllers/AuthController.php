<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;
use Inertia\Inertia;

class AuthController extends Controller {
    public function create() {
        return Inertia::render( 'auth/Login' );
    }

    public function store( Request $request ) {
        if ( !Auth::attempt( $request->validate( [
            'email' => 'required|string|email|max:255',
            'password' => 'required|string|min:6',
        ] ), true ) ) {
            throw ValidationException::withMessages( [
                'email' => 'Authentication failed.',
            ] );
        }

        $request->session()->regenerate();

        return redirect()->intended( route( 'listing.index' ) );
    }

    public function destroy( Request $request ) {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route( 'listing.index' );
    }
}
