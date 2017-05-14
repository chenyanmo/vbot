<?php
/**
 * Created by PhpStorm.
 * User: Losgif
 * Date: 2016/12/16
 * Time: 21:13.
 */

namespace Losgif\Vbot\Message\Entity;

use Losgif\Vbot\Message\MessageInterface;

class Location extends Message implements MessageInterface
{
    /**
     * @var string 位置链接
     */
    public $url;

    public function __construct($msg)
    {
        parent::__construct($msg);

        $this->make();
    }

    /**
     * 判断是否位置消息.
     *
     * @param $content
     *
     * @return bool
     */
    public static function isLocation($content)
    {
        return str_contains($content['Content'], 'webwxgetpubliclinkimg') && $content['Url'];
    }

    /**
     * 设置位置文字信息.
     */
    private function setLocationText()
    {
        $this->content = current(explode(":\n", $this->message));

        $this->url = $this->raw['Url'];
    }

    public function make()
    {
        $this->setLocationText();
    }
}
