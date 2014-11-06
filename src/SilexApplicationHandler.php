<?php

namespace WhoopsSilex;

use Silex\Application;
use Whoops\Handler\Handler;
use Whoops\Handler\PrettyPageHandler;

class SilexApplicationHandler extends Handler
{
    private $application;

    public function __construct(Application $application)
    {
        $this->application = $application;
    }

    /**
     * @inherit
     */
    public function handle()
    {
        $app = $this->application;
        $errorPageHandler = $app['whoops.error_page_handler'];
        if ($errorPageHandler instanceof PrettyPageHandler) {
            $errorPageHandler->addDataTable('Silex Application', array(
                'Version'           => $app::VERSION,
                'Charset'           => $app['charset'],
                'Route Class'       => $app['route_class'],
                'Dispatcher Class'  => $app['dispatcher_class'],
                'Application Class' => get_class($app),
            ));
        }
    }
}
