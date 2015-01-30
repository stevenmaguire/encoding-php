<?php namespace Stevenmaguire\EncodingDotCom;

abstract class Notification
{
    use Traits\GetTrait;

    /**
     * Notification format
     *
     * @var string
     * @property string $format
     */
    protected $format;

    /**
     * Success url
     *
     * @var string
     * @property string $success_url
     */
    protected $success_url;

    /**
     * Errors url
     *
     * @var string
     * @property string $errors_url
     */
    protected $errors_url;

    /**
     * Uploads url
     *
     * @var string
     * @property string $upload_url
     */
    protected $upload_url;
}
