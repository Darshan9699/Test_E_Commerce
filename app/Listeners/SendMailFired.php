<?php

namespace App\Listeners;

use App\Events\OrderConfirmation;
use App\Mail\OrderPlaced;
use App\Models\Order;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail;

class SendMailFired
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  OrderConfirmation  $event
     * @return void
     */
    public function handle(OrderConfirmation $event)
    {

        Mail::send(new OrderPlaced($event->order));
    }
}
