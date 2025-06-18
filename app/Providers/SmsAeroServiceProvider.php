<?php


namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use SmsAero\SmsAeroMessage;

class SmsAeroServiceProvider extends ServiceProvider
{
    public function register(): void
    {

    }

    public function boot(): void
    {
        $this->app->singleton(SmsAeroMessage::class, static function ($app) {

            $apiKey = config('mail.sms_aero.email');
            $apiSecret = config('mail.sms_aero.api');

            return new SmsAeroMessage($apiKey, $apiSecret);
        });
    }
}
