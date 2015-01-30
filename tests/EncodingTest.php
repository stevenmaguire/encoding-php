<?php

use Stevenmaguire\EncodingDotCom\Client;
use Stevenmaguire\EncodingDotCom\Format;
use Stevenmaguire\EncodingDotCom\JsonNotification;
use Stevenmaguire\EncodingDotCom\SplitScreen;

class EncodingTest extends TestCase
{
    public function setUp()
    {
        $this->client = new Client([
            'app_id' => getenv('ENCODING_DOT_COM_APP_ID'),
            'user_key' => getenv('ENCODING_DOT_COM_API_USER_KEY'),
            'api_host' => 'manage.encoding.com'
        ]);
    }

    public function test_It_Can_Get_Status_Of_Given_Media()
    {
        $action = 'GetStatus';
        $format = new Format;
        $media_id = '34024148';
        $notification = new JsonNotification;
        $region = 'us-east-1';
        $split_screen = new SplitScreen;
        $source = 'url';
        $sources = ['url','url'];

        $split_screen->setRows(1)
            ->setColumns(1)
            ->setPaddingLeft(10)
            ->setPaddingRight(10)
            ->setPaddingBottom(10)
            ->setPaddingTop();

        $bad_prop = $notification->bad_prop;

        $result = $this->client
            ->withAction($action, false)
            ->withFormat($format)
            ->withMediaId($media_id)
            ->withMediaId($media_id)
            ->withNotification($notification)
            ->withRegion($region)
            ->withSplitScreen($split_screen)
            ->withSource($source)
            ->withSource($sources)
            ->withHttps(true)
            ->send();

        print_r($result);
    }

    public function test_It_Can_Get_System_Status()
    {
        $result = $this->client->status();

        print_r($result);
    }

    public function test_It_Can_Get_Archived_System_Status()
    {
        $result = $this->client->status(0,10);

        print_r($result);
    }
}
