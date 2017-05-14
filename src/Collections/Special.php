<?php
/**
 * Created by PhpStorm.
 * User: Losgif
 * Date: 2016/12/13
 * Time: 20:56.
 */

namespace Losgif\Vbot\Collections;

class Special extends BaseCollection
{
    public static $instance = null;

    /**
     * create a single instance.
     *
     * @return Special
     */
    public static function getInstance()
    {
        if (static::$instance === null) {
            static::$instance = new self();
        }

        return static::$instance;
    }
}
