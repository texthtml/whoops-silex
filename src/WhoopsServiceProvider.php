<?php
/**
 * Whoops - php errors for cool kids
 * @author Filipe Dobreira <http://github.com/filp>
 */

namespace WhoopsSilex;

use Pimple\Container;
use Pimple\ServiceProviderInterface;
use WhoopsPimple\WhoopsServiceProvider as PimpleWhoopsServiceProvider;
use WhoopsSilex\SilexApplicationHandler;
use WhoopsSilex\RequestHandler;

class WhoopsServiceProvider implements ServiceProviderInterface
{
    public function register(Container $container)
    {
        $container->register(new PimpleWhoopsServiceProvider);
        $container['whoops']->pushHandler(new RequestHandler($container));
        $container['whoops']->pushHandler(new SilexApplicationHandler($container));

        $container->error($container['whoops.exception_handler']);
    }
}
