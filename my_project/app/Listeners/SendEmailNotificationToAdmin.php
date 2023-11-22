<?php

namespace App\Listeners;

use App\Mail\NewPaymentMail;
use App\Models\Payment;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class SendEmailNotificationToAdmin implements ShouldQueue
{
    use InteractsWithQueue;

    private $adminEmail;

    /**
     * Create the event listener.
     */
    public function __construct()
    {
        $this->adminEmail = config('app.admin_email');
    }

    /**
     * Handle the event.
     */
    public function handle(Payment $payment): void
    {
        Mail::to($this->adminEmail)->send(new NewPaymentMail());
        Log::channel('paymentLog')->info("New payment event. Admin email: {$this->adminEmail} Payment id: {$payment->id}");
    }

}
