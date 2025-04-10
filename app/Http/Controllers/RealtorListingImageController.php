<?php

namespace App\Http\Controllers;

use App\Models\Listing;
use App\Models\ListingImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;
use Inertia\Inertia;

class RealtorListingImageController extends Controller {
    public function create( Listing $listing ) {
        $listing->load( 'images' );

        return Inertia::render( 'realtor/ListingImage/Create', [
            'listing' => $listing,
        ] );
    }

    public function store( Listing $listing, Request $request ) {
        if ( $request->hasFile( 'images' ) ) {
            $request->validate( [
                'images.*' => 'mimes:jpeg,jpg,png,webp|max:5000'
            ], [
                'images.*.mimes' => 'Only jpeg, jpg, png, webp images are allowed.',
            ] );

            foreach ( $request->file( 'images' ) as $file ) {
                $path = $file->store( 'images', 'public' );

                $listing->images()->save( new ListingImage( [
                    'filename' => $path,
                ] ) );
            }
        }

        return Redirect::back()
            ->with( 'success', 'Images uploaded successfully' );
    }

    public function destroy( Listing $listing, ListingImage $image ) {
        Storage::disk( 'public' )->delete( $image->filename );

        $image->delete();

        return Redirect::back()
            ->with( 'success', 'Image deleted successfully' );
    }
}
