<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ListingController;
use App\Http\Controllers\UserAccountController;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get( '/', function () {
    return Inertia::render( 'Index' );
} )->name( 'home' );


// Listing
Route::resource( 'listing', ListingController::class )
    ->only( [ 'create', 'store', 'edit', 'update', 'destroy' ] )
    ->middleware( 'auth' );

Route::resource( 'listing', ListingController::class )
    ->except( [ 'create', 'store', 'edit', 'update', 'destroy' ] );


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
