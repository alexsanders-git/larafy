<?php

namespace App\Http\Controllers;

use App\Models\Listing;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;

class ListingController extends Controller {
    /**
     * Display a listing of the resource.
     */
    public function index( Request $request ) {
        $filters = $request->only( [ 'priceFrom', 'priceTo', 'beds', 'baths', 'areaFrom', 'areaTo', ] );

        return Inertia::render( 'listing/Index', [
            'filters' => $filters,
            'listings' => Listing::mostRecent()
                ->filter( $filters )
                ->paginate( 9 )
                ->withQueryString()
        ] );
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create() {
        return Inertia::render( 'listing/Create' );
    }

    /**
     * Store a newly created resource in storage.
     */
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

        return Redirect::route( 'listing.index' )
            ->with( 'success', 'Listing created successfully' );
    }

    /**
     * Display the specified resource.
     */
    public function show( Listing $listing ) {
        return Inertia::render( 'listing/Show', [
            'listing' => $listing,
        ] );
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit( Listing $listing ) {
        Gate::authorize( 'update', $listing );

        return Inertia::render( 'listing/Edit', [
            'listing' => $listing,
        ] );
    }

    /**
     * Update the specified resource in storage.
     */
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

        return Redirect::route( 'listing.index' )
            ->with( 'success', 'Listing updated successfully' );
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy( Listing $listing ) {
        $listing->delete();

        return Redirect::route( 'listing.index' )
            ->with( 'success', 'Listing deleted successfully' );
    }
}
