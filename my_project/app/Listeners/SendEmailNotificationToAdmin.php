<?php

namespace App\Listeners;

use App\Events\NewPaymentEvent;
use App\Mail\NewPaymentMail;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class SendEmailNotificationToAdmin implements ShouldQueue
{
    use InteractsWithQueue;
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(NewPaymentEvent $event): void
    {
        $adminEmail = 'admin@gmail.com';

        Mail::to($adminEmail)->send(new NewPaymentMail());
        Log::info('New payment event. Admin email: ' . $adminEmail);
    }

}
