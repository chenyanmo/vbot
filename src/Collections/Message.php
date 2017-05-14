<?php
/**
 * Created by PhpStorm.
 * User: Losgif
 * Date: 2016/12/13
 * Time: 20:56.
 */

namespace Losgif\Vbot\Collections;

use Illuminate\Support\Collection;

class Message extends Collection
{
    /**
     * @var Message
     */
    public static $instance = null;

    /**
     * create a single instance.
     *
     * @return Message
     */
    public static function getInstance()
    {
        if (static::$instance === null) {
            static::$instance = new self();
        }

        return static::$instance;
    }
}
