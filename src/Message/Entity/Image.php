<?php
/**
 * Created by PhpStorm.
 * User: Losgif
 * Date: 2017/1/10
 * Time: 16:51.
 */

namespace Losgif\Vbot\Message\Entity;

use Losgif\Vbot\Message\MediaInterface;
use Losgif\Vbot\Message\MediaTrait;
use Losgif\Vbot\Message\MessageInterface;
use Losgif\Vbot\Message\UploadAble;
use Losgif\Vbot\Support\Console;
use Losgif\Vbot\Support\FileManager;

class Image extends Message implements MessageInterface, MediaInterface
{
    use UploadAble, MediaTrait;

    public static $folder = 'jpg';

    public function __construct($msg)
    {
        parent::__construct($msg);

        $this->make();
    }

    public static function sendByMsgId($username, $msgId)
    {
        $path = static::getPath(static::$folder);

        static::send($username, $path.$msgId.'.jpg');
    }

    public static function send($username, $file)
    {
        $response = static::uploadMedia($username, $file);

        if (!$response) {
            Console::log("图片 {$file} 上传失败", Console::WARNING);

            return false;
        }

        $mediaId = $response['MediaId'];

        $url = sprintf(server()->baseUri.'/webwxsendmsgimg?fun=async&f=json&pass_ticket=%s', server()->passTicket);
        $data = [
            'BaseRequest' => server()->baseRequest,
            'Msg'         => [
                'Type'         => 3,
                'MediaId'      => $mediaId,
                'FromUserName' => myself()->username,
                'ToUserName'   => $username,
                'LocalID'      => time() * 1e4,
                'ClientMsgId'  => time() * 1e4,
            ],
        ];
        $result = http()->json($url, $data, true);

        if ($result['BaseResponse']['Ret'] != 0) {
            Console::log('发送图片失败', Console::WARNING);

            return false;
        }

        return true;
    }

    public function make()
    {
        $this->download();

        $this->content = '[图片]';
    }

    public function download()
    {
        $url = server()->baseUri.sprintf('/webwxgetmsgimg?MsgID=%s&skey=%s', $this->raw['MsgId'], server()->skey);
        $content = http()->get($url);
        FileManager::saveToUserPath(static::$folder.DIRECTORY_SEPARATOR.$this->raw['MsgId'].'.jpg', $content);
    }
}
