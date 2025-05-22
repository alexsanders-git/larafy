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
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\Request;
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

// Email verification
Route::get( '/email/verify', function () {
    return inertia( 'auth/VerifyEmail' );
} )
    ->middleware( 'auth' )
    ->name( 'verification.notice' );

Route::get( '/email/verify/{id}/{hash}', function ( EmailVerificationRequest $request ) {
    $request->fulfill();

    return redirect()
        ->route( 'listing.index' )
        ->with( 'success', 'Email was verified!' );
} )
    ->middleware( [ 'auth', 'signed' ] )
    ->name( 'verification.verify' );

Route::post( '/email/verification-notification', function ( Request $request ) {
    $request->user()->sendEmailVerificationNotification();

    return back()
        ->with( 'success', 'Verification link sent!' );
} )
    ->middleware( [ 'auth', 'throttle:6,1' ] )
    ->name( 'verification.send' );

// Account
Route::resource( 'account', UserAccountController::class )
    ->only( [ 'create', 'store' ] );

// Realtor
Route::prefix( 'realtor' )
    ->name( 'realtor.' )
    ->middleware( [ 'auth', 'verified' ] )
    ->group( function () {
        Route::name( 'listing.restore' )->put( 'listing/{listing}/restore', [ RealtorListingController::class, 'restore' ] )
            ->withTrashed();
        Route::resource( 'listing', RealtorListingController::class )
            ->withTrashed();

        Route::name( 'offer.accept' )->put( 'offer/{offer}/accept', RealtorListingAcceptOfferController::class );

        Route::resource( 'listing.image', RealtorListingImageController::class )
            ->only( [ 'create', 'store', 'destroy' ] );
    } );
