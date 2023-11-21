<?php

namespace App\Http\Controllers;

use App\Jobs\SendEmailNotificationJob;
use App\Models\User;
use App\Notifications\EmailNotification;
use Illuminate\Http\Request;

class NotificationController extends Controller
{
    public function sendEmailNotification(Request $request, User $user): \Illuminate\Http\RedirectResponse
    {
        $request->validate([
            'notification_text' => 'required|string',
        ]);

        $message = $request->input('notification_text');

        SendEmailNotificationJob::dispatch($message, $user);

        return redirect()->route('profile.show', $user)->with('success', 'Notification queued for email.');
    }
}
