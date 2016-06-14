<?php

return [
	'directmail' => [
		'app_key'    => env('DIRECT_MAIL_APP_KEY'),
		'app_secret' => env('DIRECT_MAIL_APP_SECRET'),
		'region'     => 'cn-beijing',
		'account'    => [
			'name'    => env('DIRECT_MAIL_ACCOUNT_NAME'),
			'address' => env('DIRECT_MAIL_ACCOUNT_ADDRESS'),
		]
	],
];