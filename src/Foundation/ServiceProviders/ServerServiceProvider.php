<?php

namespace Losgif\Vbot\Foundation\ServiceProviders;

use Losgif\Vbot\Core\Server;
use Pimple\Container;
use Pimple\ServiceProviderInterface;

class ServerServiceProvider implements ServiceProviderInterface
{
    public function register(Container $pimple)
    {
        $pimple['server'] = function ($pimple) {
            return server($pimple['config']);
        };
    }
}
