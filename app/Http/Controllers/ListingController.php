<?php

namespace App\Http\Controllers;

use App\Models\Listing;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;

class ListingController extends Controller {
    /** Display a listing of the resource. */
    public function index( Request $request ) {
        $filters = $request->only( [ 'priceFrom', 'priceTo', 'beds', 'baths', 'areaFrom', 'areaTo', ] );

        return Inertia::render( 'listing/Index', [
            'filters' => $filters,
            'listings' => Listing::mostRecent()
                ->filter( $filters )
                ->withoutSold()
                ->paginate( 9 )
                ->withQueryString()
        ] );
    }

    /** Display the specified resource. */
    public function show( Listing $listing ) {
        $listing->load( 'images' );
        $offer = !Auth::user() ? null : $listing->offers()->byMe()->first();

        return Inertia::render( 'listing/Show', [
            'listing' => $listing,
            'offerMade' => $offer
        ] );
    }
}
