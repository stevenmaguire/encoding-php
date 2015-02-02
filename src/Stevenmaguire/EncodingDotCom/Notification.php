<?php namespace Stevenmaguire\EncodingDotCom;

/**
 * @property string $format
 * @property string $success_url
 * @property string $error_url
 * @property string $upload_url
 */
abstract class Notification extends Model
{
    /**
     * Notification format
     *
     * @var string
     */
    protected $format;

    /**
     * Create new notification
     */
    public function __construct()
    {
        $this->setAttribute('format', $this->format);
    }

    /**
     * Url to use for error notifications
     *
     * @param  string $url
     *
     * @return Notification
     */
    public function forError($url)
    {
        return $this->setAttribute('error_url', $url);
    }

    /**
     * Url to use for success notifications
     *
     * @param  string $url
     *
     * @return Notification
     */
    public function forSuccess($url)
    {
        return $this->setAttribute('success_url', $url);
    }

    /**
     * Url to use for upload notifications
     *
     * @param  string $url
     *
     * @return Notification
     */
    public function forUpload($url)
    {
        return $this->setAttribute('upload_url', $url);
    }
}
