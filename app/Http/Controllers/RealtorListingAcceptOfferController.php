<?php

namespace App\Http\Controllers;

use App\Models\Offer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class RealtorListingAcceptOfferController extends Controller {
    public function __invoke( Offer $offer ) {
        // Accept selected offer
        $offer->update( [ 'accepted_at' => now() ] );

        $offer->listing->sold_at = now();
        $offer->listing->save();

        // Reject all other offers
        $offer->listing->offers()->except( $offer )
            ->update( [ 'rejected_at' => now() ] );

        return Redirect::back()
            ->with( 'success', "Offer #{$offer->id} accepted successfully! Other offers rejected" );
    }
}
