<?php
/**
 * Created by PhpStorm.
 * User: Losgif
 * Date: 2017/1/13
 * Time: 15:48.
 */

namespace Losgif\Vbot\Message\Entity;

use Losgif\Vbot\Message\MediaTrait;
use Losgif\Vbot\Message\MessageInterface;

class Recall extends Message implements MessageInterface
{
    use MediaTrait;

    /**
     * @var Message 上一条撤回的消息
     */
    public $origin;

    /**
     * @var string 撤回者昵称
     */
    public $nickname;

    public function __construct($msg)
    {
        parent::__construct($msg);

        $this->make();
    }

    /**
     * 解析message获取msgId.
     *
     * @param $xml
     *
     * @return string msgId
     */
    private function parseMsgId($xml)
    {
        preg_match('/<msgid>(\d+)<\/msgid>/', $xml, $matches);

        return $matches[1];
    }

    public function make()
    {
        $msgId = $this->parseMsgId($this->message);

        /* @var Message $message */
        $this->origin = message()->get($msgId, null);

        if ($this->origin) {
            $this->nickname = $this->origin->sender ? $this->origin->sender['NickName'] : account()->getAccount($this->origin->raw['FromUserName'])['NickName'];
            $this->setContent();
        }
    }

    private function setContent()
    {
        $this->content = "{$this->nickname} 刚撤回了消息";
    }
}
