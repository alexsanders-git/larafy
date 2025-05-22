<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ListingController;
use App\Http\Controllers\ListingOfferController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\NotificationSeenController;
use App\Http\Controllers\UserAccountController;
use App\Http\Controllers\RealtorListingController;
use App\Http\Controllers\RealtorListingImageController;
use App\Http\Controllers\RealtorListingAcceptOfferController;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get( '/', function () {
    return Inertia::render( 'Index' );
} )->name( 'home' );


// Listing
Route::resource( 'listing', ListingController::class )
    ->only( [ 'index', 'show' ] )
    ->withTrashed();

// Offer
Route::resource( 'listing.offer', ListingOfferController::class )
    ->middleware( 'auth' )
    ->only( 'store' );

// Notification
Route::resource( 'notification', NotificationController::class )
    ->middleware( 'auth' )
    ->only( 'index' );

Route::put( 'notification/{notification}/seen', NotificationSeenController::class )
    ->middleware( 'auth' )
    ->name( 'notification.seen' );

// Auth
Route::get( 'login', [ AuthController::class, 'create' ] )
    ->name( 'login' );

Route::post( 'login', [ AuthController::class, 'store' ] )
    ->name( 'login.store' );

Route::delete( 'logout', [ AuthController::class, 'destroy' ] )
    ->name( 'logout' );

// Account
Route::resource( 'account', UserAccountController::class )
    ->only( [ 'create', 'store' ] );

// Realtor
Route::prefix( 'realtor' )
    ->name( 'realtor.' )
    ->middleware( 'auth' )
    ->group( function () {
        Route::name( 'listing.restore' )->put( 'listing/{listing}/restore', [ RealtorListingController::class, 'restore' ] )
            ->withTrashed();
        Route::resource( 'listing', RealtorListingController::class )
            ->withTrashed();

        Route::name( 'offer.accept' )->put( 'offer/{offer}/accept', RealtorListingAcceptOfferController::class );

        Route::resource( 'listing.image', RealtorListingImageController::class )
            ->only( [ 'create', 'store', 'destroy' ] );
    } );
