<?php

return [
	'directmail' => [
		'app_key'    => env('DIRECT_MAIL_APP_KEY'),
		'app_secret' => env('DIRECT_MAIL_APP_SECRET'),
		'region'     => 'cn-beijing',
		'account'    => [
			'alias' => env('DIRECT_MAIL_ACCOUNT_ALIAS'),
			'name' => env('DIRECT_MAIL_ACCOUNT_NAME'),
		]
	],
];