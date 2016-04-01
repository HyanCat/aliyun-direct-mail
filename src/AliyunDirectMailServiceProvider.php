<?php
namespace HyanCat\DirectMail;

use Illuminate\Mail\TransportManager;
use Illuminate\Support\ServiceProvider;

class AliyunDirectMailServiceProvider extends ServiceProvider
{
	protected $defer = true;

	public function register()
	{
		$this->mergeConfigFrom(dirname(__DIR__) . '/config/services.php', 'services');

		$this->app->resolving('swift.transport', function (TransportManager $transportManager) {
			$transportManager->extend('directmail', function () {
				$appKey    = config('services.directmail.app_key');
				$appSecret = config('services.directmail.app_secret');

				return new DirectMailTransport($appKey, $appSecret);
			});
		});
	}
}