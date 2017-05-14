<?php
/**
 * Created by PhpStorm.
 * User: Losgif
 * Date: 2017/1/15
 * Time: 12:29.
 */

namespace Losgif\Vbot\Message\Entity;

use Losgif\Vbot\Message\MessageInterface;

class Mina extends Message implements MessageInterface
{
    public $title;

    public $url;

    public function __construct($msg)
    {
        parent::__construct($msg);

        $this->make();
    }

    public function make()
    {
        $array = (array) simplexml_load_string($this->message, 'SimpleXMLElement', LIBXML_NOCDATA);

        $info = (array) $array['appmsg'];

        $this->title = $info['title'];
        $this->url = $info['url'];

        $this->content = '[小程序]';
    }
}
