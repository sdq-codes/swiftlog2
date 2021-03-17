<?php

namespace App\Listeners;


use App\Adapter\Interfaces\SmsAdapterInterface;
use App\Events\AccountRegistered;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class AccountRegisteredListener implements ShouldQueue
{
    use InteractsWithQueue;

    /**
     * @param AccountRegistered $event
     */
    private $smsAdapter;

    public function __construct(SmsAdapterInterface $smsAdapter)
    {
        $this->smsAdapter = $smsAdapter;
    }

    public function handle(AccountRegistered $event)
    {
        $this->smsAdapter->SendOtp($event->otp, $event->user);
    }
}
