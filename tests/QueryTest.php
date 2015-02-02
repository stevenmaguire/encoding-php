<?php

use Stevenmaguire\EncodingDotCom\Format;
use Stevenmaguire\EncodingDotCom\JsonNotification;
use Stevenmaguire\EncodingDotCom\Query;
use Stevenmaguire\EncodingDotCom\SplitScreen;

class QueryTest extends TestCase
{
    public function setUp()
    {
        parent::setUp();
        $this->query = new Query;
    }

    private function getPayload()
    {
        $payload = $this->query->getPayload();
        return json_decode($payload);
    }

    public function test_It_Can_Set_User_Id()
    {
        $user_id = uniqid();

        $this->query->setUserId($user_id);

        $payload = $this->getPayload();
        $this->assertEquals($user_id, $payload->query->userid);
    }

    public function test_It_Can_Set_User_Key()
    {
        $user_key = uniqid();

        $this->query->setUserKey($user_key);

        $payload = $this->getPayload();
        $this->assertEquals($user_key, $payload->query->userkey);
    }

    public function test_It_Can_Set_Action()
    {
        $action = uniqid();

        $this->query->setAction($action);

        $payload = $this->getPayload();
        $this->assertEquals($action, $payload->query->action);
    }

    public function test_It_Can_Add_Single_Media_Id()
    {
        $media_id = uniqid();

        $this->query->addMediaId($media_id);

        $payload = $this->getPayload();
        $this->assertEquals($media_id, $payload->query->mediaid);
    }

    public function test_It_Can_Add_Multiple_Media_Ids()
    {
        $count = rand(2,5);
        $media_ids = [];
        for ($i = 0; $i < $count; $i++) {
            $media_ids[] = uniqid();
        }

        foreach ($media_ids as $media_id) {
            $this->query->addMediaId($media_id);
        }

        $payload = $this->getPayload();
        $this->assertEquals(implode(',', $media_ids), $payload->query->mediaid);
    }

    public function test_It_Can_Add_Single_Source()
    {
        $source = uniqid();

        $this->query->addSource($source);

        $payload = $this->getPayload();
        $this->assertTrue(in_array($source, $payload->query->source));
    }

    public function test_It_Can_Add_Multiple_Sources()
    {
        $count = rand(2,5);
        $sources = [];
        for ($i = 0; $i < $count; $i++) {
            $sources[] = uniqid();
        }

        foreach ($sources as $source) {
            $this->query->addSource($source);
        }

        $payload = $this->getPayload();
        $this->assertEquals($sources, $payload->query->source);
    }

    public function test_It_Can_Add_SplitScreen_Configuration()
    {
        $split_screen = new SplitScreen;

        $this->query->setSplitScreen($split_screen);

        $this->assertEquals($split_screen, $this->query->split_screen);
    }

    public function test_It_Can_Add_Format_Configuration()
    {
        $format = new Format;

        $this->query->setFormat($format);

        $this->assertEquals($format, $this->query->format);
    }

    public function test_It_Can_Add_Notification_Configuration()
    {
        $urls = ['error_url' => uniqid(), 'success_url' => uniqid(), 'upload_url' => uniqid()];
        $notification = new JsonNotification;
        $notification->forError($urls['error_url'])
            ->forSuccess($urls['success_url'])
            ->forUpload($urls['upload_url']);

        $this->query->setNotification($notification);

        $payload = $this->getPayload();
        $this->assertEquals('json', $payload->query->notify_format);
        $this->assertEquals($urls['error_url'], $payload->query->notify_encoding_errors);
        $this->assertEquals($urls['success_url'], $payload->query->notify);
        $this->assertEquals($urls['upload_url'], $payload->query->notify_upload);
    }

    public function test_It_Can_Add_Region()
    {
        $region = uniqid();

        $this->query->setRegion($region);

        $payload = $this->getPayload();
        $this->assertEquals($region, $payload->query->region);
    }

    public function test_It_Can_Use_Extended_Mode_When_Boolean_True_Provided()
    {
        $expected_mode = 'yes';

        $this->query->setExtended(true);

        $payload = $this->getPayload();
        $this->assertEquals($expected_mode, $payload->query->extended);
    }

    public function test_It_Can_Not_Use_Extended_Mode_When_Boolean_False_Provided()
    {
        $this->query->setExtended(false);

        $payload = $this->getPayload();
        $this->assertNull($payload->query->extended);
    }
}
