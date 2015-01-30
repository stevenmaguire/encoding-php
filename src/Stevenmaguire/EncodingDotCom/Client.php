<?php namespace Stevenmaguire\EncodingDotCom;

use GuzzleHttp\Client as HttpClient;
use GuzzleHttp\Exception\TransferException;
use GuzzleHttp\Message\Response;
use GuzzleHttp\Subscriber\Oauth\Oauth1;

class Client
{
    /**
     * API host url
     *
     * @var string
     */
    private $api_host;

    /**
     * App id
     *
     * @var string
     */
    private $app_id;

    /**
     * API user key
     *
     * @var string
     */
    private $user_key;

    /**
     * Use HTTPS
     *
     * @var boolean
     */
    private $use_secure = false;

    /**
     * Query
     *
     * @var Stevenmaguire\EncodingDotCom\Query
     */
    private $query;

    /**
     * Create new client
     *
     * @param array $configuration
     */
    public function __construct($configuration = [])
    {
        $this->parseConfiguration($configuration);

        $this->app_id = $configuration['app_id'];
        $this->user_key = $configuration['user_key'];
        $this->api_host = $configuration['api_host'];
        $this->query = $this->getBaseQuery();
    }

    /**
     * Set action
     *
     * @param  string $action
     *
     * @return  Stevenmaguire\EncodingDotCom\Client Modified client
     */
    public function withAction($action, $extended = false)
    {
        $this->query
            ->setAction($action)
            ->setExtended($extended);
        return $this;
    }

    /**
     * Set format
     *
     * @param  Stevenmaguire\EncodingDotCom\Format $format
     *
     * @return  Stevenmaguire\EncodingDotCom\Client Modified client
     */
    public function withFormat(Format $format)
    {
        $this->query->setFormat($format);
        return $this;
    }

    /**
     * Set Http security of client
     *
     * @param boolean  $use_secure
     *
     * @return Stevenmaguire\EncodingDotCom\Client Modified client
     */
    public function withHttps($use_secure = true)
    {
        $this->use_secure = $use_secure;
        return $this;
    }

    /**
     * Set media id
     *
     * @param  string|array $media_ids
     *
     * @return  Stevenmaguire\EncodingDotCom\Client Modified client
     */
    public function withMediaId($media_ids)
    {
        if (!is_array($media_ids)) {
            $media_ids = [$media_ids];
        }
        foreach ($media_ids as $media_id) {
            $this->query->addMediaId($media_id);
        }
        return $this;
    }

    /**
     * Set notification configuration
     *
     * @param  Stevenmaguire\EncodingDotCom\Notification $notification
     *
     * @return  Stevenmaguire\EncodingDotCom\Client Modified client
     */
    public function withNotification(Notification $notification)
    {
        $this->query->setNotification($notification);
        return $this;
    }

    /**
     * Set region
     *
     * @param  string $region
     *
     * @return  Stevenmaguire\EncodingDotCom\Client Modified client
     */
    public function withRegion($region)
    {
        $this->query->setRegion($region);
        return $this;
    }

    /**
     * Add source(s)
     *
     * @param  string|array $sources
     *
     * @return  Stevenmaguire\EncodingDotCom\Client Modified client
     */
    public function withSource($sources)
    {
        if (!is_array($sources)) {
            $sources = [$sources];
        }
        foreach ($sources as $source) {
            $this->query->addSource($source);
        }
        return $this;
    }

    /**
     * Set split screen configuration
     *
     * @param  Stevenmaguire\EncodingDotCom\SplitScreen $split_screen
     *
     * @return  Stevenmaguire\EncodingDotCom\Client Modified client
     */
    public function withSplitScreen(SplitScreen $split_screen)
    {
        $this->query->setSplitScreen($split_screen);
        return $this;
    }

    /**
     * Makes a request to the Encoding.com API with Query, returns the response
     *
     * @return   stdClass The JSON response from the request
     * @throws   Stevenmaguire\EncodingDotCom\Exception
     */
    public function send()
    {
        $parameters = [
            'body' => [
                'json' => $this->query->getPayload()
            ]
        ];
        return $this->request(
            'post',
            $this->getManageUrl(),
            $parameters
        );
    }

    /**
     * Makes a request to the Encoding.com API and returns the response
     *
     * @param  integer|null $skip
     * @param  integer|null $take
     *
     * @return   stdClass The JSON response from the request
     * @throws   Stevenmaguire\EncodingDotCom\Exception
     */
    public function status($skip = null, $take = null)
    {
        $params = ['format' => 'json'];
        if (is_numeric($skip) || is_numeric($take)) {
            if (is_numeric($skip)) {
                $params['from'] = abs($skip);
            }
            if (is_numeric($take)) {
                $params['limit'] = abs($take);
            }
            return $this->request(
                'get',
                'http://status.encoding.com/archive.php',
                ['query' => $params]
            );
        }
        return $this->request(
            'get',
            'http://status.encoding.com/status.php',
            ['query' => $params]
        );
    }

    /**
     * Build and return base query with default data
     *
     * @return Stevenmaguire\EncodingDotCom\Query
     */
    private function getBaseQuery()
    {
        $query = new Query;
        return $query->setUserId($this->app_id)
            ->setUserKey($this->user_key)
            ->setNotification(new JsonNotification)
            ->setSplitScreen(new SplitScreen)
            ->setFormat(new Format);
    }

    /**
     * Parse configuration using defaults
     *
     * @param  array $configuration
     *
     * @return array $configuration
     */
    private function parseConfiguration(&$configuration = [])
    {
        $defaults = array(
            'app_id' => null,
            'user_key' => null,
            'api_host' => 'manage.encoding.com'
        );

        $configuration = array_merge($defaults, $configuration);
    }

    /**
     * Makes a request to the Encoding.com API and returns the response
     *
     * @param    string $path
     * @param    array $parameters
     *
     * @return   stdClass The JSON response from the request
     * @throws   Stevenmaguire\EncodingDotCom\Exception
     */
    private function request($verb, $path, $parameters)
    {
        try {
            $client = $this->getClient();
            $response = $client->$verb($path, $parameters);
            return json_decode($response->getBody());
        } catch (TransferException $e) {
            throw new Exception($e->getMessage());
        }
    }

    /**
     * Get Http Client
     *
     * @return GuzzleHttp\Client
     */
    public function getClient()
    {
        return new HttpClient();
    }

    /**
     * Get base url
     *
     * @return string
     */
    private function getManageUrl()
    {
        return 'http'.($this->use_secure ? 's' : '').'://' . $this->api_host;
    }
}
