<?php
/**
 * Created by PhpStorm.
 * User: Losgif
 * Date: 2017/2/12
 * Time: 20:44.
 */

namespace Losgif\Vbot\Message\Entity;

use Losgif\Vbot\Message\MessageInterface;

class NewFriend extends Message implements MessageInterface
{
    public function __construct($msg)
    {
        contact()->update($msg['FromUserName']);

        parent::__construct($msg);

        $this->make();
    }

    public function make()
    {
        $this->content = $this->message;
    }
}
