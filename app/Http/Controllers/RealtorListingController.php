<?php

namespace App\Http\Controllers;

use App\Models\Listing;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class RealtorListingController extends Controller {
    public function index( Request $request ) {
        return Inertia::render( 'realtor/Index', [
            'listings' => Auth::user()->listings
        ] );
    }
}
