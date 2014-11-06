<?php

namespace WhoopsSilex;

use Silex\Application;
use Symfony\Component\HttpFoundation\Request;
use Whoops\Handler\Handler;
use Whoops\Handler\PrettyPageHandler;

class RequestHandler extends Handler
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

        $errorPageHandler = $app["whoops.error_page_handler"];
        if (!($errorPageHandler instanceof PrettyPageHandler)) {
            return;
        }

        if (!$app->offsetExists('request_stack')) {
            // This error occurred too early in the application's life
            // and the request instance is not yet available.
            return;
        }

        $this->addRequestInfo($app['request_stack']->getCurrentRequest(), $errorPageHandler);
    }

    private function addRequestInfo(Request $request, PrettyPageHandler $handler)
    {
        $handler->addDataTable('Request', array(
            'URI'          => $request->getUri(),
            'Request URI'  => $request->getRequestUri(),
            'Path Info'    => $request->getPathInfo(),
            'Query String' => $request->getQueryString() ?: '<none>',
            'HTTP Method'  => $request->getMethod(),
            'Script Name'  => $request->getScriptName(),
            'Base Path'    => $request->getBasePath(),
            'Base URL'     => $request->getBaseUrl(),
            'Scheme'       => $request->getScheme(),
            'Port'         => $request->getPort(),
            'Host'         => $request->getHost(),
        ));
    }
}
