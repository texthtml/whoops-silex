<?php
/**
 * Whoops - php errors for cool kids
 * @author Filipe Dobreira <http://github.com/filp>
 */

namespace WhoopsSilex;

use Pimple\Container;
use Pimple\ServiceProviderInterface;
use Silex\Application;
use Silex\Api\EventListenerProviderInterface;
use Silex\ExceptionListenerWrapper;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;
use Symfony\Component\HttpKernel\KernelEvents;
use WhoopsPimple\WhoopsServiceProvider as PimpleWhoopsServiceProvider;
use WhoopsSilex\SilexApplicationHandler;
use WhoopsSilex\RequestHandler;

class WhoopsServiceProvider implements ServiceProviderInterface, EventListenerProviderInterface
{
    public function register(Container $container)
    {
        $container->register(new PimpleWhoopsServiceProvider);
        $container['whoops']->pushHandler(new RequestHandler($container));
        if ($container instanceof Application) {
            $container['whoops']->pushHandler(new SilexApplicationHandler($container));
        }
    }

    public function subscribe(Container $container, EventDispatcherInterface $dispatcher)
    {
        if ($container instanceof Application) {
            $dispatcher->addListener(
                KernelEvents::EXCEPTION,
                new ExceptionListenerWrapper($container, $container['whoops.exception_handler']),
                -8
            );
        }
    }
}
