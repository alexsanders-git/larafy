<?php

use App\Http\Controllers\ListingController;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get( '/', function () {
    return Inertia::render( 'Index' );
} )->name( 'home' );

Route::get( '/show', function () {
    return Inertia::render( 'Show' );
} )->name( 'show' );

Route::resource( 'listing', ListingController::class );
