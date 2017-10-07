<?php

namespace HyanCat\DirectMail;

use Dm\Request\V20151123 as DM;
use Illuminate\Mail\Transport\Transport;

require_once __DIR__ . "/../lib/aliyun-php-sdk-core/Config.php";

/**
 * @link API Reference: https://help.aliyun.com/document_detail/29444.html
 * @link PHPSDK: https://help.aliyun.com/document_detail/29460.html
 */
class DirectMailTransport extends Transport
{
    protected $region;
    protected $appKey;
    protected $appSecret;
    protected $accountName;
    protected $accountAlias;

    public function __construct($region, $appKey, $appSecret, $accountName, $accountAlias)
    {
        $this->region       = $region;
        $this->appKey       = $appKey;
        $this->appSecret    = $appSecret;
        $this->accountName  = $accountName;
        $this->accountAlias = $accountAlias;
    }

    protected function createClient()
    {
        $iClientProfile = \DefaultProfile::getProfile($this->region, $this->appKey, $this->appSecret);

        return new \DefaultAcsClient($iClientProfile);
    }

    /**
     * @param \Swift_Mime_SimpleMessage $message
     * @param null                      $failedRecipients
     * @return int
     */
    public function send(\Swift_Mime_SimpleMessage $message, &$failedRecipients = null)
    {
        $this->beforeSendPerformed($message);

        return $this->sendSingle($message);
    }

    protected function sendSingle(\Swift_Mime_SimpleMessage $message)
    {
        $request = new DM\SingleSendMailRequest();

        $request->setAccountName($this->accountName);    //控制台创建的发信地址
        $request->setFromAlias($this->accountAlias);
        $request->setAddressType(1);
        $request->setReplyToAddress('true');

        $request->setToAddress($this->getToAddress($message));
        $request->setSubject($message->getSubject());
        $request->setHtmlBody($message->getBody());
        // dd($message->getBody());

        $this->createClient()->getAcsResponse($request);

        return 1;
    }

    // 多个地址使用逗号分隔
    protected function getToAddress(\Swift_Mime_SimpleMessage $message)
    {
        return join(',', array_keys($message->getTo()));
    }
}
