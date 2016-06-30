# Aliyun DirectMail for Laravel 5

使用阿里云的 DirectMail 发送邮件。

当前实现仅支持[单一发信接口](https://help.aliyun.com/document_detail/29444.html)。

## 安装

1. 使用 `composer` 安装文件

   ```bash
   composer require hyancat/aliyun-direct-mail:dev-master
   ```

1. 在 `config/services.php` 中添加如下配置:

	```
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

1. 修改 `config/mail.php` 中的 `driver` 为 `directmail`（或者 `.env` 中的 `MAIL_DRIVER`）。

1. 修改 `config/app.php`，在`providers`字段中添加：

   ```
   'providers' => [
       ...
       HyanCat\DirectMail\AliyunDirectMailServiceProvider::class,
       ...
   ],
   ```