<?php
namespace HyanCat\DirectMail;

include_once __DIR__ . "/../lib/aliyun-php-sdk-core/Config.php";

use Dm\Request\V20151123 as DM;
use Illuminate\Mail\Transport\Transport;

class DirectMailTransport extends Transport
{
	private $appKey;
	private $appSecret;

	protected $acsClient;

	public function __construct($appKey, $appSecret)
	{
		$this->appKey    = $appKey;
		$this->appSecret = $appSecret;
		$iClientProfile  = \DefaultProfile::getProfile("cn-beijing", $this->appKey, $this->appSecret);
		$this->acsClient = new \DefaultAcsClient($iClientProfile);
	}

	public function send(\Swift_Mime_Message $message, &$failedRecipients = null)
	{
		return $this->sendSingle($message);
	}

	private function sendSingle(\Swift_Mime_Message $message)
	{
		$request = new DM\SingleSendMailRequest();
		$request->setAccountName($this->getFirstAddress($message->getFrom()));
		$request->setAddressType(1);
		$request->setReplyToAddress('true');
		$request->setToAddress($this->getFirstAddress($message->getTo()));
		$request->setSubject($message->getSubject());
		$request->setHtmlBody($message->getBody());
		$this->acsClient->getAcsResponse($request);

		return 1;
	}

	private function sendBatch(\Swift_Mime_Message $message)
	{
		// todo.
	}

	private function getFirstAddress($data)
	{
		if (is_string($data)) {
			return $data;
		}
		if (is_array($data) && ! empty($data)) {
			return array_keys($data)[0];
		}

		return '';
	}
}