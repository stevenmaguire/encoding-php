<?php namespace Stevenmaguire\EncodingDotCom;

/**
 * @property string $format
 * @property string $success_url
 * @property string $errors_url
 * @property string $upload_url
 */
abstract class Notification
{
    use Traits\GetTrait;

    /**
     * Notification format
     *
     * @var string
     */
    protected $format;

    /**
     * Success url
     *
     * @var string
     */
    protected $success_url;

    /**
     * Errors url
     *
     * @var string
     */
    protected $errors_url;

    /**
     * Uploads url
     *
     * @var string
     */
    protected $upload_url;
}
