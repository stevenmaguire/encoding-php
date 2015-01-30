<?php namespace Stevenmaguire\EncodingDotCom;

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
