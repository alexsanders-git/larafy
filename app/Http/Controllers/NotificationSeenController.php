<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\Request;
use Illuminate\Notifications\DatabaseNotification;
use Illuminate\Support\Facades\Redirect;

class NotificationSeenController extends Controller {
    use AuthorizesRequests;

    public function __invoke( DatabaseNotification $notification ) {
        $this->authorize( 'update', $notification );

        $notification->markAsRead();

        return Redirect::back()
            ->with( 'success', 'Notification marked as read' );
    }
}
