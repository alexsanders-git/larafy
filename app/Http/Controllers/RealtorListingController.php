<?php

namespace App\Http\Controllers;

use App\Models\Listing;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;

class RealtorListingController extends Controller {
    public function index( Request $request ) {
        return Inertia::render( 'realtor/Index', [
            'listings' => Auth::user()->listings
        ] );
    }

    public function destroy( Listing $listing ) {
        Gate::authorize( 'delete', $listing );

        $listing->deleteOrFail();

        return Redirect::back()
            ->with( 'success', 'Listing deleted successfully' );
    }
}
