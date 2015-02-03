<?php

use Mockery as m;
use Stevenmaguire\EncodingDotCom\Client;
use Stevenmaguire\EncodingDotCom\Format;
use Stevenmaguire\EncodingDotCom\JsonNotification;
use Stevenmaguire\EncodingDotCom\Query;
use Stevenmaguire\EncodingDotCom\SplitScreen;

class ClientTest extends TestCase
{
    public function setUp()
    {
        $config = [
            'app_id' => getenv('ENCODING_DOT_COM_APP_ID'),
            'user_key' => getenv('ENCODING_DOT_COM_API_USER_KEY'),
            'api_host' => 'manage.encoding.com'
        ];

        $this->client = m::mock(
            'Stevenmaguire\EncodingDotCom\Client[getClient]',
            [$config]
        );
        $this->response = $this->mockHttpResponse();
        $this->http = $this->mockHttpClient();
    }

    private function mockHttpClient()
    {
        return m::mock('GuzzleHttp\Client');
    }

    private function mockHttpResponse()
    {
        return m::mock('GuzzleHttp\Message\Response');
    }

    private function makePayloadFromArray($array)
    {
        $object = $array;
        if (is_array($object)) {
            $object = (object) array_map(array($this, __FUNCTION__), $object);
        }
        return json_encode($object);
    }

    public function test_It_Can_Set_Action()
    {
        $action = uniqid();

        $query = $this->client->withAction($action)->getQuery();

        $this->assertEquals($action, $query->action);
        $this->assertNull($query->extended);
    }

    public function test_It_Can_Set_Action_In_Extended_Mode()
    {
        $action = uniqid();
        $expected_extended = 'yes';

        $query = $this->client->withAction($action, true)->getQuery();

        $this->assertEquals($action, $query->action);
        $this->assertEquals($expected_extended, $query->extended);
    }

    public function test_It_Can_Set_Format()
    {
        $format = new Format;

        $query = $this->client->withFormat($format)->getQuery();

        $this->assertEquals($format, $query->format);
    }

    public function test_It_Can_Set_SplitScreen_Configuration()
    {
        $split_screen = new SplitScreen;

        $query = $this->client->withSplitScreen($split_screen)->getQuery();

        $this->assertEquals($split_screen, $query->split_screen);
    }

    public function test_It_Can_Set_Notification_Configuration()
    {
        $urls = ['error_url' => uniqid(), 'success_url' => uniqid(), 'upload_url' => uniqid()];
        $notification = new JsonNotification;
        $notification->setErrorUrl($urls['error_url'])
            ->setSuccessUrl($urls['success_url'])
            ->setUploadUrl($urls['upload_url']);

        $query = $this->client->withNotification($notification)->getQuery();

        $this->assertEquals('json', $query->notify_format);
        $this->assertEquals($urls['error_url'], $query->notify_encoding_errors);
        $this->assertEquals($urls['success_url'], $query->notify);
        $this->assertEquals($urls['upload_url'], $query->notify_upload);
    }

    public function test_It_Can_Set_Single_Media_Id()
    {
        $media_id = uniqid();

        $query = $this->client->withMediaId($media_id)->getQuery();

        $this->assertEquals($media_id, $query->mediaid);
    }

    public function test_It_Can_Set_Multiple_Media_Ids_At_Once()
    {
        $count = rand(2,5);
        $media_ids = [];
        for ($i = 0; $i < $count; $i++) {
            $media_ids[] = uniqid();
        }

        $query = $this->client->withMediaId($media_ids)->getQuery();

        $this->assertEquals(implode(',', $media_ids), $query->mediaid);
    }

    public function test_It_Can_Set_Merge_Additional_Media_Ids()
    {
        $count = rand(2,5);
        $media_ids = [];
        for ($i = 0; $i < $count; $i++) {
            $media_ids[] = uniqid();
        }

        foreach ($media_ids as $media_id) {
            $this->client->withMediaId($media_id);
        }

        $query = $this->client->getQuery();

        $this->assertEquals(implode(',', $media_ids), $query->mediaid);
    }

    public function test_It_Can_Set_Single_Source()
    {
        $source = uniqid();

        $query = $this->client->withSource($source)->getQuery();

        $this->assertTrue(in_array($source, $query->source));
    }

    public function test_It_Can_Set_Multiple_Sources_At_Once()
    {
        $count = rand(2,5);
        $sources = [];
        for ($i = 0; $i < $count; $i++) {
            $sources[] = uniqid();
        }

        $query = $this->client->withSource($sources)->getQuery();

        $this->assertEquals($sources, $query->source);
    }

