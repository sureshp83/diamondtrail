<?php

namespace App\Listeners;

use App\Events\CompanyRegister;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class SendCompanyRegisterNotification
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
     * @param  CompanyRegister  $event
     * @return void
     */
    public function handle(CompanyRegister $event)
    {
        dd($event);
    }
}
