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
                ->filter( $filters )
                ->withCount( 'images' )
                ->withCount( 'offers' )
                ->paginate( 8 )
                ->withQueryString()
        ] );
    }

    public function show( Request $request, Listing $listing ) {
        return Inertia::render( 'realtor/Show', [
            'listing' => $listing->load( 'offers', 'offers.bidder' ),
        ] );
    }

    public function create() {
        return Inertia::render( 'realtor/Create' );
    }

    public function store( Request $request ) {
        $request->user()->listings()->create(
            $request->validate( [
                'beds' => 'required|integer|min:1|max:20',
                'baths' => 'required|integer|min:1|max:20',
                'area' => 'required|integer|min:15|max:1500',
                'city' => 'required',
                'code' => 'required',
                'street' => 'required',
                'street_num' => 'required|min:1|max:1000',
                'price' => 'required|integer|min:15|max:20000000',
            ] ),
        );

        return Redirect::route( 'realtor.listing.index' )
            ->with( 'success', 'Listing created successfully' );
    }

    public function edit( Listing $listing ) {
        Gate::authorize( 'update', $listing );

        return Inertia::render( 'realtor/Edit', [
            'listing' => $listing,
        ] );
    }

    public function update( Request $request, Listing $listing ) {
        Gate::authorize( 'update', $listing );

        $listing->update(
            $request->validate( [
                'beds' => 'required|integer|min:1|max:20',
                'baths' => 'required|integer|min:1|max:20',
                'area' => 'required|integer|min:15|max:1500',
                'city' => 'required',
                'code' => 'required',
                'street' => 'required',
                'street_num' => 'required',
                'price' => 'required|integer|min:15|max:20000000',
            ] ),
        );

        return Redirect::route( 'realtor.listing.index' )
            ->with( 'success', 'Listing updated successfully' );
    }

    public function destroy( Listing $listing ) {
        Gate::authorize( 'delete', $listing );

        $listing->deleteOrFail();

        return Redirect::back()
            ->with( 'success', 'Listing deleted successfully' );
    }

    public function restore( Listing $listing ) {
        $listing->restore();

        return Redirect::back()
            ->with( 'success', 'Listing restored successfully' );
    }
}
