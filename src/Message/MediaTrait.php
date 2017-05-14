<?php
/**
 * Created by PhpStorm.
 * User: Losgif
 * Date: 2017/1/15
 * Time: 3:20.
 */

namespace Losgif\Vbot\Message;

use Losgif\Vbot\Support\Path;

/**
 * Class MediaTrait.
 *
 * @property string $folder
 */
trait MediaTrait
{
    public static function getPath($folder)
    {
        return Path::getCurrentUinPath().$folder.DIRECTORY_SEPARATOR;
    }
}
