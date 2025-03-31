<?php

namespace App\Http\Controllers;

use App\Models\Listing;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;

class ListingController extends Controller {
    /**
     * Display a listing of the resource.
     */
    public function index() {
        return Inertia::render( 'listing/Index', [
            'listings' => Listing::all(),
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
        Listing::create( $request->all() );

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
    public function edit( string $id ) {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update( Request $request, string $id ) {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy( string $id ) {
        //
    }
}
