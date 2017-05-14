<?php
/**
 * Created by PhpStorm.
 * User: Losgif
 * Date: 2017/1/13
 * Time: 22:08.
 */

namespace Losgif\Vbot\Message\Entity;

use Losgif\Vbot\Message\MediaInterface;
use Losgif\Vbot\Message\MediaTrait;
use Losgif\Vbot\Message\MessageInterface;
use Losgif\Vbot\Message\UploadAble;
use Losgif\Vbot\Support\FileManager;

class Voice extends Message implements MessageInterface, MediaInterface
{
    use UploadAble, MediaTrait;

    public static $folder = 'mp3';

    public function __construct($msg)
    {
        parent::__construct($msg);

        $this->make();
    }

    /**
     * 下载文件.
     *
     * @return mixed
     */
    public function download()
    {
        $url = server()->baseUri.sprintf('/webwxgetvoice?msgid=%s&skey=%s', $this->raw['MsgId'], server()->skey);
        $content = http()->get($url);
        FileManager::saveToUserPath(static::$folder.DIRECTORY_SEPARATOR.$this->raw['MsgId'].'.mp3', $content);
    }

    public function make()
    {
        $this->download();
    }
}
