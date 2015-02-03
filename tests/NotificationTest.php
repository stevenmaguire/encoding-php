<?php

use Stevenmaguire\EncodingDotCom\JsonNotification;
use Stevenmaguire\EncodingDotCom\XmlNotification;

class NotificationTest extends TestCase
{
    public function test_It_Has_Format()
    {
        $json_notification = new JsonNotification;
        $xml_notification = new XmlNotification;

        $this->assertEquals('json', $json_notification->format);
        $this->assertEquals('xml', $xml_notification->format);
    }

    public function test_It_Can_Add_Error_Url()
    {
        $url = uniqid();
        $notification = new JsonNotification;

        $notification->setErrorUrl($url);

        $this->assertEquals($url, $notification->error_url);
    }

    public function test_It_Can_Add_Success_Url()
    {
        $url = uniqid();
        $notification = new JsonNotification;

        $notification->setSuccessUrl($url);

        $this->assertEquals($url, $notification->success_url);
    }

    public function test_It_Can_Add_Upload_Url()
    {
        $url = uniqid();
        $notification = new JsonNotification;

        $notification->setUploadUrl($url);

        $this->assertEquals($url, $notification->upload_url);
    }
}
