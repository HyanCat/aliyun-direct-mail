# Aliyun DirectMail for Laravel 5/6/7

使用阿里云的 DirectMail 发送邮件。

当前实现仅支持[单一发信接口](https://help.aliyun.com/document_detail/29444.html)。

## 安装

1. 使用 `composer` 安装文件

   ```bash
   composer require hyancat/aliyun-direct-mail:dev-master
   ```

2. 在 `config/services.php` 中添加如下配置:

	```php
    ...
	'directmail' => [
		'app_key'    => env('DIRECT_MAIL_APP_KEY'),
		'app_secret' => env('DIRECT_MAIL_APP_SECRET'),
		'region'     => 'cn-beijing',
		'account'    => [
			'alias' => env('DIRECT_MAIL_ACCOUNT_ALIAS'),
			'name' => env('DIRECT_MAIL_ACCOUNT_NAME'),
		]
	],
	...
	```

   具体配置含义请参考[官方文档](https://help.aliyun.com/document_detail/29444.html)。

   请根据需要在`.env`中创建环境配置。

3. 修改 `default` 为 `directmail`（或者`.env` 中的 `MAIL_MAILER`）。

    > 如果是 Laravel 5.x/6.x，应该是修改 `config/mail.php` 中的 `driver` 为 `directmail`（或者 `.env` 中的 `MAIL_DRIVER`）。