    public function test_It_Can_Set_Merge_Additional_Sources()
    {
        $count = rand(2,5);
        $sources = [];
        for ($i = 0; $i < $count; $i++) {
            $sources[] = uniqid();
        }

        foreach ($sources as $source) {
            $this->client->withSource($source);
        }

        $query = $this->client->getQuery();

        $this->assertEquals($sources, $query->source);
    }

    public function test_It_Can_Set_External_Query()
    {
        $new_query = new Query;

        $query = $this->client->setQuery($new_query)->getQuery();

        $this->assertEquals($new_query, $query);
    }

    public function test_It_Can_Set_Region()
    {
        $region = uniqid();

        $query = $this->client->withRegion($region)->getQuery();

        $this->assertEquals($region, $query->region);
    }

    public function test_It_Can_Communicate_With_API_With_Https()
    {
        $result = $this->makePayloadFromArray([]);

        $this->response->shouldReceive('getBody')->once()->andReturn($result);
        $this->http->shouldReceive('post')->with(
            'https://manage.encoding.com',
            m::any()
        )->once()->andReturn($this->response);
        $this->client->shouldReceive('getClient')->once()->andReturn($this->http);

        $this->client->withHttps()->send();
    }

    public function test_It_Can_Communicate_With_API_With_Http()
    {
        $result = $this->makePayloadFromArray([]);

        $this->response->shouldReceive('getBody')->once()->andReturn($result);
        $this->http->shouldReceive('post')->with(
            'http://manage.encoding.com',
            m::any()
        )->once()->andReturn($this->response);
        $this->client->shouldReceive('getClient')->once()->andReturn($this->http);

        $this->client->withHttps(false)->send();
    }


    public function test_It_Can_Get_Status_Of_Given_Media()
    {
        $action = 'GetStatus';
        $format = new Format;
        $media_id1 = '34024148';
        $media_id2 = '34024149';
        $notification = new JsonNotification;
        $region = 'us-east-1';
        $split_screen = new SplitScreen;
        $source = 'url';
        $sources = ['url','url'];

        $result = $this->makePayloadFromArray([]);

        $this->response->shouldReceive('getBody')->once()->andReturn($result);
        $this->http->shouldReceive('post')->with(
            'https://manage.encoding.com',
            m::any()
        )->once()->andReturn($this->response);
        $this->client->shouldReceive('getClient')->once()->andReturn($this->http);


        $query = $this->client->withAction($action, false)
            ->withFormat($format)
            ->withMediaId($media_id1)
            ->withMediaId($media_id1)
            ->withNotification($notification)
            ->withRegion($region)
            ->withSplitScreen($split_screen)
            ->withSource($source)
            ->withSource($sources)
            ->withHttps(true)
            ->send();
    }

    /**
     * @expectedException Stevenmaguire\EncodingDotCom\Exception
     **/
    public function test_It_Can_Throw_An_Error_When_Http_Error_Encountered()
    {
        $client = new Client([
            'app_id' => getenv('ENCODING_DOT_COM_APP_ID'),
            'user_key' => getenv('ENCODING_DOT_COM_API_USER_KEY'),
            'api_host' => 'stepbystepdaybyday.encoding.com'
        ]);
        $result = $client->send();
    }

    public function test_It_Can_Get_System_Status()
    {
        $result = $this->makePayloadFromArray(['status' => 'ok', 'status_code' => '', 'incident' => '']);

        $this->response->shouldReceive('getBody')->once()->andReturn($result);
        $this->http->shouldReceive('get')->with(
            'http://status.encoding.com/status.php',
            ['query' => ['format' => 'json']]
        )->once()->andReturn($this->response);
        $this->client->shouldReceive('getClient')->once()->andReturn($this->http);

        $result = $this->client->status();
    }

    public function test_It_Can_Get_Archived_System_Status()
    {
        $result = $this->makePayloadFromArray(['paging' => [], 'incidents' => []]);

        $this->response->shouldReceive('getBody')->once()->andReturn($result);
        $this->http->shouldReceive('get')->with(
            'http://status.encoding.com/archive.php',
            ['query' => ['format' => 'json', 'from' => '0', 'limit' => 10]]
        )->once()->andReturn($this->response);
        $this->client->shouldReceive('getClient')->once()->andReturn($this->http);

        $result = $this->client->status(0,10);
    }
}
