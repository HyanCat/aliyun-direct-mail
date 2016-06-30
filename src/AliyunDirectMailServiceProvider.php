<?php
namespace HyanCat\DirectMail;

use Illuminate\Mail\TransportManager;
use Illuminate\Support\ServiceProvider;

class AliyunDirectMailServiceProvider extends ServiceProvider {
    public function register() {
        $this->mergeConfigFrom(dirname(__DIR__) . '/config/services.php', 'services');

        $this->app->resolving('swift.transport', function (TransportManager $transportManager) {
            $transportManager->extend('directmail', function () {
                $region = config('services.directmail.region');
                $appKey = config('services.directmail.app_key');
                $appSecret = config('services.directmail.app_secret');
                $accountName = config('services.directmail.account.name');
                $accountAlias = config('services.directmail.account.alias');

                return new DirectMailTransport($region, $appKey, $appSecret, $accountName, $accountAlias);
            });
        });
    }
}