<?php namespace Stevenmaguire\EncodingDotCom;

use \stdClass;
use Stevenmaguire\EncodingDotCom\Contracts\Jsonable;

class Query implements Jsonable
{
    use Traits\JsonifyTrait;

    /**
     * App id
     *
     * @var string
     */
    protected $userid;

    /**
     * API user key
     *
     * @var string
     */
    protected $userkey;

    /**
     * Action
     *
     * @var string
     */
    protected $action;

    /**
     * Media id
     *
     * @var string
     */
    protected $mediaid;

    /**
     * Display extended results
     *
     * @var string
     */
    protected $extended;

    /**
     * Sources
     *
     * @var array
     */
    protected $source = [];

    /**
     * Split screen configuration
     *
     * @var SplitScreen
     */
    protected $split_screen;

    /**
     * Region
     *
     * @var string
     */
    protected $region;

    /**
     * Notification format
     *
     * @var string
     */
    protected $notify_format;

    /**
     * Notification url for success
     *
     * @var string
     */
    protected $notify;

    /**
     * Notification url for errors
     *
     * @var string
     */
    protected $notify_encoding_errors;

    /**
     * Notification url for uploads
     *
     * @var string
     */
    protected $notify_upload;

    /**
     * Encoding format configuration
     *
     * @var Format
     */
    protected $format;

    /**
     * Set user id
     *
     * @param string $user_id
     *
     * @return Query
     */
    public function setUserId($user_id)
    {
        $this->userid = $user_id;
        return $this;
    }

    /**
     * Set user key
     *
     * @param string $user_key
     *
     * @return Query
     */
    public function setUserKey($user_key)
    {
        $this->userkey = $user_key;
        return $this;
    }

    /**
     * Set action
     *
     * @param string $action
     *
     * @return Query
     */
    public function setAction($action)
    {
        $this->action = $action;
        return $this;
    }

    /**
     * Add media id
     *
     * @param string $media_id
     *
     * @return Query
     */
    public function addMediaId($media_id)
    {
        if (empty($this->mediaid)) {
            $media_ids = [];
        } else {
            $media_ids = explode(',', $this->mediaid);
        }
        $media_ids[] = $media_id;
        $this->mediaid = implode(',', $media_ids);
        return $this;
    }

    /**
     * Add source
     *
     * @param string $source
     *
     * @return Query
     */
    public function addSource($source)
    {
        $this->source[] = $source;
        return $this;
    }

    /**
     * Set split screen configuration
     *
     * @param SplitScreen $split_screen
     *
     * @return Query
     */
    public function setSplitScreen(SplitScreen $split_screen)
    {
        $this->split_screen = $split_screen;
        return $this;
    }

    /**
     * Set region
     *
     * @param string $region
     *
     * @return Query
     */
    public function setRegion($region)
    {
        $this->region = $region;
        return $this;
    }

    /**
     * Set notification configuration
     *
     * @param Notification $notification
     *
     * @return Query
     */
    public function setNotification(Notification $notification)
    {
        $this->notify_format = $notification->format;
        $this->notify = $notification->success_url;
        $this->notify_encoding_errors = $notification->errors_url;
        $this->notify_upload = $notification->upload_url;
        return $this;
    }

    /**
     * Set extended results
     *
     * @param boolean $extended
     *
     * @return Query
     */
    public function setExtended($extended)
    {
        $this->extended = $extended ? "yes" : null;
        return $this;
    }

    /**
     * Set format configuration
     *
     * @param Format $format
     *
     * @return Query
     */
    public function setFormat(Format $format)
    {
        $this->format = $format;
        return $this;
    }

    /**
     * Convert object to json
     *
     * @return string
     */
    public function getPayload()
    {
        $payload = new stdClass;
        $payload->query = json_decode($this->toJson());
        return json_encode($payload);
    }
}
