<?php namespace Stevenmaguire\EncodingDotCom;

use Stevenmaguire\EncodingDotCom\Contracts\Jsonable;

class Format implements Jsonable
{
    use Traits\GetTrait;
    use Traits\JsonifyTrait;
}
