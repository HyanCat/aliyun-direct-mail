<?php
namespace HyanCat\DirectMail;

use Illuminate\Mail\TransportManager;
use Illuminate\Support\ServiceProvider;

class AliyunDirectMailServiceProvider extends ServiceProvider
{
	public function register()
	{
		$this->mergeConfigFrom(dirname(__DIR__) . '/config/services.php', 'services');
		$this->app->resolving('swift.transport', function (TransportManager $transportManager) {
			$transportManager->extend('directmail', function () {
				$appKey         = config('services.directmail.app_key');
				$appSecret      = config('services.directmail.app_secret');
				$region         = config('services.directmail.region');
				$accountName    = config('services.directmail.account.name');
				$accountAddress = config('services.directmail.account.address');

				$transport                 = new DirectMailTransport($region, $appKey, $appSecret);
				$transport->accountName    = $accountName;
				$transport->accountAddress = $accountAddress;

				return $transport;
			});
		});
	}
}