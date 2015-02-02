<?php namespace Stevenmaguire\EncodingDotCom;

use \stdClass;

/**
 * @property string $userid
 * @property string $userkey
 * @property string $action
 * @property string $extended
 * @property Format $format
 * @property string $mediaid
 * @property string $notify_format
 * @property string $notify
 * @property string $notify_encoding_errors
 * @property string $notify_upload
 * @property string $region
 * @property SplitScreen $split_screen
 * @property array $source
 */
class Query extends Model
{
    /**
     * Set user id
     *
     * @param string $user_id
     *
     * @return Query
     */
    public function setUserId($user_id)
    {
        return $this->setAttribute('userid', $user_id);
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
        return $this->setAttribute('userkey', $user_key);
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
        return $this->setAttribute('action', $action);
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
        $current_media_id = $this->getAttribute('mediaid');
        if (empty($current_media_id)) {
            $media_ids = [];
        } else {
            $media_ids = explode(',', $current_media_id);
        }
        $media_ids[] = $media_id;
        $updated_media_id = implode(',', $media_ids);
        return $this->setAttribute('mediaid', $updated_media_id);
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
        $current_sources = $this->getAttribute('source');
        if (empty($current_sources)) {
            $current_sources = [];
        }
        $current_sources[] = $source;
        return $this->setAttribute('source', $current_sources);
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
        return $this->setAttribute('split_screen', $split_screen);
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
        return $this->setAttribute('region', $region);
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
        return $this->setAttribute('notify_format', $notification->format)
            ->setAttribute('notify', $notification->success_url)
            ->setAttribute('notify_encoding_errors', $notification->error_url)
            ->setAttribute('notify_upload', $notification->upload_url);
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
        return $this->setAttribute('extended', ($extended ? "yes" : null));
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
        return $this->setAttribute('format', $format);
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
