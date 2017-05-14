<?php
/**
 * Created by PhpStorm.
 * User: Losgif
 * Date: 2017/1/15
 * Time: 12:29.
 */

namespace Losgif\Vbot\Message\Entity;

use Losgif\Vbot\Message\MessageInterface;

class Touch extends Message implements MessageInterface
{
    public function __construct($msg)
    {
        parent::__construct($msg);

        $this->make();
    }

    public function make()
    {
        $this->content = '[点击事件]';
    }
}
