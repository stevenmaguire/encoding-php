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
}
