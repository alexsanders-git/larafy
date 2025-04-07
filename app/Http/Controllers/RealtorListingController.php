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
        $filters = [
            'deleted' => $request->boolean( 'deleted' ),
            ...$request->only( [ 'by', 'order' ] ),
        ];

        return Inertia::render( 'realtor/Index', [
            'filters' => $filters,
            'listings' => Auth::user()
                ->listings()
                // ->mostRecent()
                ->filter( $filters )
                ->get()
        ] );
    }

    public function destroy( Listing $listing ) {
        Gate::authorize( 'delete', $listing );

        $listing->deleteOrFail();

        return Redirect::back()
            ->with( 'success', 'Listing deleted successfully' );
    }
}
